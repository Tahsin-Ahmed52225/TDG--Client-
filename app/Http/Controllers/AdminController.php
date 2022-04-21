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
