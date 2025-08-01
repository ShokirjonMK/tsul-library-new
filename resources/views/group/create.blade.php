@extends('layouts.app')

@section('template_title')
    {{ __('Create') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Groups') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/groups') }}">{{ __('Groups') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Create') }}
            </p>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ url(app()->getLocale() . '/admin/groups') }}">
                {{ __('Back') }}</a>
        </div>
    </div> 
    @includeif('partials.errors')
    <livewire:admin.crud.group :group_id="null" />

    {{-- <form method="POST" action="{{ route('groups.store', app()->getLocale()) }}"  role="form" enctype="multipart/form-data">
        @csrf

        @include('group.form')

    </form> --}}
</div>            
@endsection
