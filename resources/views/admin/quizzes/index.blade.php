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
                            <h3 class="mb-0">Quizzes</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="/admin/quizzes/create" class="btn btn-sm btn-primary">Add quiz</a>
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
                                <th scope="col">Course</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse ($quizzes as $quiz)
                                <tr>
                                    <td title="{{ $quiz->title }}">
                                        <a href="{{ route('quizzes.show', $quiz) }}">
                                            {{ \Str::limit($quiz->title, 30) }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/admin/courses/{{ $quiz->course->id }}" title="{{ $quiz->course->title }}">{{ \Str::limit($quiz->course->title, 30) }}</a>
                                    </td>
                                    <td>{{ $quiz->created_at->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{ route('quizzes.edit', $quiz) }}">Edit</a>
                                                <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <td>No quizzes found</td>
                                @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $quizzes->links() }}
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
