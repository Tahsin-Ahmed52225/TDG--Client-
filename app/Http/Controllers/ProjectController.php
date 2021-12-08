<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Carbon;
// Models
use App\User;
use App\Project;
use App\ProjectDetails;

class ProjectController extends Controller
{
    /**
     * Adding New Project
     * @param Request
     * @return GET::Add_project_page
     * @return Post::Adding_project_data
     *
     */
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
            $ids = extracting_ids($request->tdg_assignee_member);
            $client_id = extracting_client_id($request->tdg_client_ID);
            $data['assignee_member'] = $ids;
            $data['due_date'] = $request->tdg_project_date;
            $data['status'] = $request->tdg_project_status;
            $data['priority'] = $request->tdg_project_priority;
            $data['budget'] = $request->tdg_project_budget;
            $data['client_ID'] = $client_id;
            $data['project_description'] = $request->tdg_project_description;
            $data['files'] = $request->photos;

            // dd($data);

            $validator = Validator::make($data, [
                'project_name' => ['required', 'string', 'max:255'],
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
                    $project_details = ProjectDetails::create([
                        'project_id' => $record->id,
                        'subtask' => json_encode([]),
                        'project_manager_id' => null
                    ]);
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
    /**
     * Deleting Project
     * @param Request @param project_Id
     * @return GET::deleting_project_data
     *
     *
     */
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
    /**
     * Resorting  Project Data
     * @param Request @param project_Id
     * @return GET::resorte_project_data
     *
     *
     */
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
    /**
     * Change Project Status to complete
     * @param Request @param project_Id
     * @return GET::change_project_status_to_complete
     *
     *
     */
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
    /**
     * Getting All memebers name in typeahed
     * @param Request
     * @return POST(ajax)::getting_members_name_while_typing
     *
     *
     */
    public function allMember(Request $request)
    {
        if ($request->isMethod("POST")) {
            $name = User::where('role', '=', 'employee')->where('name', 'like', "%" . $request->que . "%")->get(["id", "name"]);
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
    /**
     * Getting All memebers name in typeahed
     * @param Request
     * @return POST(ajax)::getting_members_name_while_typing
     *
     *
     */
    public function allClient(Request $request)
    {
        if ($request->isMethod("POST")) {
            $name = User::where('role', '=', 'client')->where('verified', '=', 1)->where('name', 'like', "%" . $request->que . "%")->get(["id", "name"]);
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
    /**
     * View all project
     * @param Request
     * @return GET::all_project_details
     *
     *
     */
    public function viewProject(Request $request)
    {
        if ($request->isMethod("GET")) {
            $record = Project::all();
            $user = [];
            for ($i = 0; $i < sizeof($record); $i++) {
                $record[$i]->assign_employee = rtrim($record[$i]->assign_employee, ", ");
                $user[$i] = User::find(explode(",", $record[$i]->assign_employee));
            }
            return view("manager.view_project", ['record' => $record, 'user' => $user]);
        } else {
            return redirect('/');
        }
    }
    /**
     * Sorting project by month
     * @param Request
     * @return POST(ajax)::Returing_project_info_while_sorting_by_month
     *
     *
     */
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
                return  Response($data);
            }
        }
    }
    /**
     * Sorting project by Year
     * @param Request
     * @return POST(ajax)::Returing_project_info_while_sorting_by_year
     *
     *
     */
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
                return  Response($data);
            }
        }
    }
    /**
     * Sorting project by month & year
     * @param Request
     * @return POST(ajax)::Returing_project_info_while_sorting_by_month_&_year
     *
     *
     */
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
    /**
     * Sorting project by Project_name
     * @param Request
     * @return POST(ajax)::Returing_project_info_while_sorting_by_project_name
     *
     *
     */
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
        }
    }

    // public function stageChange(Request $request)
    // {
    //     if ($request->isMethod("GET")) {
    //         $project = Project::find($request->p_id);
    //         if ($project) {
    //             $project->update(["status" => $request->stage]);
    //             $project->save();
    //         }
    //     }
    // }
    public function exitingMember(Request $request)
    {
        if ($request->isMethod("POST")) {
            $project = Project::find($request->p_id);
            $project->assign_employee = rtrim($project->assign_employee, ", ");
            $user_ids = explode(",", $project->assign_employee);
            $all_user = User::all();


            for ($i = 0; $i < count($user_ids); $i++) {
                $user = $all_user->where("id", "!=", $user_ids[$i])->where("role", "!=", "admin");
                $all_user = $user;
            }
            $data = [];
            foreach ($user as $item) {
                array_push($data, $item);
            }
            return $data;
        }
    }
    public function singleProject(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $project = Project::find($id);
            return view("manager.single_project", ['project' => $project]);
        }
    }
}
