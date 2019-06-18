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

Route::get('/refresh', 'Controller@refresh') -> name('refresh');
Route::get('/', 'HomeController@index') -> name('home.index');
Route::get('/load', 'HomeController@load') -> name('home.load');
Route::get('/work', 'BlogController@work') -> name('blog.work');
Route::get('/ajaxWork', 'BlogController@loadWork') -> name('blog.ajaxWork');
Route::get('blog/load', 'BlogController@load') -> name('blog.load');
Route::get('blog/get/{blog}', 'BlogController@get') -> name('blog.get');
Route::get('blog/{id}/delete', 'BlogController@destroy') -> name('blog.delete');
Route::get('blog/ajaxCategory', 'BlogController@ajaxCategory') -> name('blog.ajaxCategory');
Route::get('blog/category', 'BlogController@category') -> name('blog.category');
Route::resource('blog', 'BlogController');
Route::post('blog/{blog}/ajaxComment', 'BlogCommentController@ajaxStore') -> name('blog.comment.ajaxStore');
Route::get('blog/comment/{id}/delete', 'BlogCommentController@destroy') -> name('blog.comment.delete');
Route::resource('blog.comment', 'BlogCommentController');
Route::post('archive/index', 'ArchiveController@index') -> name('archive.index'); // used for archive navigation with the select menu
Route::get('archive/load', 'ArchiveController@load') -> name('archive.load'); // used for archive navigation with the select menu
Route::post('calendar/index', 'CalendarController@index') -> name('calendar.index'); // used for calendar navigation with the select menu
Route::get('calendar/load', 'CalendarController@load') -> name('calendar.load'); // used for calendar navigation with the select menu
Route::get('page/{name}/index', 'PageController@open') -> name('page.open');
Route::get('page/{name}/load', 'PageController@load') -> name('page.load');
Route::get('page/{page}/delete', 'PageController@destroy') -> name('page.delete');
Route::resource('page', 'PageController');

Route::middleware(['admin.init'])->group(function() {
    Route::resource('admin', 'Admin\HomeController', ['only'=>['store']]);
});

Auth::routes();

Route::middleware(['guest:admin'])->group(function() {
    Route::get('/admin/register/show', 'Admin\Auth\RegisterController@showRegistrationForm') -> name('admin.register.show');
    Route::post('/admin/register', 'Admin\Auth\RegisterController@register')-> name('admin.register');
    Route::get('/admin/login/show', 'Admin\Auth\LoginController@showLoginForm') -> name('admin.login.show');
    Route::post('/admin/login', 'Admin\Auth\LoginController@login')-> name('admin.login');
});

Route::post('/admin/logout', 'Admin\Auth\LoginController@logout')-> name('admin.logout');