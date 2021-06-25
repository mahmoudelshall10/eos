<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:site.profile', ['only' => ['index']]);
        // $this->middleware('permission:site.generalInfo', ['only' => ['store']]);
        // $this->middleware('permission:site.changeImage', ['only' => ['store']]);
        // $this->middleware('permission:site.changePassword', ['only' => ['store']]);
    }

    public function index()
    {
        return view('site.profile.account');
    }

    public function account_post(Request $request)
    {

            if (request('a') == 'general-info')
            {
                $user = auth()->user();
                $rules = [
                    'name'                      => 'required|string',
                    'email'                     => 'required|unique:users,email,'.$user->id,
                    'gender'                    => 'nullable|in:male,female',
                    'date_of_birth'             => 'nullable|date',
                    'phone'                     => 'nullable|regex:/(01)[0-9]{9}/',
                    'facebook_url'              => 'nullable|string',
                    'twitter_url'               => 'nullable|string',
                    'linkedIn_url'              => 'nullable|string',
                    'insta_url'                 => 'nullable|string',
                    'description'               => 'nullable|string',
                ];

                $names = [
                    'name'                      => 'Name',
                    'email'                     => 'Email',
                    'gender'                    => 'Gender',
                    'phone'                     => 'Phone',
                    'facebook_url'              => 'Facebook URL',
                    'twitter_url'               => 'Twitter URL',
                    'linkedIn_url'              => 'LinkedIn URL',
                    'insta_url'                 => 'Instagram URL',
                    'description'               => 'Description',
                ];


                $data = $this->validate(request(),$rules,[],$names);
                Session::flash('success','Your Information Changed');
            }

            if(request('a') == 'change-password')
            {
                $user = auth()->user();

                $rules = 
                [
                    'old_password'              => 'required', 
                    'password'                  => 'required|min:8|confirmed',
                    'password_confirmation'     => 'required',
                ];

                $data = $this->validate(request(),$rules);

                if (Hash::check(request('old_password'), $user->password)) { 

                    $data['password'] = Hash::make(request('password'));
                    
                    $user->update([
                        'password' => $data['password']
                    ]);
                    
                    Session::flash('success','Password Changed');
                    } else {
                    Session::flash('success','Password Does not Match');
                }
            }

            if(request('a') == 'change-image')
            {
                $user = auth()->user();
                $rules = 
                [
                    'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
                ];

                $names = 
                [
                    'photo' => 'Photo'
                ];

                
                $data = $this->validate(request(),$rules,[],$names);

                if($user->photo != null)
                {
                    File::delete($user->photo); // delete previous image from folder   
                }

                $data['photo'] = storeImage($request ,'photo' , 'storage/app/users_photos/', $user->id, 'users');
                
                Session::flash('success','Image has been uploaded');
            }
            
            Auth::user()->update($data);
            return back();
    }
}
