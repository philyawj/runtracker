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

Auth::routes(['register' => false]);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::resource('/dashboard/runs', 'RunController');
Route::resource('/dashboard/goals', 'GoalController', ['parameters' => ['goal' => 'year'], 'except' => [ 'edit']]);

Route::get('/dashboard/goals/{year}/{weekofyear}/edit', 'GoalController@edit')->name('goals.edit');