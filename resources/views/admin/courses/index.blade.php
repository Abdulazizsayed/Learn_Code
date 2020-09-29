@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="main-content">
        <!-- Top navbar -->
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Courses</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="/admin/courses/create" class="btn btn-sm btn-primary">Add course</a>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-12">
                </div> --}}
                <div class="row pl-2 pr-2">
                    @forelse ($courses as $course)
                    <div class="col-md-3">
                        <div class="card" style="width: 17rem;">
                            @if ($course->photo)
                            <img src="/images/{{ $course->photo->filename }}" class="card-img-top" alt="Course image">
                            @else
                            <img src="/images/default.jpg" class="card-img-top" alt="Course image">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ \Str::limit($course->title, 100) }}</h5>
                                <form action="/admin/courses/{{ $course->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/admin/courses/{{ $course->id }}/edit" class="btn btn-info btn-sm">Edit</a>
                                    <a href="#" class="btn btn-primary btn-sm">Show</a>
                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="lead text-center">No courses found</p>
                    @endforelse
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $courses->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
