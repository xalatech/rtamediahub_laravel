<?php

use Illuminate\Support\Facades\Route;
use App\Post;

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

Route::get('/', 'HomeController@index');

Route::resource('categories', 'CategoryController');
Route::get('add_post', 'PostController@create')->name('add_post')->middleware('auth');
Route::post('submit_post', 'PostController@store')->name('submit_post')->middleware('auth');
Route::post('search', 'PostController@search')->name('search');
Route::post('download_post', 'PostController@download')->name('download_post')->middleware('auth');
Route::get('post_list', 'PostController@search')->name('post_list');

Route::get('/roles', 'PermissionController@Permission')->middleware('auth');
Route::get('/seedCategories', 'CategoryController@Seed')->middleware('auth');
Route::get('/seedPosts', 'PostController@Seed')->middleware('auth');

Route::get('/post/{post}', function ($slug) {
    $post = Post::where('slug', $slug)->first();
    $data['post'] = $post;
    return view('post_view', $data);
});

Route::group(['middleware' => 'role:manager'], function () {
    Route::get('/adminCustom', 'AdminController@index')->name('adminCustom');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('phpinfo', function(){
	phpinfo();
});