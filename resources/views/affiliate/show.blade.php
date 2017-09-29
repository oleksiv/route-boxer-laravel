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

                        @include('layouts.show')

                        <label for="map">Map</label>
                        <div class="row">
                            <div class="form-group">

                                <div id="map" latitude="{{$model->latitude}}" longitude="{{$model->longitude}}" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
