<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;


class AuthController extends Controller
{
    /**
     * Normal User Login page
     * @param Request
     * @return GET::user_login_page
     * @return POST::User_homepage
     */
    public function login(Request $request)
    {
        if ($request->isMethod("GET")) {
            return  view("auth.login");
        } else if ($request->isMethod("POST")) {
            $data['email'] = $request->email;
            $data['password'] = $request->password;
            $validator = Validator::make($data, [
                'email' => ['required', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
            ]);
            if ($validator->fails()) {
                return redirect("/login")
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if (Auth::attempt(['email' =>  $request->email, 'password' => $request->password])) {
                    if (Auth::user()->verified == 0) {
                        Auth::logout();
                        return redirect()->back()->with(session()->flash('alert-warning', 'Please verify your account'));
                    } else {
                        if (Auth::user()->role == "Client") {
                            if (Auth::user()->stage == 1) {
                                return redirect('/client/dashboard');
                            } else {
                                Auth::logout();
                                return redirect()->back()->with(session()->flash('alert-warning', 'Your account has been locked !'));
                            }
                        } else {
                            Auth::logout();
                            return redirect()->back()->with(session()->flash('alert-warning', 'Not permitted route'));
                        }
                    }
                } else {
                    return redirect()->back()->with(session()->flash('alert-danger', 'Incorract Credentials'));
                }
            }
        } else {
            return  view('welcome');
        }
    }
    /**
     * Normal User Register page
     * @param Request
     * @return GET::User_registration_page
     * @return POST::User_login_with_Alert
     */
    public function register(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("auth.register");
        } else if ($request->isMethod("POST")) {
            //  dd($request);
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = $request->password;
            $data['number'] = $request->number;
            $data['password_confirmation'] = $request->password_confirmation;
            //  dd($data);
            $validator =  Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'number' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            if ($validator->fails()) {
                return redirect("/register")
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $token = sha1(time());
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'number' => $request->number,
                    'position' => 'None',
                    'role' => 'client',
                    'verification_code' => $token,
                    'stage' => 1,
                    'password' => Hash::make($request->password),
                ]);
                if ($user != null) {
                    MailController::sendSignupemail($request->name, $request->email, $token);
                    return redirect('/login')->with(session()->flash('alert-success', 'Verification link send, Please Verify !'));
                } else {
                    return redirect()->back()->with(session()->flash('alert-danger', 'Something went wrong, Try Again !'));
                }
            }
            //  dd($request);
        } else {
            return view("welcome");
        }
    }
    /**
     * Normal User Verify Profile
     * @param Request
     * @return GET::employee_forget_Password
     */
    public function verify_User(Request $request)
    {
        if ($request->isMethod("GET")) {
            $verification_code = \Illuminate\Support\Facades\Request::get('code');
            $user = User::where("verification_code", "=", $verification_code)->first();

            if ($user != null) {
                $user->verified = 1;
                $user->verification_code = null;
                $user->save();

                return redirect("/login")->with(session()->flash('alert-success', 'Your account is verfied, Please login'));
            }
            return redirect("/login")->with(session()->flash('alert-danger', 'Invaild verification code'));
        } else {
            return view('welcome');
        }
    }
    /**
     * Normal User Forget Password page
     * @param Request
     * @return GET::employee_forget_Password
     * @return POST::Login_with_Alert
     */
    public function forget_password(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("auth.forget_password");
        } else if ($request->isMethod("POST")) {
        } else {
            return view("welcome");
        }
    }
    /**
     * Employee User Login page
     * @param Request
     * @return GET::employee_login_page
     * @return POST::Empolyee_homepage
     */
    public function tdgLogin(Request $request)
    {
        if ($request->isMethod("GET")) {
            return  view("auth.employee_login");
        } else if ($request->isMethod("POST")) {
            $data['email'] = $request->email;
            $data['password'] = $request->password;
            $validator = Validator::make($data, [
                'email' => ['required', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:6'],
            ]);
            if ($validator->fails()) {
                return redirect("/login")
                    ->withErrors($validator)
                    ->withInput();
            } else {
                if (Auth::attempt(['email' =>  $request->email, 'password' => $request->password])) {
                    if (Auth::user()->verified == 0) {
                        Auth::logout();
                        return redirect()->back()->with(session()->flash('alert-warning', 'Please verify your account'));
                    } else {
                        if (Auth::user()->role == "employee" || Auth::user()->role == "admin") {
                            if (Auth::user()->stage == 1) {
                                if (Auth::user()->role == "employee" && Auth::user()->position == "Manager") {
                                    return redirect('/manager/dashboard');
                                } else if (Auth::user()->role == "employee" && Auth::user()->position != "Manager") {
                                    return redirect('/employee/dashboard');
                                } else if (Auth::user()->role == "admin") {
                                    return redirect('/admin/dashboard');
                                }
                            } else {
                                Auth::logout();
                                return redirect()->back()->with(session()->flash('alert-warning', 'Your account has been locked !'));
                            }
                        } else {
                            Auth::logout();
                            return redirect()->back()->with(session()->flash('alert-warning', 'Not permitted route'));
                        }
                    }
                } else {
                    return redirect()->back()->with(session()->flash('alert-danger', 'Incorract Credentials'));
                }
            }
        } else {
            return  view('welcome');
        }
    }
    public function logout(Request $request)
    {
        if ($request->isMethod("GET")) {
            if (Auth::user()->role == 'client') {
                Auth::logout();
                return redirect('/login');
            } else {
                Auth::logout();
                return redirect('/tdg-login');
            }
        } else {
            return view("welcome");
        }
    }
}
