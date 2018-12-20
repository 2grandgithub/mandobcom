<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting ;

class SettingController extends Controller
{

    public function advertising_for_recycables_whenfull_requests()
    {
        $Setting = Setting::where('title','advertising_for_recycables_whenfull_requests')->first() ;
        return response()->json([  'link' => asset('images/adverting').'/'. $Setting->value  ]);
    }

    public function advertising_for_add_producer_family_product()
    {
        $Setting = Setting::where('title','advertising_for_add_producer_family_product')->first() ;
        return response()->json([  'link' => asset('images/adverting').'/'. $Setting->value  ]);
    }

    public function increment_views(Request $request)
    {
        $validate = \Validator::make($request->all(), [
             'buyer_id' => 'required',
             'item_id' => 'required',
             'type' => 'required|in:item,offer',
        ]);
        if ($validate->fails()) {
               return response($request->item_id)->json([ 'status' => 'notValid' , 'data' => $validate->messages() ]);
        }
        if ($request->type == 'item')
        {
            \App\Item::whereId($request->item_id)->increment('views');
        }
        else if($request->type == 'offer')
        {
            \App\Offer::whereId()->increment('views');
        }

        return response()->json([
              'status' => 'success'
        ]);
    }


}
