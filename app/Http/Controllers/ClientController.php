<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Project;

class ClientController extends Controller
{


    /**
     * Client Dashboard  show
     * @param Request
     * @return GET::client_dashboard
     * @return POST::User_homepage
     */
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            $running_projects = count(Project::where("status", "=", "running")->where("client_id", "=", Auth::user()->id)->get());
            $complete_projects = count(Project::where("status", "=", "complete")->where("client_id", "=", Auth::user()->id)->get());
            $on_hold = count(Project::where("status", "=", "stopped")->where("client_id", "=", Auth::user()->id)->get());


            return view('client.dashboard', ['running_projects' => $running_projects, 'complete_projects' => $complete_projects, 'on_hold' => $on_hold]);
        } else if ($request->isMethod("POST")) {
        } else {
            Auth::logout();
            return view("welcome");
        }
    }
    public function viewProjects($stage)
    {
        $projects = Project::where("status", "=", $stage)
            ->join('project_details', 'project_details.project_id', '=', 'project.id')
            ->where("client_id", "=", Auth::user()->id)->get(['project.name', 'project.id', 'project_details.subtask', 'due_date']);
        //  dd($projects);
        return view("client.view_project", ["projects" => $projects, "stage" => $stage]);
    }
}
