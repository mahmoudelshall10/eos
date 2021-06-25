<?php

namespace App\Http\Controllers\Researcher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProjectUsers;
use Illuminate\Support\Facades\Auth;

class ResearcherFilePermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:researcher.filespermissions.index|researcher.filespermissions.create|researcher.filespermissions.edit|researcher.filespermissions.destroy',['only' => ['index','store']]);
        $this->middleware('permission:researcher.filespermissions.index', ['only' => ['index']]);
        $this->middleware('permission:researcher.filespermissions.create', ['only' => ['create','store']]);
        $this->middleware('permission:researcher.filespermissions.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:researcher.filespermissions.destroy', ['only' => ['destroy']]);
    }

    public function index()
    {
        $projects = ProjectUsers::with(['project' => function($q){
            $q->where('id',Auth::id());
        }])->get();

        return $projects;

        return view('researchers.workspaces.permissions.index',compact('projects'));
    }
}
