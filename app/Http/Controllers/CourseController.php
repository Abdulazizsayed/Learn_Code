<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index($slug)
    {
        return view('course')->with(['course' => Course::where('slug', $slug)->first()]);
    }
}
