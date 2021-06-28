<?php

namespace App\Http\Controllers\Admin;

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

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:
        admin.projects.index|admin.projects.create|admin.projects.edit|admin.projects.destroy|
        admin.projects.files.index|admin.projects.files.create|admin.projects.files.edit|admin.projects.files.destroy',['only' => ['index','store']]);

        $this->middleware('permission:admin.projects.index', ['only' => ['index']]);
        $this->middleware('permission:admin.projects.create', ['only' => ['create','store']]);
        $this->middleware('permission:admin.projects.edit', ['only' => ['edit','update']]);

        $this->middleware('permission:admin.projects.updatePermission', ['only' => ['store']]);

        $this->middleware('permission:admin.projects.destroy', ['only' => ['destroy']]);

        $this->middleware('permission:admin.projects.files.index', ['only' => ['index']]);
        $this->middleware('permission:admin.projects.files.create', ['only' => ['create','store']]);
        $this->middleware('permission:admin.projects.files.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:admin.projects.files.destroy', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::get();
        $users = User::where('role_id',3)->get();
        return view('admin.projects.index',compact(['projects','users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $researchers = User::where('role_id',2)->get();
        $users = User::where('role_id',3)->get();
        $categories  = Category::get(); 
        return view('admin.projects.create',compact(['researchers','categories','users']));
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
            'researcher_id'    => 'required:role_id,2|integer|exists:users,id',
            'category_id'      => 'required|array',
            'category_id.*'    => 'required|integer|exists:categories,id',
            'project_files'    => 'required|array',
            'project_files.*'  => 'required|mimes:jpeg,png,jpg,gif,svg,pdf,csv,doc,docx,xls,xlsx,ppt|max:4096',
            'status'           => 'required|string|in:hidden,specific_users,all_users',
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
            'researcher_id'    => 'Researcher',
            'project_files'    => 'Project Files',
            'status'           => 'Status',
            'user_id'          => 'User'
        ];

        $this->validate($request, $rules , [],$names);

        
        $project                = new Project();
        $project->name          = $request->name;
        $project->status        = $request->status;
        $project->description   = $request->description;
        $project->researcher_id = $request->researcher_id;
        $project->uuid          = (string)Uuid::generate();
        $project->created_by    =  Auth::id();
        $project->save();

        if ($request->hasfile('project_files')) 
        {

            foreach($request->project_files as $file) 
            {
                $directory = 'storage/app/project_files/';

                if (!file_exists($directory)) {
  
                    mkdir($directory, 755, true);
                }

                $uuid = (string)Uuid::generate();

                $filename        = $file->getClientOriginalName();
                
                $imageSaveAsName = time() . $uuid . $file->getClientOriginalName();

                // $file = Image::make($file->getRealPath());
                
                $image_url = $directory . $imageSaveAsName;
                
                // $file->save(public_path($directory .$imageSaveAsName));
                $file->move(public_path($directory), $imageSaveAsName);

                $project_file             = new ProjectFiles;
                $project_file->name       = $filename; 
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

        return redirect()->route('admin.projects.index')
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
        return view('admin.projects.show',compact('project'));
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

        $researchers = User::where('role_id',2)->get();
        $users       = User::where('role_id',3)->get();
        $categories  = Category::get();

        return view('admin.projects.edit',compact(['project','researchers','categories','categoryIds','userIds','users']));
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
            'researcher_id'    => 'required:role_id,2|integer|exists:users,id',
            'category_id'      => 'required|array',
            'category_id.*'    => 'required|integer|exists:categories,id',
            'status'           => 'required|string|in:hidden,specific_users,all_users',
            'user_id'          => 'User'
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
            'researcher_id'    => 'Researcher',
            'category_id'      => 'Category',
            'status'           => 'Status',
            'user_id'          => 'User'
        ];

        
        
        $data = $this->validate($request, $rules , [],$names);


        $project = Project::find($id);
        
        $project->update($data);

        if($request->status === "specific_users" && $request->user_id)
        {
            $project->users()->sync($request->user_id,['status' => 'allowed']);

        }else{
            
            $project->users()->detach();
        }

        
        $project->categories()->sync($request->category_id);

        return redirect()->route('admin.projects.index')
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
        
        return redirect()->route('admin.projects.index')
                ->with('success','Project deleted successfully');
    }


    public function indexProjectFiles($project_id)
    {
        $project = Project::findOrFail($project_id);
        return view('admin.projects.files.index',compact('project'));   
    }

    public function createProjectFiles(Request $request ,$project_id)
    {
        $project = Project::findOrFail($project_id);
        return view('admin.projects.files.create',compact('project'));   
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
                
                if (!file_exists($directory)) {
  
                    mkdir($directory, 755, true);
                }

                $uuid = (string)Uuid::generate();

                $filename        = $file->getClientOriginalName();

                $imageSaveAsName = time() . $uuid . $file->getClientOriginalName();

                // $file = Image::make($file->getRealPath());
                
                $image_url = $directory . $imageSaveAsName;
                
                // $file->save(public_path($directory .$imageSaveAsName));
                $file->move(public_path($directory), $imageSaveAsName);

                $project_file             = new ProjectFiles;
                $project_file->name       = $filename; 
                $project_file->uuid       = $uuid; 
                $project_file->project_id = $project->id; 
                $project_file->file_path  = $image_url; 
                $project_file->save();

            }
        }

        return redirect()->route('admin.projects.files.index',$project->id)
                ->with('success','Filed created successfully');
    }

    public function editProjectFiles($project_id , $file_id)
    {
        $project = Project::find($project_id);
        $file    = ProjectFiles::findOrFail($file_id);

        return view('admin.projects.files.edit',compact(['project','file'])); 
        
    }

    public function updateProjectFiles(Request $request,$project_id,$file_id)
    {

        $project = Project::find($project_id);
        $file    = ProjectFiles::findOrFail($file_id);
        $uuid    = $file->uuid; 

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

            $filename        = $file_path->getClientOriginalName();

            $imageSaveAsName = time() . $uuid . $file_path->getClientOriginalName();

            // $file_path = Image::make($file_path->getRealPath());
            
            $image_url = $directory . $imageSaveAsName;
            
            // $file_path->save(public_path($directory . $imageSaveAsName));
            $file_path->move(public_path($directory), $imageSaveAsName);

            $data['name']           = $filename;
            $data['file_path']      = $image_url;
        }

        $file->update($data);

        return redirect()->route('admin.projects.files.index',$project->id)
                ->with('success','File updated successfully');

        
        
    }

    public function deleteProjectFiles($project_id,$file_id)
    {
        $project = Project::find($project_id);
        $file  = ProjectFiles::findOrFail($file_id);
        File::delete($file->file_path); // delete previous image from folder
        $file->delete();
        return redirect()->route('admin.projects.files.index',$project->id)
                ->with('success','File deleted successfully');

    }
}
