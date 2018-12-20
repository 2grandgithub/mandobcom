<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AramexCountry;

class CityController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        return view('Admin.City.index');
    }

    //---api----
    public function get_list(Request $request)
    {
         $search = $request->search;
         return AramexCountry::
          where(function($q)use($search){
              if ($search)
                $q->where('code',$search)->where('name_en','like','%'.$search.'%')->orWhere('name_ar','like','%'.$search.'%')->orWhere('id',$search);
          })
          ->latest('id')->paginate();
    }


    //
    // //--api--
    // public function update(Request $request)
    // {
    //     $validator = \Validator::make($request->all(), [
    //         'id' => 'required',
    //         'name_en' => 'required',
    //         'name_en' => 'required',
    //     ]);
    //     if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }
    //
    //     $City = City::findOrFail($request->id);
    //     $City->update($request->except('_token'));
    //     return response()->json([
    //       'status' => 'success',
    //       'data' => $City
    //     ]);
    // }

    //--api--
    public function showORhide($id)
    {
         $Car = AramexCountry::findOrFail($id);
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

    // //--api--
    // public function destroy($id)
    // {
    //      try {
    //        $deleted = City::destroy($id);
    //      } catch (\Exception $e) {
    //        return 'false';
    //      }
    //      return 'true';
    // }

}
