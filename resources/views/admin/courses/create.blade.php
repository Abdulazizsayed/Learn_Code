@extends('layouts.app', ['title' => __('Courses Management')])

@section('content')
    @include('admin.users.partials.header', ['title' => __('Add Course')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Courses Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('courses.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('courses.store') }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">{{ __('Course information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="textarea-description">{{ __('Description') }}</label>
                                    <textarea name="description" id="textarea-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description" required>
                                        {{ old('description') }}
                                    </textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('link') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-link">{{ __('Link') }}</label>
                                    <input type="url" name="link" id="input-link" class="form-control form-control-alternative{{ $errors->has('link') ? ' is-invalid' : '' }}" placeholder="{{ __('Link') }}" value="{{ old('link') }}" required>

                                    @if ($errors->has('link'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('link') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('photo') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-photo">{{ __('Photo') }}</label>
                                    <input type="file" name="photo" id="input-photo" class="form-control form-control-alternative{{ $errors->has('photo') ? ' is-invalid' : '' }}" required>

                                    @if ($errors->has('photo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="price">Pricing</label>
                                    <select name="status" class="form-control" id="price" required>
                                        <option value="0"{{ old('status') == 0 ? ' selected' : '' }}>Free</option>
                                        <option value="1"{{ old('status') == 1 ? ' selected' : '' }}>Paid</option>
                                    </select>

                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('track') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="track">Course track</label>
                                    <select name="track_id" class="form-control" id="track" required>
                                        @foreach ($tracks as $track)
                                        <option value="{{ $track->id }}"{{ old('track_id') == $track->id ? ' selected' : '' }}>{{ $track->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('track'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('track') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
