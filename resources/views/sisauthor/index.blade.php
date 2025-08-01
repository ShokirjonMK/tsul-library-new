@extends('layouts.app')

@section('template_title')
    {{ __('My applications') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('My applications') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Articles') }}
            </p>
        </div>
        <div>
            <a href="{{ route('udcs.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create article') }}  
            </a>
        </div>
    </div>
   
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
