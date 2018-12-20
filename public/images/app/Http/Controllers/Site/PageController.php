<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class PageController extends Controller
{
    public function about_us()
    {
      $lang = app()->getLocale()??'ar';
      $abouts = Setting:: where('title','about_us_title_'.$lang )
                       ->orWhere('title','about_us_details_'.$lang )->pluck('value','title'); 
      return view('Site.about',compact('abouts','lang'));
    }
}
