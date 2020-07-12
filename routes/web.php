<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('home');
// });



Route::get('categories/{category:slug}', 'CategoryController@show')->name('categories.show');
Route::get('tags/{tag:slug}', 'TagController@show')->name('tags.show');
Route::get('search', 'SearchController@post')->name('search.get.post');

// Route::view('contact', 'contact');
// Route::view('about', 'about');
// Route::view('login', 'login');

Route::prefix('posts')->middleware('auth')->group(function(){
    Route::get('create', 'PostController@create')->name('posts.create');
    Route::post('store', 'PostController@store')->name('posts.store');
    Route::get('{post:slug}/edit', 'PostController@edit')->name('posts.edit');
    Route::patch('{post:slug}/edit', 'PostController@update')->name('posts.update');
    Route::delete('{post:slug}/delete', 'PostController@destroy')->name('posts.destroy');
});
Route::get('posts', 'PostController@index')->name('posts.index');
Route::get('posts/{post:slug}', 'PostController@show')->name('posts.show');

// Route::get('contact' , function(Request $request){
//     // return $request->fullUrl(); 
//     // hasilnya http://localhost:8001/contact

//     return $request->path();
//     // hasilnya contact
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
