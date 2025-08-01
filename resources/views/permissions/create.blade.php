@extends('layouts.app')

@section('template_title')
    {{ __('Permissions') }}
@endsection


@section('content')

    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Permissions') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/permissions') }}">{{ __('Permissions') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Create') }}
                </p>
            </div>
            <div>
                <a class="btn btn-primary" href="{{ url(app()->getLocale() . '/admin/permissions') }}">
                    {{ __('Back') }}</a>
            </div>
        </div>
        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('permissions.store', app()->getLocale()) }}" role="form"
                enctype="multipart/form-data">
                @csrf
                @include('permissions.form')
            </form>
        </div>
    </div>
@endsection
