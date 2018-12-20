<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactUs;


class ContactUsController extends Controller
{


    public function store(Request $request,$user_id)
    {
         $data = \Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'message' => 'required',
         ]);
         if ($data->fails()) {
                return response()->json([ 'state' => 'notValid' , 'data' => $data->messages() ]);
         }
         $request->merge(['user_id'=>$user_id]);
         $ContactUs = ContactUs::create($request->all());
         return response()->json([
           'status' => 'success'
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
