<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
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
            { return redirect('DashBoard'); }
           return view('atlant.sign-in');
        }

        public function admin_login(Request $request)
        {
               $request->validate([
                 'username' => 'required',
                 'password' => 'required'
               ]);

               if( \Auth::attempt( ['username'=>$request->username, 'password'=>$request->password ])  )
               {
                  \App::setLocale('ar');
                  return redirect('DashBoard');
               }
               else
               {
                 \Session::flash('flash_message','username or password is wrong');
                 return back()->withInput($request->only('username','remember') );
               }
        }



}
