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

            return view("manager.single_project", ['project' => $project, 'tasks' => $tasks, 'user' => $user, 'project_manager' => $project_manager, 'client_details' => $client_details]);
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
     * Deleting Task on Single Project
     * @param Request
     * @return task_deleted
     *
     */
    public function deleteProjectTask(Request $request, $project_id)
    {
        if ($request->isMethod("POST")) {
            dd($project_id);
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
     * Discusstion function working on it
     * @param Request
     *
     *
     */
    public function addDiscussion(Request $request)
    {
        if ($request->isMethod("POST")) {
            dd($request->project_test);
        }
    }
    /**
     * Showing client single project
     * @param Request @param project_id
     * @return GET::Single_project_page::Client_side
     *
     */
    public function clientSingleProject(Request $request, $id)
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
            return view("client.single_project", ['project' => $project, 'tasks' => $tasks, 'user' => $user, 'project_manager' => $project_details->project_manager_id]);
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
            $project_details = ProjectDetails::where("project_id", $project_id)->first();
            if ($project_details) {
                $project_details->update(["project_manager_id" => $request->project_manager]);
                return redirect()->back();
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
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
    /**
     * Remove manager from a project
     * @param Request @param project_id
     * @return GET::Single_project_page::Manager_single_project_page
     *
     */
    public function removeManager(Request $request, $project_id)
    {
        if ($request->isMethod("POST")) {
            $project_details = ProjectDetails::where("project_id", $project_id)->first();
            if ($project_details) {
                $project_details->update(["project_manager_id" => null]);
                return redirect()->back();
            } else {
                return redirect('/');
            }
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
                $project->update(["name" => $request->project_name]);
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
     * updating project file
     * @param Request
     * @return json::success_status
     *
     */
    public function addProjectFile(Request $request, $project_id)
    {
        if ($request->isMethod("POST")) {
            $project = Project::find($project_id);
            if ($project) {
                if ($request->hasfile('fileUpload')) {
                    $file = $request->file('fileUpload');
                    $name = time() . '.' . $file->extension();
                    $file->move(public_path() . '/files/' . $project_id, $name);
                    $project_files = json_decode($project->project_files);
                    array_push($project_files, $name);
                    $project->update(["project_files" => json_encode($project_files)]);
                    return "Success";
                } else {
                    return "Error";
                }
                //return response()->json(["success" => true]);
            } else {
                //return response()->json(["success" => false]);
            }
        }
    }
    /**
     * deleting project file
     * @param Request @param project_id
     * @return single_project_page
     *
     */
    public function deleteFile(Request $request, $project_id)
    {
        if ($request->isMethod("POST")) {
            $project = Project::find($project_id);
            $files = json_decode($project->project_files);
            array_splice($files, $request->file_index, 1);
            $project->update(["project_files" => json_encode($files)]);
            return redirect()->back();
            //dd($request->file_index);
        }
    }

    /**
     * deleting single subtask
     * @param Request @param project_id
     * @return single_project_page
     *
     */
    public function deleteSubtask(Request $request)
    {
        if ($request->isMethod("GET")) {
            $project_details = ProjectDetails::where("project_id", $request->project_id)->first();
            if ($project_details) {
                $old_tasks =  json_decode($project_details->subtask);
                foreach ($old_tasks as $key => $task) {
                    if ($task->id == $request->task_id) {
                        unset($old_tasks[$key]);
                    }
                }
                $project_details->update(["subtask" => json_encode($old_tasks)]);
                return $old_tasks;
            }
        }
    }
}
