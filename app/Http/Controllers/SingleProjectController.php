<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Project;
use App\ProjectDetails;

class SingleProjectController extends Controller
{
    /**
     * Manager Single Project Show
     * @param Request   @param Project_id
     * @return GET::Single_project_page
     *
     */
    public function singleProject(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $project = Project::find($id);
            $user = [];

            $project->assign_employee = rtrim($project->assign_employee, ", ");
            $user = User::find(explode(",", $project->assign_employee));

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
            return view("manager.single_project", ['project' => $project, 'tasks' => $tasks, 'user' => $user]);
        }
    }
    /**
     * Creating new Task on Single Project
     * @param Request
     * @return POST::New_task_added
     *
     */
    public function createNewtask(Request $request)
    {
        if ($request->isMethod("POST")) {
            $project_details = ProjectDetails::where("project_id", $request->ids)->first();
            if ($project_details) {
                $old_tasks =  json_decode($project_details->subtask);
                if (sizeof($old_tasks) < $request->task_id) {
                    foreach ($request->task as $item) {
                        array_push($old_tasks, $item);
                    }
                } else {
                    for ($i = 0; $i < sizeof($old_tasks); $i++) {
                        if ($old_tasks[$i]->id == $request->task_id) {
                            $old_tasks[$i] = $request->task[0];
                        }
                    }
                }

                $project_details->update(["subtask" => json_encode($old_tasks)]);
            } else {
                $project_details = ProjectDetails::create([
                    'project_id' => $request->ids,
                    'subtask' => json_encode($request->task),
                ]);
            }
        } else {
            return redirect('/');
        }
    }
    /**
     * Geting the   new Task ID
     * @param Request
     * @return GET::Returning_latest_task_id
     *
     */
    public function getNewTaskID(Request $request)
    {
        if ($request->isMethod("GET")) {
            $project_details = ProjectDetails::where("project_id", $request->project_id)->first();
            if ($project_details) {
                $tasks = json_decode($project_details->subtask);
                return (sizeof($tasks) + 1);
            } else {
                return 1;
            }
        }
    }
    /**
     * Updating the Task stage
     * @param Request
     * @return GET::Returning_to_the_project_page_with_changed_stage
     *
     */
    public function getOldTaskStage(Request $request)
    {
        if ($request->isMethod("GET")) {
            $project_details = ProjectDetails::where("project_id", $request->project_id)->first();
            if ($project_details) {
                $tasks =  json_decode($project_details->subtask);
                for ($i = 0; $i < sizeof($tasks); $i++) {
                    if ($tasks[$i]->id == $request->task_id) {
                        if ($tasks[$i]->stage == "true") {
                            $tasks[$i]->stage = "false";
                            break;
                        } else if ($tasks[$i]->stage == "false") {
                            $tasks[$i]->stage = "true";
                            break;
                        }
                    }
                }
                $project_details->update(["subtask" => json_encode($tasks)]);
                return $tasks[$i]->stage;
                //return $tasks[$request->task_id]->stage;
            }
        }
    }
    public function updateProjectMember(Request $request, $id)
    {
        if ($request->isMethod("POST")) {
            $project = Project::find($id);
            if ($project) {
                $ids = '';
                //Modifining input value into id string
                preg_match_all('!\d+!', $request->tdg_assignee_member, $id);
                for ($i = 0; $i < sizeof($id[0]); $i++) {
                    $ids .= (string)$id[0][$i] . ',';
                }
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
    public function addDiscussion(Request $request)
    {
        if ($request->isMethod("POST")) {
            dd($request->project_test);
        }
    }
}
