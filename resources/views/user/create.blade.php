@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        New user
                        <a href="{{ url('/users') }}" class="btn btn-xs btn-primary pull-right">Back</a>
                    </div>

                    <div class="panel-body">

                        @include('layouts.session')
                        @include('layouts.errors')

                        {!! Form::open(['action' => ['UserController@store']]) !!}

                            <div class="form-group">
                                <label for="name">User Full Name</label>
                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <label for="email">User Email</label>
                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                            </div>

                        <div class="form-group">
                            <h3>Roles</h3>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Assigned</th>
                                    <th>Name</th>
                                    <th>Full Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $item)
                                    <tr>
                                        <td>
                                        {!! Form::checkbox('roles[' . $item->name .']', $item->getKey(), false) !!}
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->display_name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation</label>
                                {!! Form::password('password_confirmation', ['placeholder' => 'Password Confirmation', 'class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>

                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
