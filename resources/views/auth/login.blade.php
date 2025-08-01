@extends('layouts.auth')

@section('content')
    <div class="container d-flex align-items-center justify-content-center form-height-login pt-24px pb-24px">

        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="ec-brand">
                            <a href="/" title="AKBT">
                                <img class="ec-brand-icon" src="/logo.png" alt="" />
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-5">
                        <h4 class="text-dark mb-5"> {{ __('Login') }}</h4>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="col-12">

                            <ul class="nav nav-tabs" id="myRatingTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="product-detail-tab" data-bs-toggle="tab"
                                        data-bs-target="#login" href="#login" role="tab" aria-selected="true">
                                        <i class="mdi mdi-library-books mr-1"></i> {{ __('Login') }} </a>
                                </li>

                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="product-information-tab" data-bs-toggle="tab"
                                        data-bs-target="#hemisLogin" href="#hemisLogin" role="tab"
                                        aria-selected="false">
                                        <i class="mdi mdi-information mr-1"></i>HEMIS bn kirish</a>
                                </li> --}}


                            </ul>
                            <div class="tab-content" id="myTabContent2">
                                <div class="tab-pane pt-3 fade show active" id="login" role="tabpanel">

                                    <form method="POST" action="{{ route('login', app()->getLocale()) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12 mb-4">
                                                <label for="login"
                                                    class="col-md-4 col-form-label text-md-start">{{ __('Login') }}</label>
                                                <input id="login" type="text"
                                                    class="form-control @error('login') is-invalid @enderror" name="login"
                                                    value="{{ old('login') }}" required autocomplete="login" autofocus
                                                    placeholder="{{ __('Login') }}">
                                                @error('login')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="password"
                                                    class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password"
                                                    placeholder="{{ __('Password') }}">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-flex my-2 justify-content-between">
                                                    <div class="d-inline-block mr-3">
                                                        <div class="control control-checkbox">
                                                            <label class="form-check-label" for="remember">
                                                                {{ __('Remember Me') }}
                                                            </label>
                                                            <input class="form-check-input" type="checkbox" name="remember"
                                                                id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            <div class="control-indicator"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                                    {{ __('Login') }}
                                                </button>
                                                @if (Route::has('register'))
                                                    <p class="sign-upp">
                                                        {{ __("Don't have an account yet?") }}
                                                        <a class="text-blue"
                                                            href="{{ url(app()->getLocale() . '/register') }}">
                                                            {{ __('Sign Up') }}
                                                        </a>
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane pt-3 fade" id="hemisLogin" role="tabpanel">
                                    <form method="POST" action="{{ route('loginHemis', app()->getLocale()) }}">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12 mb-4">
                                                <label for="student_id"
                                                    class="col-md-4 col-form-label text-md-start">{{ __('Student ID') }}</label>
                                                <input id="student_id" type="text"
                                                    class="form-control @error('student_id') is-invalid @enderror" name="student_id"
                                                    value="{{ old('student_id') }}" required autocomplete="login" autofocus
                                                    placeholder="{{ __('Student ID') }}">
                                                @error('student_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="password"
                                                    class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password"
                                                    placeholder="{{ __('Password') }}">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-flex my-2 justify-content-between">
                                                    <div class="d-inline-block mr-3">
                                                        <div class="control control-checkbox">
                                                            <label class="form-check-label" for="remember">
                                                                {{ __('Remember Me') }}
                                                            </label>
                                                            <input class="form-check-input" type="checkbox"
                                                                name="remember" id="remember"
                                                                {{ old('remember') ? 'checked' : '' }}>
                                                            <div class="control-indicator"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                                    {{ __('Login') }}
                                                </button>
                                                 
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
