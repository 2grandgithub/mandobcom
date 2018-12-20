<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Buyer;

class BuyerController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
        return view('Admin.Buyer.index');
    }

    //---api----
    public function get_list(Request $request)
    {
         $search = $request->search;
         $accaptance = $request->accaptance;
         $lang = app()->getLocale()??'ar';
         return Buyer::select('buyers.*', \DB::raw("CONCAT(aramex_countries.name_".$lang.",' - ',aramex_City) as full_location") )
         ->where(function($q)use($search,$accaptance){
              if ($search)
                $q->where('name','like','%'.$search.'%')->orWhere('buyers.id',$search)->orWhere('buyers.email',$search)->orWhere('buyers.phone',$search);
              if ($accaptance == 'not_accapted')
                $q->where('buyers.is_accapted_by_admin',0)->where('email_verified',1)->where('phone_verified',1);
              elseif ($accaptance == 'accapted_only')
                $q->where('buyers.is_accapted_by_admin',1);
          })
          ->leftJoin('aramex_countries','aramex_countries.code','buyers.aramex_CountryCode')
          ->groupBy('buyers.id')
          ->latest('buyers.id')->paginate(); 
    }

    //--api--
    public function showORhide($id)
    {
         $Car = Buyer::findOrFail($id);
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
         $Car = Buyer::findOrFail($id);
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
           $deleted = Buyer::destroy($id);
         } catch (\Exception $e) {
           return 'false';
         }
         return 'true';
    }

}
