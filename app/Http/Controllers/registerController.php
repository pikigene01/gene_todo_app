<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;



class registerController extends Controller
{
    public function register(Request $request)
    {
        $user = Auth::user();

        // Get the currently authenticated user's ID...
        $id = Auth::id();
        $role = 0; //first registered user will be admin and we will change the role to be 1 if no users inside the db
        $users = User::get();
        if($users->count() > 0){
            $role = 0;//for normal users
        }else{
            $role = 1;//first user automatically admin
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'email' => 'required|min:6',
                'password' => 'required|min:3',
                'password_confirmation' => 'required|same:password',

            ]
        );


        if ($validator->fails()) {
            return redirect()->back()->with('message', $validator->errors());

        } else {
            $user = User::where('email', $request->email)->first();
           if($user){
            //user already exist
            return redirect()->back()->with('message', 'User already exist');

           }else{

            $input = array(
                'name' => $request->name,
                'email' => $request->email,
                'role' => $role,
                'isVerified' => '1',
                'password' => bcrypt($request->password),
            );

            User::create($input);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('welcome');
            }

           }

        }
    }

    public function delete_user(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required'

            ]
        );


        if ($validator->fails()) {
            return response()->json(['status' => 401, 'message' => 'Please fill all fields']);
        } else {

            $user_id = $request->user_id;
            $isAuthenticated = $request->isAuthenticated;
            $user_file = User::where('id', $user_id)->where('belongs', $request->belongs)->get();

            if ($isAuthenticated) {
                $user = User::where('id', $user_id)->where('belongs', $request->belongs)->delete();
                foreach ($user_file as $user_file) {
                    $delete_image = true;
                    if ($user && $delete_image) {
                        return response()->json([
                            'status' => 200,
                            'message' => 'User Deleted Successfully and user image',
                        ]);
                    } else {
                        return response()->json([
                            'status' => 400,
                            'message' => 'Not Authorised',
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Please you are not authorized to delete user',
                ]);
            }
        }
    }
    public function update_user(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => 'required',

            ]
        );


        if ($validator->fails()) {
            return response()->json(['status' => 401, 'message' => 'Please fill all fields']);
        } else {
            $user_id = $request->user_id;

            $user = User::where('id', $user_id)->update(array(
                'name' => $request->name,
                'phone' => $request->phone, 'location' => $request->location, 'description' => $request->description, 'surname' => $request->surname
            ));

            return response()->json([
                'status' => 200,
                'message' => 'User updated Successfully',
            ]);
        }
    }
}
