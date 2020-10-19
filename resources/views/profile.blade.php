@extends('layouts.userlayout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h2 class="pt-5 pb-3">Profile: {{ $user->name }}</h2>
            <div id="message"></div>
            <div id="uploaded-image">
                <img src="/images/{{ $user->photo ? $user->photo->filename : 'default_user_photo.jpg' }}" alt="User photo" class="img-thumbnail">
            </div>
            <div class="text-center pt-3 pb-3">
                <a class="btn btn-primary upload-btn" href=""><i class="fas fa-cloud-upload-alt"></i> Upload</a>
                <form id="upload-form" hidden action="/profile" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="file" name="photo">
                </form>
            </div>
            <div class="container">
                <p class="lead pt-3"><i class="fas fa-envelope-square"></i> {{ $user->email }}</p>
                <p>
                    <i class="fas fa-pen"></i> <span class="text-muted">{{ $user->score }} points</span>
                </p>
                <p>
                    <i class="fas fa-user-secret"></i> <strong>{{ $user->admin ? 'Admin' : 'Learner' }}</strong>
                </p>
                <p>
                    <span class="{{ $user->email_verified_at ? 'text-success' : 'text-danger'}}">{{ $user->email_verified_at ? 'Verified' : 'Unverified'}}</span>
                </p>
                <p class="lead">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>
        </div>
        <div class="col-sm-8 pl-5">
            <h4 class="pt-5" style="margin-top: 50px;">User info</h4>
            <form action="/profile" method="POST">
                @csrf
                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address.." value="{{ $user->email }}" aria-describedby="emailHelp">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="name">Your name</label>
                    <input type="name" class="form-control" id="name" name="name" placeholder="Enter your full name.." value="{{ $user->name }}">

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter a strong password..">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                    <label for="password2">Confirm password</label>
                    <input type="password" class="form-control" id="password2" name="password_confirmation" placeholder="Enter the same password..">

                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection
