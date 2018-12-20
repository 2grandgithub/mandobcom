<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Offer;
use App\Company;
use App\Category;

class OfferController extends Controller
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
          $Category = Category::select('name_'.$lang.' as label','id as value')->get();
          return view('Admin.Offer.index',compact('Company','Category'));
      }

      //---api----
      public function get_list(Request $request)
      {
           $lang = app()->getLocale()??'ar';
           $search = $request->all();
           $Offers = Offer::select('offers.*','categories.name_'.$lang.' as category_name','sub_categories.name_'.$lang.' as sub_category_name',
            'companies.name_'.$lang.' as company_name',
                   \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/offers')."/',offers_images.image)) as image")   )
           ->where(function($q)use($search){
                if (isset($search['text']))
                   $q->where('offers.name_en','like','%'.$search['text'].'%')
                     ->orWhere('offers.name_ar','like','%'.$search['text'].'%')->orWhere('offers.id',$search['text']);
                if (isset($search['company_id']))
                   $q->where('company_id',$search['company_id']);
                if (isset($search['category_id']))
                   $q->where('category_id',$search['category_id']);
                if (isset($search['accapted_by_admin']))
                {
                    if($search['accapted_by_admin'] == 'yes')
                      $q->where('accapted_by_admin',1);
                    else if($search['accapted_by_admin'] == 'no')
                      $q->where('accapted_by_admin',0);
                }
            })
            ->Join('categories','categories.id','offers.category_id')
            ->leftJoin('sub_categories','sub_categories.id','offers.sub_category_id')
            ->Join('companies','companies.id','offers.company_id')
            ->Join('offers_images','offers_images.offer_id','offers.id')
            ->groupBy('offers.id')
            ->latest('id')->paginate();
            return $Offers;
      }

      //--api--
      public function showORhide($id)
      {
           $Offer = Offer::findOrFail($id);
           if( $Offer->status )
           {
              $Offer->update(['status' => '0']);
              $case = 0;
           }
           else
           {
              $Offer->update(['status' => '1']);
              $case = 1;
           }

           return response()->json([
               'status' => 'success',
               'case' => $case
           ]);
      }

      //--api--
      public function accaptance_by_admin($id)
      {
           $Offer = Offer::findOrFail($id);
           if( $Offer->accapted_by_admin )
           {
              $Offer->update(['accapted_by_admin' => '0']);
              $case = 0;
           }
           else
           {
              $Offer->update(['accapted_by_admin' => '1']);
              $case = 1;
           }

           return response()->json([
               'status' => 'success',
               'case' => $case
           ]);
      }

      //--api--
      public function destroy($id)
      {
           try {
             $deleted = Offer::destroy($id);
           } catch (\Exception $e) {
             return 'false';
           }
           return 'true';
      }
}
