@extends('layouts.app')

@section('template_title')
    {{ $department->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Department') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/departments') }}">{{ __('Department') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/departments') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $department->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                         
                        <div class="form-group">
                            <strong>{{ __('Organization') }}:</strong>
                            {!! $department->organization ? $department->organization->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Branch') }}:</strong>
                            {!! $department->branch ? $department->branch->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $department->title }}
                        </div>
                        
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $department->created_by ? $department->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $department->updated_by ? $department->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $department->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $department->updated_at  }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
