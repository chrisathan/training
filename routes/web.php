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

Route::get('new', function(){
	return view('newProject');
});

Route::post('store', 'ProjectController@store');

Route::get('index', 'ProjectController@viewProjects');



Route::get('edit/{id}', ['uses'=>'ProjectController@edit', 'as'=>'edit']);



