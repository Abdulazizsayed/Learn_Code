<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyCoursesController extends Controller
{
    public function index()
    {
        return view('mycourses')->with(['user_courses' => auth()->user()->courses]);
    }
}
