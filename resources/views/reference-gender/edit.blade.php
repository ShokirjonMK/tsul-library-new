@extends('layouts.app')

@section('template_title')
    {{ __('Update') }}
@endsection

@section('content')
<div class="content">

    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Reference Gender') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Update') }}
            </p>
        </div>
        <div>
            <a href="{{ url(app()->getLocale() . '/admin/reference-genders') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>

    @includeif('partials.errors')
    <form method="POST" action="{{ route('reference-genders.update', [app()->getLocale(), $referenceGender->id]) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf

        @include('reference-gender.form')

    </form> 

</div>

@endsection
