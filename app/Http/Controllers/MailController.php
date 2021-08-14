<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\SignupEmail;

use App\Mail\AddNewEmployee;

use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupemail($name, $email, $verification_code)
    {
        $data = [
            'name' => $name,
            'verfication_code' => $verification_code,
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }
    public static function addEmployeeMail($name, $email, $token, $phone, $password)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'token' => $token,
            'phone' => $phone,
            'password' => $password
        ];
        Mail::to($email)->send(new AddNewEmployee($data));
    }
}
