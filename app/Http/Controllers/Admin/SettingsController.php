<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.settings.index',['only' => ['index','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.settings');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request ,Setting $setting)
    {

        $rules = 
        [
            'name'             => 'nullable|string', 
            'meta_description' => 'nullable',
            'meta_keywords'    => 'nullable|string',
            'logo'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'icon'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'email'            => 'nullable|email',
            'phone'            => 'nullable|regex:/(01)[0-9]{9}/',
        ];

        $names = 
        [
            'name'             =>'Name', 
            'meta_description' =>'Meta Description',
            'meta_keywords'    =>'Meta Keywords',
            'logo'             =>'Logo',
            'icon'             =>'Icon', 
            'email'            =>'Email',
            'phone'            =>'Phone',
        ];

            if(request('phone') != null)
            {
                $rules = [
                    'phone' => 'required|regex:/(1)[0-9]{9}/'
                ];
            }

           $this->validate(request(),$rules , [] ,$names);

           $setting->put('name' , request('name'));
           $setting->put('meta_description' , request('meta_description'));
           $setting->put('meta_keywords' , request('meta_keywords'));
           $setting->put('email' , request('email'));



           if(request('phone') != null)
           {
                $setting->put('phone' , request('phone'));
           }

            if(request('logo') != null)
            {

                if(SiteSetting('logo') != null)
                {
                    File::delete(SiteSetting('logo')); // delete previous image from folder   
                }

                $setting->put('logo' , storeImage($request ,'logo' , 'storage/app/settings_photos/', '1', 'settings'));
            }


            if(request('icon') != null)
            {
                if(SiteSetting('icon') != null)
                {
                    File::delete(SiteSetting('icon')); // delete previous image from folder   
                }

                $setting->put('icon' , storeImage($request ,'icon' , 'storage/app/settings_photos/', '1', 'settings'));

            }

            Session::flash('success','Site Settings has been updated');
            return back();
            
    }

    
}
