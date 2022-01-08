<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\ProjectSubtask;

class ProjectSubtaskController extends Controller
{
    /**
     * Geting the   new Task ID
     * @param Request
     * @return GET::Returning_latest_task_id
     *
     */
    public function getNewTaskID(Request $request)
    {
        if ($request->isMethod("GET")) {
            $project_subtasks = ProjectSubtask::where("project_id", $request->project_id)->get("id");
            if (count($project_subtasks) > 0) {
                return (count($project_subtasks) + 1);
            } else {
                return 1;
            }
        } else {
            redirect("/");
        }
    }
}
