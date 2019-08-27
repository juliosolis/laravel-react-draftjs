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
    return view('cover');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'email'], function () {
        Route::get('/', 'EmailController@index')->name('email');
        Route::get('new', 'EmailController@create')->name('email.new');
        Route::get('edit/{email}', 'EmailController@edit')->name('email.edit');
        Route::get('view/{email}', 'EmailController@show')->name('email.view');

        Route::post('save', 'EmailController@store')->name('email.store');
        Route::put('update/{email}', 'EmailController@update')->name('email.update');
        Route::delete('delete', 'EmailController@destroy')->name('email.delete');
    });
});