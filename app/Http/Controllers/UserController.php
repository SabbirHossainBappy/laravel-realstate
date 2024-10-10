<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserDashboard(Request $request){
        return view('user.user_dashboard');
    }
}
