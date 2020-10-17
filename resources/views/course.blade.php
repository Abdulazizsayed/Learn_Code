@extends('layouts.userlayout')

@section('content')

<div class="container mt-5">
    <div class="card text-white bg-primary mb-3">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-sm-8 p-3 course-content">
                    <h2>{{ $course->title }}</h2>
                    <h3 class="card-title">
                        Track: <a href="/tracks/{{ $course->track->name }}" class="text-white">{{ $course->track->name }}</a>
                    </h3>
                    <p class="card-text">{{ $course->description }}</p>
                    <div class="row align-items-end">
                        <div class="col-sm-6">
                            <span class="badge {{ $course->status ? "badge-danger" : "badge-success" }}">{{ $course->status ? "Paid" : "Free" }}</span>
                        </div>
                        <div class="col-sm-6">{{ $course->users->count() }} enrolled</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <img src="/images/{{ $course->photo ? $course->photo->filename : 'default.jpg' }}" height="220px" width="100%" alt="Course photo">
                </div>
            </div>
        </div>
    </div>
    <div class="videos">
        <div class="row">
            <div class="col-sm-12">
                <h3>Course videos</h3>
                <ul class="list-group">
                    @forelse ($course->videos as $video)
                    <li class="list-group-item bg-light video">
                        <i class="fab fa-youtube text-danger mr-3"></i>
                        <a href="{{ $video->link }}" data-toggle="modal" data-target="#show-video">{{ $video->title }}</a>
                    </li>
                    @empty
                    <div class="alert alert-danger">
                        This course does not include any videos yet!
                    </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div><hr>
    <div class="quizzes mt-3">
        <div class="row">
            <div class="col-sm-12">
                <h3>Course quizzes</h3>
                <ul class="list-group">
                    @forelse ($course->quizzes as $quiz)
                    <li class="list-group-item bg-light quiz">
                        <i class="fas fa-question text-primary mr-3"></i>
                        <a href="/quiz/{{ $quiz->id }}" target="_blank">{{ $quiz->title }}</a>
                    </li>
                    @empty
                    <div class="alert alert-danger">
                        This course does not include any quizzes yet!
                    </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="show-video" tabindex="-1" role="dialog" aria-labelledby="show-video-Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="show-video-Label">Video preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe
                    class="video-iframe"
                    width="560"
                    height="315"
                    src=""
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
</div>

@endsection
