@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search Affiliates</div>

                    <div class="panel-body">
                        @include('layouts.session')

                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="Ternopil" placeholder="Origin" id="origin">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="Lviv" placeholder="Destination" id="destination">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="10" placeholder="Distance" id="distance">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" id="search">Get Direction</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <div id="map" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
