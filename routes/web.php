<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('admin.utils.right_sidebar');
});

Route::group(['middleware' => 'dashboard', 'prefix' => 'dashboard'], function () {
    Route::resource('/', 'DashboardController');
    Route::resource('/addUser', 'DashboardController');
    Route::resource('/addUser1', 'DashboardController');
    Route::group(['middleware' => 'dashboard', 'prefix' => 'dashboard'], function () {
        Route::resource('/', 'DashboardController');
        Route::resource('/addUser', 'DashboardController');
        Route::resource('/addUser1', 'DashboardController');
        Route::resource('/addUser2', 'DashboardController');
    });
    Route::resource('/addUser2', 'DashboardController');
});