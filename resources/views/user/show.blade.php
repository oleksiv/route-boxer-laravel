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

                        @include('layouts.session')

                        @include('layouts.show')

                        <hr>

                        <h3>Roles</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Full Name</th>
                                <th>Role Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model->roles as $item)
                                <tr>
                                    <td>{{ $item->getKey() }}</td>
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
