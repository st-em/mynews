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
/* 課題３
Route::group(['prefix'=>'XXX'], function(){
	Route::get('XXX', 'AAAController@bbb');
});


Route::get('XXX', 'AAAController@bbb');
*/



Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
    Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
    Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
    
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//13章：追記
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'Admin\NewsController@add');
     Route::post('news/create', 'Admin\NewsController@create'); # 追記
});

//13章：課題
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::post('profile/edit', 'Admin\ProfileController@update');
     Route::post('profile/create', 'Admin\ProfileController@create'); 
});