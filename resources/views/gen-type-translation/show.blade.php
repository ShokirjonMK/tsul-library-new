@extends('layouts.app')

@section('template_title')
    {{ $genTypeTranslation->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Gen Type Translation') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/gen-type-translations') }}">{{ __('Gen Type Translation') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/gen-type-translations') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Locale:</strong>
                            {{ $genTypeTranslation->locale }}
                        </div>
                        <div class="form-group">
                            <strong>Gen Type Id:</strong>
                            {{ $genTypeTranslation->gen_type_id }}
                        </div>
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $genTypeTranslation->title }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $genTypeTranslation->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Content:</strong>
                            {{ $genTypeTranslation->content }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
