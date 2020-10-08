<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Track;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard')->with([
            'last_tracks' => Track::orderBy('id', 'desc')->limit(5)->get(),
            'last_courses' => Course::orderBy('id', 'desc')->limit(5)->get(),
            'last_users' => User::where('admin', 0)->orderBy('id', 'desc')->limit(5)->get(),
            'last_quizzes' => Quiz::orderBy('id', 'desc')->limit(5)->get(),
        ]);
    }
}
