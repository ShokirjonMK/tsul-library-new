@extends('layouts.app')

@section('template_title')
    {{ $organization->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Organization') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/organizations') }}">{{ __('Organization') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $organization->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/organizations') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $organization->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $organization->title }}
                        </div> 
                        <div class="form-group">
                            <strong>{{ __('Address') }}:</strong>
                            {{ $organization->address }}
                        </div> 
                        <div class="form-group">
                            <strong>{{ __('Image') }}:</strong>
                            @if ($organization->image_path)
                                <img src="{{ asset('/storage/organizations/photo/' . $organization->image_path) }}"
                                    width="100px">
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $organization->created_by ? $organization->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $organization->updated_by ? $organization->updatedBy->name : '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
