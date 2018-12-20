<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AuctionRequest;
use App\AuctionOffer;

class AuctionRequestController extends Controller
{

    public function __construct()
    {
       $this->middleware('verifyApiJWT:Buyer,true')->only(['pay_for_offer']);
    }

    public function list(Request $request)
    {
         $val = $request->search;
         $buyer_id = $request->buyer_id;
         $category_id = $request->category_id;
         $AuctionRequest = AuctionRequest::select('auction_requests.id','auction_requests.buyer_id','auction_requests.company_id','auction_requests.title',
                            'auction_requests.description','auction_requests.required_quantity','auction_requests.image',
                'categories.name_ar as category_name_ar',
                'categories.name_en as category_name_en', \DB::raw("IFNULL(winner_offer_id,0) as winner_offer_id"),
                \DB::raw("IF(payment_method,1,0) as is_deal_done"),
                \DB::raw("IF(winner_offer.price_offer,winner_offer.price_offer,0) as price_offerd"),
                \DB::raw("DATEDIFF(auction_requests.to,now()) as days_left"), \DB::raw("now()"), 
                'buyers.name as buyer_name','companies.name_ar as company_name_ar','companies.name_en as company_name_en')
          ->where(function($q)use($val,$category_id){
              if ($val)
                  $q->where('title','like','%'.$val.'%')->orWhere('auction_requests.id',$val)
                        ->orWhere('buyers.name','like','%'.$val.'%')->orWhere('companies.name_ar','like','%'.$val.'%')
                        ->orWhere('companies.name_en','like','%'.$val.'%');
              if ($category_id)
                  $q->where('category_id',$category_id);
         })
         ->where('buyers.id',$buyer_id)
         ->join('categories','categories.id','auction_requests.category_id')
         ->leftJoin('buyers','buyers.id','auction_requests.buyer_id')
         ->leftJoin('auction_offers as winner_offer','winner_offer.id','auction_requests.winner_offer_id')
         ->leftJoin('companies','companies.id','auction_requests.company_id')
         ->groupBy('auction_requests.id')
         ->latest('auction_requests.id')->paginate();
         return $AuctionRequest;
    }

    public function offers_list($auction_id)
    {
        $AuctionRequest = AuctionRequest::findOrFail($auction_id);
        $winner_offer_id = $AuctionRequest->winner_offer_id;
        $payment_method = $AuctionRequest->payment_method??0;
        $Offers = AuctionOffer::select('auction_offers.*','companies.name_en as company_name_en','companies.name_ar as company_name_ar',
                                       'companies.phone as company_phone',
                                       \DB::raw("IF(auction_offers.id = '$winner_offer_id' ,1,0 ) as winner")  ,
                                       \DB::raw("IF(auction_offers.id = '$winner_offer_id' ,$payment_method,0 ) as is_deal_done") )
                    ->where('auction_request_id',$auction_id)
                    ->join('companies','companies.id','auction_offers.company_id')
                    ->groupBy('auction_offers.id')
                    ->orderBy('auction_offers.price_offer')->get();
        return  $Offers;
    }

    //add auction
    public function store(Request $request)
    {
          $validator = \Validator::make($request->all(), [
              'buyer_id' => 'required',
              'title' => 'required',
              'description' => 'required',
              'required_quantity' => 'required',
              'category_id' => 'required',
              'image' => 'required',
          ]);
          if ($validator->fails()) { return response()->json([ 'status' => 'notValid' , 'data' => $validator->messages() ]);  }
          $Auction = AuctionRequest::create($request->except('_token'));

          $Matched_company_ids = \App\Item::where('category_id',$Auction->category_id)->distinct('company_id')->pluck('company_id');

          $Companies = \App\Company::whereIn('id',$Matched_company_ids)->get();

          \Notification::send($Companies, new \App\Notifications\AuctionMatchedWithCompany($Auction));

          return response()->json([
              'status' => 'success'
          ]);
    }


    public function accapt_offer(Request $request)
    {
          $validator = \Validator::make($request->all(), [
              'buyer_id' => 'required',
              'auction_request_id' => 'required',
              'offer_id' => 'required',
          ]);
          if ($validator->fails()) { return response()->json([ 'status' => 'notValid' , 'data' => $validator->messages() ]);  }

          $AuctionRequest = AuctionRequest::whereId($request->auction_request_id)->where('buyer_id',$request->buyer_id)->whereNull('winner_offer_id')->first();
          $AuctionOffer = AuctionOffer::whereId($request->offer_id)->first();
          if(!$AuctionOffer){
              return response()->json([
                  'status' => 'wrong AuctionOffer id',
              ]);
          }

          if($AuctionRequest)
          {
                $AuctionRequest->update([ 'winner_offer_id' => $AuctionOffer->id ]);

                $Company = \App\Company::whereId($AuctionOffer->company_id)->first();
                \Notification::send($Company, new \App\Notifications\AuctionOfferHasAccapted($AuctionOffer,$AuctionRequest));


                return response()->json([
                    'status' => 'success',
                    'accapted_offer_id' => $AuctionOffer->id,
                    'auction_request_id' => $request->auction_request_id
                ]);
          }
          else{
              return response()->json([
                  'status' => 'wrong AuctionRequest id or deal is finshed',
                  'accapted_offer_id' => $AuctionOffer->id
              ]);
          }
    }

    public function pay_for_offer(Request $request)
    {
          $validator = \Validator::make($request->all(), [
              'buyer_id' => 'required',
              'offer_id' => 'required',
              'payment_method' => 'required',
              'is_paid' => 'required',
          ]);
          if ($validator->fails()) { return response()->json([ 'status' => 'notValid' , 'data' => $validator->messages() ]);  }
          $Offer = AuctionOffer::findOrFail( $request->offer_id );
          $AuctionRequest = AuctionRequest::whereId($Offer->auction_request_id)->where('buyer_id',$request->buyer_id)->first();
          if( $AuctionRequest->winner_offer_id != $request->offer_id ){
              return response()->json([
                  'status' => 'not_a_winner_offer'
              ]);
          }
          if( $AuctionRequest->payment_method ){
              return response()->json([
                  'status' => 'already_payment_method_determined'
              ]);
          }
          $AuctionRequest->update([
            'payment_method' => $request->payment_method,
            'is_paid' => $request->is_paid,
          ]);
          return response()->json([
              'status' => 'success'
          ]);
    }


}
