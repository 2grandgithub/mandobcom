<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Buyer;
use App\VerificationCode;

class BuyerController extends Controller
{

    public function register(Request $request)
    {
          $validator = \Validator::make($request->all(), [
              'firebase_token' => 'required',
              'app_version' => 'required',
              'model' => 'required',
              'os' => 'required|in:android,ios',
              'email' => 'required|unique:buyers',  // edit:  'email' => 'required|unique:buyers,email,'.$user_id,
              'password'  => 'required', // phone:send as -> md5( 'moi20'+password )
              'name' => 'required',
              // 'city_id'  => 'required',
              // 'governorate_id'  => 'required',
              'aramex_CountryCode' => 'required',
              'aramex_City' => 'required',
              'street'  => 'required',
              'building_no'  => '',
              'zip_code'  => '',
              'phone'  => 'required',
              'CommercialRegistrationNo'  => 'required',
              'CommercialRegistrationType'  => 'required',
              'TypeOfCompanyActivity'  => 'required',
              'employees_no'  => 'required',
         ]);
         if ($validator->fails()) {
               if($validator->errors()->has('email'))
                    {  return response()->json([ 'status' => 'The email has already been taken.'  ]);  }
              return response()->json([ 'status' => 'notValid' , 'data' => $validator->errors() ]);
         }

         $check_phone = Buyer::where('phone',$request->phone)->where('phone_verified',1)->exists();
         if($check_phone){
            return response()->json([ 'status' => 'The phone has already been taken.'  ]);
         }

         $CommercialRegistrationTypes_array = [ 'مساهمة عامة محدودة','مساهمة خاصة محدودة','ذات مسؤولية محدودة','تضامن','توصية بسيطة',
               'توصية بالأسهم','عربية مشتركة','أجنبية فرع عامل','اجنبية فرع غير عامل','معفاة','لا تهدف الى ربح','دنيه','استثمار مشترك' ];
          if(!in_array($request->CommercialRegistrationType,$CommercialRegistrationTypes_array))
              { return response()->json([ 'status' => 'wrong CommercialRegistrationType'  ]); }

         if ($request->password)
              $request->merge([ 'password' => md5($request->password) ]);
         $request->merge([ 'jwt' => str_random(200) ]);

         $Buyer = Buyer::create( $request->all() );

         $VerificationCode = VerificationCode::create([
             'buyer_id' => $Buyer->id,
             'code' => rand(1111,9999),
             'phone' => $Buyer->phone
         ]);

         \App\SmsUnifonic::send($Buyer->phone,"كود+التفعيل+الخاص+بحسابك+علي+مندوبكم+".$VerificationCode->code);

         \Mail::to($request->email)->send(new \App\Mail\RegisterMail('Buyer',$Buyer->id));

         return response()->json([
           'status' => 'success',
           'id' => $Buyer->id
         ]);
    }


    public function update_token(Request $request)
    {
        //
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
