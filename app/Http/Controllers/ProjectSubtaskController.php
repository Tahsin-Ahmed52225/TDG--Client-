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
            $project_subtasks = ProjectSubtask::all();
            if (count($project_subtasks) > 0) {
                $latest_task_id = $project_subtasks->last()->id;

                return ($latest_task_id + 1);
            } else {
                $demo_subTask = ProjectSubtask::create([
                    'Name' => "Demo Task",
                    'project_id' => $request->project_id,
                ]);
                $new_index = $demo_subTask->id + 1;
                $demo_subTask->delete();
                return $new_index;
            }
        } else {
            redirect("/");
        }
    }
    /**
     * Create or Update the subtask title
     * @param Request
     * @return Show_new_subtask_title
     *
     */
    public function updateSubtaskTitle(Request $request)
    {
        //find if subtask already exist
        if ($request->ajax()) {
            $project_subtask = ProjectSubtask::find($request->subtask_id);
            if ($project_subtask) {
                $project_subtask->Name = $request->subtask_title;
                $project_subtask->save();
                return $request->subtask_title;
            } else {
                //create new subtask
                $sutask = ProjectSubtask::create([
                    'Name' => $request->subtask_title,
                    'project_id' => $request->project_id,
                ]);
                return $request->subtask_title;
            }
        }
    }
    /**
     * Changing subtask status
     * @param Request
     * @return updated_subtask_status
     *
     */
    public function updateSubtaskStatus(Request $request)
    {
        if ($request->ajax()) {
            $project_subtask = ProjectSubtask::find($request->subtask_id);
            if ($project_subtask) {
                $project_subtask->complete = $project_subtask->complete == 0 ? 1 : 0;
                $project_subtask->save();
                return $project_subtask->complete;
            } else {
                // return response()->json(["success" => false]);
            }
        }
    }
    /**
     * Delete subtask
     * @param Request
     * @return respnse_status
     *
     */
    public function deleteProjectTask(Request $request)
    {
        if ($request->ajax()) {
            $project_subtask = ProjectSubtask::find($request->subtask_id);
            if ($project_subtask) {
                $project_subtask->delete();
                return response()->json(["success" => true]);
            } else {
                return response()->json(["success" => false]);
            }
        }
    }
    /**
     * Update subtask description
     * @param Request
     * @return respnse_status
     *
     */
    public function updateSubtaskdescription(Request $request)
    {
        if ($request->ajax()) {
            $project_subtask = ProjectSubtask::find($request->subtask_id);
            if ($project_subtask) {
                $project_subtask->Description = $request->description;
                $project_subtask->save();
                return response()->json(["success" => true]);
            } else {
                return response()->json(["success" => false]);
            }
        }
    }
    public function assignSubTask(Request $request, $subtask_id, $employee_id)
    {
        if ($request->isMethod("GET")) {
            $project_subtask = ProjectSubtask::find($subtask_id);
            if ($project_subtask) {
                if ($project_subtask->assigned_member == null) {
                    $project_subtask->assigned_member = decrypt($employee_id);
                } else {
                    $already_added_member =   explode(",", $project_subtask->assigned_member);
                    if (!in_array(decrypt($employee_id), $already_added_member)) {
                        $project_subtask->assigned_member = $project_subtask->assigned_member . "," . decrypt($employee_id);
                    }
                }
                $project_subtask->save();
                return redirect()->back();
            } else {
            }
        }
    }
}
