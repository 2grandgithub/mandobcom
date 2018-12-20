<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Company;
use App\Category;

class ItemController extends Controller
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
          return view('Admin.Item.index',compact('Company','Category'));
      }

      //---api----
      public function get_list(Request $request)
      {
           $lang = app()->getLocale()??'ar';
           $search = $request->all();
           $items = Item::select('items.*','categories.name_'.$lang.' as category_name','sub_categories.name_'.$lang.' as sub_category_name',
                                'companies.name_'.$lang.' as company_name',
                   \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/items')."/',items_images.image)) as image")   )
           ->where(function($q)use($search){
                if (isset($search['text']))
                   $q->where('items.name_en','like','%'.$search['text'].'%')->orWhere('items.code',$search['text'])
                     ->orWhere('items.name_ar','like','%'.$search['text'].'%')->orWhere('items.id',$search['text']);
                if (isset($search['company_id']))
                   $q->where('items.company_id',$search['company_id']);
                if (isset($search['category_id']))
                   $q->where('items.category_id',$search['category_id']);
                if (isset($search['accapted_by_admin']))
                {
                     if($search['accapted_by_admin'] == 'yes')
                        $q->where('accapted_by_admin',1);
                     else if($search['accapted_by_admin'] == 'no')
                        $q->where('accapted_by_admin',0);
                }
            })
            ->Join('categories','categories.id','items.category_id')
            ->leftJoin('sub_categories','sub_categories.id','items.sub_category_id')
            ->Join('companies','companies.id','items.company_id')
            ->Join('items_images','items_images.item_id','items.id')
            ->groupBy('items.id')
            ->latest('id')->paginate();
            return $items;
      }

      //--api--
      public function showORhide($id)
      {
           $Item = Item::findOrFail($id);
           if( $Item->status )
           {
              $Item->update(['status' => '0']);
              $case = 0;
           }
           else
           {
              $Item->update(['status' => '1']);
              $case = 1;
           }

           return response()->json([
               'status' => 'success',
               'case' => $case
           ]);
      }

      public function accaptance_by_admin($id)
      {
           $Item = Item::findOrFail($id);
           if( $Item->accapted_by_admin )
           {
              $Item->update(['accapted_by_admin' => '0']);
              $case = 0;
           }
           else
           {
              $Item->update(['accapted_by_admin' => '1']);
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
             $deleted = Item::destroy($id);
           } catch (\Exception $e) {
             return 'false';
           }
           return 'true';
      }
}
