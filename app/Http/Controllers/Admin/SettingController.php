<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }


    public function index()
    {
        return view('Admin.Setting.index' );
    }

    public function list()
    {
        return Setting::pluck('value','title') ;
    }

    public function store(Request $request)
    {             
         $validator = \Validator::make($request->all(), [
           // 'advertising_for_recycables_whenfull_requests' => '',
           // 'advertising_for_add_producer_family_product' => '',
           'about_us_title_en' => 'required',
           'about_us_details_ar' => 'required',
           'about_us_title_ar' => 'required',
           'about_us_details_en' => 'required',
           'facebook' => 'required',
           'twitter' => 'required',
           'linkedin' => 'required',
           'instagram' => 'required',
           'our_address_en' => 'required',
           'our_address_ar' => 'required',
           'our_phone' => 'required',
           'our_email' => 'required',
         ]);
         if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }


         Setting::where('title','about_us_title_en')->update(['value'=>$request->about_us_title_en]);
         Setting::where('title','about_us_details_ar')->update(['value'=>$request->about_us_details_ar]);
         Setting::where('title','about_us_title_ar')->update(['value'=>$request->about_us_title_ar]);
         Setting::where('title','about_us_details_en')->update(['value'=>$request->about_us_details_en]);
         Setting::where('title','facebook')->update(['value'=>$request->facebook]);
         Setting::where('title','twitter')->update(['value'=>$request->twitter]);
         Setting::where('title','linkedin')->update(['value'=>$request->linkedin]);
         Setting::where('title','instagram')->update(['value'=>$request->instagram]);
         Setting::where('title','our_address_en')->update(['value'=>$request->our_address_en]);
         Setting::where('title','our_address_ar')->update(['value'=>$request->our_address_ar]);
         Setting::where('title','our_phone')->update(['value'=>$request->our_phone]);
         Setting::where('title','our_email')->update(['value'=>$request->our_email]);

         if ($request->file('main_page_image1_beside_slider'))
         {
             $fileName = rand(11111,99999).'.'.$request->main_page_image1_beside_slider->getClientOriginalExtension(); // renameing image
             $destinationPath = public_path('images/ads');
             $request->main_page_image1_beside_slider->move($destinationPath, $fileName); // uploading file to given path
             Setting::where('title','main_page_image1_beside_slider')
                    ->update(['value'=>$fileName]);
         }
         if ($request->file('main_page_image2_beside_slider'))
         {   // dd(' main_page_image2_beside_slider 2');
             $fileName = rand(11111,99999).'.'.$request->main_page_image2_beside_slider->getClientOriginalExtension(); // renameing image
             $destinationPath = public_path('images/ads');
             $request->main_page_image2_beside_slider->move($destinationPath, $fileName); // uploading file to given path
             Setting::where('title','main_page_image2_beside_slider')
                    ->update(['value'=>$fileName]);
         }

         $Settings = Setting::pluck('value','title') ;
         return response()->json([
           'status' => 'success',
           'data' => $Settings
         ]);
    }


}
