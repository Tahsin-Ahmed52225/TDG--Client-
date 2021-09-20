<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\ProjectDetails;

class SingleProjectController extends Controller
{
    public function singleProject(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $project = Project::find($id);
            $project_details = ProjectDetails::where("project_id", $id)->first();
            if ($project_details) {
                $tasks = json_decode($project_details->subtask);
                //  dd($project_details->subtask);
            } else {
                $tasks = null;
            }
            // $tasks = json_decode($project_details->subtask);
            //   dd($tasks[0]->stage);
            // $tasks = json_decode($project_details->subtask);
            //   dd($tasks);
            return view("manager.single_project", ['project' => $project, 'tasks' => $tasks]);
        }
    }
    public function createNewtask(Request $request)
    {
        if ($request->isMethod("POST")) {
            $project_details = ProjectDetails::where("project_id", $request->ids)->first();
            if ($project_details) {
                $old_tasks =  json_decode($project_details->subtask);
                foreach ($request->task as $item) {
                    array_push($old_tasks, $item);
                }
                $project_details->update(["subtask" => json_encode($old_tasks)]);
            } else {
                $project_details = ProjectDetails::create([
                    'project_id' => $request->ids,
                    'subtask' => json_encode($request->task),
                    'discussion' => '-',
                    'files' => '-'
                ]);
            }
        } else {
            return redirect('/');
        }
    }
}
