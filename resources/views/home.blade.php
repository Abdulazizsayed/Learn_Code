@extends('layouts.userlayout')

@section('content')
    @include('includes.home_picture')

    @auth
        @include('includes.my_courses')
    @endauth

    @include('includes.track_famous_courses')
@endsection
