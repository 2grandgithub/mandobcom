<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class AdvertisingController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        $adverting = Setting::pluck('value','title');
        return view('Admin.Advertising.index',compact('adverting'));
    }

    //--api--
    public function update(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'link' => 'required',
            'image' => ' ',
        ]);
       
        if($request->image)
        {
            $fileName = rand(11111,99999).'.'.$request->image->getClientOriginalExtension(); // renameing image
            $destinationPath = public_path('images/ads');
            $request->image->move($destinationPath, $fileName); // uploading file to given path

            Setting::where( 'title',$request->name )->update([
                'value' => $fileName,
            ]);
        }

        Setting::where( 'title',$request->name.'_link' )->update([
            'value' => $request->link,
        ]);

        \Session::flash('flash_message','  تم التعديل ');
        return back();
    }


}
