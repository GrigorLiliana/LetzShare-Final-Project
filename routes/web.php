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

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/gallery', 'PhotoController');

Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact', 'ContactController@store');

Route::get('/sendemail', 'SendEmailController@index');
Route::post('/sendemail/send', 'SendEmailController@send');

Route::get("send/email", "HomeController@mail");

/**
 * Tests
 */
Route::get('/chupelagaite', function () {
    return view('chupelagaite');
});
