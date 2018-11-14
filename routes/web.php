<?php

use Intervention\Image\Facades\Image;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('cat/{id}', 'HomeController@cat');
Route::resource('maps', 'MapController')->middleware('auth');
Route::resource('category', 'CategoryController')->middleware('auth');


Route::get('category/media/{icon}', function ($icon) {
    return Image::make(storage_path().'/app/uploads/category/'.$icon)->response();
});
