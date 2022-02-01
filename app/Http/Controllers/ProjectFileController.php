<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class ProjectFileController extends Controller
{
    public function create(Request $request, $project_id)
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
}
