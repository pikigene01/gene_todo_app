<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(){

        \Auth::logout();

        return redirect()->back()->with(['message'=>'You have been logged out successfully!!!']);
    }
}
