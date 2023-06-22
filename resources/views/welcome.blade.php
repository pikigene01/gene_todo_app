@extends('layouts.app')

@section('title', 'Bless Tech')

@section('sidebar')
    <p>This is appended to the master sidebar.</p>
@stop

@section('content')
    <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-dark aside-md" id="nav">
            <section class="vbox">
                <header class="nav-bar dker">
                    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
                        <i class="fa fa-bars"></i>
                    </a>
                    <a href="#" class="nav-brand" data-toggle="fullscreen">todo</a>
                    <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user">
                        <i class="fa fa-comment-o"></i>
                    </a>
                </header>
                <section>
                    <nav class="nav-primary hidden-xs">
                        <h5>Logged in as: {{ Auth::user()->name }}</h5>
                        <ul class="nav">
                            @if (Auth::user()->role == 1)
                                <li>
                                    <a href="/users">
                                        <i class="fa fa-users"></i> <span>Users</span>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="/todos">
                                    <i class="fa fa-clock-o"></i> <span>Todos</span>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="/delete/{{ Auth::user()->id }}">
                                    @csrf

                                    <button type="submit" class="btn btn-danger"><i class="fa fa-flag"></i> <span>Delete
                                            Account</span> </button>

                                </form>
                            </li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li>
                                    <button type="submit" class="btn btn-danger mb-20">
                                        <i class="fa fa-flag"></i> <span>Logout</span>
                                    </button>
                                </li>
                            </form>
                        </ul>
                    </nav>
                    <!-- note -->
                    <div class="bg-dark lter wrapper hidden-vertical animated fadeInUp text-sm">
                        <a href="#" data-dismiss="alert" class="pull-right m-r-n-sm m-t-n-sm"><i
                                class="fa fa-times"></i></a>
                        Gene Todo App
                    </div>
                    <!-- / note -->
                </section>
                <footer class="footer bg-gradient hidden-xs">
                    <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-sm btn-link m-r-n-xs pull-right">
                        <i class="fa fa-power-off"></i>
                    </a>
                    <a href="#nav" data-toggle="class:nav-vertical" class="btn btn-sm btn-link m-l-n-sm">
                        <i class="fa fa-bars"></i>
                    </a>
                </footer>
            </section>
        </aside>
        <!-- /.aside -->
        <!-- .vbox -->
        <section id="content">
            <section class="hbox stretch" id="taskapp">
                <aside>
                    <section class="vbox">
                        <header class="header bg-light lter bg-gradient b-b">
                            <form method="POST" action="{{ route('createTodo') }}">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm pull-right btn-icon"
                                    title="create task">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </form>
                            <p>Tasks</p>
                        </header>
                        <section class="bg-light lter">
                            <section class="hbox stretch" >

                                <section class="vbox">
                                    <section class="scrollable wrapper">
                                        <!-- task list -->
                                        <ul id="task-list" class="list-group list-group-sp"></ul>
                                        @if (count($todos) > 0)

                                            @foreach ($todos as $todo)
                                                <div class="view" id="{{ $todo->id }}">

                                                    <form method="POST" action="/todoEdit/{{ $todo->id }}">
                                                        @csrf
                                                        <div class="checkbox">
                                                            <input class="toggle" name="is_completed" type="checkbox"
                                                                value="{{ $todo->is_completed }}"
                                                                {{ $todo->is_completed ? 'checked' : '' }} />

                                                            <span class="task-name">{{ $todo->todo }}</span>
                                                            <input name="todo" class="edit form-control" type="text"
                                                                value="{{ $todo->todo }}" />

                                                        </div>
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </form>
                                                    <form method="POST" action="/todoDelete/{{ $todo->id }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">
                                                            Delete
                                                            &times;
                                                        </button>

                                                    </form>
                                                </div>
                                            @endforeach
                                        @else
                                            <form method="POST" action="{{ route('createTodo') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-success"> Create Todo</button>

                                            </form>

                                        @endif


                                        <!-- task list -->
                                    </section>
                                </section>

                            </section>
                        </section>

                    </section>
                </aside>
                <!-- .aside -->
                <aside class="col-lg-4 bg-white">
                    <section class="vbox flex b-l" id="task-detail">
                        <!-- task detail -->
                        <script type="text/template" id="task-template">
              <header class="header bg-light lt b-b">  </header> <section> <section> <section> <ul id="task-comment" class="list-group no-radius no-border m-t-n-xxs"> </ul> </section> </section> </section> <footer class="footer bg-light lter clearfix b-t"> <div class="input-group m-t-sm">  </footer>
            </script>
                        <!-- task detail -->

                    </section>
                </aside>
                <!-- /.aside -->
            </section>
        </section>
        <!-- /.vbox -->
    </section>

    <script>
        const toggle = document.querySelectorAll('.toggle');
        toggle.forEach((tg) => {
            tg.oninput = (e) => {
                let value = e.target.value;
                if (value == 0) {
                    e.target.setAttribute('value', true);
                } else {
                    e.target.setAttribute('value', false);
                }
            }
        })
    </script>

@stop
