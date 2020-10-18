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

// Route::get('/', function () {
//     return view('tweets/index');
// });
Auth::routes();

Route::group(['prefix'=>'tweet','middleware'=>'auth'],function(){
    Route::get('index','TweetController@index')->name('tweets.index');
    Route::get('create','TweetController@create')->name('tweets.create');
    Route::post('store','TweetController@store')->name('tweets.store');
    Route::get('show/{id}','TweetController@show')->name('tweets.show');
    Route::get('edit/{id}','TweetController@edit')->name('tweets.edit');
    Route::post('update/{id}','TweetController@update')->name('tweets.update');
    Route::post('destroy/{id}','TweetController@destroy')->name('tweets.destroy');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
