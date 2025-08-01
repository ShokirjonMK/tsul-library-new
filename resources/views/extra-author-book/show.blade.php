@extends('layouts.app')

@section('template_title')
    {{ $extraAuthorBook->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Extra Author Book') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/extra-author-books') }}">{{ __('Extra Author Book') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/extra-author-books') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Extra Author Id:</strong>
                            {{ $extraAuthorBook->extra_author_id }}
                        </div>
                        <div class="form-group">
                            <strong>Book Id:</strong>
                            {{ $extraAuthorBook->book_id }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $extraAuthorBook->name }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $extraAuthorBook->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Extra1:</strong>
                            {{ $extraAuthorBook->extra1 }}
                        </div>
                        <div class="form-group">
                            <strong>Extra2:</strong>
                            {{ $extraAuthorBook->extra2 }}
                        </div>
                        <div class="form-group">
                            <strong>Extra3:</strong>
                            {{ $extraAuthorBook->extra3 }}
                        </div>
                        <div class="form-group">
                            <strong>Created By:</strong>
                            {{ $extraAuthorBook->created_by }}
                        </div>
                        <div class="form-group">
                            <strong>Updated By:</strong>
                            {{ $extraAuthorBook->updated_by }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
