<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Own profile view
     *
     * @param Request
     * @return admin.member.add_member
     */
    public function myProfileView(Request $request)
    {
        if ($request->isMethod('GET')) {
            $user = auth()->user();
            return view('common.profile.index', ['user' => $user]);
        }
    }
}
