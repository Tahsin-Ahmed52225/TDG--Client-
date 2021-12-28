<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectDetails;
use App\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("employee.index");
        }
    }
    public function viewMyProjects(Request $request)
    {
        if ($request->isMethod("GET")) {
            $id = (string) Auth::user()->id;
            $record  = Project::where('assign_employee', 'like', '%' . $id . '%')->get();
            $project_manager = ProjectDetails::where('project_manager_id', Auth::user()->id)->get('project_id');
            $user = [];
            for ($i = 0; $i < sizeof($record); $i++) {
                $record[$i]->assign_employee = rtrim($record[$i]->assign_employee, ", ");
                $user[$i] = User::find(explode(",", $record[$i]->assign_employee));
            }
            return view("employee.view_project", ['record' => $record, 'user' => $user, 'project_manager' => $project_manager]);
        }
    }
}
