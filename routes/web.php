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
    return view('welcome');
});

// Posts
Route::get('/posts', 'PostsController@index')->name('posts');

Route::get('/posts/create', 'PostsController@create')->name('posts.create');

Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');

Route::post('/posts', 'PostsController@store')->name('posts.store');

Route::get('/posts/{post}/edit', 'PostsController@edit')->name('posts.edit');

Route::patch('/posts/{post}', 'PostsController@update')->name('posts.update');

Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy');

// Comments
Route::post('/posts/{id}/comment', 'CommentController@store')->middleware('auth');




Route::resource('users', 'UsersController')->middleware('verified');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
