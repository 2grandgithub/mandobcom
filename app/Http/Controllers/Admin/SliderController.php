<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;

class SliderController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        $Sliders = Slider::get();
        return view('Admin.Slider.index',compact('Sliders'));
    }

    public function update(Request $request)
    {
         $data = $request->validate([
            'id' => 'required',
            'link' => 'required',
            'image' => ' ',
        ]);

        if($request->image)
        {
          $fileName = rand(11111,99999).'.'.$request->image->getClientOriginalExtension(); // renameing image
          $destinationPath = public_path('images/Slider');
          $request->image->move($destinationPath, $fileName); // uploading file to given path
          $data['image'] = $fileName;
        }

        Slider::whereId( $request->id )->update( $data );

        \Session::flash('flash_message','  تم التعديل ');
        return back();
    }

    public function create(Request $request)
    {
         $data = $request->validate([
            'link' => 'required',
            'image' => '',
        ]);
        //
        // if($request->image)
        // {
        //   $fileName = rand(11111,99999).'.'.$request->image->getClientOriginalExtension(); // renameing image
        //   $destinationPath = public_path('images/Slider');
        //   $request->image->move($destinationPath, $fileName); // uploading file to given path
        //   $data['image'] = $fileName;
        // }
        $data['status'] = 1;
        Slider::create( $data );

        \Session::flash('flash_message','  تم الاضافة ');
        return back();
    }

    //--api--
    public function showORhide($id)
    {
         $Car = Slider::findOrFail($id);
         if( $Car->status )
         {
            $Car->update(['status' => '0']);
            $case = 0;
         }
         else
         {
            $Car->update(['status' => '1']);
            $case = 1;
         }

         return response()->json([
             'status' => 'success',
             'case' => $case
         ]);
    }

    //--api--
     public function destroy($id)
     {
           try {
             $deleted = Slider::destroy($id);
           } catch (\Exception $e) {
               return 'false';
           }
           return 'true';
     }

}
