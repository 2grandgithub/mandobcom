<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recipt;
use App\ReciptItem;
use App\Company;

class ReciptController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        $lang = app()->getLocale()??'ar';
        $Company = Company::select('name_'.$lang.' as label','id as value')->get();
        return view('Admin.Recipt.index',compact('Company' ) );
    }

    //---api---
    public function get_list(Request $request)
    {
         $lang = app()->getLocale()??'ar';
         $val = $request->search;
         $company_id = $request->company_id;
         $case = $request->case;
         $from = $request->from;
         $to = $request->to;

         $Recipt = Recipt::select('recipts.*','buyers.name as buyer_name','buyers.id as buyer_id','buyers.phone as buyer_phone','buyers.email as buyer_email',
                 'companies.name_'.$lang.' as company_name','companies.email as company_email','companies.phone as company_phone',
                 'companies.id as company_id')
          ->where(function($q)use($val,$company_id,$case,$from,$to){
              if ($val)
                  $q->where('buyers.phone',$val)->orWhere('buyers.name','like','%'.$val.'%')
                    ->orWhere('recipts.id',$val)->orWhere('buyers.id',$val);
              if($company_id)
                  $q->where('recipts.company_id',$company_id);
              //---status---
              if($case=='is_paid')
                  $q->where('is_paid',1)->where('is_delivered',0);
              elseif($case=='is_delivered')
                  $q->where('is_paid',0)->where('is_delivered',1);
              elseif($case=='is_paid_AND_delivered')
                  $q->where('is_paid',1)->where('is_delivered',1);
              elseif($case=='is_cancled')
                  $q->where('is_cancled',1);
              //----date----
              if($from && $to)
                $q->where(\DB::raw('date(recipts.created_at)'),'>=',$from)->where(DB::raw('date(recipts.created_at)'),'<=',$to);
              else if($from)
                $q->where(\DB::raw('date(recipts.created_at)'),'>=',$from);
              else if($to)
                $q->where(\DB::raw('date(recipts.created_at)'),'<=',$to);

         })
         ->join('buyers','buyers.id','recipts.buyer_id')
         ->join('companies','companies.id','recipts.company_id')
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
        return  $Offers;
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
         $lang = app()->getLocale()??'ar';
         $Recipt = Recipt::select('recipts.*','buyers.name as buyer_name','buyers.id as buyer_id','buyers.phone as buyer_phone','buyers.email as buyer_email',
                  'companies.name_'.$lang.' as company_name','companies.email as company_email','companies.phone as company_phone',
                   \DB::raw("CONCAT(buyers.aramex_CountryCode,' - ',buyers.aramex_City) as buyer_location") ,
                   \DB::raw("CONCAT(companies.aramex_CountryCode,' - ',companies.aramex_City) as company_location") ,
                  'companies.id as company_id' , \DB::raw("CONCAT('".asset('images/companies')."/',logo) as logo")
               )
         ->where('recipts.id',$id)      
         ->join('buyers','buyers.id','recipts.buyer_id')
         ->join('companies','companies.id','recipts.company_id')
         ->groupBy('recipts.id')
         ->first();


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
             return view('Admin.Recipt.invoice',compact('Recipt','ReciptItem','lang') );
    }


}
