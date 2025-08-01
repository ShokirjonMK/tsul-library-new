@extends('layouts.app')

@section('template_title')
    {{ __('Update') }}
@endsection

@section('content')
<div class="content">

    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Book Language') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/book-languages') }}">{{ __('Book Language') }}</a></span>

                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Update') }}
            </p>
        </div>
        <div>
            <a href="{{ url(app()->getLocale() . '/admin/book-languages') }}"  class="btn btn-primary" >{{ __('Back') }}</a> 
        </div>
    </div>

    @includeif('partials.errors')
    <form method="POST" action="{{ route('book-languages.update', [app()->getLocale(), $bookLanguage->id]) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf

        @include('book-language.form')

    </form> 

</div>

@endsection
