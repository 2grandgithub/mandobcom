<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AuctionRequest;
use App\Category;
use App\AuctionOffer;

class AuctionRequestController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        $lang = app()->getLocale()??'ar';
        $Category = Category::select('name_'.$lang.' as label','id as value')->orderBy('name_'.$lang)->get();
        return view('Admin.AuctionRequest.index',compact('Category'));
    }

    //---api---
    public function get_list(Request $request)
    {
         $lang = app()->getLocale()??'ar';
         $val = $request->search;
         $category_id = $request->category_id;
         $AuctionRequest = AuctionRequest::select('auction_requests.*','categories.name_'.$lang.' as category_name',
                'buyers.name as buyer_name','companies.name_'.$lang.' as company_name',
                'auction_offers.price_offer as price_offer','winer_company.name_'.$lang.' as winer_company_name',
                'auction_requests.from as from_date','auction_requests.to as to_date',
                \DB::raw("CASE
                              WHEN NOW() BETWEEN `from` AND `to` THEN 'current'
                              WHEN NOW() < `from` THEN 'future'
                              WHEN NOW() > `to` THEN 'finshed'
                              ELSE 'notAccapted'
                          END as auction_case ")
                )
          ->where(function($q)use($val,$category_id,$lang){
              if ($val)
                  $q->where('title','like','%'.$val.'%')->orWhere('auction_requests.id',$val)
                        ->orWhere('buyers.name','like','%'.$val.'%')->orWhere('companies.name_'.$lang,'like','%'.$val.'%');
              if ($category_id)
                  $q->where('category_id',$category_id);
         })
         ->join('categories','categories.id','auction_requests.category_id')
         ->leftJoin('buyers','buyers.id','auction_requests.buyer_id')
         ->leftJoin('companies','companies.id','auction_requests.company_id')
         ->leftJoin('auction_offers','auction_offers.id','auction_requests.winner_offer_id')
         ->leftJoin('companies as winer_company','winer_company.id','auction_offers.company_id')
         ->groupBy('auction_requests.id')
         ->latest('auction_requests.id')->paginate();
         return $AuctionRequest;
    }

    public function offers_list($auction_id)
    {
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


    public function store(Request $request)
    {
          $data = $request->validate([
            'name' => 'required',
          ]);
          if ($request->has('status'))
              $data['status'] = 1;
          else
            $data['status'] = 0;
          if ($request->image)
          {
             $fileName  = rand(11111,99999).'.'.$request->image->getClientOriginalExtension(); // renameing image
             $destinationPath = public_path('images/AuctionRequests');
             $request->image->move($destinationPath, $fileName); // uploading file to given path
             $data['image'] = $fileName;
          }

          $AuctionRequest = AuctionRequest::create($data);
          \Session::flash('flash_message',' الشركة اضافت ');
          return back();
    }


    public function update(Request $request)
    {
        $data = $request->validate([
          'name' => 'required',
          'id' => 'required',
        ]);
        $AuctionRequest = AuctionRequest::findOrFail($request->id);
        if ($request->has('status'))
            $data['status'] = 1;
        else
          $data['status'] = 0;
        if ($request->image)
        {
           $fileName  = rand(11111,99999).'.'.$request->image->getClientOriginalExtension(); // renameing image
           $destinationPath = public_path('images/AuctionRequests');
           $request->image->move($destinationPath, $fileName); // uploading file to given path
           $data['image'] = $fileName;
        }

        $AuctionRequest->update($data);
        \Session::flash('flash_message',' الشركة اتعدلت');
        return back();
    }

    //--api--
    public function unAccaptedAuction($id)
    {
         $Car = AuctionRequest::findOrFail($id);
         $Car->update([
           'status' => '0',
           'from' => null,
           'to' => null,
         ]);

         return response()->json([
             'status' => 'success',
             'case' => 0
         ]);
    }

    public function accaptAuction(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required',
            'from' => 'required|date',
            'to' => 'required|date|after:from',
        ]);
        if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }
        $Auction = AuctionRequest::findOrFail($request->id);
        $Auction->update([
          'status' => '1',
          'from' => $request->from,
          'to' => $request->to,
        ]);

        $Matched_company_ids = \App\Item::where('category_id',$Auction->category_id)->distinct('company_id')->pluck('company_id');
        $Companies = \App\Company::whereIn('id',$Matched_company_ids)->where('id','!=',$Auction->company_id)->get();
        \Notification::send($Companies, new \App\Notifications\AuctionMatchedWithCompany($Auction));

        return response()->json([
            'status' => 'success',
            'case' => 1,
        ]);
    }


}
