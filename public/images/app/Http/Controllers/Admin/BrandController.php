<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;

class BrandController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        return view('Admin.Brand.index');
    }

    //---api---
    public function list(Request $request)
    {
         $val = $request->search;
         $Brand = Brand::where(function($query)use($val){
            if ($val)
            {
                $query->where('name','like','%'.$val.'%')->orWhere('id',$val);
            }
         })->latest()->paginate();
         return $Brand;
    }


    //---api----
    public function destroy($id)
    {
         try {
           $deleted = Brand::destroy($id);
         } catch (\Exception $e) {
           return 'false';
         }
         return 'true';
    }


    public function store(Request $request)
    {
          $data = $request->validate([
            'name' => 'required',
          ]);
          if ($request->has('status'))
              $data['status'] = 1;
          else
            $data['status'] = 0;
          if ($request->image)
          {
             $fileName  = rand(11111,99999).'.'.$request->image->getClientOriginalExtension(); // renameing image
             $destinationPath = public_path('images/brands');
             $request->image->move($destinationPath, $fileName); // uploading file to given path
             $data['image'] = $fileName;
          }

          $Brand = Brand::create($data);
          \Session::flash('flash_message',' الشركة اضافت ');
          return back();
    }


    public function update(Request $request)
    {
        $data = $request->validate([
          'name' => 'required',
          'id' => 'required',
        ]);
        $Brand = Brand::findOrFail($request->id);
        if ($request->has('status'))
            $data['status'] = 1;
        else
          $data['status'] = 0;
        if ($request->image)
        {
           $fileName  = rand(11111,99999).'.'.$request->image->getClientOriginalExtension(); // renameing image
           $destinationPath = public_path('images/brands');
           $request->image->move($destinationPath, $fileName); // uploading file to given path
           $data['image'] = $fileName;
        }

        $Brand->update($data);
        \Session::flash('flash_message',' الشركة اتعدلت');
        return back();
    }


}
