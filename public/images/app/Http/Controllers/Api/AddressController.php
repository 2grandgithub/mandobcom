<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Address;

class AddressController extends Controller
{
    public function __construct()
    {
       $this->middleware('verifyApiJWT:Buyer,true');
    }

    public function info($buyer_id)
    {
        return Address::where('buyer_id',$buyer_id)->select('buyer_id','address','lat','lang')->first();
    }


    public function store(Request $request)
    {
          $data = \Validator::make($request->all(), [
                'buyer_id' => 'required',
                'address' => 'required',
                'lat'     => 'required',
                'lang'    => 'required',
          ]);
          if ($data->fails()) {
                 return response()->json([ 'state' => 'notValid' , 'data' => $data->messages() ]);
          }
          $Address = Address::where('buyer_id',$request->buyer_id)->first();
          if ($Address)
          {
               $Address->update($request->all());
          }
          else {
              Address::create($request->all());
          }
          return response()->json([
                'status' => 'success'
          ]);
    }


}
