<?php

namespace App\Http\Controllers\Researcher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProjectUsers;
use App\Model\Project;
use App\User;
use Illuminate\Support\Facades\Auth;

class ResearcherFilePermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:researcher.filespermissions.index|
        researcher.filespermissions.create|
        researcher.filespermissions.changePermission|
        researcher.filespermissions.destroy',['only' => ['index','store']]);
        $this->middleware('permission:researcher.filespermissions.index', ['only' => ['index']]);
        $this->middleware('permission:researcher.filespermissions.create', ['only' => ['create','store']]);
        $this->middleware('permission:researcher.filespermissions.changePermission', ['only' => ['create','store']]);
        // $this->middleware('permission:researcher.filespermissions.destroy', ['only' => ['destroy']]);
    }

    public function index($project_id)
    {
        $projects = ProjectUsers::where('project_id',$project_id)->get();

        return view('researchers.workspaces.permissions.index',compact(['projects','project_id']));
    }


    public function create(Request $request,$project_id)
    {
        $project = Project::find($project_id);


        $users   = User::where('role_id',3)->whereDoesntHave('manyProjects', function ($query) use ($project_id){
            $query->where('project_id',$project_id);
        })->get();
        
        return view('researchers.workspaces.permissions.create',compact(['project','users']));

    }

    public function store(Request $request,$project_id)
    {
        $project = Project::find($project_id);

        $rules = 
        [
            'user_id'      => 'required|array',
            'user_id.*'    => 'required|integer|exists:users,id'
        ];

        $name=
        [
            'user_id'     => 'User', 
        ];

        $data = $this->validate($request , $rules , [] ,$name);

        $user_id = $request->user_id;

        $project->users()->attach($user_id,['status' => 'allowed']);

        return redirect()->route('researcher.filespermissions.index',$project_id)->with('success',' User permissions created successfully');
    }

    // public function destroy(Request $request,$project_id)
    // {
    //     $user_email = $request->email;
    //     $user_id = User::where('email',$user_email)->first()->id;

    //     $project = Project::find($project_id);

    //     $project->users()->detach($user_id);

    //     return back()->with('success','Permissions deleted successfully');
    // }

    public function changePermission(Request $request)
    {
        $user_email = $request->email;
        $user_id = User::where('email',$user_email)->first()->id;

        $rules = 
        [
            'project_id' => 'required|integer|exists:projects,id',
            'email'      => 'required|email|unique:users,email,'.$user_id,
        ];

        $name=
        [
            'project_id' => 'Project',
            'email'      => 'User Email', 
        ];

        $data = $this->validate($request , $rules , [] ,$name);

        $projectuser = ProjectUsers::where('project_id',$request->project_id)->where('user_id',$user_id)->first();

        $project = Project::find($request->project_id);
 
        if($projectuser)
        {
            if($projectuser->status == 'allowed')
            {   
                $project->users()->updateExistingPivot($user_id,['status' => 'pending']);

            }else if($projectuser->status == 'pending'){ 
                $project->users()->updateExistingPivot($user_id,['status' => 'allowed']);
            }
        }
        return back()->with('success','Permissions updated successfully');
    }
}
