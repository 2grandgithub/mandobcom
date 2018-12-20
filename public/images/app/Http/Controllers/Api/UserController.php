<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Buyer;
use App\Recycable;
use App\ProducerFamily;
use App\VerificationCode;

class UserController extends Controller
{

      public function login(Request $request)
      {
           $data = \Validator::make($request->all(), [
              'email' => 'required',
              'password' => 'required', // phone:send as -> md5( 'moi20'+password )
              'type' => 'required|in:Buyer,Recycable,ProducerFamily', //
           ]);
           if ($data->fails()) {
              return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
           }
           $email = $request->email;
           if ($request->type == 'Buyer'){
                 $user = Buyer::where(function($q)use($email){
                    $q->where('email',$email)->orWhere('phone',$email);
                 })
                 ->where( 'password',md5($request->password) )->first();
           }
           else if($request->type == 'Recycable'){
                 $user = Recycable::where(function($q)use($email){
                    $q->where('email',$email)->orWhere('phone',$email);
                 })
                 ->where( 'password',md5($request->password) )->first();
           }
           else if($request->type == 'ProducerFamily'){
                 $user = ProducerFamily::where(function($q)use($email){
                    $q->where('email',$email)->orWhere('phone',$email);
                 })
                 ->where( 'password',md5($request->password) )->first();
           }

           if ($user)//email & password is found
           {
                if(!$user->email_verified && !$user->phone_verified)
                    return response()->json([ 'status' => 'email and phone not verified','id'=> $user->id ]);
                else if(!$user->email_verified)
                    return response()->json([ 'status' => 'email not verified','id'=> $user->id ]);
                else if(!$user->phone_verified)
                    return response()->json([ 'status' => 'phone not verified','id'=> $user->id ]);
                else if(!$user->is_accapted_by_admin)
                    return response()->json([ 'status' => 'admin not accapted you yet','id'=> $user->id ]);
                else if(!$user->status)
                    return response()->json([ 'status' => 'admin blocked you','id'=> $user->id ]);
                else  //valid
                {
                    // $user->update([ 'jwt' => str_random(200) ]);
                    return response()->json([ 'status' => 'success','id'=> $user->id ,'userToken'=>$user->jwt ,
                        'data' => [
                              'id' => $user->id ,
                              'name' => $user->name ,
                              'email' => $user->email ,
                              'city_id' => $user->city_id ,
                              'governorate_id' => (string)$user->governorate_id ,
                              'street' => (string)$user->street ,
                              'building_no' => (string)$user->building_no ,
                              'zip_code' => (string)$user->zip_code ,
                              'phone' => $user->phone ,
                              'CommercialRegistrationNo' => (string)$user->CommercialRegistrationNo ,
                              'CommercialRegistrationType' => (string)$user->CommercialRegistrationType ,
                              'TypeOfCompanyActivity' => (string)$user->TypeOfCompanyActivity ,
                              'employees_no' => (string)$user->employees_no ,
                          ]
                        ]);
                }
           }
           else {
               return response()->json([ 'status' => 'faild','id'=> '' ,'userToken'=> '' ]);
           }

      }

      public function check_phone_activation_code(Request $request)
      {
          $data = \Validator::make($request->all(), [
              'type' => 'required|in:Buyer,Recycable,ProducerFamily',
              'user_id' => 'required',
              'code' => 'required',
          ]);
          if ($data->fails()) {
                 return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
          }

          switch ($request->type)
          {
              case 'Buyer':
                  $user_type_id = 'buyer_id';
                break;
              case 'Recycable':
                  $user_type_id = 'recycable_id';
                break;
              case 'ProducerFamily':
                  $user_type_id = 'ProducerFamily_id';
                break;
          }

          $verification = VerificationCode::where($user_type_id , $request->user_id)
                                          ->where('created_at', '>', \Carbon\Carbon::now()->subMinutes(5)->toDateTimeString())
                                          ->orderBy('created_at', 'desc')->first();

            if( !isset($verification->code) )
            {
                return response()->json([
                  'status' => 'faild' //status = false if unvalid code
                ]);
            }
            else
            {
                  if( $verification->code != $request->code )
                  {
                      return response()->json([
                        'status' => 'faild' //status = false if unvalid code
                      ]);
                  }
                  else // the code match
                  {
                        switch ($request->type)
                        {
                          case 'Buyer':
                                $user = Buyer::findOrFail($request->user_id);
                            break;
                          case 'Recycable':
                                $user = Recycable::findOrFail($request->user_id);
                            break;
                          case 'ProducerFamily':
                                $user = ProducerFamily::findOrFail($request->user_id);
                            break;
                        }
                      $user->update([
                        'phone' => $verification->phone,
                        'phone_verified' => '1'
                      ]);
                      $verification->delete();
                      return response()->json([
                        'status' => 'success' //status = false if unvalid code
                      ]);
                  }
            }
      }


      public function update_firebase_Token(Request $request)
      {
            $data = \Validator::make($request->all(), [
                'type' => 'required|in:Buyer,Recycable,ProducerFamily',
                'user_id' => 'required',
                'firebase_token' => 'required',
            ]);
            if ($data->fails()) {
                   return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
            }

            switch ($request->type)
            {
                case 'Recycable':
                    $user = Recycable::findOrFail($request->user_id);
                  break;
                case 'Buyer':
                    $user = Buyer::findOrFail($request->user_id);
                  break;
                case 'ProducerFamily':
                    $user = ProducerFamily::findOrFail($request->user_id);
                  break;
            }
            //--check jwt
            if ($user->jwt != $request->headers->get('userToken') ){
                return response()->json([ 'status' => 'unValidToken' ]);
            }

            $user->update([
              'firebase_token' => $request->firebase_token
            ]);

            return response()->json([
              'status' => 'success'
            ]);
      }

      public function reSend_phone_Code($user_id,$type)
      {
            $send = [
              'code' => rand(1111,9999)
            ];
            switch ($type)
            {
              case 'Buyer':
                    $user = \App\Buyer::findOrFail($user_id);
                    $send['buyer_id'] = $user_id;
                break;
              case 'Recycable':
                    $user = \App\Recycable::findOrFail($user_id);
                    $send['recycable_id'] = $user_id;
                break;
              case 'ProducerFamily':
                    $user = \App\ProducerFamily::findOrFail($user_id);
                    $send['ProducerFamily_id'] = $user_id;
                break;
            }
            $send['phone'] = $user->phone;
            VerificationCode::create($send);

            return response()->json([
              'status' => 'success'
            ]);
      }

        public function show($id)
        {
            $user = User::whereId($id)->select('name','email','phone','id')->first();
            return $user;

        }

        public function change_password(Request $request)
        {
              $data = \Validator::make($request->all(), [
                  'type' => 'required|in:Buyer,Recycable,ProducerFamily',
                  'user_id' => 'required',
                  'old_password' => 'required', // md5( 'moi20'+password )
                  'new_password' => 'required', // md5( 'moi20'+password )
              ]);
              if ($data->fails()) {
                     return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
              }
              switch ($request->type)
              {
                  case 'Recycable':
                      $user = Recycable::whereId($request->user_id)->where('password',md5($request->old_password))->first();
                    break;
                  case 'Buyer':
                      $user = Buyer::whereId($request->user_id)->where('password',md5($request->old_password))->first();
                    break;
                  case 'ProducerFamily':
                      $user = ProducerFamily::whereId($request->user_id)->where('password',md5($request->old_password))->first();
                    break;
              }

              if ($user)
              {
                  $user->update(['password'=>$request->new_password]);
                  return response()->json([
                      'status' => 'success'
                  ]);
              }
              else {
                return response()->json([ 'status' => 'wrong_old_password' ]);
              }
        }

        public function show_profile(Request $request)
        {
              $data = \Validator::make($request->all(), [
                  'type' => 'required|in:Buyer,Recycable,ProducerFamily',
                  'user_id' => 'required',
              ]);
              if ($data->fails()) {
                     return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
              }
              $select = [
                'email','name','city_id','street','building_no','zip_code','phone','CommercialRegistrationNo','employees_no',
                'governorate_id', 'CommercialRegistrationNo','CommercialRegistrationType','TypeOfCompanyActivity'
              ];
              switch ($request->type)
              {
                  case 'Recycable':
                      array_push($select,'type');
                      $user = Recycable::whereId($request->user_id)->select($select)->first();
                    break;
                  case 'Buyer':
                      $user = Buyer::whereId($request->user_id)->select($select)->first();
                    break;
                  case 'ProducerFamily':
                      $user = ProducerFamily::whereId($request->user_id)->select($select)->first();
                    break;
              }
              // return $user;
              return [
                    'id' => $user->id ,
                    'name' => $user->name ,
                    'email' => $user->email ,
                    'city_id' => $user->city_id ,
                    'governorate_id' => (string)$user->governorate_id ,
                    'street' => (string)$user->street ,
                    'building_no' => (string)$user->building_no ,
                    'zip_code' => (string)$user->zip_code ,
                    'phone' => $user->phone ,
                    'CommercialRegistrationNo' => (string)$user->CommercialRegistrationNo ,
                    'CommercialRegistrationType' => (string)$user->CommercialRegistrationType ,
                    'TypeOfCompanyActivity' => (string)$user->TypeOfCompanyActivity ,
                    'employees_no' => (string)$user->employees_no ,
                ];
        }

        public function verifyEmail($type,$id)
        {
              if ($type == 'Buyer'){
                    $user = \App\Buyer::whereId($id)->where('email_verified',0)->first();
              }
              else if($type == 'Recycable'){
                    $user = \App\Recycable::whereId($id)->where('email_verified',0)->first();
              }
              else if($type == 'ProducerFamily'){
                    $user = \App\ProducerFamily::whereId($id)->where('email_verified',0)->first();
              }
              else if($type == 'Company'){
                    $user = \App\Company::whereId($id)->where('email_verified',0)->first();
              }
              if(!$user)
              {
                 return '<br><h1><center> انتها </center><h1>' ;
              }
              else {
                $user->update(['email_verified'=>1]);
                return '<br><h1><center> تم تفعيل البريد الاكتروني </center><h1>' ;
              }
        }

        // public function update_profile(Request $request)
        // {
        //       $data = \Validator::make($request->all(), [
        //           'type' => 'required|in:Buyer,Recycable,ProducerFamily',
        //           'user_id' => 'required',
        //           'name' => 'required',
        //           'name' => 'required',
        //       ]);
        //       if ($data->fails()) {
        //              return response()->json([ 'status' => 'notValid' , 'data' => $data->messages() ]);
        //       }
        //
        //       'email','name','city_id','street','building_no','zip_code','phone','CommercialRegistrationNo','employees_no',
        //       'governorate_id', 'CommercialRegistrationNo','CommercialRegistrationType','TypeOfCompanyActivity'
        // }

}
