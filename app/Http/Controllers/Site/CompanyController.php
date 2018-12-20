<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Category;

class CompanyController extends Controller
{

    public function index()
    {

        return view('Site.Company.index');
    }

    public function get_list(Request $request)
    {
        $lang = app()->getLocale()??'ar';
        $search = $request->search;

        return Company::select('companies.id','companies.name_'.$lang.' as name','logo','companies.membership_id',
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
                         ->where(function($q)use($search){
                            if($search)
                               $q->where('name_ar','like','%'.$search.'%')->orWhere('name_en','like','%'.$search.'%');
                         })
                        ->where('email_verified',1)->where('phone_verified',1)->where('is_accapted_by_admin',1)->where('status',1)
                       ->latest('membership_id')->latest('id')->paginate(30);
    }

    public function details($id)
    {
        $lang = app()->getLocale()??'ar';
        $Company = Company::select('companies.id','companies.name_'.$lang.' as name','logo' ,'cities.name_'.$lang.' as city_name')
                        ->join('cities','cities.id','companies.city_id')
                        ->where('email_verified',1)->where('phone_verified',1)->where('is_accapted_by_admin',1)->where('companies.status',1)
                        ->where('companies.id',$id)
                        ->first();
          if(!$Company)
            return back();
        $category_ids = \App\Item::distinct('category_id')->where('company_id',$Company->id)->pluck('category_id');
        $categoires = Category::select('id','name_'.$lang.' as name','logo')->whereIn('id',$category_ids)->get();

        return view('Site.Company.details',compact('Company','categoires'));
    }


}
