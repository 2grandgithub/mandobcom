<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ShoppingCart;
use App\Address;

class ShoppingCartController extends Controller
{

    public function __construct()
    {
       $this->middleware('verifyApiJWT:Buyer,true') ;
    }

    public function list($buyer_id)
    {
       $items = ShoppingCart::select('items.id as item_id','items.name_en','items.name_ar','items.price', \DB::raw("'item' as type") ,
                                            'items.minimum_amount','items.maximum_amount', 'items.company_id','items.Weight as Weight',
                                            \DB::raw("CONCAT('".asset('images/items')."/',items_images.image) as image"),
                                            'companies.name_en as company_name_en','companies.name_ar as company_name_ar'
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

         $offers = ShoppingCart::select('offers.id as item_id','offers.name_en','offers.name_ar','offers.new_price as price', \DB::raw("'offer' as type"),
                                      'offers.company_id','offers.amount as minimum_amount','offers.amount as maximum_amount',
                                      \DB::raw("CONCAT('".asset('images/offers')."/',offers_images.image) as image"),
                                      'companies.name_en as company_name_en','companies.name_ar as company_name_ar'
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

        $Address = Address::where('buyer_id',$buyer_id)->select('address')->first();


        $card = [];
        foreach ($ShoppingCart as $value)
        {
              $card[$value->company_id]['company_name_ar'] = $value->company_name_ar;
              $card[$value->company_id]['company_name_en'] = $value->company_name_en;
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
              'Address' => $Address->address??'',
              'paymentMethods' => $paymentMethods ,
              'ShoppingCart' =>  array_values($card),
        ]);
    }

    public function add_or_remove($buyer_id,$item_id,$type)
    {
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
                }
          }
          return response()->json([
                'status' => 'success'
          ]);
    }



    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
