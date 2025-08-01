@extends('layouts.app')

@section('template_title')
    {{ $bookInventar->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Book Inventar') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/book-inventars') }}">{{ __('Book Inventar') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/book-inventars') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Isactive:</strong>
                            {{ $bookInventar->isActive }}
                        </div>
                        <div class="form-group">
                            <strong>Comment:</strong>
                            {{ $bookInventar->comment }}
                        </div>
                        <div class="form-group">
                            <strong>Inventar Number:</strong>
                            {{ $bookInventar->inventar_number }}
                        </div>
                        <div class="form-group">
                            <strong>Book Id:</strong>
                            {{ $bookInventar->book_id }}
                        </div>
                        <div class="form-group">
                            <strong>Book Information Id:</strong>
                            {{ $bookInventar->book_information_id }}
                        </div>
                        <div class="form-group">
                            <strong>Branch Id:</strong>
                            {{ $bookInventar->branch_id }}
                        </div>
                        <div class="form-group">
                            <strong>Deportmetn Id:</strong>
                            {{ $bookInventar->deportmetn_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created By:</strong>
                            {{ $bookInventar->created_by }}
                        </div>
                        <div class="form-group">
                            <strong>Updated By:</strong>
                            {{ $bookInventar->updated_by }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
