<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Project;
use App\ProjectDetails;

class SingleProjectController extends Controller
{

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
}
