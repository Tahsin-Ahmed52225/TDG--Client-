<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\temp_file;
use Illuminate\Contracts\Session\Session;

class ProjectFileController extends Controller
{
    public function tempUpload(Request $request, $project_id)
    {
        if ($request->isMethod("POST")) {

            if ($request->hasfile('fileUpload')) {
                $file = $request->file('fileUpload');
                $name = time() . '.' . $file->extension();
                $file->move(public_path() . '/files/temp', $name);
                $temp_file = temp_file::create([
                    'file_name' => $name
                ]);
                Session::put('file_id', $temp_file->id);
                return response()->json(["success" => true]);
            } else {
                return response()->json(["success" => false]);
            }
        }
    }
    public function create()
    {
    }
}
