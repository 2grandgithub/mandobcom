<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Membership;

class MembershipController extends Controller
{
      public function __construct()
      {
         $this->middleware('auth');
         $this->middleware('lang');
      }

      public function index()
      {
          $lang = app()->getLocale()??'ar';
          $Memberships = Membership::select('name_'.$lang.' as name','id','see_auctions','no_add_offers','price_per_month')->get();
          return view('Admin.Membership.index',compact('Memberships'));
      }

      public function update(Request $request)
      {
           $data = $request->validate([ 
              'id' => 'required',
              'see_auctions' => 'required',
              'no_add_offers' => ' ',
              'price_per_month' => 'required',
          ]);

           Membership::whereId( $request->id )->update( $data );

          \Session::flash('flash_message','  تم التعديل ');
          return back();
      }



}
