<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
      public function __construct()
      {
          // $this->middleware('auth','auth:Company');
      }

      public function change_lang($get_lang)
      {
            \Session::put('lang',$get_lang);
            // app()->setLocale($get_lang);
            // \App::setLocale($get_lang);
            // if (\Auth::check())
            // {
            //   \Auth::user()->lang = $get_lang;
            //   \Auth::user()->save();
            // }
            // dd(\Session::get('lang'));
            // dd(\App::getLocale());
            return back();
      }

      public function mark_notification_seen($id)
      {
           $notification = auth('Company')->user()->notifications()->where('id',$id)->first();
           if ($notification)
           {
               $notification->update(['read_at'=>\Carbon\Carbon::now()]);
               return back();
           }
           else
               return back()->withErrors('we could not found the specified notification');
       }
}
