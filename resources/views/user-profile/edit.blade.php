@extends('layouts.app')

@section('template_title')
    {{ __('Update') }}
@endsection

@section('content')
<div class="content">

    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('User Profile') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/user-profiles') }}">{{ __('User Profile') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Update') }}
            </p>
        </div>
        <div>
            <a href="{{ url(app()->getLocale() . '/admin/user-profiles') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>

    @includeif('partials.errors')
    <form method="POST" action="{{ route('user-profiles.update', [app()->getLocale(), $userProfile->id]) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf

        @include('user-profile.form')

    </form> 

</div>

@endsection
