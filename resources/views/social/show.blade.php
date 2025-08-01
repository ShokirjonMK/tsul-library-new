@extends('layouts.app')

@section('template_title')
    {{ $social->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Social') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/socials') }}">{{ __('Social') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/socials') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        
                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $social->isActive == 1
                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Link') }} | {{ __('Title') }}:</strong>
                            <a href="{{ $social->link }}" target="__blank">{{ $social->title }}</a> 
                        </div>
                        
                        <div class="form-group">
                            <strong>Fa Icon Class:</strong>
                            {{ $social->fa_icon_class }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Ismain') }}:</strong>
                            {!! $social->isMain == 1
                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Procedure') }}:</strong>
                            {{ $social->order }}
                        </div>
                         
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $social->created_by ? $social->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $social->updated_by ? $social->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $social->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $social->updated_at  }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
