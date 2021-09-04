<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\User;
use App\Project;
use Illuminate\Support\Carbon;

class ProjectController extends Controller
{
    public function addProject(Request $request)
    {
        if ($request->isMethod("GET")) {
            $record = Project::take(3)->orderBy('due_date', 'desc')->get();
            // dd($record);
            //dd(json_decode($record[0]->project_files)[1]);
            //Converting the string into id array
            $user = [];
            for ($i = 0; $i < sizeof($record); $i++) {
                $record[$i]->assign_employee = rtrim($record[$i]->assign_employee, ", ");
                $user[$i] = User::find(explode(",", $record[$i]->assign_employee));
            }
            //  dd($user);
            return view("manager.add_project", ['record' => $record, 'user' => $user]);
        } else if ($request->isMethod("POST")) {



            $data['project_name'] = $request->tdg_project_name;
            $ids = '';
            //Modifining input value into id string
            preg_match_all('!\d+!', $request->tdg_assignee_member, $id);
            for ($i = 0; $i < sizeof($id[0]); $i++) {
                $ids .= (string)$id[0][$i] . ',';
            }

            $data['assignee_member'] = $ids;
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
    public function deleteProject(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $project = Project::find($id);
            if ($project) {
                $project->delete();
                $request->session()->put('id_value', $id);
                return redirect()->back()->with(session()->flash('alert-delete_msg', 'Project delete successfully! '));
            } else {
                return redirect()->back()->with(session()->flash('alert-undoed', 'Something went wrong! '));
            }
        }
    }
    public function undoProject(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $project = Project::withTrashed()->find($id);
            //dd($project);
            if ($project->trashed()) {
                $project->restore();
                return redirect()->back()->with(session()->flash('alert-undoed', 'Project restored successfully! '));
            } else {
            }
        }
    }
    public function markComplete(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            if (Project::find($id)) {
                Project::find($id)->update(["status" => "complete"]);
                return redirect()->back();
            } else {
                return redirect()->back()->with(session()->flash('alert-undoed', 'Something went wrong! '));
            }
        }
    }
    public function allMember(Request $request)
    {
        if ($request->isMethod("POST")) {
            $name = User::where('name', 'like', "%" . $request->que . "%")->get(["id", "name"]);
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
    public function viewProject(Request $request)
    {
        if ($request->isMethod("GET")) {
            $record = Project::all();
            $user = [];
            for ($i = 0; $i < sizeof($record); $i++) {
                $record[$i]->assign_employee = rtrim($record[$i]->assign_employee, ", ");
                $user[$i] = User::find(explode(",", $record[$i]->assign_employee));
            }
            //     dd($user);
            return view("manager.view_project", ['record' => $record, 'user' => $user]);
            // $record = Project::take(3)->orderBy('due_date', 'desc')->get();
            // // dd($record);
            // //dd(json_decode($record[0]->project_files)[1]);
            // //Converting the string into id array

            // return view("manager.view_project", ['record' => $record, 'user' => $user]);
            // // return view("manager.view_project");
        } else {
            return redirect('/');
        }
    }
    public function sortBymonth(Request $request)
    {
        if ($request->isMethod("POST")) {
            $record = Project::whereMonth('created_at', $request->month)->get();
            // dd($record);
            $user = [];
            for ($i = 0; $i < sizeof($record); $i++) {
                $record[$i]->assign_employee = rtrim($record[$i]->assign_employee, ", ");
                $user[$i] = User::find(explode(",", $record[$i]->assign_employee));
            }
            //  dd(sizeof($user[0]));
            $names = [];

            for ($i = 0; $i < sizeof($user); $i++) {
                $names[$i] = '';
                for ($j = 0; $j < sizeof($user[$i]); $j++) {

                    $names[$i] .=  '<span class="tool" data-tip="' .   $user[$i][$j]->name . ' | ' . $user[$i][$j]->position . '">' .
                        '<i style="font-size: 25px;" class="far fa-user-circle"></i>' .
                        '</span>';
                }
            }



            if ($record) {
                $data = '';
                $k = 0;
                foreach ($record as $item) {
                    if ($item->status == 'complete') {
                        $icon = '<i class="fas fa-check-circle pr-2 text-success" style="font-size:20px"></i>';
                    } else {
                        $icon =     '<a href="./mcp/' . $item->id . '">'
                            . '<i class="far fa-check-circle pr-2 grow" style="font-size:20px"></i>' .
                            '</a>';
                    }
                    $url = "'" . "./projects/" . $item->id . "'";
                    $data .=  '<tr id="row"' . 'onclick="window.location=' . $url . '";>' .
                        '<td id="name"' . 'style="padding: 17px 10px !important; width:50%;">' .
                        $icon .
                        $item->name .
                        '</td>' .
                        '<td>' . $names[$k] . '</td>' .
                        '<td>' . Carbon::parse($item->due_date)->format('d-m-Y')  . '</td>' .
                        '<td>' . $item->priority  . '</td>' .
                        '<td>' . $item->status  . '</td>' .
                        '</tr>';
                    $k++;
                }
                // dd($data);
                return  Response($data);
            }
            // if (!$record->isEmpty()) {
            //     return $record;
            // } else {
            //     // $data = [[
            //     //     "name" => "No record Found",
            //     // ]];
            //     // return $data;
            // }
        }
    }
    public function sortByYear(Request $request)
    {
        if ($request->isMethod("POST")) {
            $record = Project::whereYear('created_at', $request->year)->get();
            // dd($record);
            $user = [];
            for ($i = 0; $i < sizeof($record); $i++) {
                $record[$i]->assign_employee = rtrim($record[$i]->assign_employee, ", ");
                $user[$i] = User::find(explode(",", $record[$i]->assign_employee));
            }
            //  dd(sizeof($user[0]));
            $names = [];

            for ($i = 0; $i < sizeof($user); $i++) {
                $names[$i] = '';
                for ($j = 0; $j < sizeof($user[$i]); $j++) {

                    $names[$i] .=  '<span class="tool" data-tip="' .   $user[$i][$j]->name . ' | ' . $user[$i][$j]->position . '">' .
                        '<i style="font-size: 25px;" class="far fa-user-circle"></i>' .
                        '</span>';
                }
            }



            if ($record) {
                $data = '';
                $k = 0;
                foreach ($record as $item) {
                    if ($item->status == 'complete') {
                        $icon = '<i class="fas fa-check-circle pr-2 text-success" style="font-size:20px"></i>';
                    } else {
                        $icon =     '<a href="./mcp/' . $item->id . '">'
                            . '<i class="far fa-check-circle pr-2 grow" style="font-size:20px"></i>' .
                            '</a>';
                    }
                    $url = "'" . "./projects/" . $item->id . "'";
                    $data .=  '<tr id="row"' . 'onclick="window.location=' . $url . '";>' .
                        '<td id="name"' . 'style="padding: 17px 10px !important; width:50%;">' .
                        $icon .
                        $item->name .
                        '</td>' .
                        '<td>' . $names[$k] . '</td>' .
                        '<td>' . Carbon::parse($item->due_date)->format('d-m-Y')  . '</td>' .
                        '<td>' . $item->priority  . '</td>' .
                        '<td>' . $item->status  . '</td>' .
                        '</tr>';
                    $k++;
                }
                // dd($data);
                return  Response($data);
            }
            // if (!$record->isEmpty()) {
            //     return $record;
            // } else {
            //     // $data = [[
            //     //     "name" => "No record Found",
            //     // ]];
            //     // return $data;
            // }
        }
    }
    public function sortByBoth(Request $request)
    {
        if ($request->isMethod("POST")) {
            $record = Project::whereYear('created_at', $request->year)
                ->whereMonth('created_at', $request->month)->get();
            // dd($record);
            $user = [];
            for ($i = 0; $i < sizeof($record); $i++) {
                $record[$i]->assign_employee = rtrim($record[$i]->assign_employee, ", ");
                $user[$i] = User::find(explode(",", $record[$i]->assign_employee));
            }
            //  dd(sizeof($user[0]));
            $names = [];

            for ($i = 0; $i < sizeof($user); $i++) {
                $names[$i] = '';
                for ($j = 0; $j < sizeof($user[$i]); $j++) {

                    $names[$i] .=  '<span class="tool" data-tip="' .   $user[$i][$j]->name . ' | ' . $user[$i][$j]->position . '">' .
                        '<i style="font-size: 25px;" class="far fa-user-circle"></i>' .
                        '</span>';
                }
            }



            if ($record) {
                $data = '';
                $k = 0;
                foreach ($record as $item) {
                    if ($item->status == 'complete') {
                        $icon = '<i class="fas fa-check-circle pr-2 text-success" style="font-size:20px"></i>';
                    } else {
                        $icon =     '<a href="./mcp/' . $item->id . '">'
                            . '<i class="far fa-check-circle pr-2 grow" style="font-size:20px"></i>' .
                            '</a>';
                    }
                    $url = "'" . "./projects/" . $item->id . "'";
                    $data .=  '<tr id="row"' . 'onclick="window.location=' . $url . '";>' .
                        '<td id="name"' . 'style="padding: 17px 10px !important; width:50%;">' .
                        $icon .
                        $item->name .
                        '</td>' .
                        '<td>' . $names[$k] . '</td>' .
                        '<td>' . Carbon::parse($item->due_date)->format('d-m-Y')  . '</td>' .
                        '<td>' . $item->priority  . '</td>' .
                        '<td>' . $item->status  . '</td>' .
                        '</tr>';
                    $k++;
                }
                // dd($data);
                return  Response($data);
            }
            // if (!$record->isEmpty()) {
            //     return $record;
            // } else {
            //     // $data = [[
            //     //     "name" => "No record Found",
            //     // ]];
            //     // return $data;
            // }
        }
    }
    public function singleProject(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $project = Project::find($id);
            return view("manager.single_project", ['project' => $project]);
        }
    }
    public function searchProject(Request $request)
    {
        if ($request->isMethod("POST")) {
            $record = Project::where('name', 'like', '%' . $request->que . '%')->get();
            // dd($record);
            $user = [];
            for ($i = 0; $i < sizeof($record); $i++) {
                $record[$i]->assign_employee = rtrim($record[$i]->assign_employee, ", ");
                $user[$i] = User::find(explode(",", $record[$i]->assign_employee));
            }
            //  dd(sizeof($user[0]));
            $names = [];

            for ($i = 0; $i < sizeof($user); $i++) {
                $names[$i] = '';
                for ($j = 0; $j < sizeof($user[$i]); $j++) {

                    $names[$i] .=  '<span class="tool" data-tip="' .   $user[$i][$j]->name . ' | ' . $user[$i][$j]->position . '">' .
                        '<i style="font-size: 25px;" class="far fa-user-circle"></i>' .
                        '</span>';
                }
            }



            if ($record) {
                $data = '';
                $k = 0;
                foreach ($record as $item) {
                    if ($item->status == 'complete') {
                        $icon = '<i class="fas fa-check-circle pr-2 text-success" style="font-size:20px"></i>';
                    } else {
                        $icon =     '<a href="./mcp/' . $item->id . '">'
                            . '<i class="far fa-check-circle pr-2 grow" style="font-size:20px"></i>' .
                            '</a>';
                    }
                    $url = "'" . "./projects/" . $item->id . "'";
                    $data .=  '<tr id="row"' . 'onclick="window.location=' . $url . '";>' .
                        '<td id="name"' . 'style="padding: 17px 10px !important; width:50%;">' .
                        $icon .
                        $item->name .
                        '</td>' .
                        '<td>' . $names[$k] . '</td>' .
                        '<td>' . Carbon::parse($item->due_date)->format('d-m-Y')  . '</td>' .
                        '<td>' . $item->priority  . '</td>' .
                        '<td>' . $item->status  . '</td>' .
                        '</tr>';
                    $k++;
                }
                // dd($data);
                return  Response($data);
            }
            // if (!$record->isEmpty()) {
            //     return $record;
            // } else {
            //     // $data = [[
            //     //     "name" => "No record Found",
            //     // ]];
            //     // return $data;
            // }
        }
    }
}
