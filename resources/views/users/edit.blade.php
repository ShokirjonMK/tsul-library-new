@extends('layouts.app')
@section('template_title')
    {{ __('Update') }}
@endsection

@section('content')
<div class="content">

    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Users') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Update') }}
            </p>
        </div>
        <div>
            <a href="{{ url(app()->getLocale() . '/admin/users') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    <livewire:admin.users.usercu :user_id="$user->id"/>

    {{-- @includeif('partials.errors')
    <form method="POST" action="{{ route('users.update', [app()->getLocale(), $user->id]) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf

        @include('users.form')

    </form>  --}}

</div> 

@endsection