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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::controller('category','Category');
//category
Route::get('/category','CategoryController@index');
Route::get('/cast','CastController@index');
Route::get('/actor','ActorController@index');
Route::get('/report','ReportController@index');
Route::get('/movie','MovieController@index');
Route::get('/movie-request','MovieController@getMovieRequest');
Route::get('/series','SeriesController@index');
Route::get('/episode/{id}','SeriesController@getepisode');
Route::get('/notify','NotificationController@index');