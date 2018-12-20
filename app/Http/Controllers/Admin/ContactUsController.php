<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContactUs;

class ContactUsController extends Controller
{
  public function __construct()
  {
     $this->middleware('auth');
     $this->middleware('lang');
  }

  public function index()
  {
      return view('Admin.ContactUs.index');
  }

  //---api----
  public function get_list(Request $request)
  {
       $search = $request->search;
       return ContactUs::select( 'id',\DB::raw("CONCAT(fname,' ',lname) as name"),'phone','email','message','created_at' )
        ->where(function($q)use($search){
            if ($search)
              $q->whereRaw("CONCAT(fname,' ',lname) like '%$search%' ")->orWhere('phone',$search)->orWhere('email',$search)
                ->orWhere('id',$search);
        })
        ->latest('id')->paginate();
  }

  //--api--
  public function destroy($id)
  {
       try {
         $deleted = ContactUs::destroy($id);
       } catch (\Exception $e) {
         return 'false';
       }
       return 'true';
  }

}
