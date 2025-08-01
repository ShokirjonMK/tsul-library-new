@extends('layouts.app')

@section('template_title')
    {{ $resourceType->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Resource Field') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/res-field') }}">{{ __('Resource Field') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $resourceType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/res-field') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $resourceType->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $resourceType->title }}
                        </div>
                         
                        {{-- <div class="form-group">
                            <strong>{{ __('Image') }}:</strong>
                            @if ($resourceType->image_path)
                                <img src="{{ asset('/storage/resourceTypes/photo/' . $resourceType->image_path) }}"
                                    width="100px">
                            @endif
                        </div> --}}
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $resourceType->created_by ? $resourceType->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $resourceType->updated_by ? $resourceType->updatedBy->name : '' !!}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $resourceType->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $resourceType->updated_at  }}
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
