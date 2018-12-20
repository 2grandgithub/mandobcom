<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recipt;
use App\ReciptItem;
use App\ShoppingCart;
use DB;

class ReciptController extends Controller
{
      public function __construct()
      {
         $this->middleware('verifyApiJWT:Buyer,true');
      }

      public function add_recipt(Request $request)
      {
            $validator = \Validator::make($request->all(), [
                'buyer_id' => 'required',
                'company_id' => 'required',
                'payment_method' => 'required',
                'buyer_notes' => '',
                'is_paid' => 'required',
                'items' => 'required',
            ]);
            if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }

            // return $request->all();


            $Recipt = Recipt::create([
                  'buyer_id' => $request->buyer_id ,
                  'company_id' => $request->company_id ,
                  'payment_method' => $request->payment_method ,
                  'buyer_notes' => $request->buyer_notes ,
                  'is_paid' => $request->is_paid ,
            ]);

            $Recipt_price = 0;

            foreach (($request->items) as $item)
            {
                  $item_total_price = $item['price'] * $item['quantity'];
                  $Recipt_price += (float)$item_total_price;
                  $item_data = [
                      'receipt_id' => $Recipt->id,
                      'quantity' => $item['quantity'],
                      'single_price' => $item['price'],
                      'total_price' => $item_total_price,
                  ];
                  ($item['type'] == 'item')? $item_data['item_id'] = $item['item_id'] : $item_data['offer_id'] = $item['item_id'];
                  ReciptItem::create($item_data);

                  if($item['type'] == 'item')
                      ShoppingCart::where('buyer_id',$request->buyer_id)->where('item_id',$item['item_id'])->delete();
                  else if($item['type'] == 'offer')
                      ShoppingCart::where('buyer_id',$request->buyer_id)->where('offer_id',$item['item_id'])->delete();
            }
            $Recipt->update([
                'total_price' => $Recipt_price
            ]);

            return response()->json([
              'status' => 'success',
            ]);
      }

      public function recipt_list($buyer_id)
      {
            $Recipts = Recipt::select('recipts.payment_method','recipts.total_price','recipts.is_paid','recipts.is_delivered',
                                     'recipts.is_cancled','recipts.created_at',
                                     'companies.name_ar as company_name_ar','companies.name_en as company_name_en','recipts.id')
                                    ->join('companies','companies.id','recipts.company_id')
                                    ->groupBy('recipts.id')
                                    ->where('buyer_id',$buyer_id)
                                     ->latest('recipts.id')
                                    ->simplePaginate(60);
             foreach ($Recipts as $Recipt)
             {
                $Recipt->items = ReciptItem::select(
                                  DB::raw("IF(recipt_items.item_id,'item','offer') as type"),
                                  DB::raw("IF(recipt_items.item_id,recipt_items.item_id,recipt_items.offer_id) as id"),
                                  'recipt_items.quantity',
                                  'recipt_items.single_price','recipt_items.total_price',

                                  DB::raw("IF(recipt_items.item_id,items.name_en,offers.name_en) as name_en"),
                                  DB::raw("IF(recipt_items.item_id,items.name_ar,offers.name_ar) as name_ar"),
                                  DB::raw("IF(recipt_items.item_id,
                                          CONCAT('".asset('images/items')."/',items_images.image),
                                          CONCAT('".asset('images/offers')."/',offers_images.image)
                                          ) as image")
                                )
                            ->leftJoin('items','items.id','recipt_items.item_id')
                            ->leftJoin('offers','offers.id','recipt_items.offer_id')
                            ->leftJoin('items_images','items_images.item_id','items.id')
                            ->leftJoin('offers_images','offers_images.offer_id','offers.id')
                            ->where('recipt_items.receipt_id',$Recipt->id)
                            ->groupBy('recipt_items.id')
                            ->get();
             }
            return $Recipts;
      }

}
