<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyMembership;
use App\Membership;

class CompanyMembershipController extends Controller
{
      public function __construct()
      {
         $this->middleware('auth:Company');
         // $this->middleware('lang');
      }

      public function index()
      {
          $lang = app()->getLocale()??'ar';
          $Memberships = Membership::select('name_'.$lang.' as name','id','see_auctions','no_add_offers','price_per_month')->get();

          return view('Company.Membership.index', compact('Category','Memberships') );
      }

      public function assign_membership(Request $request)
      {
          $data = $request->validate([
              'membership_id' => 'required',
              'from' => 'required',
              'months' => 'required',
              // 'paid' => 'required',
          ]);
          $membership = Membership::findOrFail($request->membership_id);
          $data['price'] = $membership->price_per_month * $request->months;
          $to = \Carbon\Carbon::parse($request->from)->addMonth($request->months);
          $to = $to->toDateString();
          $from = $request->from;
          $data['to'] = $to;
          $data['company_id'] = auth('Company')->id();       
          $check = CompanyMembership::whereRaw("((`from` = ? AND `to` = ? ) OR ( ? BETWEEN `from` AND `to` ) OR ( ? BETWEEN `from` AND `to` ) OR ( `from` > ? AND `to` < ? ))",[$from,$to,$from,$to,$from,$to ])
                  ->where('company_id', $data['company_id'] )->first();
          if($check){
            \Session::flash('flash_message_danger',' التاريخ متعارض معا اشتراك سابق لك ');
             return back();
          }
          CompanyMembership::create($data);
          \Session::flash('flash_message',' تم الاشتراك في العضويه سوف يتم تفعيل الاشتراك عند الدفع  ');
          // \Session::flash('flash_message_superImportant',' تم الاشتراك في العضويه سوف يتم تفعيل الاشتراك عند الدفع  ');
           return redirect('Company/Item');
      }

}
