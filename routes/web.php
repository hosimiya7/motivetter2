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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::post('api/goal/create', 'GoalController@create')->name('goal.create');
    Route::get('api/goal/show', 'GoalController@show')->name('goal.show');
    Route::get('api/character/show', 'CharacterController@show')->name('character.show');
});
