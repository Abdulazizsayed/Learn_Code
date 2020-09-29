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
                            <h3 class="mb-0">Videos</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="/admin/videos/create" class="btn btn-sm btn-primary">Add video</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
            </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Link</th>
                                <th scope="col">Course</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse ($videos as $video)
                                <tr>
                                    <td title="{{ $video->title }}">{{ \Str::limit($video->title, 30) }}</td>
                                    <td>
                                        <a title="{{ $video->link }}" href="{{ $video->link }}">{{ \Str::limit($video->link, 30) }}</a>
                                    </td>
                                    <td>
                                        <a href="/admin/courses/{{ $video->course->title }}" title="{{ $video->course->title }}">{{ \Str::limit($video->course->title, 30) }}</a>
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
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $videos->links() }}
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
