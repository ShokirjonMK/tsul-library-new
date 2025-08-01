@extends('layouts.app')

@section('template_title')
    {{ $scientificPublication->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Scientific Publication') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/scientific-publications') }}">{{ __('Scientific Publication') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/scientific-publications') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Steps:</strong>
                            {{ $scientificPublication->steps }}
                        </div>
                        <div class="form-group">
                            <strong>Copies:</strong>
                            {{ $scientificPublication->copies }}
                        </div>
                        <div class="form-group">
                            <strong>Key:</strong>
                            {{ $scientificPublication->key }}
                        </div>
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $scientificPublication->code }}
                        </div>
                        <div class="form-group">
                            <strong>Publication Year:</strong>
                            {{ $scientificPublication->publication_year }}
                        </div>
                        <div class="form-group">
                            <strong>Page Number:</strong>
                            {{ $scientificPublication->page_number }}
                        </div>
                        <div class="form-group">
                            <strong>Permission:</strong>
                            {{ $scientificPublication->permission }}
                        </div>
                        <div class="form-group">
                            <strong>Barcode Key:</strong>
                            {{ $scientificPublication->barcode_key }}
                        </div>
                        <div class="form-group">
                            <strong>Barcode:</strong>
                            {{ $scientificPublication->barcode }}
                        </div>
                        <div class="form-group">
                            <strong>Inventar Number:</strong>
                            {{ $scientificPublication->inventar_number }}
                        </div>
                        <div class="form-group">
                            <strong>Isactive:</strong>
                            {{ $scientificPublication->isActive }}
                        </div>
                        <div class="form-group">
                            <strong>Image Path:</strong>
                            {{ $scientificPublication->image_path }}
                        </div>
                        <div class="form-group">
                            <strong>File Path:</strong>
                            {{ $scientificPublication->file_path }}
                        </div>
                        <div class="form-group">
                            <strong>Journal Id:</strong>
                            {{ $scientificPublication->journal_id }}
                        </div>
                        <div class="form-group">
                            <strong>Magazine Issue Id:</strong>
                            {{ $scientificPublication->magazine_issue_id }}
                        </div>
                        <div class="form-group">
                            <strong>Res Lang Id:</strong>
                            {{ $scientificPublication->res_lang_id }}
                        </div>
                        <div class="form-group">
                            <strong>Res Type Id:</strong>
                            {{ $scientificPublication->res_type_id }}
                        </div>
                        <div class="form-group">
                            <strong>Res Field Id:</strong>
                            {{ $scientificPublication->res_field_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created By:</strong>
                            {{ $scientificPublication->created_by }}
                        </div>
                        <div class="form-group">
                            <strong>Updated By:</strong>
                            {{ $scientificPublication->updated_by }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
