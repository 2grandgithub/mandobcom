<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recipt;
use App\ReciptItem;

class ReciptController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth:Company');
       // $this->middleware('lang');
    }

    public function index()
    {
        $lang = app()->getLocale()??'ar';
        return view('Company.Recipt.index' );
    }

    //---api---
    public function get_list(Request $request)
    {
         $lang = app()->getLocale()??'ar';
         $val = $request->search;
         $case = $request->case;

         $Recipt = Recipt::select('recipts.*','buyers.name as buyer_name','buyers.id as buyer_id','buyers.phone as buyer_phone',
                                  'buyers.email as buyer_email'  )
          ->where(function($q)use($val,$case){
              if ($val)
                  $q->orWhere('buyers.phone',$val)->orWhere('buyers.name','like','%'.$val.'%')
                    ->orWhere('recipts.id',$val)->orWhere('buyers.id',$val)->orWhere('buyers.phone',$val)->orWhere('buyers.email',$val);
              if($case=='is_paid')
                  $q->where('is_paid',1)->where('is_delivered',0);
              elseif($case=='is_delivered')
                  $q->where('is_paid',0)->where('is_delivered',1);
              elseif($case=='is_paid_AND_delivered')
                  $q->where('is_paid',1)->where('is_delivered',1);
         })
         ->join('buyers','buyers.id','recipts.buyer_id')
         ->where( 'company_id',auth('Company')->id() )
         ->groupBy('recipts.id')
         ->latest('recipts.id')->paginate();
         return $Recipt;
    }

    public function items_list($recipt_id)
    {
        $lang = app()->getLocale()??'ar';
        $ReciptItem = ReciptItem::select(
                          'recipt_items.*' ,'items.name_'.$lang.' as item_name',
                          \DB::raw("CONCAT('".asset('images/items')."/',items_images.image) as item_image") ,
                          'offers.name_'.$lang.' as offer_name',
                          \DB::raw("CONCAT('".asset('images/offers')."/',offers_images.image) as offer_image")
                        )
                    ->leftJoin('items','items.id','recipt_items.item_id')
                    ->leftJoin('offers','offers.id','recipt_items.offer_id')
                    ->leftJoin('items_images','items_images.item_id','items.id')
                    ->leftJoin('offers_images','offers_images.offer_id','offers.id')
                    ->where('recipt_items.receipt_id',$recipt_id)
                    ->groupBy('recipt_items.id')
                    ->get();
        return $ReciptItem;
    }

    public function offers_list($auction_id)
    {
       $lang = app()->getLocale()??'ar';
        $Offers = AuctionOffer::select('auction_offers.*','companies.name_'.$lang.' as company_name','companies.phone as company_phone')
                    ->where('auction_request_id',$auction_id)
                    ->join('companies','companies.id','auction_offers.company_id')
                    ->groupBy('auction_offers.id')
                    ->orderBy('auction_offers.price_offer')->get();
        return $Offers;
    }


    //--api--
    public function make_paided($recipt_id)
    {
         $Recipt = Recipt::findOrFail($recipt_id);
         if( $Recipt->is_paid )
         {
            $Recipt->update(['is_paid' => '0']);
            $case = [
              'is_cancled' => $Recipt->is_cancled,
              'is_paid' => 0,
              'is_delivered' => $Recipt->is_delivered
            ];
         }
         else
         {
            $Recipt->update(['is_paid' => '1']);
            $case = [
              'is_cancled' => 0,
              'is_paid' => 1,
              'is_delivered' => $Recipt->is_delivered
            ];
         }

         return response()->json([
             'status' => 'success',
             'case' => $case
         ]);
    }

    public function make_delivered($recipt_id)
    {
         $Recipt = Recipt::findOrFail($recipt_id);
         if( $Recipt->is_delivered )
         {
            $Recipt->update(['is_delivered' => 0]);
            $case = [
              'is_cancled' => $Recipt->is_cancled,
              'is_paid' => $Recipt->is_paid,
              'is_delivered' => 0
            ];
         }
         else
         {
            $Recipt->update(['is_delivered' => '1']);
            $case = [
              'is_cancled' => 0,
              'is_paid' => $Recipt->is_paid,
              'is_delivered' => 1
            ];
         }

         return response()->json([
             'status' => 'success',
             'case' => $case
         ]);
    }

    public function make_cancled($recipt_id)
    {
         $Recipt = Recipt::findOrFail($recipt_id);
         if( $Recipt->is_cancled )
         {
            $case = [
              'is_cancled' => 0,
              'is_paid' => $Recipt->is_paid,
              'is_delivered' => $Recipt->is_delivered
            ];
            $Recipt->update(['is_cancled' => 0]);
         }
         else
         {
             $case = [
               'is_cancled' => 1,
               'is_paid' => 0,
               'is_delivered' => 0
             ];
            $Recipt->update($case);
         }

         return response()->json([
             'status' => 'success',
             'case' => $case
         ]);
    }


    //---api----
    public function destroy($id)
    {
         try {
           $deleted = Recipt::destroy($id);
         } catch (\Exception $e) {
           return 'false';
         }
         return 'true';
    }

    public function invoice($id)
    {
          $Recipt = Recipt::select('recipts.*','buyers.name as buyer_name','buyers.id as buyer_id','buyers.phone as buyer_phone',
                                   'buyers.email as buyer_email' ,
                                   \DB::raw("CONCAT(buyers.aramex_CountryCode,' - ',buyers.aramex_City) as buyer_location"))
          ->join('buyers','buyers.id','recipts.buyer_id')
          ->where('recipts.id',$id)->where( 'company_id',auth('Company')->id() )
          ->groupBy('recipts.id')
          ->first();

          if(!$Recipt){
             return back();
          }

          $lang = app()->getLocale()??'ar';
          $ReciptItem = ReciptItem::select(
                           'recipt_items.*' ,'items.name_'.$lang.' as item_name',
                           'offers.name_'.$lang.' as offer_name',
                           \DB::raw("CASE
                                       WHEN items.id  THEN  CONCAT('".asset('images/items')."/',items_images.image)
                                       WHEN offers.id THEN  CONCAT('".asset('images/offers')."/',offers_images.image)
                                    ENd as image"),
                           \DB::raw("CASE
                                       WHEN items.id  THEN  SUBSTRING( items.description_$lang , 1, 100)
                                       WHEN offers.id THEN  SUBSTRING( offers.description_$lang , 1, 100)
                                    ENd as substring_description")
                          )
                      ->leftJoin('items','items.id','recipt_items.item_id')
                      ->leftJoin('offers','offers.id','recipt_items.offer_id')
                      ->leftJoin('items_images','items_images.item_id','items.id')
                      ->leftJoin('offers_images','offers_images.offer_id','offers.id')
                      ->where('recipt_items.receipt_id',$Recipt->id)
                      ->groupBy('recipt_items.id')
                      ->get();
          return  view('Company.Recipt.invoice',compact('Recipt','ReciptItem','lang') );
    }


}
