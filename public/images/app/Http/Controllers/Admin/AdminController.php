<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lang');
    }

    public function index()
    {
        $admins = Admin::paginate();
        return view('Admin.Admin.index',compact('admins'));
    }

    public function search($val)
    {
        $admins = Admin::where('name','like','%'.$val.'%')->orWhere('username','like','%'.$val.'%')
                    ->orWhere('email','like','%'.$val.'%')->orWhere('phone','like','%'.$val.'%')
                    ->orWhereHas('get_Role',function($query)use($val){
                       $query->where('name','like','%'.$val.'%');
                    })->paginate();
        return view('Admin.Admin.index',compact('admins','val'));
    }

    public function create()
    {
        $roles = Role::latest()->pluck('name','id');
        $roles = [ ''=>'  ' ] + collect($roles)->toArray();
        return view('Admin.Admin.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:admins',
            'password' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'role_id' => 'required'
        ]);
        $data['password'] = \Hash::make($request->password);
        $admin = Admin::create($data);
        if( \Session::get('lang') == 'ar' )
          { \Session::flash('flash_message',' اضاف '.$admin->name.' مشرف ');   }
        else
          { \Session::flash('flash_message','Admin '.$admin->name.' has added');  }

        return redirect('Admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::latest()->pluck('name','id');
        return view('Admin.Admin.edit',compact('roles','admin'));
    }

    public function update(Request $request, $id)
    {
      $data = $request->validate([
          'name' => 'required',
          'username' => 'required|unique:admins,id,'.$id,
          'email' => 'required',
          'phone' => 'required',
          'role_id' => 'required'
      ]);
      $admin = Admin::findOrFail($id);
      if ($request->password)
      {
          $data['password'] = \Hash::make($request->password);
      }
      $admin->update($data);
      if( \Session::get('lang') == 'ar' )
        { \Session::flash('flash_message',' اتعدل '.$admin->name.' مشرف ');   }
      else
        { \Session::flash('flash_message','Admin '.$admin->name.' has updated');  }

      return redirect('Admin');
    }


    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        if( \Session::get('lang') == 'ar' )
          { \Session::flash('flash_message',' اتمسح '.$admin->name.' مشرف ');   }
        else
          { \Session::flash('flash_message','Admin '.$admin->name.' has delete');  }

        return redirect('Admin');
    }
}
