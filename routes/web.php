<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->middleware('auth');

Route::resource('categories', 'CategoryController');
Route::resource('posts', 'PostController');
Route::get('add_post', 'PostController@create')->name('add_post');
Route::post('submit_post', 'PostController@store')->name('submit_post');
Route::post('search', 'PostController@search')->name('search');
Route::get('post_list', 'PostController@search')->name('post_list');

Route::get('/roles', 'PermissionController@Permission');
Route::get('/seed', 'CategoryController@Seed');

Route::group(['middleware' => 'role:manager'], function () {
    Route::get('/admin', 'AdminController@index')->name('admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
