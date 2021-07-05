<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Project;
use App\Model\ProjectFiles;
use App\Model\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:admin.dashboards.index',['only' => ['index']]);
    }
    

    public function index()
    {
        $admins = User::where('role_id',1)->count();
        $researchers = User::where('role_id',2)->count();
        $users = User::where('role_id',3)->count();

        $roles = Role::count();
        $permissions = Permission::count();

        $teams = Team::count();
        $projects = Project::count();

        $categories = Category::count();

        $files = ProjectFiles::count();

        return view('admin.dashboard.index',compact([
            'admins' , 'researchers' , 'users' , 'roles', 'permissions','teams',
            'projects' , 'categories','files'
        ]));
    }
}
