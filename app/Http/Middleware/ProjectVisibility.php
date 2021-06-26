<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\Project;
use App\Model\ProjectUsers;

class ProjectVisibility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            if(Auth::check() && Auth::user()->role_id == 3)
            {
                $singleProject = Project::where('uuid',$request->uuid)->where('status','<>','hidden')->first();

                if($singleProject->status === "all_users")
                {
                    return $next($request);

                }else if($singleProject->status === "specific_users"){
                    $project = ProjectUsers::where('project_id',$singleProject->id)
                                            ->where('user_id',Auth::id())
                                            ->first();

                    if($project) {
                        switch ($project->status) {
                            case 'allowed':
                                return $next($request);
                                break;

                            case 'pending':
                                return redirect('pending')->with(['pending' => 'Waiting for permission']);
                                break;
                            
                            default:
                            session(['uuid'=>$request->uuid]);
                            return redirect()->route('permissionToAccess')
                            ->with(
                                ['permission' => 'please click to give you an access']);
                                break;
                        }
                    }else{
                        session(['uuid'=>$request->uuid]);
                        return redirect()->route('permissionToAccess')
                        ->with(
                            ['permission' => 'please click to give you an access']);
                    }
                }
           


            }else{

                 return $next($request);
            }


           
        
    }
}
