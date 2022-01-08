<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Models
use App\Project;
use App\ProjectSubtask;
use App\User;

class ManagerSingleProjectController extends Controller
{
    /**
     * Manager Single Project Show
     * @param Request   @param Project_id
     * @return GET::Single_project_page
     *
     */
    public function view(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $project = Project::find($id);
            //Project Assign Employee
            $employee = [];
            $project->assign_employee = rtrim($project->assign_employee, ", ");
            $employee = User::find(explode(",", $project->assign_employee));

            //Project Client
            $client_details = User::find($project->client_id);

            //Project Manager
            $project_manager = User::find($project->project_manager_id);

            //Project Subtask
            $project_subtask = ProjectSubtask::where('project_id', $id)->get();

            return view(
                "manager.single_project",
                ['project' => $project,  'employee' => $employee, 'client_details' => $client_details, 'project_manager' => $project_manager, 'tasks' => $project_subtask]
            );
        }
    }
    /** AJAX request
     * updating project Name
     * @param Request
     * @return json::success_status
     *
     */
    public function updateProjectName(Request $request)
    {
        if ($request->ajax()) {
            $project = Project::find($request->project_id);
            if ($project) {
                $project->update(["project_name" => $request->project_name]);
                return response()->json(["success" => true]);
            } else {
                return response()->json(["success" => false]);
            }
        }
    }
    /** AJAX request
     * updating project description
     * @param Request
     * @return json::success_status
     *
     */
    public function updateProjectDescription(Request $request)
    {
        if ($request->ajax()) {
            $project = Project::find($request->project_id);
            if ($project) {
                $project->update(["description" => $request->project_description]);
                return response()->json(["success" => true]);
            } else {
                return response()->json(["success" => false]);
            }
        }
    }
}
