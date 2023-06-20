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
                                <form method="POST" action="/delete/{{Auth::user()->id}}">
                                    @csrf

                                    <button type="submit" class="btn btn-danger"><i class="fa fa-flag"></i> <span>Delete Account</span> </button>

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
                            <a href="/create-user" class="btn btn-success btn-sm pull-right btn-icon">
                                <i class="fa fa-plus"></i>
                            </a>
                            <p>Users</p>
                        </header>
                        <section class="bg-light lter">
                            <section class="hbox stretch">
                                <!-- .aside -->
                                <aside>
                                    <section class="vbox">
                                        <section class="scrollable wrapper">
                                            <div class="table-responsive">
                                                <table class="table table-striped b-t text-sm">
                                                    <thead>
                                                        <tr>
                                                            <th width="20"><input type="checkbox"></th>
                                                            <th class="th-sortable" data-toggle="class">Id <span
                                                                    class="th-sort"> <i class="fa fa-sort-down text"></i> <i
                                                                        class="fa fa-sort-up text-active"></i> <i
                                                                        class="fa fa-sort"></i> </span> </th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th width="30"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($users) > 0)

                                                        @foreach ($users as $user)

                                                        <tr>
                                                            <td><input type="checkbox" name="post[]" value="2"></td>
                                                            <td>{{ $user->id }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td style="display: flex;"> {{ $user->email }}
                                                                <form method="GET" action="/userEdit/{{$user->id}}" style="margin-right: 10px;margin-left: 20px;">
                                                                @csrf
                                                                <button class="btn btn-warning">Edit</button>
                                                                </form>
                                                                <form method="POST" action="/userDelete/{{$user->id}}">
                                                                    @csrf
                                                                <button class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </td>
                                                            <td> <a href="#" class="active" data-toggle="class"><i
                                                                        class="fa fa-check text-success text-active"></i><i
                                                                        class="fa fa-times text-danger text"></i></a> </td>
                                                        </tr>
                                                        @endforeach

                                                        @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>
                                    </section>
                                </aside>
                                <!-- /.aside -->
                            </section>
                        </section>

                    </section>
                </aside>
                <!-- .aside -->
                <aside class="col-lg-4 bg-white">
                    <section class="vbox flex b-l" id="task-detail">
                        <!-- task detail -->
                        <script type="text/template" id="task-template">
              <header class="header bg-light lt b-b"> <p class="m-b"> <span class="text-muted">Created:</span> <%- moment(date).format('MMM Do, h:mm a') %> </p> <div class="lter pull-in b-t m-t-xxs"> <textarea type="text" class="form-control form-control-trans scrollable" placeholder="Task description"><%- desc %></textarea> </div> </header> <section> <section> <section> <ul id="task-comment" class="list-group no-radius no-border m-t-n-xxs"> </ul> </section> </section> </section> <footer class="footer bg-light lter clearfix b-t"> <div class="input-group m-t-sm"> <input type="text" class="form-control input-sm" id="task-c-input" placeholder="Type a comment"> <span class="input-group-btn"> <button class="btn btn-success btn-sm" type="button" id="task-c-btn"><i class="fa fa-pencil"></i></button> </span> </div> </footer>
            </script>
                        <!-- task detail -->
                        <script type="text/template" id="item-c-template">
              <div class="view"> <button class="destroy close hover-action">&times;</button> <div> <span><%- desc %></span> <small class="text-muted block text-xs"><i class="fa fa-clock-o"></i> <%- moment(date).fromNow() %></small> </div> </div>
            </script>
                    </section>
                </aside>
                <!-- /.aside -->
            </section>
        </section>
        <!-- /.vbox -->
    </section>


@stop
