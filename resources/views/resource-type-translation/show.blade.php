@extends('layouts.app')

@section('template_title')
    {{ $resourceTypeTranslation->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Resource Type Translation') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/resource-type-translations') }}">{{ __('Resource Type Translation') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/resource-type-translations') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Locale:</strong>
                            {{ $resourceTypeTranslation->locale }}
                        </div>
                        <div class="form-group">
                            <strong>Resource Type Id:</strong>
                            {{ $resourceTypeTranslation->resource_type_id }}
                        </div>
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $resourceTypeTranslation->title }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $resourceTypeTranslation->slug }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
