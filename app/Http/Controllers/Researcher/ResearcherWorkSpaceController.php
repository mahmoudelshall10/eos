<?php

namespace App\Http\Controllers\Researcher;

use App\Model\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\ProjectCategory;
use App\Model\ProjectFiles;
use App\Model\ProjectUsers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;
use Webpatser\Uuid\Uuid;

class ResearcherWorkSpaceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:
        researcher.workspaces.index|researcher.workspaces.create|researcher.workspaces.edit|researcher.workspaces.destroy|
        researcher.workspaces.files.index|researcher.workspaces.files.create|researcher.workspaces.files.edit|researcher.workspaces.files.destroy',['only' => ['index','store']]);

        $this->middleware('permission:researcher.workspaces.index', ['only' => ['index']]);
        $this->middleware('permission:researcher.workspaces.create', ['only' => ['create','store']]);
        $this->middleware('permission:researcher.workspaces.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:researcher.workspaces.destroy', ['only' => ['destroy']]);
        $this->middleware('permission:researcher.workspaces.files.index', ['only' => ['index']]);
        $this->middleware('permission:researcher.workspaces.files.create', ['only' => ['create','store']]);
        $this->middleware('permission:researcher.workspaces.files.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:researcher.workspaces.files.destroy', ['only' => ['destroy']]);
    }

    public function index()
    {
        $projects = Project::where('researcher_id',Auth::id())->get();
        return view('researchers.workspaces.index',compact('projects'));
    }

    public function create()
    {
        $categories  = Category::get(); 
        $users = User::where('role_id',3)->get();
        return view('researchers.workspaces.create',compact(['categories','users']));
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
            'description'      => 'required|string',
            'category_id'      => 'required|array',
            'category_id.*'    => 'required|integer|exists:categories,id',
            'project_files'    => 'required|array',
            'project_files.*'  => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,csv,doc,docx,xls,xlsx,ppt|max:4096'
        ];

        if($request->status === "specific_users")
        {
            $rules['user_id']      = 'required|array';
            $rules['user_id.*']    = 'required|integer|exists:users,id';
        }

        $names = 
        [
            'name'             => 'Name',
            'description'      => 'Description',
            'category_id'      => 'Category',
            'project_files'    => 'Project Files',
        ];

        $this->validate($request, $rules , [],$names);

        
        $project                = new Project();
        $project->name          = $request->name;
        $project->description   = $request->description;
        $project->researcher_id = Auth::id();
        $project->status        = $request->status;
        $project->uuid          = (string)Uuid::generate();
        $project->created_by    =  Auth::id();
        $project->save();

        if ($request->hasfile('project_files')) 
        {

            foreach($request->project_files as $file) 
            {
                $directory = 'storage/app/project_files/';

                $uuid = (string)Uuid::generate();

                $imageSaveAsName = $file->getClientOriginalName();

                // $file = Image::make($file->getRealPath());
                
                $image_url = $directory . $imageSaveAsName;

                // $file->move(public_path($directory), $imageSaveAsName);
                $file->move(public_path($directory), $imageSaveAsName);

                $project_file             = new ProjectFiles;
                $project_file->name       = $imageSaveAsName; 
                $project_file->uuid       = $uuid; 
                $project_file->project_id = $project->id; 
                $project_file->file_path  = $image_url; 
                $project_file->save();

            }
        }

        if($request->status === "specific_users" && $request->user_id)
        {
            $project->users()->attach($request->user_id,['status' => 'allowed']);
        }


        $project->categories()->attach($request->category_id);

        return redirect()->route('researcher.workspaces.index')
                ->with('success','Project created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('researchers.workspaces.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::with('categories')->find($id);

        $categoryIds = [];
        foreach ($project->categories as $item)
        {
            $categoryIds[] = $item->id;
        }
        
        $userIds = ProjectUsers::where('project_id',$id)->pluck('user_id')->toArray();

        $categories  = Category::get();
        $users       = User::where('role_id',3)->get();

        return view('researchers.workspaces.edit',compact(['project','categories','categoryIds','userIds','users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $categoryIds = [];

        $rules = 
        [
            'name'             => 'required|string',
            'description'      => 'required|string',
            'category_id'      => 'required|array',
            'category_id.*'    => 'required|integer|exists:categories,id',
        ];

        $names = 
        [
            'name'             => 'Name',
            'description'      => 'Description',
            'category_id'      => 'Category',
            'category_id.*'    => 'Category'
        ];

        if($request->status === "specific_users")
        {
            $rules['user_id']      = 'required|array';
            $rules['user_id.*']    = 'required|integer|exists:users,id';
        }
        
        $data = $this->validate($request, $rules , [],$names);

        $categoryIds[] = ProjectCategory::where('project_id',$id)->get();

        $project = Project::find($id);
        
        $project->update($data);

        if($request->status === "specific_users" && $request->user_id)
        {
            $project->users()->sync($request->user_id,['status' => 'allowed']);

        }else{
            
            $project->users()->detach();
        }
        
        $project->categories()->sync($request->category_id);

        return redirect()->route('researcher.workspaces.index')
                ->with('success','Project updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        
        foreach($project->files as $file)
        {
            File::delete($file->file_path); // delete previous image from folder
        }

        $project->files()->delete();
        $project->categories()->detach();
        $project->delete();
        
        return redirect()->route('researcher.workspaces.index')
                ->with('success','Project deleted successfully');
    }

    public function indexProjectFiles($project_id)
    {
        $project = Project::findOrFail($project_id);
        return view('researchers.workspaces.files.index',compact('project'));   
    }

    public function createProjectFiles(Request $request ,$project_id)
    {
        $project = Project::findOrFail($project_id);
        return view('researchers.workspaces.files.create',compact('project'));   
    }

    public function storeProjectFiles(Request $request, $project_id )
    {
        $project = Project::find($project_id);

        $rules = 
        [
            'project_files'      => 'required|array',
            'project_files.*'  => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,csv,doc,docx,xls,xlsx,ppt|max:4096'
        ];

        $names = 
        [
            'project_files'      => 'Project Files',
        ];
        
        $data = $this->validate($request, $rules , [],$names);

        
        if ($request->hasfile('project_files')) 
        {

            foreach($request->project_files as $file) 
            {
                $directory = 'storage/app/project_files/';

                $uuid = (string)Uuid::generate();

                $imageSaveAsName = $file->getClientOriginalName();

                // $file = Image::make($file->getRealPath());
                
                $image_url = $directory . $imageSaveAsName;
                
                // $file->save(public_path($directory .$imageSaveAsName));

                $file->move(public_path($directory), $imageSaveAsName);

                $project_file             = new ProjectFiles;
                $project_file->name       = $imageSaveAsName; 
                $project_file->uuid       = $uuid; 
                $project_file->project_id = $project->id; 
                $project_file->file_path  = $image_url; 
                $project_file->save();

            }
        }

        return redirect()->route('researcher.workspaces.files.index',$project->id)
                ->with('success','Filed created successfully');
    }

    public function editProjectFiles($project_id , $file_id)
    {
        $project = Project::find($project_id);
        $file    = ProjectFiles::findOrFail($file_id);

        return view('researchers.workspaces.files.edit',compact(['project','file'])); 
        
    }

    public function updateProjectFiles(Request $request,$project_id,$file_id)
    {

        $project = Project::find($project_id);
        $file    = ProjectFiles::findOrFail($file_id);

        $rules = 
        [
            'file_path'  => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,csv,doc,docx,xls,xlsx,ppt|max:4096'
        ];

        $names = 
        [
            'file_path'      => 'Project File',
        ];

        $data = $this->validate($request, $rules , [],$names);

        
        if(request('file_path') != null)
        {               
            File::delete($file->file_path); // delete previous image from folder   
            
            $file_path = $request->file_path;

            $directory = 'storage/app/project_files/';

            $imageSaveAsName = $file_path->getClientOriginalName();

            // $file_path = Image::make($file_path->getRealPath());
            
            $image_url = $directory . $imageSaveAsName;
            
            // $file_path->save(public_path($directory . $imageSaveAsName));
            $file_path->move(public_path($directory), $imageSaveAsName);

            $data['name']           = $imageSaveAsName;
            $data['file_path']      = $image_url;
        }

        $file->update($data);

        return redirect()->route('researcher.workspaces.files.index',$project->id)
                ->with('success','File updated successfully');

        
        
    }

    public function deleteProjectFiles($project_id,$file_id)
    {
        $project = Project::find($project_id);
        $file  = ProjectFiles::findOrFail($file_id);
        File::delete($file->file_path); // delete previous image from folder
        $file->delete();
        return redirect()->route('researcher.workspaces.files.index',$project->id)
                ->with('success','File deleted successfully');

    }
}
