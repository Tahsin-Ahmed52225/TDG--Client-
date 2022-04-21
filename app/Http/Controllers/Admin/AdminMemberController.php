<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

//Custom Model
use App\User;

class AdminMemberController extends Controller
{
    /**
     * Admin Add Member
     *
     * @param Request
     * @return admin.member.add_member
     */
    public function addMember(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view('admin.member.add_member');
        } else if ($request->isMethod("POST")) {
            $data['name'] = $request->tdg_name;
            $data['email'] = $request->tdg_email;
            $data['phone'] = $request->tdg_phone;
            $data['position'] = $request->tdg_position;
            $data['password'] = $request->tdg_password;
            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'phone' => ['required', 'string', 'max:255'],
                'position' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
            ]);
            if ($validator->fails()) {
                return redirect("/admin/add-member")
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $token = sha1(time());
                $user = User::create([
                    'name' =>  $data['name'],
                    'email' =>   $data['email'],
                    'number' => $data['phone'],
                    'position' =>  $data['position'],
                    'role' => 'employee',
                    'verification_code' => $token,
                    'stage' => 1,
                    'password' => Hash::make($request->password),
                ]);
                if ($user != null) {
                    MailController::addEmployeeMail($request->tdg_name, $request->tdg_email, $token, $request->tdg_phone, $request->tdg_password);
                    return redirect()->back()->with(session()->flash('alert-success', 'Member Added !'));
                } else {
                    return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong, Try Again !'));
                }
            }
        } else {

            return redirect('/');
        }
    }
    /**
     * View All Member
     *
     * @param Request
     * @return admin.member.view_member
     */
    public function viewMember(Request $request)
    {
        if ($request->isMethod("GET")) {
            $users = User::where("role", "=", "employee")->get();
            return view('admin.member.view_member', ['users' => $users]);
        } else {
            return redirect('/');
        }
    }
    /**
     * Update member info
     *
     * @param Request
     * @return ajax_response
     */
    public function updateMember(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->id);
            if ($request->value == null) {
                $msg = ucwords($request->option) . " shouldn't be empty";
                Session::flash('error', $msg);
                return View::make('partials/flash_message');
            } else {
                if ($request->option == "email") {
                    if (filter_var($request->value, FILTER_VALIDATE_EMAIL)) {
                        if ($user) {
                            $option = $request->option;
                            $user->$option =  filter_var($request->value, FILTER_SANITIZE_EMAIL);
                            $user->save();
                            $msg = ucwords($request->option) . " updated successfully";
                            Session::flash('success', $msg);
                            return View::make('partials/flash_message');
                        } else {
                            Session::flash('error', "Something went wrong");
                            return View::make('partials/flash_message');
                        }
                    } else {
                        Session::flash('error', "Enter valid email");
                        return View::make('partials/flash_message');
                    }
                } else if ($request->option == "number") {
                    if (filter_var($request->value, FILTER_VALIDATE_INT)) {
                        if ($user) {
                            $option = $request->option;
                            $user->$option =  filter_var($request->value, FILTER_VALIDATE_INT);
                            $user->save();
                            $msg = ucwords($request->option) . " updated successfully";
                            Session::flash('success', $msg);
                            return View::make('partials/flash_message');
                        } else {
                            Session::flash('error', "Something went wrong");
                            return View::make('partials/flash_message');
                        }
                    } else {
                        Session::flash('error', "Incorrect input");
                        return View::make('partials/flash_message');
                    }
                } else {
                    if ($user) {
                        $option = $request->option;
                        $user->$option =  $request->value;
                        $user->save();
                        $msg = ucwords($request->option) . " updated successfully";
                        Session::flash('success', $msg);
                        return View::make('partials/flash_message');
                    } else {
                        Session::flash('error', "Something went wrong");
                        return View::make('partials/flash_message');
                    }
                }
            }
        } else {
            return redirect('/');
        }
    }
    /**
     * Delete Member
     *
     * @param Request
     * @return response
     */
    public function deleteMember(Request $request)
    {
        if ($request->ajax()) {
            $user = User::find($request->data);
            if ($user) {
                $user->delete();
                Session::flash('success', 'Member removed successfully');
                return View::make('partials/flash_message');
            } else {
                Session::flash('error', 'Something is wrong');
                return View::make('partials/flash_message');
            }
        } else {
            return redirect('/');
        }
    }
}
