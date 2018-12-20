<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;

class CompanyController extends Controller
{

      public function index()
      {
          // return Company::select('id','name_en','name_ar','logo','membership_id')->where('status',1)->get();
          return Company::select('companies.id','companies.name_en','companies.name_ar','logo','companies.membership_id',
                             'memberships.name_ar as membership_name',
                             \DB::raw("IF(c_m.membership_id,c_m.membership_id,1) as membership_id")
                           )
                           ->leftJoin('company_membership as c_m',function($q){
                               $q->on('c_m.company_id','companies.id')->whereRaw("NOW() BETWEEN c_m.from AND c_m.to")->where('confirmed',1);
                           })
                           ->leftJoin('memberships',function($q){
                               // if have membership else membership is (1) -> normail
                               $q->on('memberships.id',\DB::raw("IF(c_m.membership_id,c_m.membership_id,1)"));
                           })
                          ->where('companies.status',1)
                         ->latest('membership_id')->get();
      }

      public function search_by_name(Request $request)
      {
           $data = \Validator::make($request->all(), [
                'name' => '',
           ]);
           if ($data->fails()) {
                  return response()->json([ 'state' => 'notValid' , 'data' => $data->messages() ]);
           }
           $name = $request->name;
           return Company::select('companies.id','companies.name_en','companies.name_ar','logo','companies.membership_id',
                                  'memberships.name_ar as membership_name',
                                  \DB::raw("IF(c_m.membership_id,c_m.membership_id,1) as membership_id")
                                )
                                ->leftJoin('company_membership as c_m',function($q){
                                    $q->on('c_m.company_id','companies.id')->whereRaw("NOW() BETWEEN c_m.from AND c_m.to")->where('confirmed',1);
                                })
                                ->leftJoin('memberships',function($q){
                                    // if have membership else membership is (1) -> normail
                                    $q->on('memberships.id',\DB::raw("IF(c_m.membership_id,c_m.membership_id,1)"));
                                })
                               ->where('companies.status',1)
                          ->where(function($query)use($name){
                              if($name)
                                 $query->where('companies.name_en','like','%'.$name.'%')->orWhere('companies.name_ar','like','%'.$name.'%');
                          })
                          ->latest('membership_id')->get();
      }

      public function company_from_categoiry_id($categoiry_id)
      {
            $company_ids = \App\Item::where(function($q)use($categoiry_id){
                  if($categoiry_id && $categoiry_id != 0) {
                      $q->where('category_id',$categoiry_id);
                  }
            })->distinct('company_id')->pluck('company_id');

          return Company::select('companies.id','companies.name_en','companies.name_ar','logo','companies.membership_id',
                                 'memberships.name_ar as membership_name',
                                 \DB::raw("IF(c_m.membership_id,c_m.membership_id,1) as membership_id")
                               )
                               ->leftJoin('company_membership as c_m',function($q){
                                   $q->on('c_m.company_id','companies.id')->whereRaw("NOW() BETWEEN c_m.from AND c_m.to")->where('confirmed',1);
                               })
                               ->leftJoin('memberships',function($q){
                                   // if have membership else membership is (1) -> normail
                                   $q->on('memberships.id',\DB::raw("IF(c_m.membership_id,c_m.membership_id,1)"));
                               })
                     ->where('companies.status',1)
                     ->whereIn('companies.id',$company_ids)
                     ->latest('membership_id')->get();
      }

}
