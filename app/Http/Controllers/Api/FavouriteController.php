<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Favourite;
use App\Item;
use App\CategoryCompany;
use App\Category;

class FavouriteController extends Controller
{

    public function __construct()
    {
       $this->middleware('verifyApiJWT:Buyer,true');
    }

    public function list($Buyer_id)
    {
        $items = Favourite::select('items.id','items.name_en','items.name_ar','items.description_en','items.description_ar','items.price',
                           'items.likes','minimum_amount','maximum_amount',
                           'companies.name_en as company_name_en','companies.name_ar as company_name_ar',
                      //--get is_favourite--
                      \DB::raw("IF (True,1,0) as is_favourite") ,
                      //--get is_like--
                      \DB::raw("IF ( likes.buyer_id ,1,0) as is_like") ,
                      //--get is_like--
                      \DB::raw("IF ( shopping_carts.buyer_id ,1,0) as in_card") ,
                      //--get images--
                      \DB::raw("GROUP_CONCAT(CONCAT('".asset('images/items')."/',items_images.image)) as images") ,
                      //--get rating--
                      \DB::raw(self::stars('rating.stars'))
                    )
                    ->leftJoin('items','favourites.item_id','items.id')
                    ->leftJoin('likes',function($q)use($Buyer_id){
                        $q->on('likes.item_id','items.id')->where('likes.buyer_id',$Buyer_id);
                    })
                    ->leftJoin('shopping_carts',function($q)use($Buyer_id){
                        $q->on('shopping_carts.item_id','items.id')->where('shopping_carts.buyer_id',$Buyer_id);
                    })
                    ->leftJoin('items_images','items_images.item_id','items.id')
                    ->leftJoin('rating','rating.item_id','items.id')
                    ->leftJoin('companies','companies.id','items.company_id')
                    ->where('items.status',1)
                    ->where('favourites.buyer_id',$Buyer_id)
                    ->orderBy('favourites.id','DESC')
                    ->groupBy('favourites.id')
                    ->paginate();

        return $items;
  }


    public function store($Buyer_id,$item_id)
    {
          $Favourite = Favourite::where('buyer_id',$Buyer_id)->where('item_id',$item_id)->first();
          if ($Favourite)
          {
             $Favourite->delete();
          }
          else {
              Favourite::create([
                   'buyer_id' => $Buyer_id,
                   'item_id'  => $item_id
              ]);
          }
          return response()->json([
            'status' => 'success'
          ]);
    }

}
