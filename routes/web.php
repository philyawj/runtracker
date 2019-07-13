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
    return view('welcome');
});

Auth::routes(['register' => false, 'reset' => false]);

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

// users must be logged in to see dashboard
Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    
    Route::resource('/dashboard/runs', 'RunController');
    Route::resource('/dashboard/goals', 'GoalController', ['parameters' => ['goal' => 'year'], 'except' => [ 'edit', 'create']]);
    
    Route::get('/dashboard/goals/{year}/{week_of_year}/edit', 'GoalController@edit')->name('goals.edit');
    Route::get('/dashboard/goals/{year}/{week_of_year}/create', 'GoalController@create')->name('goals.create');
    Route::post('/dashboard/goals/reroute', 'GoalController@reroute')->name('goals.reroute');
});

