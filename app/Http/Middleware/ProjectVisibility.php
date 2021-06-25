<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ProjectVisibility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $project = null)
    {
        // if(Auth::check() && Auth::user()->role_id == 3)
        // {

        //     switch ($project->status) {
        //         case 'hidden':
        //             return redirect('403');
        //           break;
        //         case 'specific_users':
                  

                    
        //           break;
        //         case label3:
        //           code to be executed if n=label3;
        //           break;
        //           ...
        //         default:
        //           code to be executed if n is different from all labels;
        //       }
        // }
    }
}
