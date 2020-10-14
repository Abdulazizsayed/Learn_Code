<?php

namespace App\Http\Controllers;

use App\Track;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        return view('home')->with([
            'user_courses' => auth()->user()->courses,
            'tracks' => Track::with('courses')->orderBy('id', 'desc')->get()
        ]);
    }
}
