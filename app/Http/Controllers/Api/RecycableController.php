<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recycable;
use App\VerificationCode;
use App\RecycablesWhenfullRequests;

class RecycableController extends Controller
{

      public function register(Request $request)
      {
            $validator = \Validator::make($request->all(), [
                'firebase_token' => 'required',
                'app_version' => 'required',
                'model' => 'required',
                'os' => 'required|in:android,ios',
                'email' => 'required|unique:recycables',  // edit:  'email' => 'required|unique:buyers,email,'.$user_id,
                'password'  => 'required', // phone:send as -> md5( 'moi20'+password )
                'name' => 'required',
                // 'type'  => 'required|in:all,specific',
                // 'city_id'  => 'required',
                // 'governorate_id'  => 'required',
                'aramex_CountryCode' => 'required',
                'aramex_City' => 'required',
                'street'  => 'required',
                'building_no'  => '',
                'zip_code'  => '',
                'phone'  => 'required',
                'CommercialRegistrationNo' => '',
                'CommercialRegistrationType'  => '',
                'TypeOfCompanyActivity'  => '',
                'employees_no'  => '',
                'the_type'  => '',
           ]);
           if ($validator->fails()) {
                 if($validator->errors()->has('email'))
                      {  return response()->json([ 'status' => 'The email has already been taken.' ]);  }
                return response()->json([ 'status' => 'notValid' , 'data' => $validator->errors() ]);
           }

           $check_phone = Recycable::where('phone',$request->phone)->where('phone_verified',1)->exists();
           if($check_phone){
              return response()->json([ 'status' => 'The phone has already been taken.'  ]);
           }

           if ($request->password)
                $request->merge([ 'password' => md5($request->password) ]);
           $request->merge([ 'jwt' => str_random(200) ]);

           $Recycable = Recycable::create( $request->all() );

           $VerificationCode = VerificationCode::create([
               'recycable_id' => $Recycable->id,
               'code' => rand(1111,9999),
               'phone' => $Recycable->phone
           ]);

            \App\SmsUnifonic::send($Recycable->phone,"كود+التفعيل+الخاص+بحسابك+علي+مندوبكم+".$VerificationCode->code);

            \Mail::to($request->email)->send(new \App\Mail\RegisterMail('Recycable',$Recycable->id));

           return response()->json([
             'status' => 'success',
             'id' => $Recycable->id
           ]);
      }

      public function Requests_when_packge_is_fulled(Request $request)
      {
           $validator = \Validator::make($request->all(), [
                'recycable_id' => 'required',
                'comment' => 'required',
                'Glass' => '',
                'Plastic' => '',
                'Metal' => '',
                'Paper' => '',
           ]);
           if ($validator->fails()) {
                return response()->json([ 'status' => 'notValid' , 'data' => $validator->errors() ]);
           }

           Recycable::findOrFail( $request->recycable_id );

           RecycablesWhenfullRequests::create( $request->all() );

           return response()->json([
             'status' => 'success'
           ]);
      }

}
