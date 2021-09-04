<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class EmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->isEmployee()) {
            return $next($request);
        }
        Auth::logout();
        return redirect('/login')->with(session()->flash('alert-danger', 'Non Permitted Route'));
    }
}
