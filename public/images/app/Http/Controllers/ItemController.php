<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\ItemImages;
use App\Category;
use App\SubCategory;

class ItemController extends Controller
{
      public function __construct()
      {
         $this->middleware('auth:Company');
         // $this->middleware('lang');
      }

      public function index()
      {
          $lang = \App::getLocale()??'ar';
          $Category = Category::select('name_'.$lang.' as label','id as value')->get();
          foreach ($Category as $cat) {
             $cat->SubCategory = SubCategory::where('category_id',$cat->value)->select('name_'.$lang.' as label','id as value')->get();
          }
          return view('Company.Item.index',compact( 'Category'));
      }

      //---api----
      public function get_list(Request $request)
      {
           $lang = app()->getLocale()??'ar';
           $search = $request->all();
           $items = Item::select('items.*','categories.name_'.$lang.' as category_name',
                   \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/items')."/',items_images.image)) as image")   )
           ->where( 'company_id',auth('Company')->id() )
           ->where(function($q)use($search){
                if (isset($search['text']))
                   $q->where('items.name_en','like','%'.$search['text'].'%')
                     ->orWhere('items.name_ar','like','%'.$search['text'].'%')->orWhere('items.id',$search['text']);
                if (isset($search['category_id']))
                   $q->where('category_id',$search['category_id']);
            })
            ->Join('categories','categories.id','items.category_id')
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

      public function store(Request $request)
      {
            $validator = \Validator::make($request->all(), [
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'name_en' => 'required',
                'name_ar' => 'required',
                'description_en' => 'required',
                'description_ar' => 'required',
                'price' => 'required',
                'minimum_amount' => 'required',
                'maximum_amount' => 'required',
                'image' => 'required',
            ]);
            if ($validator->fails()) { return response()->json([ 'status' => 'notValid' , 'data' => $validator->messages() ]);  }
            $request->merge([ 'company_id'=>auth('Company')->id() ]);
            $item = Item::create($request->except('_token','image'));
            for ($i=0; $i < count($request->image); $i++)
            {
                $ItemImages = ItemImages::create([
                    'item_id' => $item->id,
                    'image' => $request->image[$i]
                ]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $item
            ]);
      }

      public function update(Request $request)
      {
            $validator = \Validator::make($request->all(), [
                'id' => 'required',
                'category_id' => 'required',
                'name_en' => 'required',
                'name_ar' => 'required',
                'description_en' => 'required',
                'description_ar' => 'required',
                'price' => 'required',
                'minimum_amount' => 'required',
                'maximum_amount' => 'required',
                'image' => '',
            ]);
            if ($validator->fails()) { return response()->json([ 'status' => 'notValid' , 'data' => $validator->messages() ]);  }
            $request->merge([ 'company_id'=>auth('Company')->id() ]);
            $item = Item::findOrFail($request->id);
            $item->update($request->except('_token','image'));

            if ( $request->image && $request->image != "[object FileList]")
            {
                ItemImages::where('item_id',$item->id)->delete();
                for ($i=0; $i < count($request->image); $i++)
                {
                    $ItemImages = ItemImages::create([
                        'item_id' => $item->id,
                        'image' => $request->image[$i]
                    ]);
                }
            }

            return response()->json([
                'status' => 'success',
                'data' => $item
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
