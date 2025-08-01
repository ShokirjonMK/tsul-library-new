@extends('layouts.app')

@section('template_title')
    {{ $scientificPublicationTranslation->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Scientific Publication Translation') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/scientific-publication-translations') }}">{{ __('Scientific Publication Translation') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/scientific-publication-translations') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Locale:</strong>
                            {{ $scientificPublicationTranslation->locale }}
                        </div>
                        <div class="form-group">
                            <strong>Scientific Publication Id:</strong>
                            {{ $scientificPublicationTranslation->scientific_publication_id }}
                        </div>
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $scientificPublicationTranslation->title }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $scientificPublicationTranslation->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Sub Title:</strong>
                            {{ $scientificPublicationTranslation->sub_title }}
                        </div>
                        <div class="form-group">
                            <strong>Country:</strong>
                            {{ $scientificPublicationTranslation->country }}
                        </div>
                        <div class="form-group">
                            <strong>Inst Nome Address:</strong>
                            {{ $scientificPublicationTranslation->inst_nome_address }}
                        </div>
                        <div class="form-group">
                            <strong>Authors:</strong>
                            {{ $scientificPublicationTranslation->authors }}
                        </div>
                        <div class="form-group">
                            <strong>Keywords:</strong>
                            {{ $scientificPublicationTranslation->keywords }}
                        </div>
                        <div class="form-group">
                            <strong>Place Protection:</strong>
                            {{ $scientificPublicationTranslation->place_protection }}
                        </div>
                        <div class="form-group">
                            <strong>Content:</strong>
                            {{ $scientificPublicationTranslation->content }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $scientificPublicationTranslation->description }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
