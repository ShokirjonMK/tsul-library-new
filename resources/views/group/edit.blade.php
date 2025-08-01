@extends('layouts.app')

@section('template_title')
    {{ __('Update') }}
@endsection

@section('content')
<div class="content">

    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Groups') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/groups') }}">{{ __('Groups') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Update') }}
            </p>
        </div>
        <div>
            <a href="{{ url(app()->getLocale() . '/admin/groups') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    <livewire:admin.crud.group :group_id="$group->id" />

    {{-- @includeif('partials.errors')
    <form method="POST" action="{{ route('groups.update', [app()->getLocale(), $group->id]) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf

        @include('group.form')

    </form>  --}}

</div>

@endsection
