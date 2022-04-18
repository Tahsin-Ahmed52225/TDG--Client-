<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use App\User;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     * @param Request
     * @return GET::admin dashboard
     *
     */
    public function index(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('admin.dashboard');
        }
    }
    public function myProfile()
    {
        return view("admin.my_profile");
    }
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
        }
    }
    /**
     * Admin view all clients
     * @param Request
     * @return GET::all_clients
     * @return POST::Invite_clients
     */
    public function viewClients(Request $request)
    {
        if ($request->isMethod("GET")) {
            $users = User::where("role", "=", "client")->get();
            return view('admin.view_client', ['users' => $users]);
        }
    }
}
