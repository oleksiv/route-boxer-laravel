@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Affiliates
                        <a href="{{ url('/affiliates/create') }}" class="btn btn-xs btn-primary pull-right">Create new</a>
                    </div>

                    <div class="panel-body">

                            @include('layouts/session')

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($models as $model)
                                    <tr>
                                        <td>
                                            <a href="{{ url('/affiliates/' . $model->getKey()) }}">{{ $model->getKey() }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/affiliates/' . $model->getKey() . '/edit') }}">{{ $model->name }}</a>
                                        </td>
                                        <td>{{ $model->address }}</td>
                                        <td>{{ $model->latitude }}</td>
                                        <td>{{ $model->longitude }}</td>
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
