<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectDetails;
use App\User;

class ProjectManagerController extends Controller
{
    public function singleProject(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $project = Project::find($id);
            //dd($project);
            $user = [];

            $project->assign_employee = rtrim($project->assign_employee, ", ");
            $user = User::find(explode(",", $project->assign_employee));

            $project_details = ProjectDetails::where("project_id", $id)->first();
            $client_details = User::find($project->client_id);

            if ($project_details) {
                $tasks = json_decode($project_details->subtask);
                $project_manager = $project_details->project_manager_id;
                //  dd($project_details->subtask);
            } else {
                $tasks = null;
            }

            return view("project_manager.single_project", ['project' => $project, 'tasks' => $tasks, 'user' => $user, 'project_manager' => $project_manager, 'client_details' => $client_details]);
        }
    }
}
