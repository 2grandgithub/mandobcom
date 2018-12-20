<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recycable;

class RecycableController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        return view('Admin.Recycable.index');
    }

    //---api----
    public function get_list(Request $request)
    {
         $search = $request->search;
         $accaptance = $request->accaptance;
         $lang = app()->getLocale()??'ar';
         return Recycable::select('recycables.*', \DB::raw("CONCAT(aramex_countries.name_".$lang.",' - ',aramex_City) as full_location") )
         ->where(function($q)use($search,$accaptance){
              if ($search)
                $q->where('name','like','%'.$search.'%')->orWhere('recycables.id',$search)->orWhere('recycables.email',$search)->orWhere('recycables.phone',$search);
              if ($accaptance == 'not_accapted')
                $q->where('recycables.is_accapted_by_admin',0)->where('email_verified',1)->where('phone_verified',1);
              elseif ($accaptance == 'accapted_only')
                $q->where('recycables.is_accapted_by_admin',1);
          })
          ->leftJoin('aramex_countries','aramex_countries.code','recycables.aramex_CountryCode')
          ->groupBy('recycables.id')
          ->latest('recycables.id')->paginate();
    }

    //--api--
    public function showORhide($id)
    {
         $Car = Recycable::findOrFail($id);
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
    public function accaptedORunAccapted($id)
    {
         $Car = Recycable::findOrFail($id);
         if( $Car->is_accapted_by_admin )
         {
            $Car->update(['is_accapted_by_admin' => '0']);
            $case = 0;
         }
         else
         {
            $Car->update(['is_accapted_by_admin' => '1']);
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
           $deleted = Recycable::destroy($id);
         } catch (\Exception $e) {
           return 'false';
         }
         return 'true';
    }

}
