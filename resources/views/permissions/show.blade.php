@extends('layouts.app')

@section('template_title')
    {{ $permission->name ?? __('Show') }}
@endsection

@section('content')
<div class="container">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Permissions') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a
                        href="{{ url(app()->getLocale() . '/admin/permissions') }}">{{ __('Permissions') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $permission->title ?? __('Show') }}
            </p>
        </div>
        <div>
            <a href="{{ url(app()->getLocale() . '/admin/permissions') }}" class="btn btn-primary">{{ __('Back') }}</a>
        </div>
    </div>

    <div class="justify-content-center">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <strong>{{ __('Title') }}:</strong>
                                {{ $permission->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection