<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('lang');
    }

    public function index()
    {
       $User = User::latest()->paginate();
       return view('User.index');
    }

    //---api---
    public function User_list(Request $request)
    {
       $val = $request->search;
       $User = User::select('*',\DB::raw("CONCAT(fname,' ',lname) as name") )->where(function($query)use($val){
          if ($val)
          {
              $query->whereRaw("CONCAT(fname,' ',lname) like ?",['%'.$val.'%'])->orWhere('phone','like','%'.$val.'%')->orWhere('email','like','%'.$val.'%')
                    ->orWhere('model','like','%'.$val.'%')->orWhere('id',$val)->orWhere('os',$val);
          }
       })->latest()->paginate();
       return $User;
    }


    //---api----
    public function destroy($id)
    {
        $User = User::whereId($id)->delete();
    }
}
