@extends('layouts.app')

@section('template_title')
    {{ $faculty->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Faculty') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/faculties') }}">{{ __('Faculty') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/faculties') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $faculty->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                         
                        <div class="form-group">
                            <strong>{{ __('Organization') }}:</strong>
                            {!! $faculty->organization ? $faculty->organization->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Branch') }}:</strong>
                            {!! $faculty->branch ? $faculty->branch->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $faculty->title }}
                        </div>
                        
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $faculty->created_by ? $faculty->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $faculty->updated_by ? $faculty->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $faculty->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $faculty->updated_at  }}
                        </div>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
