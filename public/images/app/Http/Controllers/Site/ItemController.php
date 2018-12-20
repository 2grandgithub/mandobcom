<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Company;

class ItemController extends Controller
{
      public function __construct()
      {
      }

      public function index($categoiry_id)
      {
          $page_name = 'items_list';
          return view('Site/Item/list',compact('categoiry_id','page_name'));
      }

      public function list_without_category_selected()
      {
          $page_name = 'items_list';
          return view('Site/Item/list_without_category_selected',compact( 'page_name'));
      }

      //---api----
      public function get_list(Request $request)
      {
           $lang = app()->getLocale()??'ar';
           $search = $request->all();

           $AuthBuyer_id = ( auth('Buyer')->check() )?  auth('Buyer')->id() : 0 ;


           switch ($request->sort)
           {
             case 'stars':
                  $sort = 'stars';
                  $sort_order = 'DESC';
               break;
             case 'views':
                  $sort = 'views';
                  $sort_order = 'DESC';
               break;
             case 'price_desc':
                  $sort = 'price';
                  $sort_order = 'DESC';
               break;
             case 'price_desc':
                  $sort = 'price_asc';
                  $sort_order = 'ASC';
               break;
             default:
                  $sort = 'items.id';
                  $sort_order = 'DESC';
               break;
           }
           $items = Item::select('items.name_'.$lang.' as item_name','items.id as item_id','items.description_'.$lang.' as item_description',
                              'items.category_id','items.sub_category_id','items.company_id' ,'items.likes',
                              'items.minimum_amount','items.maximum_amount','items.views' ,
                                'categories.name_'.$lang.' as category_name','sub_categories.name_'.$lang.' as sub_category_name',
                                'companies.name_'.$lang.' as company_name',
                   \DB::raw("if( $AuthBuyer_id , CONCAT(items.price,' ".__('page.JD')."') , '".__('page.Great prices')."'  ) as price"),
                   \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/items')."/',items_images.image)) as image"),
                   \DB::raw(self::stars('rating.stars')),
                   \DB::raw("if( shopping_carts.item_id , 1,0 ) as in_card")
                )
           ->where(function($q)use($search){
                if (isset($search['text']))
                   $q->where('items.name_en','like','%'.$search['text'].'%')
                     ->orWhere('items.name_ar','like','%'.$search['text'].'%')->orWhere('items.id',$search['text']);
                if (isset($search['company_id']))
                   $q->where('company_id',$search['company_id']);
                if (isset($search['subCats_ids']))
                    $q->whereIn('sub_category_id',$search['subCats_ids'] );
                if (isset($search['company_ids']))
                    $q->whereIn('company_id',$search['company_ids'] );
                if (isset($search['text']))
                    $q->where('items.name_ar','like','%'.$search['text'].'%' )
                      ->orWhere('items.name_en','like','%'.$search['text'].'%' );

                //--price--
                if (isset($search['price_from']) && isset($search['price_to']))
                    $q->where('items.price','>=',$search['price_from'])->where('items.price','<=',$search['price_to']);
                if (isset($search['price_from']))
                    $q->where('items.price','>=',$search['price_from']);
                if (isset($search['price_to']))
                    $q->where('items.price','<=',$search['price_to']);
            })
            ->where('items.status',1)->where('items.accapted_by_admin',1)
            ->where('items.category_id',$request->category_id)
            ->Join('categories','categories.id','items.category_id')
            ->leftJoin('sub_categories','sub_categories.id','items.sub_category_id')
            ->Join('companies','companies.id','items.company_id')
            ->Join('items_images','items_images.item_id','items.id')
            ->leftJoin('rating','rating.item_id','items.id')
            ->leftJoin('shopping_carts',function($q)use($AuthBuyer_id){
                $q->on('shopping_carts.item_id','items.id')->where('shopping_carts.buyer_id',$AuthBuyer_id);
            })
            ->groupBy('items.id')
            ->orderBy($sort,$sort_order)
            ->paginate($request->paginate_no??'15');

             //--get related Companies
            $company_ids = Item::where('category_id',$request->category_id)->distinct('company_id')->pluck('company_id');
            $Companies = Company::select('name_'.$lang.' as name','id')->whereIn('id',$company_ids)->get();

            return response()->json([
                'items' => $items,
                'Companies' => $Companies,
            ]);
      }

      //---api----
      public function get_item_list_without_cat(Request $request)
      {
           $lang = app()->getLocale()??'ar';
           $search = $request->all();

           $AuthBuyer_id = ( auth('Buyer')->check() )?  auth('Buyer')->id() : 0 ;


           switch ($request->sort)
           {
             case 'stars':
                  $sort = 'stars';
                  $sort_order = 'DESC';
               break;
             case 'views':
                  $sort = 'views';
                  $sort_order = 'DESC';
               break;
             case 'price_desc':
                  $sort = 'price';
                  $sort_order = 'DESC';
               break;
             case 'price_desc':
                  $sort = 'price_asc';
                  $sort_order = 'ASC';
               break;
             default:
                  $sort = 'items.id';
                  $sort_order = 'DESC';
               break;
           }
           $items = Item::select('items.name_'.$lang.' as item_name','items.id as item_id','items.description_'.$lang.' as item_description',
                              'items.category_id','items.sub_category_id','items.company_id' ,'items.likes',
                              'items.minimum_amount','items.maximum_amount','items.views' ,
                                'categories.name_'.$lang.' as category_name','sub_categories.name_'.$lang.' as sub_category_name',
                                'companies.name_'.$lang.' as company_name',
                   \DB::raw("if( $AuthBuyer_id , CONCAT(items.price,' ".__('page.JD')."') , '".__('page.Great prices')."'  ) as price"),
                   \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/items')."/',items_images.image)) as image"),
                   \DB::raw(self::stars('rating.stars')),
                   \DB::raw("if( shopping_carts.item_id , 1,0 ) as in_card")
                )
           ->where(function($q)use($search){
                if (isset($search['text']))
                   $q->where('items.name_en','like','%'.$search['text'].'%')
                     ->orWhere('items.name_ar','like','%'.$search['text'].'%')->orWhere('items.id',$search['text']);
                if (isset($search['company_id']))
                   $q->where('company_id',$search['company_id']);
                if (isset($search['subCats_ids']))
                    $q->whereIn('sub_category_id',$search['subCats_ids'] );
                if (isset($search['company_ids']))
                    $q->whereIn('company_id',$search['company_ids'] );
                if (isset($search['text']))
                    $q->where('items.name_ar','like','%'.$search['text'].'%' )
                      ->orWhere('items.name_en','like','%'.$search['text'].'%' );

                //--price--
                if (isset($search['price_from']) && isset($search['price_to']))
                    $q->where('items.price','>=',$search['price_from'])->where('items.price','<=',$search['price_to']);
                if (isset($search['price_from']))
                    $q->where('items.price','>=',$search['price_from']);
                if (isset($search['price_to']))
                    $q->where('items.price','<=',$search['price_to']);
            })
            ->where('items.status',1)->where('items.accapted_by_admin',1)
            ->Join('categories','categories.id','items.category_id')
            ->leftJoin('sub_categories','sub_categories.id','items.sub_category_id')
            ->Join('companies','companies.id','items.company_id')
            ->Join('items_images','items_images.item_id','items.id')
            ->leftJoin('rating','rating.item_id','items.id')
            ->leftJoin('shopping_carts',function($q)use($AuthBuyer_id){
                $q->on('shopping_carts.item_id','items.id')->where('shopping_carts.buyer_id',$AuthBuyer_id);
            })
            ->groupBy('items.id')
            ->orderBy($sort,$sort_order)
            ->paginate($request->paginate_no??'15');

            return response()->json([
                'items' => $items,
            ]);
      }

      public function details($item_id)
      {
          $lang = app()->getLocale()??'ar';
          $AuthBuyer_id = ( auth('Buyer')->check() )?  auth('Buyer')->id() :  0 ;

          $item = Item::select('items.name_'.$lang.' as item_name','items.id as item_id','items.description_'.$lang.' as item_description',
                             'items.category_id','items.sub_category_id','items.company_id' ,'items.likes',
                             'items.minimum_amount','items.maximum_amount','items.views' ,
                               'categories.name_'.$lang.' as category_name','sub_categories.name_'.$lang.' as sub_category_name',
                               'companies.name_'.$lang.' as company_name',
                  \DB::raw("if( $AuthBuyer_id , CONCAT(items.price,' ".__('page.JD')."') , '".__('page.Great prices')."'  ) as price"),
                  \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/items')."/',items_images.image)) as image"),
                  \DB::raw(self::stars('rating.stars')),
                  \DB::raw("if( shopping_carts.item_id , 1,0 ) as in_card"),
                  \DB::raw("if( likes.item_id , 1,0 ) as is_liked")
                  )
           ->where('items.status',1)->where('items.accapted_by_admin',1)
           ->Join('categories','categories.id','items.category_id')
           ->leftJoin('sub_categories','sub_categories.id','items.sub_category_id')
           ->Join('companies','companies.id','items.company_id')
           ->Join('items_images','items_images.item_id','items.id')
           ->leftJoin('rating','rating.item_id','items.id')
           ->leftJoin('shopping_carts',function($q)use($AuthBuyer_id){
               $q->on('shopping_carts.item_id','items.id')->where('shopping_carts.buyer_id',$AuthBuyer_id);
           })
           ->leftJoin('likes',function($q)use($AuthBuyer_id){
               $q->on('likes.item_id','items.id')->where('likes.buyer_id',$AuthBuyer_id);
           })
           ->where('items.id',$item_id)
           ->groupBy('items.id')
           ->first();
           if(!$item)
              return back();
           Item::whereId($item_id)->increment('views');
           return view('Site/Item/details',compact('item'));
      }

}
