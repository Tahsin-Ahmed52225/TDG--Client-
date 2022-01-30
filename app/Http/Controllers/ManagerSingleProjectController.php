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
            if ($project_manager) {
                $project_manager = $project_manager->id;
            }

            //Project Subtask
            $project_subtask = ProjectSubtask::where('project_id', $id)->get();
            $subtask_employee = [];
            for ($i = 0; $i < sizeof($project_subtask); $i++) {
                $project_subtask[$i]->assign_employee = rtrim($project_subtask[$i]->assigned_member, ", ");
                $subtask_employee[$i] = User::find(explode(",", $project_subtask[$i]->assigned_member));
            }

            return view(
                "manager.single_project",
                ['project' => $project,  'employee' => $employee, 'client_details' => $client_details, 'project_manager' => $project_manager, 'tasks' => $project_subtask, 'subtask_employee' => $subtask_employee]
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
    /**
     * Assign project manager to the project
     * @param Request @param project_id
     * @return GET::Single_project_page::Manager_single_project_page
     *
     */
    public function assignProjectManager(Request $request, $project_id)
    {
        if ($request->isMethod("POST")) {
            $project_details = Project::where("id", $project_id)->first();
            if ($project_details) {
                $project_manager = (int)$request->project_manager;
                $project_details->project_manager_id = $project_manager;
                $project_details->save();
                return redirect()->back();
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
    /**
     * Adding member to the project
     * @param Request @param member_id
     * @return GET::Single_project_page::Manager_single_project_page
     *
     */
    public function updateProjectMember(Request $request, $id)
    {
        if ($request->isMethod("POST")) {
            $project = Project::find($id);
            if ($project) {
                preg_match_all('!\d+!', $request->tdg_assignee_member, $id);
                $ids = array_to_string($id[0]);
                $new_member_list = $project->assign_employee . $ids;
                $project->update(["assign_employee" => $new_member_list]);

                return redirect()->back();
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
    /**
     * Remove manager from a project
     * @param Request @param project_id
     * @return GET::Single_project_page::Manager_single_project_page
     *
     */
    public function removeManager(Request $request, $project_id)
    {
        if ($request->isMethod("POST")) {
            $project_details = Project::where("id", $project_id)->first();
            if ($project_details) {
                $project_details->project_manager_id = null;
                $project_details->save();
                return redirect()->back();
            } else {
                return redirect('/');
            }
        }
    }
    /**
     * Remove member form the project
     * @param Request @param project_id
     * @return GET::Single_project_page::Manager_single_project_page
     *
     */
    public function removeMember(Request $request, $project_id)
    {
        if ($request->isMethod("POST")) {
            $project = Project::where("id", $project_id)->first();
            if ($project) {
                preg_match_all('!\d+!', $project->assign_employee, $id);
                $ids = remove_number_from_array($id[0], $request->member_id);
                $new_member_list = array_to_string($ids);
                $project->update(["assign_employee" => $new_member_list]);
                return redirect()->back();
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }
}
