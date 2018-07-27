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



//Tags
Route::resource('tags', 'TagController', ['except' => ['create']]);

//Categories
Route::resource('categories', 'CategoryController', ['except' => ['create']]);

//Comments
Route::post('comments/{id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

//Blog
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');

Route::get('blog', ['as' => 'blog.index','uses' => 'BlogController@getIndex']);

//Pages
Route::get('contact', 'PagesController@getContact');

Route::get('about', 'PagesController@getAbout');

Route::get('/', 'PagesController@getIndex');

//Posts
Route::resource('posts', 'PostController');

Auth::routes();

Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');

//Route::get('/home', 'HomeController@index');

/*
*Authentication Tutorial (Admin)

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    
    Route::get('/', 'AdminController@index')->name('admin.dashboard');    

    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});

*/






