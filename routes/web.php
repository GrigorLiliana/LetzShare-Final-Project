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

Route::get('/', 'HomeController@index')->name('home');

Route::view('/terms', 'termsconditions')->name('terms');
Route::view('/about-us', 'about-us')->name('about-us');

Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact/sendemail', 'ContactController@sendEmail');

Route::get('/uploadphoto', 'PhotoController@create')->name('uploadphoto');
Route::post('/uploadphoto', 'PhotoController@store');

Route::get('/useraccount', 'UserController@index')->name('useraccount');
Route::get('/userprofile/{id}', 'ProfileController@index')->name('userprofile');
Route::post('/userprofile/{id}', 'ProfileController@store');
Route::post('/userprofile/description/{id}', 'ProfileController@description');

Route::get('/gallery', 'PhotoController@index');
Route::get('/gallery/{category_id}', 'PhotoController@getCategory');

//** Likes handler */
Route::get('/like', 'PhotoController@photoLikePhoto')->name('like');

//** ADMIN - Middleware auth validation */
//Route::get('/admin', 'AdminController@index')->middleware('admin');


//** TESTs */
Route::view('/chupelagaite', 'chupelagaite');
