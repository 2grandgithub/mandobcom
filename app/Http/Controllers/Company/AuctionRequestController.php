<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AuctionRequest;
use App\Category;
use App\AuctionOffer;

class AuctionRequestController extends Controller
{
    public $membership_info ;

    public function __construct()
    {
       $this->middleware('auth:Company');
       // $this->middleware('lang');
    }

    public function check_auction_membership()
    {
        $membership_info = \App\Functions::company_membership_info();
        if(isset($membership_info->see_auctions)) {
            return true;
        }
        else {
          return false;
        }
    }

    public function index()
    {
         if( ! $this->check_auction_membership() )
          return back() ;
        $lang = app()->getLocale()??'ar';
        $Category = Category::select('name_'.$lang.' as label','id as value')->orderBy('name_'.$lang)->get();
        return view('Company.AuctionRequest.index',compact('Category'));
    }

    //---api---
    public function get_list(Request $request)
    {
          if( ! $this->check_auction_membership() )
           return back() ;
         $lang = app()->getLocale()??'ar';
         $val = $request->search;
         $category_id = $request->category_id;
         $company_id = $request->company_id;
         $AuctionRequest = AuctionRequest::select('auction_requests.*','categories.name_'.$lang.' as category_name',
                'buyers.name as buyer_name','companies.name_'.$lang.' as company_name','companies.id as company_id',
                'from','to')
          ->where(function($q)use($val,$category_id,$company_id,$lang){
              if ($val)
                  $q->where('title','like','%'.$val.'%')->orWhere('auction_requests.id',$val)
                        ->orWhere('buyers.name','like','%'.$val.'%')->orWhere('companies.name_'.$lang,'like','%'.$val.'%');
              if ($category_id)
                  $q->where('category_id',$category_id);
              if ($company_id)
                  $q->where('company_id',$company_id);
         })
         ->whereRaw("NOW() BETWEEN `from` AND `to` ")
         ->where('auction_requests.status',1)
         ->join('categories','categories.id','auction_requests.category_id')
         ->leftJoin('buyers','buyers.id','auction_requests.buyer_id')
         ->leftJoin('companies','companies.id','auction_requests.company_id')
         ->groupBy('auction_requests.id')
         ->latest('auction_requests.id')->paginate();
         return $AuctionRequest;
    }

    public function offers_list($auction_id)
    {
      if( ! $this->check_auction_membership() )
       return back() ;
       $lang = app()->getLocale()??'ar';
        $Offers = AuctionOffer::select('auction_offers.*','companies.name_'.$lang.' as company_name','companies.phone as company_phone')
                    ->where('auction_request_id',$auction_id)
                    ->join('companies','companies.id','auction_offers.company_id')
                    ->groupBy('auction_offers.id')
                    ->orderBy('auction_offers.price_offer')->get();
        return  $Offers;
    }


    //---api----
    public function destroy($id)
    {
         try {
           $deleted = AuctionRequest::destroy($id);
         } catch (\Exception $e) {
           return 'false';
         }
         return 'true';
    }

    public function add_offer(Request $request)
    {
          if( ! $this->check_auction_membership() )
            return back() ;
          $validator = \Validator::make($request->all(), [
              'auction_request_id' => 'required',
              'price_offer' => 'required',
              'comment' => 'required',
          ]);
          if ($validator->fails()) { return response()->json([ 'status' => 'notValid' , 'data' => $validator->messages() ]);  }
          $request->merge(['company_id' => auth('Company')->id() ]);
          $AuctionOffer = AuctionOffer::create($request->except('_token'));

          $AuctionRequest = AuctionRequest::find($request->auction_request_id);
          if($AuctionRequest->company_id)
          {
              $Companies = \App\Company::whereId($AuctionRequest->company_id)->first();
              \Notification::send($Companies, new \App\Notifications\AuctionHasNewOffer($AuctionOffer,$AuctionRequest));
          }

          return response()->json([
              'status' => 'success'
          ]);
    }

    public function accapt_offer($offer_id)
    {
          $AuctionOffer = AuctionOffer::whereId($offer_id)->first();
          $AuctionRequest = AuctionRequest::whereId($AuctionOffer->auction_request_id)->whereNull('winner_offer_id')->first();
          $AuctionRequest->update([ 'winner_offer_id' => $offer_id ]);

        if( \Session::get('lang') == 'ar' )
          { \Session::flash('flash_message',' تم الموافقة علي العرض ');  }
        else
          { \Session::flash('flash_message',' offer has appacpted ');  }

        return back();
        // return response()->json([
        //     'status' => 'success',
        //     'accapted_offer_id' => $offer_id
        // ]);
    }


    public function add_auction(Request $request)
    {
          if( ! $this->check_auction_membership() )
            return back() ;
          $validator = \Validator::make($request->all(), [
              'title' => 'required',
              'description' => 'required',
              'required_quantity' => 'required',
              'category_id' => 'required',
              'image' => 'required',
          ]);
          if ($validator->fails()) { return response()->json([ 'status' => 'notValid' , 'data' => $validator->messages() ]);  }
          $request->merge(['company_id' => auth('Company')->id() ]);
          $Auction = AuctionRequest::create($request->except('_token'));

          // $Matched_company_ids = \App\Item::where('category_id',$Auction->category_id)->distinct('company_id')->pluck('company_id');
          // $Companies = \App\Company::whereIn('id',$Matched_company_ids)->get();
          // \Notification::send($Companies, new \App\Notifications\AuctionMatchedWithCompany($Auction));

          return response()->json([
              'status' => 'success'
          ]);
    }

    public function make_payment($auction_id)
    { 
        $AuctionRequest = AuctionRequest::whereId($auction_id)->where('company_id', auth('Company')->id() )->first();
        $Offer = AuctionOffer::findOrFail( $AuctionRequest->winner_offer_id );
        if( !$AuctionRequest->winner_offer_id ){
          if( \Session::get('lang') == 'ar' )
            { \Session::flash('flash_message',' لم تفز بالمناقصة ');   }
          else
            { \Session::flash('flash_message',' must win the auction ');  }
            return back();
        }
        if( $AuctionRequest->payment_method ){
            if( \Session::get('lang') == 'ar' )
              { \Session::flash('flash_message',' تم الانتهاء من المناقصة مسبقا ');   }
            else
              { \Session::flash('flash_message',' deal is already done ');  }
              return back();
        }
        $AuctionRequest->update([
          'payment_method' => $_GET['paymentMethod'],
          'is_paid' =>  ($_GET['paymentMethod'] =='credit card' )?1:0,
        ]);
        if( \Session::get('lang') == 'ar' )
          { \Session::flash('flash_message',' تم اتمام الصفقة ');   }
        else
          { \Session::flash('flash_message',' deal is has been done ');  }
          return redirect('Company/MyAuctionRequest');
    }


}
