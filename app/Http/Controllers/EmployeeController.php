<?php

namespace App\Http\Controllers;

use App\Project;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            $id = (string) Auth::user()->id;
            $record  = Project::where('assign_employee', 'like', '%' . $id . '%')->get();
            // dd($record);
            return view("employee.dashboard", ['record' => $record]);
        }
    }
}
