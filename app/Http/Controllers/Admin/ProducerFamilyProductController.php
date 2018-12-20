<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProducerFamilyProduct;

class ProducerFamilyProductController extends Controller
{
      public function __construct()
      {
         $this->middleware('auth');
         $this->middleware('lang');
      }

      public function index()
      {
          $lang = app()->getLocale()??'ar';
          return view('Admin.ProducerFamilyProduct.index',compact('Company','Category'));
      }

      //---api----
      public function get_list(Request $request)
      {
           $lang = app()->getLocale()??'ar';
           $search = $request->all();
           $ProducerFamilyProducts = ProducerFamilyProduct::select('producer_family_products.*','producer_family.name as family')
           ->where(function($q)use($search){
                if (isset($search['text']))
                   $q->where('producer_family_products.name_en','like','%'.$search['text'].'%')
                     ->orWhere('producer_family_products.name_ar','like','%'.$search['text'].'%')
                     ->orWhere('producer_family.name','like','%'.$search['text'].'%')
                     ->orWhere('producer_family_products.id',$search['text']);
            })
            ->join('producer_family','producer_family.id','producer_family_products.ProducerFamily_id')
            ->groupBy('producer_family_products.id')
            ->latest('producer_family_products.id')->paginate();
            return $ProducerFamilyProducts;
      }

      //--api--
      public function showORhide($id)
      {
           $ProducerFamilyProduct = ProducerFamilyProduct::findOrFail($id);
           if( $ProducerFamilyProduct->status )
           {
              $ProducerFamilyProduct->update(['status' => '0']);
              $case = 0;
           }
           else
           {
              $ProducerFamilyProduct->update(['status' => '1']);
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
             $deleted = ProducerFamilyProduct::destroy($id);
           } catch (\Exception $e) {
             return 'false';
           }
           return 'true';
      }
}
