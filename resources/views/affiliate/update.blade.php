@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $model->name }}
                        <a href="{{ url('/affiliates') }}" class="btn btn-xs btn-primary pull-right">Back</a>
                    </div>

                    <div class="panel-body">

                        @include('layouts.session')
                        @include('layouts.errors')

                        {!! Form::model($model, ['method' => 'PUT', 'action' => ['AffiliateController@update', $model->getKey()]]) !!}

                        <div class="form-group">
                            <label for="name">Name</label>
                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            {!! Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            {!! Form::text('latitude', null, ['placeholder' => 'Latitude', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            {!! Form::text('longitude', null, ['placeholder' => 'Longitude', 'class' => 'form-control']) !!}
                        </div>

                        <label for="map">Map</label>
                        <div class="row">
                            <div class="form-group">

                                <div id="map" latitude="{{$model->latitude}}" longitude="{{$model->longitude}}" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            {!! Form::textarea('description', null, ['placeholder' => 'Description', 'class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-warning pull-right">Update</button>
                        </div>

                        {!! Form::close() !!}

                        <div class="form-group">
                            {!! Form::open(['method' => 'DELETE', 'action' => ['AffiliateController@destroy', $model->id]]) !!}
                            <button href="{{ url('/users') }}" class="btn btn-danger pull-left">Delete affiliate</button>
                            {!! Form::close() !!}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
