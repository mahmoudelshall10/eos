<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Project;
use App\Model\ProjectFiles;

class SearchController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function search(Request $request)
    {
        $projects = Project::search()->get();
        return view('site.search',compact('projects'));
    }

    public function singleProject($uuid)
    {
        $project = Project::where('uuid',$uuid)->first();
        return view('site.singleProject',compact('project'));
    }


    public function getDownload($file_uuid)
    {
        $download = ProjectFiles::where('uuid',$file_uuid)->first();
        return response()->download($download->file_path, $download->name);
    }
}
