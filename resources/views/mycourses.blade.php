@extends('layouts.userlayout')

@section('content')
    <div class="container">
        <h2 class=" mt-5">Your courses</h2>
        <div class="row">
            @forelse (auth()->user()->courses as $course)
                <div class="col-sm-4">
                    <div class="card mt-5" style="width: 18rem;">
                        <img src="/images/{{ $course->photo ? $course->photo->filename : 'default.jpg' }}" class="card-img-top" alt="Course photo">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                            <a href="/courses/{{ $course->slug }}" class="btn btn-primary">Go to course</a>
                            <span class="float-right">{{ $course->users->count() }} users enrolled</span>
                        </div>
                    </div>
                </div>
                @empty
                    <p class="lead text-center">No courses found</p>
                @endforelse
        </div>
    </div>
@endsection
