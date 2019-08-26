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

Route::get('/demo', function () {
    return [
        [
            'id' => 1,
            'name' => 'Julio',
            'age' => 35,
        ],
        [
            'id' => 2,
            'name' => 'Nesla',
            'age' => 34,
        ],
        [
            'id' => 3,
            'name' => 'Jr',
            'age' => 8,
        ],
        [
            'id' => 4,
            'name' => 'Yulia',
            'age' => 2,
        ]
    ];
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'email'], function () {
        Route::get('/', 'EmailController@index')->name('email');
        Route::get('new', 'EmailController@create')->name('email.new');
        Route::post('save', 'EmailController@store')->name('email.store');
        Route::delete('delete', 'EmailController@destroy')->name('email.delete');
    });
});