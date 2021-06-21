<?php

namespace App\Http\Controllers\Admin;

use App\Model\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class TeamController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:admin.teams.index|admin.teams.create|admin.teams.edit|admin.teams.destroy', ['only' => ['index','store']]);
        $this->middleware('permission:admin.teams.index', ['only' => ['index']]);
        $this->middleware('permission:admin.teams.create', ['only' => ['create','store']]);
        $this->middleware('permission:admin.teams.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:admin.teams.destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_members = Team::get();
        return view('admin.teams.index',compact('team_members'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teams.create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = 
        [
            'name'             => 'required|string',
            'job_title'        => 'required|string',
            'facebook_url'     => 'nullable|string',
            'twitter_url'      => 'nullable|string',
            'linkedIn_url'     => 'nullable|string',
            'insta_url'        => 'nullable|string',
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];

        $names = 
        [
            'name'             =>'Name',
            'job_title'        =>'Job Title',
            'photo'            =>'Photo',
            'facebook_url'     =>'Facebook URL',
            'twitter_url'      =>'Twitter URL',
            'linkedIn_url'     =>'LinkedIn URL',
            'insta_url'        =>'Instagram URL',
        ];

        $data = $this->validate($request , $rules , [] , $names);

        $data['created_by'] = Auth::id();
        $data['photo']      = storeImage($request ,'photo' , 'storage/app/teams_photos/', $data['created_by'], 'teams');

        
        Team::create($data);


        return redirect()->route('admin.teams.index')
                ->with('success','Team Member created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);
        return view('admin.teams.show',compact('team'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        return view('admin.teams.edit',compact('team')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
   {
        $team = Team::find($id);
        $rules = 
        [
            'name'             => 'required|string',
            'job_title'        => 'required|string',
            'facebook_url'     => 'nullable|string',
            'twitter_url'      => 'nullable|string',
            'linkedIn_url'     => 'nullable|string',
            'insta_url'        => 'nullable|string',
            'photo'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ];

        $names = 
        [
            'name'             =>'Name',
            'job_title'        =>'Job Title',
            'photo'            =>'Photo',
            'facebook_url'     =>'Facebook URL',
            'twitter_url'      =>'Twitter URL',
            'linkedIn_url'     =>'LinkedIn URL',
            'insta_url'        =>'Instagram URL',
        ];

        $data = $this->validate($request , $rules , [] , $names);

           if(request('photo') != null)
            {               
                File::delete($team->photo); // delete previous image from folder   

                $data['photo']      = storeImage($request ,'photo' , 'storage/app/teams_photos/', $team->created_by, 'teams');
            }
        
        

        $team->update($data);

        return redirect()->route('admin.teams.index')
                ->with('success','Team Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        if($team->photo)
        {
            File::delete($team->photo); // delete previous image from folder
        }
        $team->delete();

        return redirect()->route('admin.teams.index')
                ->with('success','Team Member deleted successfully');
    }
}
