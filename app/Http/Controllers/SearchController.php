<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Project;
use App\Model\ProjectFiles;
use App\Model\ProjectUsers;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function search(Request $request)
    {
        $projects = Project::search()->where('status','<>',"hidden")->orderBy('id')->get();
        return view('site.search',compact('projects'));
    }

    public function singleProject($uuid)
    {
        $project = Project::where('uuid',$uuid)->first();

        if($project)
        {
            return view('site.singleProject',compact('project'));

        }else{

            return redirect('403');
        }

    }

    public function accessPermission(Request $request)
    {
        $user    = Auth::user()->id;
        $project = Project::where('uuid',$request->uuid)->first();

        $userProject = ProjectUsers::where('project_id','$project->id')
                                    ->where('user_id',$user)
                                    ->first();
        if($userProject){
            return back()->with('error','this permission exists');
        }else{

            $projectUser             = new ProjectUsers;
            $projectUser->project_id = $project->id;
            $projectUser->user_id    = $user;
            $projectUser->status     = 'pending';
            $projectUser->save();
            return redirect('pending')->with('pending','Waiting for permission from adminstrator');
        }

    }


    public function getDownload($file_uuid)
    {
        $download = ProjectFiles::where('uuid',$file_uuid)->first();
        return response()->download($download->file_path, $download->name);
    }
}
