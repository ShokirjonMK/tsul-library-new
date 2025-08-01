@extends('layouts.app')

@section('template_title')
    {{ $subjectGroupTranslation->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Subject Group Translation') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/subject-group-translations') }}">{{ __('Subject Group Translation') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url()->previous() }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Locale:</strong>
                            {{ $subjectGroupTranslation->locale }}
                        </div>
                        <div class="form-group">
                            <strong>Subject Group Id:</strong>
                            {{ $subjectGroupTranslation->subject_group_id }}
                        </div>
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $subjectGroupTranslation->title }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $subjectGroupTranslation->slug }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
