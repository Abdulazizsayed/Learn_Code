<?php

namespace App\Http\Controllers;

use App\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index($name)
    {
        $courses = Track::where('name', $name)->firstOrFail()->courses;
        return view('track_courses', compact('courses'));
    }
}
