<?php

use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/tours/search', 'TourController@search');
Route::get('/affiliates/search', 'AffiliateController@search');
Route::get('/affiliates/contains', 'AffiliateController@contains');

Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('users', 'UserController');
    Route::resource('affiliates', 'AffiliateController');
});

