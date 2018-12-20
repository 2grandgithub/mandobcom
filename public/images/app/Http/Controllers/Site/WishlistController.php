<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

class WishlistController extends Controller
{
      public function __construct()
      {
          // $this->middleware('verifyApiJWT:Buyer,true')->only('add_or_remove');
          $this->middleware('auth:Buyer')->only('index');
      }

      public function index()
      {
          return view('Site.Wishlist',compact('item'));
      }

      public function get_list()
      {
          $lang = app()->getLocale()??'ar';
          $AuthBuyer_id = ( auth('Buyer')->check() )? auth('Buyer')->id() : 0 ;

          $items = Item::select('items.id as item_id','items.name_'.$lang.' as name','items.price', \DB::raw("'item' as type") ,
                                         'items.minimum_amount','items.maximum_amount', 'items.company_id',
                                         'items.minimum_amount as current_amount',
                                         \DB::raw("CONCAT('".asset('images/items')."/',items_images.image) as image"),
                                         'companies.name_'.$lang.' as company_name',
                                         \DB::raw("'1' as is_liked")
                                      )
                      ->leftJoin('items_images','items.id','items_images.item_id')
                      ->leftJoin('companies','companies.id','items.company_id')
                      ->join('likes',function($q)use($AuthBuyer_id){
                          $q->on('likes.item_id','items.id')->where('likes.buyer_id',$AuthBuyer_id);
                      })
                      ->orderBy('items.id')
                      ->groupBy('items.id')
                      ->paginate(10);
              return $items;
      }

}
