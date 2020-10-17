@extends('layouts.userlayout')

@section('content')

<div class="container mt-5">
    <h3>{{ $quiz->course->title }}: {{ $quiz->title }} quiz</h3>
    @empty(!session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
    @endempty
    <form class="mt-3" method="POST" action="">
        @csrf
        @forelse ($quiz->questions as $question)
        <h6 class="mb-3">{{ $question->title }}? <span style="color: rgb(172, 170, 170)">({{ $question->score }} point/s).</span></h6>
            @if ($quiz->type == 'text')

        <div class="form-group">
            <input class="form-control" type="text" name="answer" id="answer">
        </div>
            @else
                @foreach (explode(',', $question->answers) as $answer)
        <div class="custom-control custom-radio">
            <label><input type="radio" name="{{ $question->id }}" value="{{ $answer }}"> {{ $answer }}</label>
        </div>
                @endforeach
            @endif
            <hr>
            @empty
        <p class="lead text-center">This quiz have no questions yet!</p>
        @endforelse
        @if($quiz->questions->count() != 0)
        <button type="submit" class="btn btn-primary">Submit</button>
        @endif
    </form>
</div>

@endsection
