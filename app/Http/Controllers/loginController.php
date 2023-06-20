<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class loginController extends Controller
{


    public function __construct()
    {
    }

    public function loginweb(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|max:191',
                'password' => 'required',

            ]
        );


        if ($validator->fails()) {
            return redirect()->back()->with('message', $validator->errors());
        } else {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('welcome');
            } else {
                return redirect()->back()->with('message', 'credentials do not match!!!!!');
            }
        }
    }

    public function deleteMyAccount(Request $request,$id)
    {

        $deletedMyAccount = User::where('id', $id)->delete();
        \Auth::logout();

        return redirect('/login');
    }
}
