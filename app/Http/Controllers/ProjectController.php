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
     * View all project
     * @param Request
     * @return GET::all_project_details
     *
     *
     */
    public function view(Request $request)
    {
        if ($request->isMethod("GET")) {
            $record = Project::all();
            $user = [];
            for ($i = 0; $i < sizeof($record); $i++) {
                $record[$i]->assign_employee = rtrim($record[$i]->assign_employee, ", ");
                $user[$i] = User::find(explode(",", $record[$i]->assign_employee));
            }
            if (Auth::user()->role == "admin") {
                return view("admin.view_project", ['record' => $record, 'user' => $user]);
            } else {
                return view("manager.view_project", ['record' => $record, 'user' => $user]);
            }
        } else {
            return redirect('/');
        }
    }
    /**
     * Adding New Project
     * @param Request
     * @return GET::Add_project_page
     * @return Post::Adding_project_data
     *
     */
    public function create(Request $request)
    {
        if ($request->isMethod("GET")) {
            $record = Project::take(3)->orderBy('due_date', 'desc')->get();
            $user = [];
            for ($i = 0; $i < sizeof($record); $i++) {
                $record[$i]->assign_employee = rtrim($record[$i]->assign_employee, ", ");
                $user[$i] = User::find(explode(",", $record[$i]->assign_employee));
            }
            if (Auth::user()->role == "admin") {
                return view("admin.add_project", ['record' => $record, 'user' => $user]);
            } else {
                return view("manager.add_project", ['record' => $record, 'user' => $user]);
            }
        } else if ($request->isMethod("POST")) {

            //extracting ids from the string
            $ids = '';
            $ids = extracting_ids($request->tdg_assignee_member);
            $client_id = extracting_client_id($request->tdg_client_ID);

            $data['project_name'] = $request->tdg_project_name;
            $data['project_assigned_member'] = $ids;
            $data['project_due_date'] = $request->tdg_project_date;
            $data['project_status'] = $request->tdg_project_status;
            $data['project_priority'] = $request->tdg_project_priority;
            $data['project_description'] = $request->tdg_project_description;
            $data['project_type'] = $request->tdg_project_type;


            //validation
            if ($data["project_type"] == "client") {
                $data['project_budget'] = $request->tdg_project_budget;
                $data['client_id'] = $client_id;

                $validator = Validator::make($data, [
                    'project_name' => ['required', 'string', 'max:255'],
                    'project_assigned_member' => ['required', 'string', 'max:255'],
                    'project_due_date' => ['required', 'date', 'max:255'],
                    'project_status' => ['required', 'string', 'max:255'],
                    'project_priority' => ['required', 'string', 'max:255'],
                    'project_description' => ['string', 'max:255'],
                    'project_type' => ['required', 'string', 'max:255'],
                    'project_budget' => ['required', 'integer', 'gt:0'],
                    'client_id' => ['required', 'integer', 'max:255'],
                ]);
            } else {
                $data['project_budget'] = 0;
                $data['client_id'] = 0;

                $validator = Validator::make($data, [
                    'project_name' => ['required', 'string', 'max:255'],
                    'project_assigned_member' => ['required', 'string', 'max:255'],
                    'project_due_date' => ['required', 'date', 'max:255'],
                    'project_status' => ['required', 'string', 'max:255'],
                    'project_priority' => ['required', 'string', 'max:255'],
                    'project_description' => ['string', 'max:255'],
                    'project_type' => ['required', 'string', 'max:255'],
                ]);
            }

            if ($validator->fails()) {
                //validation fail redirection
                return redirect("/manager/add-project")
                    ->withErrors($validator)
                    ->withInput();
            } else {
                //storing project data in database
                $record = Project::create([
                    'project_name' => filter_var($data['project_name'], FILTER_SANITIZE_STRING),
                    'assign_employee' => filter_var($data['project_assigned_member'], FILTER_SANITIZE_STRING),
                    'manager_id' => Auth::user()->id,
                    'due_date' => $data['project_due_date'],
                    'status' =>  $data['project_status'],
                    'priority' => $data['project_priority'],
                    'description' => filter_var($data['project_description'], FILTER_SANITIZE_STRING),
                    'project_type' => $data['project_type'],
                    'budget' => $data['project_budget'],
                    'payment_amount' => 0,
                    'client_id' => $data['client_id'],
                ]);
                if ($record) {
                    //Success message
                    return redirect()->back()->with(session()->flash('alert-success', 'Project added successfully! '));
                } else {
                    //DB error redirection
                    return redirect()->back()->with(session()->flash('alert-success', 'Project added successfully! '));
                }
            }
        } else {
            //invaild request redirection
            return redirect()->back()->with(session()->flash('alert-success', 'Project added successfully! '));
        }
    }

    /**
     * Deleting Project
     * @param Request @param project_Id
     * @return GET::deleting_project_data
     *
     *
     */
    public function delete(Request $request, $id)
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
    public function undo_delete(Request $request, $id)
    {
        if ($request->isMethod("GET")) {
            $project = Project::withTrashed()->find($id);
            //dd($project);
            if ($project->trashed()) {
                $project->restore();
                return redirect()->back()->with(session()->flash('alert-undoed', 'Project restored successfully! '));
            } else {
                return redirect()->back()->with(session()->flash('alert-undoed', 'Something went wrong! '));
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
     * Sorting project by month
     * @param Request
     * @return POST(ajax)::Returing_project_info_while_sorting_by_month
     *
     *
     */
    public function sortBymonth(Request $request)
    {
        if ($request->isMethod("POST")) {
            if ($request->month == 'none') {
                $record = Project::all();
            } else {
                $record = Project::whereMonth('created_at', $request->month)->get();
            }

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
                        $item->project_name .
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
            if ($request->year == 'none') {
                $record = Project::all();
            } else {
                $record = Project::whereYear('created_at', $request->year)->get();
            }

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
                        $item->project_name .
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
            $record = Project::where('project_name', 'like', '%' . $request->que . '%')->get();
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
                        $item->project_name .
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
    public function exitingMember(Request $request)
    {
        if ($request->isMethod("POST")) {
            $project = Project::find($request->p_id);
            $project->assign_employee = rtrim($project->assign_employee, ", ");
            $user_ids = explode(",", $project->assign_employee);
            $all_user = User::all();


            for ($i = 0; $i < count($user_ids); $i++) {
                $user = $all_user->where("id", "!=", $user_ids[$i])->where("role", "==", "employee");
                $all_user = $user;
            }
            $data = [];
            foreach ($user as $item) {
                array_push($data, $item);
            }
            return $data;
        }
    }
}
