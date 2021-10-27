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
    Route::post('api/character/updateExp', 'CharacterController@updateExp')->name('character.updateExp');
    Route::post('api/character/delete', 'CharacterController@delete')->name('character.delete');
    Route::post('api/character/food', 'CharacterController@food')->name('character.food');
    Route::post('api/game/postPoint', 'GameController@postPoint')->name('game.postPoint');
    Route::get('api/game/showPoint', 'GameController@showPoint')->name('game.showPoint');
    Route::post('api/game/postFood', 'GameController@postFood')->name('game.postFood');
    Route::get('api/game/showFood', 'GameController@showFood')->name('game.showFood');
});
