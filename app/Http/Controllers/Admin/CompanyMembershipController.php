<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyMembership;

class CompanyMembershipController extends Controller
{
      public function __construct()
      {
         $this->middleware('auth');
         $this->middleware('lang');
      }

      public function index()
      {
          $lang = app()->getLocale()??'ar';
          $companies = \App\Company::select('name_'.$lang.' as label','id as value')->get();
          $Memberships = \App\Membership::select('name_'.$lang.' as label','id as value')->get();
          return view('Admin.CompanyMembership.index',compact('companies','Memberships'));
      }

      //---api----
      public function get_list(Request $request)
      {
           $lang = app()->getLocale()??'ar';
           $search = $request->text;
           $company_id = $request->company_id;
           $membership_id = $request->membership_id;
           $status = $request->status;
           return CompanyMembership::select( 'company_membership.id', 'companies.id as company_id', 'companies.name_'.$lang.' as company_name',
                                     'companies.email','companies.phone', 'memberships.name_'.$lang.' as membership_name',
                                     'from','to','price','paid','confirmed' , 'company_membership.created_at')
            ->join('companies','companies.id','company_membership.company_id')
            ->join('memberships','memberships.id','company_membership.membership_id')
            ->groupBy('company_membership.id')
            ->where(function($q)use($search,$company_id,$membership_id,$status){
                if ($search)
                    $q->where("companies.name_ar",'like','%'.$search.'%')->orWhere("companies.name_en",'like','%'.$search.'%')
                      ->orWhere('companies.phone',$search)->orWhere('companies.email',$search)
                      ->orWhere('company_membership.id',$search);
                if($company_id)
                    $q->where("company_membership.company_id",$company_id);
                if($membership_id)
                    $q->where("company_membership.membership_id",$membership_id);
                if($status)
                {
                    if($status == 'paid')
                       $q->where("paid",1);
                    else if($status == 'not_paid')
                       $q->where("paid",0);
                    else if($status == 'paid_and_notConfirmed')
                       $q->where("paid",1)->where("confirmed",0);
                    else if($status == 'paid_and_confirmed')
                       $q->where("paid",1)->where("confirmed",1);
                }

            })
            ->latest('company_membership.id')->paginate();
      }


      //--api--
      public function switch_paid($id)
      {
           $Car = CompanyMembership::findOrFail($id);
           if( $Car->paid )
           {
              $Car->update(['paid' => '0']);
              $case = 0;
           }
           else
           {
              $Car->update(['paid' => '1']);
              $case = 1;
           }

           return response()->json([
               'status' => 'success',
               'case' => $case
           ]);
      }

      //--api--
      public function switch_confirmed($id)
      {
           $CompanyMembership = CompanyMembership::findOrFail($id);
           if( $CompanyMembership->confirmed )
           {
              $CompanyMembership->update(['confirmed' => '0']);
              $case = 0;
           }
           else
           {
              $CompanyMembership->update(['confirmed' => '1']);
              $case = 1;
              $Company = \App\Company::find($CompanyMembership->company_id);
              \Notification::send($Company, new \App\Notifications\MembershipConfirmed($CompanyMembership));
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
             $deleted = CompanyMembership::destroy($id);
           } catch (\Exception $e) {
             return 'false';
           }
           return 'true';
      }
}
