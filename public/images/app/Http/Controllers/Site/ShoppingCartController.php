<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShoppingCart;
use App\Aramex;

class ShoppingCartController extends Controller
{

      public function __construct()
      {
          $this->middleware('verifyApiJWT:Buyer,true')->only('add_or_remove');
          $this->middleware('auth:Buyer')->only('index');
      }

      public function index()
      {
          $Obj_Aramex = new Aramex();
          $Aramex_Countries = $Obj_Aramex->LocationCountriesFetching();
          // $CalculateRate = $Obj_Aramex->CalculateRate();                        return $CalculateRate;
          $Buyer_aramex_CountryCode = auth('Buyer')->user()->aramex_CountryCode;
          $Buyer_aramex_City = auth('Buyer')->user()->aramex_City;
          return view('Site/ShoppingCart/index',compact('Aramex_Countries','Buyer_aramex_CountryCode','Buyer_aramex_City'));
      }

      public function list()
      {
         $lang = app()->getLocale()??'ar';
         $buyer_id = ( auth('Buyer')->check() )? auth('Buyer')->id() : 0 ;

         $items = ShoppingCart::select('items.id as item_id','items.name_'.$lang.' as name','items.price', \DB::raw("'item' as type") ,
                                              'items.minimum_amount','items.maximum_amount', 'items.company_id','items.Weight as Weight',
                                              'items.minimum_amount as current_amount',
                                              \DB::raw("CONCAT('".asset('images/items')."/',items_images.image) as image"),
                                              'companies.name_'.$lang.' as company_name',
                                              'companies.aramex_City as aramex_City','companies.aramex_CountryCode as aramex_CountryCode'
                                       )
                       ->leftJoin('items','items.id','shopping_carts.item_id')
                       ->leftJoin('offers','offers.id','shopping_carts.offer_id')
                       ->leftJoin('items_images','items.id','items_images.item_id')
                       ->leftJoin('companies','companies.id','items.company_id')
                       ->where('shopping_carts.buyer_id',$buyer_id)
                       ->whereNotNull('shopping_carts.item_id')
                       ->orderBy('items.company_id')
                       ->groupBy('shopping_carts.id')
                       ->get()->toArray();

           $offers = ShoppingCart::select('offers.id as item_id','offers.name_'.$lang.' as name','offers.new_price as price', \DB::raw("'offer' as type"),
                                        'offers.company_id','offers.amount as minimum_amount','offers.amount as maximum_amount','offers.Weight as Weight',
                                        'offers.amount as current_amount',
                                        \DB::raw("CONCAT('".asset('images/offers')."/',offers_images.image) as image"),
                                        'companies.name_'.$lang.' as company_name',
                                        'companies.aramex_City as aramex_City','companies.aramex_CountryCode as aramex_CountryCode'
                                   )
                       ->leftJoin('offers','offers.id','shopping_carts.offer_id')
                       ->leftJoin('offers_images','offers.id','offers_images.offer_id')
                       ->leftJoin('companies','companies.id','offers.company_id')
                       ->where('shopping_carts.buyer_id',$buyer_id)
                       ->whereNotNull('shopping_carts.offer_id')
                       ->orderBy('offers.company_id')
                       ->groupBy('shopping_carts.id')
                       ->get()->toArray();


          $ShoppingCart = array_merge($items,$offers);
          $ShoppingCart = collect(json_decode(json_encode($ShoppingCart)));

          // $Address = Address::where('buyer_id',$buyer_id)->select('address')->first();


          $card = [];
          foreach ($ShoppingCart as $value)
          {
                $card[$value->company_id]['aramex_City'] = $value->aramex_City;
                $card[$value->company_id]['aramex_CountryCode'] = $value->aramex_CountryCode;
                $card[$value->company_id]['company_name'] = $value->company_name;
                $card[$value->company_id]['company_id'] = $value->company_id;
                // $card[$value->company_id]['type'] = $value->type;
                if(isset($card[$value->company_id]['count']))
                    $card[$value->company_id]['count']++;
                else
                    $card[$value->company_id]['count'] = 1;
                $card[$value->company_id]['items'][] = $value;
          }
          $paymentMethods = [
            'pay on delivery','credit card','bank transfer','my account credit','partner bank'
          ];

          return response()->json([
                // 'Address' => $Address->address??'',
                'paymentMethods' => $paymentMethods ,
                'ShoppingCart' =>  array_values($card),
          ]);
      }

      public function add_or_remove($buyer_id,$item_id,$type)
      {
            $in_card = false;
            if ($type == 'item')
            {
                  $ShoppingCart = ShoppingCart::where('buyer_id',$buyer_id)->where('item_id',$item_id)->first();
                  if ($ShoppingCart){
                      $ShoppingCart->delete();
                  }
                  else {
                        ShoppingCart::create([
                            'buyer_id' => $buyer_id,
                            'item_id'  => $item_id
                       ]);
                       $in_card = true;
                  }
            }
            else if ($type == 'offer')
            {
                  $ShoppingCart = ShoppingCart::where('buyer_id',$buyer_id)->where('offer_id',$item_id)->first();
                  if ($ShoppingCart){
                      $ShoppingCart->delete();
                  }
                  else {
                        ShoppingCart::create([
                            'buyer_id' => $buyer_id,
                            'offer_id'  => $item_id
                       ]);
                       $in_card = true;
                  }
            }
            return response()->json([
                  'status' => 'success',
                  'case' => $in_card
            ]);
      }

}
