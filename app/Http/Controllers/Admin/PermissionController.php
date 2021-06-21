<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:admin.permissions.index|admin.permissions.create|admin.permissions.edit|admin.permissions.destroy', ['only' => ['index','store']]);
         $this->middleware('permission:admin.permissions.index', ['only' => ['index']]);
         $this->middleware('permission:admin.permissions.create', ['only' => ['create','store']]);
         $this->middleware('permission:admin.permissions.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:admin.permissions.destroy', ['only' => ['destroy']]);
    }

    public function index()
    {
        $permissions = Permission::get();
        return view('admin.permissions.index',compact('permissions'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store()
    {
        $rules = 
        [
            'name' => 'required|string',
        ];

        $names = 
        [
            'name' => 'Name'
        ];

        $data = $this->validate(request(),$rules, [],$names);

        Permission::create($data);
        Session::flash('success','Permission Created');
        return back();
    }

    public function show($id)
    {

    }
   
    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('admin.permissions.edit',compact('permission'));

    }

    public function update($id)
    {
        $permission = Permission::find($id);

        $rules = 
        [
            'name' => 'required|string',
        ];

        $names = 
        [
            'name' => 'Name'
        ];

        $data = $this->validate(request(),$rules, [],$names);

        Permission::where('id',$permission->id)->update($data);
        Session::flash('success','Permission Updated');
        return back();

    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        Permission::where('id',$permission->id)->delete();
        Session::flash('success','Permission Deleted');
        return back();
    }


    
    
}
