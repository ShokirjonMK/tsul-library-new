@extends('layouts.app')

@section('template_title')
    {{ $genType->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Gen Type') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/gen-types') }}">{{ __('Gen Type') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/gen-types') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                            
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $genType->title }}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('Key') }}:</strong>
                            {{ $genType->code }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $genType->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $genType->created_by ? $genType->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $genType->updated_by ? $genType->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $genType->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $genType->updated_at  }}
                        </div>
                        

                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
