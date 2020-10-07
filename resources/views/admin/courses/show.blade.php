@extends('layouts.app', ['title' => __('Course Management')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Preview Course')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ $course->title }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="course-image">
                                    @if ($course->photo)
                                    <img class="img-fluid" src="/images/{{ $course->photo->filename }}" alt="Course photo">
                                    @else
                                    <img class="img-fluid" src="/images/default.jpg" alt="Course photo">
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="course-info">
                                    <h3>{{ \Str::limit($course->title, 50) }}</h3>
                                    <h5> <a href="/admin/tracks/{{ $course->track->id }}">{{ $course->track->name }}</a> </h5>
                                    <span class="{{ $course->status == 0 ? 'text-success' : 'text-danger' }}"> {{ $course->status ? 'Paid' : 'Free' }} </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive mt-3">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h2 class="mb-0">Course videos</h2>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="/admin/courses/{{ $course->id }}/videos/create" class="btn btn-sm btn-primary">{{ __('New video') }}</a>
                                        <a href="/admin/courses/{{ $course->id }}/quizzes/create" class="btn btn-sm btn-primary">{{ __('New quiz') }}</a>
                                    </div>
                                </div>
                            </div>
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Title</th>
                                        <th scope="col">Link</th>
                                        <th scope="col">Creation Date</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @forelse ($course->videos as $video)
                                        <tr>
                                            <td title="{{ $video->title }}">
                                                <a href="{{ route('videos.show', $video) }}">
                                                    {{ \Str::limit($video->title, 30) }}
                                                </a>
                                            </td>
                                            <td>
                                                <a title="{{ $video->link }}" href="{{ $video->link }}">{{ \Str::limit($video->link, 30) }}</a>
                                            </td>
                                            <td>{{ $video->created_at->diffForHumans() }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="{{ route('videos.edit', $video) }}">Edit</a>
                                                        <form action="{{ route('videos.destroy', $video) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <td>No videos found</td>
                                        @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
