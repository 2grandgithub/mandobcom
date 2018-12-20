<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProducerFamily;

class ProducerFamilyController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        return view('Admin.ProducerFamily.index');
    }

    //---api----
    public function get_list(Request $request)
    {
         $search = $request->search;
         $accaptance = $request->accaptance;
         $lang = app()->getLocale()??'ar';
         return ProducerFamily::select('producer_family.*',\DB::raw("CONCAT(aramex_countries.name_".$lang.",' - ',aramex_City) as full_location") )
         ->where(function($q)use($search,$accaptance){
              if ($search)
                $q->where('name','like','%'.$search.'%')->orWhere('producer_family.id',$search)->orWhere('producer_family.email',$search)->orWhere('producer_family.phone',$search);
              if ($accaptance == 'not_accapted')
                $q->where('producer_family.is_accapted_by_admin',0)->where('email_verified',1)->where('phone_verified',1);
              elseif ($accaptance == 'accapted_only')
                $q->where('producer_family.is_accapted_by_admin',1);
          })
          ->leftJoin('aramex_countries','aramex_countries.code','producer_family.aramex_CountryCode')
          ->groupBy('producer_family.id')
          ->latest('producer_family.id')->paginate();
    }

    //--api--
    public function showORhide($id)
    {
         $Car = ProducerFamily::findOrFail($id);
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
         $Car = ProducerFamily::findOrFail($id);
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
           $deleted = ProducerFamily::destroy($id);
         } catch (\Exception $e) {
           return 'false';
         }
         return 'true';
    }

}
