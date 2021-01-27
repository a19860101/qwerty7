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

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/posts','PostController@index')->name('posts.index');
// Route::get('/posts/create','PostController@create')->name('posts.create');
// Route::get('/posts/{id}/edit','PostController@edit')->name('posts.edit');
// Route::get('/posts/show/{id}','PostController@show')->name('posts.show');

// Route::post('/posts','PostController@store')->name('posts.store');
// Route::delete('/posts/{id}','PostController@destroy')->name('posts.destroy');
// Route::put('/posts/{id}','PostController@update')->name('posts.update');


// Route::resource('/posts','PostController')->middleware('auth');

Route::group(['middleware' => 'auth'],function(){
    Route::resource('/posts','PostController')->except('index','show');
});
Route::resource('/posts','PostController')->only('index','show');

Route::resource('/category','CategoryController');


Route::get('/posts/tag/{tag}','PostController@postsTag')->name('posts.tag');
Route::get('/posts/category/{category}','PostController@postsCategory')->name('posts.category');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
