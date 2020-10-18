@extends('layouts.userlayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @forelse ($courses as $course)
                <div class="card mt-5" style="width: 18rem;">
                    <img src="/images/{{ $course->photo ? $course->photo->filename : 'default.jpg' }}" class="card-img-top" alt="Course photo">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ $course->description }}</p>
                        <a href="/courses/{{ $course->slug }}" class="btn btn-primary">Go to course</a>
                        <span class="float-right">{{ $course->users->count() }} users enrolled</span>
                    </div>
                </div>
                @empty
                    <p class="lead text-center">No courses found</p>
                @endforelse
            </div>
            <div class="col-sm-9"></div>
        </div>
    </div>
@endsection
