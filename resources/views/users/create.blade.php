@extends('layouts.app')

@section('template_title')
    {{ __('Create') }}
@endsection

@section('content')

<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Users') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Create') }}
            </p>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ url(app()->getLocale() . '/admin/users') }}">
                {{ __('Back') }}</a>
        </div>
    </div> 
    <livewire:admin.users.usercu :user_id="null"/>
    {{-- @includeif('partials.errors')
    
    <form method="POST" action="{{ route('users.store', app()->getLocale()) }}"  role="form" enctype="multipart/form-data">
        @csrf
        @include('users.form')
    </form> --}}
</div>      
 

@endsection