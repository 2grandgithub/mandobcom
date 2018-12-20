<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth'); 
    }


    public function index()
    {
        $Settings = Setting::pluck('value','title');
        return view('Setting.index',compact('Settings'));
    }

    public function store(Request $request)
    {
         //return $request->all();
         $data = $request->validate([
             'about_app' => 'required',
             'termis_and_condations' => 'required',
         ]);
         $Settings = Setting::where('title','about_app')->update(['value'=>$request->about_app]);
         $Settings = Setting::where('title','termis_and_condations')->update(['value'=>$request->termis_and_condations]);

         \Session::flash('flash_message',' الاعدادات اتعدلت ');
         return back();
    }


}
