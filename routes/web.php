<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// User routes

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// Admin routes

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', 'Admin\HomeController@index')->name('home');
    Route::get('/admin', function () {
        return redirect('admin/dashboard');
    });
    Route::resource('/admin/admins', 'Admin\AdminController', ['except' => ['show']]);
    Route::resource('/admin/users', 'Admin\UserController', ['except' => ['show']]);
    Route::resource('/admin/tracks', 'Admin\TrackController', ['except' => ['create']]);
    Route::resource('/admin/courses', 'Admin\CourseController');
    Route::resource('/admin/videos', 'Admin\VideoController');
    Route::resource('/admin/quizzes', 'Admin\QuizController');
    Route::get('/admin/profile', ['as' => 'profile.edit', 'uses' => 'Admin\ProfileController@edit']);
    Route::put('/admin/profile', ['as' => 'profile.update', 'uses' => 'Admin\ProfileController@update']);
    Route::put('/admin/profile/password', ['as' => 'profile.password', 'uses' => 'Admin\ProfileController@password']);
});
