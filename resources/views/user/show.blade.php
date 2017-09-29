@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $model->name }}
                        <a href="{{ url('/users') }}" class="btn btn-xs btn-primary pull-right">Back</a>
                    </div>

                    <div class="panel-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $model->name }}</td>
                                </tr>

                                <tr>
                                    <td>Email</td>
                                    <td>{{ $model->email }}</td>
                                </tr>

                                <tr>
                                    <td>Created At</td>
                                    <td>{{ $model->created_at }}</td>
                                </tr>

                                <tr>
                                    <td>Updated At</td>
                                    <td>{{ $model->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr>

                        <h3>Roles</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Full Name</th>
                                <th>Role Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model->roles as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->display_name }}</td>
                                    <td>{{ $item->description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
