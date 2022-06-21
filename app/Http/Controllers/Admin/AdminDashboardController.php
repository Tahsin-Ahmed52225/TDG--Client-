<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    /**
     * Admin Dashboard
     *
     * @param Request
     * @return admin.dashboard
     */
    public function view(Request $request)
    {
        if ($request->isMethod('GET')) {

            return view('admin.dashboard');
        }
    }
}
