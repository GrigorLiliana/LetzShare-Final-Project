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

Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/photos-gallery', 'PhotoController');
Route::get("send/email", "HomeController@mail");

/**
 * Tests
 */
Route::get('/chupelagaite', function () {
    return view('chupelagaite');
});
