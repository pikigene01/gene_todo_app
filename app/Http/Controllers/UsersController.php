<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public $role;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('user', ['users'=> User::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('create', ['users'=> User::get()]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->role = "0";
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
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->role = $this->role;
                $user->password = bcrypt($request->password);
                $user->isVerified = 1;
                $user->save();

       return view('user', ['users'=> User::get()]);

        }

    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|max:191',
                'name' => 'required',

            ]
        );


        if ($validator->fails()) {
            return redirect()->back()->with('message', $validator->errors());
        } else {
                $updatedUser = User::where('id', $id)->update(array('name'=>$request->name, 'email'=> $request->email));
                return view('user', ['users'=> User::get()]);
        }
    }
    public function view($id)
    {
        return view('edit', ['user'=> User::where('id', $id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedUser = User::where('id', $id)->delete();
        return view('user', ['users'=> User::get()]);
    }
}
