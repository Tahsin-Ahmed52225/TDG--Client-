<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Client Dashboard  show
     * @param Request
     * @return GET::client_dashboard
     * @return POST::User_homepage
     */
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view('client.dashboard');
        } else if ($request->isMethod("POST")) {
        } else {
            Auth::logout();
            return view("welcome");
        }
    }
}
