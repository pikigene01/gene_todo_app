<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Todos;


class TodoController extends Controller
{
    public $auth_id;

    public function __construct()
    {
        $this->auth_id = null;
    }

    public function update_auth()
    {

        $this->auth_id = \Auth::id();
    }
    public function index()
    {
        $this->update_auth();

        $todos = Todos::where('user_id', $this->auth_id)->get();

        return view('welcome', ['todos' => $todos]);
    }

    public function store(Request $request)
    {
        $this->update_auth();

        $todo = new Todos();
        $todo->todo = "New Todo can be edited";
        $todo->is_completed = false;
        $todo->user_id = $this->auth_id;
        $todo->save();

        $todos = Todos::where('user_id', $this->auth_id)->get();

        return view('welcome', ['todos' => $todos]);
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
                'todo' => 'required|max:191',
            ]
        );


        if ($validator->fails()) {
            return redirect()->back()->with('message', $validator->errors());
        } else {
            $updatedTodo = Todos::where('id', $id)->update(array('todo' => $request->todo, 'is_completed' => $request->is_completed));
            return redirect()->route('home', ['todos' => Todos::get()]);
        }
    }
    public function view($id)
    {
        return view('welcome', ['todo' => Todos::where('id', $id)->first()]);
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
        $deletedUser = Todos::where('id', $id)->delete();

        return redirect()->route('home', ['todos' => Todos::get()]);
    }
}
