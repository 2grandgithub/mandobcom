<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginCompanyController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = '/test';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('guest')->except('logout');
  }

      public function admin_login_form()
      {
          if( \Auth::check() )
          { return redirect('Company.DashBoard'); }
         return view('atlant.sign-in_company');
      }

      public function admin_login(Request $request)
      {
             $request->validate([
               'email' => 'required',
               'password' => 'required'
             ]);

             $login_arr = [
               'email'=>$request->email,
               'password'=>$request->password ,
               'status'=> 1,
               'is_accapted_by_admin'=> 1,
               'email_verified'=> 1,
               'phone_verified'=> 1,
             ];

             if( \Auth::guard('Company')->attempt($login_arr)  )
             {
                  \App::setLocale('ar');
                  return redirect('Company/DashBoard');
             }
             else
             {
                  \Session::flash('flash_message','username or password is wrong');
                  return back()->withInput($request->only('username','remember') );
             }
      }


}
