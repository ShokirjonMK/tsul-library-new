@extends('layouts.app')

@section('template_title')
    {{ $extraAuthor->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Extra Author') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/extra-authors') }}">{{ __('Extra Author') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/extra-authors') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $extraAuthor->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                         
                        <div class="form-group">
                            <strong>{{ __('Organization') }}:</strong>
                            {!! $extraAuthor->organization_id ? $extraAuthor->organization->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Branch') }}:</strong>
                            {!! $extraAuthor->branch_id ? $extraAuthor->branch->title : '' !!}
                        </div>
                        
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $extraAuthor->title }}
                        </div>
                        
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $extraAuthor->created_by ? $extraAuthor->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $extraAuthor->updated_by ? $extraAuthor->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $extraAuthor->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $extraAuthor->updated_at  }}
                        </div>
                         

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
