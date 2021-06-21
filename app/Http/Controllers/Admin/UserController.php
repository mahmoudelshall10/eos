<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:admin.users.index|admin.users.create|admin.users.edit|admin.users.destroy', ['only' => ['index','store']]);
         $this->middleware('permission:admin.users.index', ['only' => ['index']]);
         $this->middleware('permission:admin.users.create', ['only' => ['create','store']]);
         $this->middleware('permission:admin.users.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:admin.users.destroy', ['only' => ['destroy']]);
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where('id','<>',1)->orderBy('id','DESC')->get();
        return view('admin.users.index',compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.users.create',compact(['roles']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name'                      => 'required|string',
            'email'                     => 'required|email|unique:users,email',
            'password'                  => 'required|min:8|confirmed',
            'password_confirmation'     => 'required',
            'role_id'                   => 'required|integer|exists:roles,id',
            'gender'                    => 'required|in:male,female',
            'photo'                     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'date_of_birth'             => 'required|date',
            'phone'                     => 'required|regex:/(01)[0-9]{9}/'
        ];

        $names = [
            'name'                      => 'Name',
            'email'                     => 'Email',
            'password'                  => 'Password',
            'password_confirmation'     => 'Password Confirmation',
            'role_id'                   => 'Role',
            'gender'                    => 'Gender',
            'photo'                     => 'Photo',
            'phone'                     => 'Phone',
        ];
        
        $data = $this->validate($request, $rules , [],$names);

        $data['date_of_birth'] = request('date_of_birth');

        $data['password'] = Hash::make(request('password'));

        $role_name = Role::where('id',request('role_id'))->first();
        
        $user = new User($data);

        if(request('photo') != null)
        {
            if(request('role_id') == 1)
            {
                $data['photo'] = storeImage($request ,'photo' , 'storage/app/admins_photos/', $user->id, 'users');
                
            }else{
                
                $data['photo'] = storeImage($request ,'photo' , 'storage/app/users_photos/', $user->id, 'users');
            }
        }
        
        $user->assignRole($role_name->name);
        
        $user->save();

        Session::flash('success','User created successfully');
        
        return redirect()->route('admin.users.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        
        return view('admin.users.edit',compact(['user']));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name'                      => 'required|string',
            'email'                     => 'required|email|unique:users,email,'.$id,
            'role_id'                   => 'required|integer|exists:roles,id',
            'gender'                    => 'required|in:male,female',
            'photo'                     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'date_of_birth'             => 'required|date',
            'phone'                     => 'required|regex:/(01)[0-9]{9}/'
        ];

        if(request('photo') != null)
        {
            $rules['photo'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096';
        }

        $names = [
            'name'                      => 'Name',
            'email'                     => 'Email',
            'role_id'                   => 'Role',
            'gender'                    => 'Gender',
            'photo'                     => 'Photo',
            'date_of_birth'             => 'Date Of Birth',
            'phone'                     => 'Phone',
        ];

        $data = $this->validate($request, $rules , [],$names);

        $user = User::find($id);

        $data['date_of_birth'] = request('date_of_birth');

        if(request('photo') != null)
        {
            if($user->photo != null)
            {
                File::delete($user->photo); // delete previous image from folder   
            }
    
            if(request('role_id') == 1)
            {
                $data['photo'] = storeImage($request ,'photo' , 'storage/app/admins_photos/', $user->id, 'users');
                
            }else{
    
                $data['photo'] = storeImage($request ,'photo' , 'storage/app/users_photos/', $user->id, 'users');
            }
        }
        
        $user->update($data);
        $role_name = Role::where('id',request('role_id'))->first();
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($role_name->name);


        return redirect()->route('admin.users.index')
                        ->with('success','User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        return redirect()->route('admin.users.index')
                        ->with('success','User deleted successfully');
    }

    public function updatePassword($id)
    {
            $user = User::find($id);

            $rules = 
            [
                'password'                  => 'required|min:8|confirmed',
				'password_confirmation'     => 'required',
            ];

            $data = $this->validate(request(),$rules);
            $data['password'] = Hash::make(request('password'));
            $user->update($data);
            return redirect()->route('admin.users.index')
                        ->with('success','User Password Updated successfully');
    }


    
}
