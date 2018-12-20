<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\City;
use App\Governorate;
use App\Buyer;
use App\Company;
use App\VerificationCode;
use App\Aramex;

class AuthController extends Controller
{
      public function index()
      {
           $lang = app()->getLocale()??'ar';
           $Aramex_Countries = \App\AramexCountry::select('name_'.$lang.' as label','code as value')->where('status',1)->get();

           return view('Site.Auth.login_register',compact('Aramex_Countries'));
      }

      //---api---
      public function check_For_email_uniqueness(Request $request)
      {
            switch ($request->userType)
            {
              case 'buyer':
                  $table = 'buyers';
               break;
              case 'company':
                  $table = 'companies';
               break;
            }
            $validator = \Validator::make($request->all(), [
                  'email' => 'required|unique:'.$table,
            ]);
            if ($validator->fails()) {
                  if( $validator->errors()->has('email'))
                  return response()->json([ 'status' => 'The email has already been taken.' ]);
            }
            return response()->json([ 'status' => 'success'  ]);
      }

      //---api---
      public function check_For_phone_uniqueness(Request $request)
      {
            $validator = \Validator::make($request->all(), [
                  'phone' => 'required',
            ]);

            switch ($request->userType)
            {
              case 'buyer':
                    $check_phone = Buyer::where('phone',$request->phone)->where('phone_verified',1)->exists();
                    if($check_phone){
                       return response()->json([ 'status' => 'The phone has already been taken.'  ]);
                    }
               break;
              case 'company':
                    $check_phone = Company::where('phone',$request->phone)->where('phone_verified',1)->exists();
                    if($check_phone){
                       return response()->json([ 'status' => 'The phone has already been taken.'  ]);
                    }
               break;
            }

            return response()->json([ 'status' => 'success'  ]);
      }

      public function register(Request $request)
      {
          $table = '';
            switch ($request->userType)
            {
              case 'buyer':
                  $table = 'buyers';
               break;
              case 'company':
                  $table = 'companies';
               break;
            }
            $data = $request->validate([
                 'name' => ($table == 'buyers')?'required':'',
                 'name_en' => ($table == 'companies')?'required':'',
                 'name_ar' => ($table == 'companies')?'required':'',
                 'email' => 'required|unique:'.$table,
                 'password' => 'required',
                 // 'city_id' => 'required',
                 // 'governorate_id' => 'required',
                 'aramex_CountryCode' => 'required',
                 'aramex_City' => 'required',
                 'street' => 'required',
                 'building_no' => 'required',
                 'zip_code' => 'required',
                 'phone' => 'required',
                 'CommercialRegistrationNo' => 'required',
                 'CommercialRegistrationType' => 'required',
                 'TypeOfCompanyActivity' => 'required',
                 'employees_no' => 'required',
                 'logo' => ($table == 'companies')?'required':'',
            ]);

            $request->merge(['password'=> ($request->userType == 'buyer')? md5(md5( 'moi20'. $request->password )) : Hash::make($request->password)  ]);
            $request->merge([ 'jwt' => str_random(200) ]);
            $VerificationCode = [
              'code' => rand(1111,9999),
              'phone' => $request->phone
            ];
            if($request->userType == 'buyer' )
            {
                $check_phone = Buyer::where('phone',$request->phone)->where('phone_verified',1)->exists();
                if($check_phone){
                   return response()->json([ 'status' => 'The phone has already been taken.'  ]);
                }

                $user = Buyer::create($request->all());
                $VerificationCode['buyer_id'] = $user->id;

                \Mail::to($request->email)->send(new \App\Mail\RegisterMail('Buyer',$user->id));
            }
            else if($request->userType == 'company' )
            {
                $check_phone = Company::where('phone',$request->phone)->where('phone_verified',1)->exists();
                if($check_phone){
                   return response()->json([ 'status' => 'The phone has already been taken.'  ]);
                }

                $user = Company::create($request->all());
                $VerificationCode['company_id'] = $user->id;

                \Mail::to($request->email)->send(new \App\Mail\RegisterMail('Company',$user->id));
            }
            $VerificationCode = VerificationCode::create($VerificationCode);

            \App\SmsUnifonic::send($user->phone,"كود+التفعيل+الخاص+بحسابك+علي+مندوبكم+".$VerificationCode->code);

            // \Mail::to($user->email)->send(new \App\Mail\RegisterMail($request->userType,$user->id));

            \Session::flash('flash_message', __('page.pleases verfiy the account by email and sms') );
            return redirect('Site/VerificationCode/'.$request->userType.'/'.$user->id);
      }

      public function VerificationCode_index($user_type,$user_id)
      {
          return view('Site.Auth.VerifyCode',compact('user_type','user_id'));
      }

      public function check_phone_activation_code(Request $request)
      {
            $data = $request->validate([
                'user_type' => 'required|in:buyer,company',
                'user_id' => 'required',
                'code' => 'required',
            ]);

            switch ($request->user_type)
            {
                case 'buyer':
                    $user_type_id = 'buyer_id';
                  break;
                case 'company':
                    $user_type_id = 'company_id';
                  break;
            }
            $verification = VerificationCode::where($user_type_id , $request->user_id)
                                            ->where('created_at', '>', \Carbon\Carbon::now()->subMinutes(5)->toDateTimeString())
                                            ->orderBy('created_at', 'desc')->first();
            if( !isset($verification->code) )
            {
                \Session::flash('flash_message', __('page.code not match or you take more than 5 minutes') );
                return back();
            }
            else
            {
                  if( $verification->code != $request->code )
                  {
                     \Session::flash('flash_message', __('page.please verify email if not verifed and wait until the admin approvement') );
                     return back();
                  }
                  else // the code match
                  {
                        switch ($request->user_type)
                        {
                          case 'buyer':
                                $user = Buyer::findOrFail($request->user_id);
                            break;
                          case 'company':
                                $user = Company::findOrFail($request->user_id);
                            break;
                        }
                      $user->update([
                        'phone' => $verification->phone,
                        'phone_verified' => '1'
                      ]);
                      $verification->delete();
                      \Session::flash('flash_message', __('page.phone verified') );
                      return redirect('Site/login_register');
                  }
            }
      }

      public function resend_code($user_type,$user_id)
      {
         $VerificationCode = [
           'code' => rand(1111,9999),
         ];
            switch ($user_type)
            {
                case 'buyer':
                    $user_type_id = 'buyer_id';
                    $user = Buyer::findOrFail($user_id);
                    $VerificationCode['buyer_id'] = $user->id;
                  break;
                case 'company':
                    $user_type_id = 'company_id';
                    $user = Company::findOrFail($user_id);
                    $VerificationCode['company_id'] = $user->id;
                  break;
            }              //   return $user;
              VerificationCode::where($user_type_id,$user_id)->delete();
            $VerificationCode['phone'] = $user->phone;
            $verification = VerificationCode::create($VerificationCode);
            \App\SmsUnifonic::send($user->phone,"كود+التفعيل+الخاص+بحسابك+علي+مندوبكم+".$verification->code);

            \Session::flash('flash_message', __('page.verification code has been sent to your phone') );
            return back();
      }

      //--------------------------------------------LOG IN--------------------------

      public function login(Request $request)
      {
        // return $request->all();
          $validator = $request->validate([
              'userType' => 'required|in:buyer,company',
              'email' => 'required',
              'password' => 'required',
          ]);

          $VerificationCode = [
            'code' => rand(1111,9999),
            'phone' => $request->phone
          ];

          $errors = new \Illuminate\Support\MessageBag();
          $accapted_to_login = true;

          switch ($request->userType)
          {
              case 'buyer':
                  $user_type_id = 'buyer_id';
                  $user = Buyer::where('email',$request->email)->where('password', md5(md5( 'moi20'. $request->password )) )->first();
                  $VerificationCode['buyer_id'] = $user->id??null;
                break;
              case 'company':
                  $user_type_id = 'company_id';
                  $user = Company::where('email',$request->email)->first();
                  if($user)
                  {
                      if( ! Hash::check($request->password, $user->password) ) {
                        $errors->add('your_custom_error', __('page.email or password is wrong'));
                        return back()->withErrors($errors)->withInput();
                      }
                      $VerificationCode['company_id'] = $user->id??null;
                  }
                break;
          }

          if(!$user)
          {
              $errors->add('your_custom_error', __('page.email or password is wrong'));
              return back()->withErrors($errors)->withInput();
          }
          else
          {
              if($user->phone_verified == 0)
              {
                  $errors->add('your_custom_error', __('page.phone not verified'));
                  $accapted_to_login = false;
                  $VerificationCode['phone'] = $user->phone;
                  $VerificationCode = VerificationCode::create($VerificationCode);
                  \App\SmsUnifonic::send($user->phone,"كود+التفعيل+الخاص+بحسابك+علي+مندوبكم+".$VerificationCode->code);
                  \Session::flash('flash_message', __('page.pleases verfiy the account by email and sms') );
                  return redirect('Site/VerificationCode/'.$request->userType.'/'.$user->id);
              }
              if($user->email_verified == 0)
              {
                  $errors->add('your_custom_error', __('page.email not verified'));
                  $accapted_to_login = false;
                  \Mail::to($request->email)->send(new \App\Mail\RegisterMail(ucfirst($request->userType),$user->id));
              }
              if($user->is_accapted_by_admin == 0)
              {
                  $errors->add('your_custom_error', __('page.admin not accapted you yet'));
                  $accapted_to_login = false;
              }
              if($user->status == 0)
              {
                  $errors->add('your_custom_error', __('page.admin stops you from login'));
                  $accapted_to_login = false;
              }
          }

          if($accapted_to_login == false)
            return back()->withErrors($errors)->withInput();
          else
          {
                switch ($request->userType)
                {
                    case 'buyer':
                        auth('Buyer')->loginUsingId($user->id, $request->keep_login);
                        return redirect('Site/Home');
                      break;
                    case 'company':
                        auth('Company')->loginUsingId($user->id,  $request->keep_login);
                        return redirect('Company/Item');
                      break;
                }
          }
      }//----End login----

      public function logout()
      {
          \Auth::guard('Buyer')->logout();
          \Auth::guard('Company')->logout();
          return back();
      }

}
