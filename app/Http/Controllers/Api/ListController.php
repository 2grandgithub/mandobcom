<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AramexCountry;
use App\AramexCity;

class ListController extends Controller
{

    public function Country_list()
    {
      $Country = AramexCountry::select('name_en','name_ar','code')->where('status',1)->get();
      return $Country;
    }

    public function City_list($code)
    {
         $Obj_Aramex = new \App\Aramex();
         $Cities = $Obj_Aramex->LocationCitiesFetching($code);
         return $Cities;
    }

         public function City_list_array($code)
         {
                $Obj_Aramex = new \App\Aramex();
                $Cities = $Obj_Aramex->LocationCitiesFetching($code);
                $Cities = json_decode($Cities); dd($Cities);
                return response()->json( $Cities->Cities->string );
         }
 


}
