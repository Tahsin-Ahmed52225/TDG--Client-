<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProjectController extends Controller
{
    public function addProject(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("manager.add_project");
        }
    }
    public function viewProject(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("manager.view_project");
        }
    }
    public function allMember(Request $request)
    {
        if ($request->isMethod("POST")) {
            return User::where('name', 'like', "%" . $request->que . "%")->get("name");
        }
    }
}
