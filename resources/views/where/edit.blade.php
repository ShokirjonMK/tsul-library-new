@extends('layouts.app')

@section('template_title')
    {{ __('Update') }}
@endsection

@section('content')
<div class="content">

    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Where') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/wheres') }}">{{ __('Where') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Update') }}
            </p>
        </div>
        <div>
            <a href="{{ url(app()->getLocale() . '/admin/wheres') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>

    @includeif('partials.errors')
    <form method="POST" action="{{ route('wheres.update', [app()->getLocale(), $where->id]) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf

        @include('where.form')

    </form> 

</div>

@endsection
