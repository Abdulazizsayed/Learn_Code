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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'SearchController@index');
Route::get('/tracks/{name}', 'TrackController@index');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/courses/{slug}', 'CourseController@index');
    Route::post('/courses/{slug}', 'CourseController@enroll');
    Route::get('/courses/{slug}/quizzes/{name}', 'QuizController@index');
    Route::post('/courses/{slug}/quizzes/{name}', 'QuizController@submit');
    Route::get('/mycourses', 'MyCoursesController@index');
    Route::post('/profile', 'ProfileController@update');
    Route::get('/profile', 'ProfileController@index');
});

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
    Route::resource('admin/courses.videos', 'Admin\CourseVideoController');
    Route::resource('admin/courses.quizzes', 'Admin\CourseQuizController');
    Route::resource('admin/tracks.courses', 'Admin\TrackCourseController');
    Route::resource('/admin/videos', 'Admin\VideoController');
    Route::resource('/admin/quizzes', 'Admin\QuizController');
    Route::resource('/admin/questions', 'Admin\QuestionController');
    Route::resource('/admin/quizzes.questions', 'Admin\QuizQuestionController');
    Route::get('/admin/profile', ['as' => 'profile.edit', 'uses' => 'Admin\ProfileController@edit']);
    Route::put('/admin/profile', ['as' => 'profile.update', 'uses' => 'Admin\ProfileController@update']);
    Route::put('/admin/profile/password', ['as' => 'profile.password', 'uses' => 'Admin\ProfileController@password']);
});

// For tests
// Route::get('/test', function () {
//     return
// });
