<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recipt;
use App\ReciptItem;
use App\ShoppingCart;

class PaymentController extends Controller
{

      // Hyper pay payment

      public function __construct()
      {
          $this->middleware('verifyApiJWT:Buyer,true') ->only('add_or_remove');
          $this->middleware('auth:Buyer')->only('index');
      }

      public function Prepare_the_checkout()
      {
            $url = "https://test.oppwa.com/v1/checkouts";
          	$data = "authentication.userId=8a8294174d0595bb014d05d829e701d1" .
          		"&authentication.password=9TnJPc2n9h" .
          		"&authentication.entityId=8a8294174d0595bb014d05d829cb01cd" .
          		"&amount=92.00" .
          		"&currency=EUR" .
          		"&paymentType=DB";

          	$ch = curl_init();
          	curl_setopt($ch, CURLOPT_URL, $url);
          	curl_setopt($ch, CURLOPT_POST, 1);
          	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
          	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          	$responseData = curl_exec($ch);
          	if(curl_errno($ch)) {
          		return curl_error($ch);
          	}
          	curl_close($ch);
          	return $responseData;
      }



      public function hyperPayor_or_normail_makePayment($deal_string)
      {
            $deal = json_decode($deal_string);

            $buyer_id = auth('Buyer')->id();
                                                    
            $Recipt = Recipt::create([
                  'buyer_id' =>  $buyer_id ,
                  'company_id' => $deal->company_id ,
                  'payment_method' => $deal->paymentMethod ,
                  'is_paid' => ($deal->paymentMethod == 'credit card') ? 1 : 0 ,
            ]);

            $Recipt_price = 0;

            foreach (($deal->items) as $item)
            {
                  $item_total_price = $item->price * $item->quantity;
                  $Recipt_price += (float)$item_total_price;
                  $item_data = [
                      'receipt_id' => $Recipt->id,
                      'quantity' => $item->quantity,
                      'single_price' => $item->price,
                      'total_price' => $item_total_price,
                  ];
                  ($item->type == 'item')? $item_data['item_id'] = $item->item_id : $item_data['offer_id'] = $item->item_id;
                  ReciptItem::create($item_data);

                  if($item->type == 'item')
                      ShoppingCart::where('buyer_id',$buyer_id)->where('item_id',$item->item_id)->delete();
                  else if($item->type == 'offer')
                      ShoppingCart::where('buyer_id',$buyer_id)->where('offer_id',$item->item_id)->delete();
            }
            $Recipt->update([
                'total_price' => $Recipt_price
            ]);

            \Session::flash('flash_message', __('page.request is done'));

            return back();
      }

}
