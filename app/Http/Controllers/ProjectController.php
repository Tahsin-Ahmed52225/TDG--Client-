<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\User;
use App\Project;

class ProjectController extends Controller
{
    public function addProject(Request $request)
    {
        if ($request->isMethod("GET")) {
            $record = Project::orderBy('due_date', 'desc')->take(3)->get();
            return view("manager.add_project", ['record' => $record]);
        } else if ($request->isMethod("POST")) {
            $data['project_name'] = $request->tdg_project_name;
            $data['assignee_member'] = $request->tdg_assignee_member;
            $data['due_date'] = $request->tdg_project_date;
            $data['status'] = $request->tdg_project_status;
            $data['priority'] = $request->tdg_project_priority;
            $data['budget'] = $request->tdg_project_budget;
            $data['client_ID'] = $request->tdg_client_ID;
            $data['project_description'] = $request->tdg_project_description;
            $data['files'] = $request->photos;

            $validator = Validator::make($data, [
                'project_name' => ['required', 'string', 'max:255', 'unique:project,name'],
                'assignee_member' => ['required', 'string', 'max:255'],
                'due_date' => ['required', 'date', 'max:255'],
                'status' => ['required', 'string', 'max:255'],
                'priority' => ['required', 'string', 'max:255'],
                'budget' => ['required'],
                'client_ID' => ['required'],
                'project_description' => ['required', 'string', 'max:255'],
                'files' => 'required',
                'files.*' => 'mimes:pdf,docx,zip'
            ]);
            if ($validator->fails()) {
                return redirect("/manager/add-project")
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if ($request->hasfile('photos')) {
                    foreach ($request->file('photos') as $file) {
                        $name = time() . '.' . $file->extension();
                        $file->move(public_path() . '/files/', $name);
                        $new_data['files'][] = $name;
                    }
                }
                // dd($new_data["files"]);
                // dd(json_encode($data['files']));
                $record = Project::create([
                    'name' => filter_var($data['project_name'], FILTER_SANITIZE_STRING),
                    'assign_employee' => filter_var($data['assignee_member'], FILTER_SANITIZE_STRING),
                    'due_date' => $data['due_date'],
                    'status' =>  $data['status'],
                    'priority' => $data['priority'],
                    'description' => filter_var($data['project_description'], FILTER_SANITIZE_STRING),
                    'budget' => $data['budget'],
                    'payment_amount' => 0,
                    'manager_id' => Auth::user()->id,
                    'client_id' => $data['client_ID'],
                    'project_files' => json_encode($new_data["files"]),
                ]);
                if ($record) {
                    return redirect()->back()->with(session()->flash('alert-success', 'Project added successfully!'));
                } else {
                    Session::flash('error', 'Something went wrong ! Try Again');
                    return View::make('partials/flash_message');
                }
            }
        } else {
            Session::flash('error', 'Something went wrong ! Try Again');
            return View::make('partials/flash_message');
        }
    }
    public function viewProject(Request $request)
    {
    }
    public function allMember(Request $request)
    {
        if ($request->isMethod("POST")) {
            $name = User::where('name', 'like', "%" . $request->que . "%")->get("name");
            if (!$name->isEmpty()) {
                return $name;
            } else {
                $data = [[
                    "name" => "No record Found",
                ]];
                return $data;
            }
        }
    }
}
