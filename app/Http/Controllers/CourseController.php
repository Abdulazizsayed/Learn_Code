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

    public function enroll($slug)
    {
        $user = auth()->user();
        $course = Course::where('slug', $slug)->first();
        $user->courses()->attach([$course->id]);

        session()->flash('enrolled', "You've been enrolled in this course");
        return redirect("/courses/$slug");
    }
}
