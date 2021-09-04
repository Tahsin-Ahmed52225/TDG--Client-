<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("employee.dashboard");
        }
    }
}
