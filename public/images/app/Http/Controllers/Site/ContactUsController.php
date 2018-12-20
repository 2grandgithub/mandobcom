<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactUs;
use App\Setting;

class ContactUsController extends Controller
{
    public function index()
    {
        $lang = app()->getLocale()??'ar';
        $abouts = Setting::where('title','about_us_title_'.$lang)->orWhere('title','about_us_details_'.$lang)->pluck('value','title');
        return view('Site/ContactUs',compact('abouts','lang'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        $ContactUs = ContactUs::create($data);
        \Session::flash('flash_message', __('page.your message is send'));
          return redirect('');
    }

}
