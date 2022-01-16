<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Models
use App\User;

class NamePickerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod("GET")) {
            $users = User::where("role", "employee")->get("name");
            //   dd($users);
            if ($users) {
                if (count($users) == 1) {
                    $names = $users->first()->name;
                } else {
                    $names = "";
                    foreach ($users as $user) {
                        $names = $names . "," . $user->name;
                    }
                    $names = ltrim($names, $names[0]);
                }
            } else {
                $names = "";
            }
            return view('manager.namepicker', ["names" => $names]);
        }
    }
}
