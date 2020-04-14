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

Route::get('/', 'HomeController@index')->middleware('auth');

Route::resource('categories', 'CategoryController');
Route::get('add_post', 'PostController@create')->name('add_post');
Route::post('submit_post', 'PostController@store')->name('submit_post');
Route::post('search', 'PostController@search')->name('search');
Route::post('download_post', 'PostController@download')->name('download_post');
Route::get('post_list', 'PostController@search')->name('post_list');

Route::get('/roles', 'PermissionController@Permission');
Route::get('/seedCategories', 'CategoryController@Seed');
Route::get('/seedPosts', 'PostController@Seed');

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
