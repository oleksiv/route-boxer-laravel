@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Users
                        <a href="{{ url('/users/create') }}" class="btn btn-xs btn-primary pull-right">Create new</a>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($models as $model)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/users/' . $model->getKey()) }}">{{$model->id}}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/users/' . $model->getKey() . '/edit') }}">{{$model->name}}</a>
                                        </td>
                                        <td>{{$model->email}}</td>
                                        <td>{{$model->created_at}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            {{ $models->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
