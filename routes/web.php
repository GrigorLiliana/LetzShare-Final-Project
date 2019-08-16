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

//Route::resource('/gallery', 'PhotoController');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact/sendemail', 'ContactController@sendEmail');

/**
 * Tests
 */
Route::get('/chupelagaite', function () {
    return view('chupelagaite');
});
Route::get('/uploadphoto', 'PhotoController@create')->name('uploadphoto');
Route::post('/uploadphoto', 'PhotoController@store');
Route::get('/useraccount', 'UserController@index')->name('useraccount');
