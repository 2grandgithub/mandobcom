<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AramexCountry;
use App\Aramex;

class GovernorateController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        $lang = app()->getLocale()??'ar';
        $cities = AramexCountry::select( \DB::raw("CONCAT(code,' :- ',name_$lang) as label"),'code as value')->get();
        return view('Admin.Governorate.index',compact('cities'));
    }

    //---api----
    public function get_list(Request $request)
    {
         $aramex_country_code = $request->aramex_country_code;
         $search = $request->search ?? '';

         $Obj_Aramex = new Aramex();
         return $Obj_Aramex->LocationCitiesFetching($aramex_country_code,$search);

         // return AramexCity::where('aramex_country_code',$aramex_country_code)
         // ->where(function($q)use($search){
         //      if ($search)
         //        $q->where('name_en','like','%'.$search.'%')->orWhere('name_ar','like','%'.$search.'%')->orWhere('id',$search);
         //  })
         //  ->latest('id')->paginate();
    }


    // public function store(Request $request)
    // {
    //       $validator = \Validator::make($request->all(), [
    //           'name_en' => 'required',
    //           'name_en' => 'required',
    //           'city_id' => 'required',
    //       ]);
    //       if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }
    //       $Governorate = Governorate::create($request->except('_token'));
    //       $Governorate->status = 1;
    //       return response()->json([
    //         'status' => 'success',
    //         'data' => $Governorate
    //       ]);
    // }
    //
    // //--api--
    // public function update(Request $request)
    // {
    //     $validator = \Validator::make($request->all(), [
    //         'id' => 'required',
    //         'name_en' => 'required',
    //         'name_en' => 'required',
    //         'city_id' => 'required',
    //     ]);
    //     if ($validator->fails()) { return response()->json([ 'state' => 'notValid' , 'data' => $validator->messages() ]);  }
    //
    //     $Governorate = Governorate::findOrFail($request->id);
    //     $Governorate->update($request->except('_token'));
    //     return response()->json([
    //       'status' => 'success',
    //       'data' => $Governorate
    //     ]);
    // }

    // //--api--
    // public function showORhide($id)
    // {
    //      $Car = Governorate::findOrFail($id);
    //      if( $Car->status )
    //      {
    //         $Car->update(['status' => '0']);
    //         $case = 0;
    //      }
    //      else
    //      {
    //         $Car->update(['status' => '1']);
    //         $case = 1;
    //      }
    //
    //
    //      return response()->json([
    //          'status' => 'success',
    //          'case' => $case
    //      ]);
    // }
    //
    // //--api--
    // public function destroy($id)
    // {
    //      try {
    //        $deleted = Governorate::destroy($id);
    //      } catch (\Exception $e) {
    //        return 'false';
    //      }
    //      return 'true';
    // }

}
