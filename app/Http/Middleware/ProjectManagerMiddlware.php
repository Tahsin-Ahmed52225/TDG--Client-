<?php

namespace App\Http\Middleware;

use Closure;
use App\Project;
use Illuminate\Support\Facades\Auth;

class ProjectManagerMiddlware
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
        //dd($request);
        $id = $request->route('id');
        if ($id == null) {
            $id = $request->project_id;
        }
        if (Auth::user()->isEmployee()) {
            $project = Project::where("id", "=", $id)->first();
            //dd($project);
            if ($project) {
                // dd(auth()->user()->id);
                if (Auth::user()->id  ==  $project->project_manager_id) {
                    return $next($request);
                } else {
                    // Auth::logout();
                    return redirect('/employee/projects/' . $id);
                }
            }
            //  return $next($request);
        } else {
            Auth::logout();
            return redirect('/login')->with(session()->flash('alert-danger', 'Non Permitted Route'));
        }
    }
}
