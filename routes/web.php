<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::get('/', function () {
    return redirect(route('login'));
});
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/projects/{id}', 'ProjectController@show');
Route::post('/projects/add', 'ProjectController@add');
Route::patch('/projects/{project}', 'ProjectController@update');

Route::post('/projects/{project}/entry/start', 'EntryController@start');
Route::post('/projects/{project}/entry/stop', 'EntryController@stop');

Route::fallback(function(){
    return redirect('login');
});
