<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lang');
    }

    public function index()
    {
        $roles = Role::latest()->paginate();
        return view('Admin.Role.index',compact('roles'));
    }

    public function search($val)
    {
        $roles = Role::where('name','like','%'.$val.'%')->orWhere('comment','like','%'.$val.'%')->latest()->paginate();
        return view('Admin.Role.index',compact('roles','val'));
    }


    public function create()
    {
        return view('Admin.Role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'comment' => 'required'
        ]);
        $role = Role::create($data);
        $role->get_Permissions()->attach($request->permissions);
        if( \Session::get('lang') == 'ar' )
          { \Session::flash('flash_message',' الدور اضاف ');   }
        else
          { \Session::flash('flash_message','Role has added');  }

        return redirect('Role');
    }

    // public function show($id)
    // {
    //     $role = Role::findOrFail($id);
    //     return view('Role.show',compact('role'));
    // }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $get_permissions = \DB::table('role_permission')->where('role_id',$role->id)->pluck('permission_id');
        $selected_permissions = array();
        array_push($selected_permissions,0);//for avoiding the problem of first index
        foreach ($get_permissions as $permission)
        {
            array_push($selected_permissions,$permission);
        }
        return view('Admin.Role.edit',compact('role','permissions','selected_permissions'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'comment' => 'required'
        ]);
        $role = Role::findOrFail($id);
        $role->update($data);
        $role->get_Permissions()->sync($request->permissions);
        if( \Session::get('lang') == 'ar' )
          { \Session::flash('flash_message',' الدور اتعدل');   }
        else
          { \Session::flash('flash_message','Role has updated');  }
        return redirect('Role');
    }

}
