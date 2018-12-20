<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aramex;

class AramexController extends Controller
{
     public function LocationCitiesFetching($CountryCode)
     {
         // $Obj_Aramex = new Aramex();
         // $Aramex_Countries = $Obj_Aramex->LocationCitiesFetching($CountryCode);
         // return $Aramex_Countries ;
         if( $CountryCode == 'JO')
         {
            return json_encode([
               'Azraq','Jerash','Zarqa','Madaba','Shouneh','Ajloon','Qwaireh','Karak','Fuhais','Mafraq','Mahes','Shoubak','Amman',
               'Tafileh','Ramtha','Mwaqar','Petra','Wadi Mousa','Dulail','Ghour','Khaldieh','Aqaba','Rwaished','Salt',
               'Ma\'An','Naour','Irbid','A\'Ay','Al Fanadik','Al Hashmyeh','Al Jafer','Al Omari Borders','Al Qaser','Al Qastal',
               'Al Rosaifa','Al Sukhneh','Bereian','Der Allah','Free Zone','Ghour Al Safi','Ghweria','Maean','Moatah','Moghayam Hetein',
               'Rashadyeh','Theban','Yajoz','Zarqa\' Al Jadedeh' 
            ]);
         }
         else {
            return json_encode([ '' => 'only jordon is available' ]);
         }
     }

     public function CalculateRate(Request $request)
     {
         $Obj_Aramex = new Aramex();
         return  $Obj_Aramex->CalculateRate($request);
     }

     public function CreateShipments(Request $request)
     {
         $Obj_Aramex = new Aramex();
         return  $Obj_Aramex->CreateShipments($request);
     }
}
