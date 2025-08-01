@extends('layouts.app')

@section('template_title')
    {{ $article->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Article') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/articles') }}">{{ __('Article') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/articles') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Steps:</strong>
                            {{ $article->steps }}
                        </div>
                        <div class="form-group">
                            <strong>Udk:</strong>
                            {{ $article->udk }}
                        </div>
                        <div class="form-group">
                            <strong>File Path:</strong>
                            {{ $article->file_path }}
                        </div>
                        <div class="form-group">
                            <strong>Journal Id:</strong>
                            {{ $article->journal_id }}
                        </div>
                        <div class="form-group">
                            <strong>Magazine Issue Id:</strong>
                            {{ $article->magazine_issue_id }}
                        </div>
                        <div class="form-group">
                            <strong>Sort Id:</strong>
                            {{ $article->sort_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created By:</strong>
                            {{ $article->created_by }}
                        </div>
                        <div class="form-group">
                            <strong>Updated By:</strong>
                            {{ $article->updated_by }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
