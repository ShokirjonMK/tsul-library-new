@extends('layouts.app')

@section('template_title')
    {{ $referenceGender->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ $booksType->title ?? __('Show') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/reference-genders') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $referenceGender->title }}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $referenceGender->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $referenceGender->created_by ? $referenceGender->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $referenceGender->updated_by ? $referenceGender->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $referenceGender->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $referenceGender->updated_at  }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
