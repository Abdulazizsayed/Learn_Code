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
                            <h3 class="mb-0">Tracks</h3>
                        </div>
                    </div>
                </div>

                <div class="col-12">
            </div>
                <form action="{{ route('tracks.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-row justify-content-center">
                        <div class="col-3">
                            <input class="form-control" type="text" name='name' placeholder="Enter Track Name">
                        </div>
                        <div class="col-2">
                            <input class="form-control btn btn-success" type="submit" value="Add">
                        </div>
                    </div>
                </form><br>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col"># Courses</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                                @forelse ($tracks as $track)
                                <tr>
                                    <td>{{ $track->name }}</td>
                                    <td>{{ $track->courses->count() }}</td>
                                    <td>{{ $track->created_at->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{ route('tracks.edit', $track) }}">Edit</a>
                                                <form action="{{ route('tracks.destroy', $track) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <td>No tracks found</td>
                                @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $tracks->links() }}
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
