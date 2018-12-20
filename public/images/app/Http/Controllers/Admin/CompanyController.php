<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        return view('Admin.Company.index');
    }

    //---api----
    public function get_list(Request $request)
    {
         $search = $request->search;
         $accaptance = $request->accaptance;
         $lang = app()->getLocale()??'ar';
         return Company::select('companies.*',\DB::raw("CONCAT(aramex_countries.name_".$lang.",' - ',aramex_City) as full_location") )
         ->where(function($q)use($search,$accaptance){
              if ($search)
                $q->where('companies.name_en','like','%'.$search.'%')->orWhere('companies.name_ar','like','%'.$search.'%')->orWhere('companies.id',$search);
              if ($accaptance == 'not_accapted')
                $q->where('companies.is_accapted_by_admin',0);
              elseif ($accaptance == 'accapted_only')
                $q->where('companies.is_accapted_by_admin',1);
          })
          ->leftJoin('aramex_countries','aramex_countries.code','companies.aramex_CountryCode')
          ->groupBy('companies.id')
          ->latest('companies.id')->paginate();
    }

    //--api--
    public function showORhide($id)
    {
         $Car = Company::findOrFail($id);
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
         $Car = Company::findOrFail($id);
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
           $deleted = Company::destroy($id);
         } catch (\Exception $e) {
           return 'false';
         }
         return 'true';
    }

}
