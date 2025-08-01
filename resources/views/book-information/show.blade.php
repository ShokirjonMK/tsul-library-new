@extends('layouts.app')

@section('template_title')
    {{ $bookInformation->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Book Information') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/book-informations') }}">{{ __('Book Information') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/book-informations') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Isactive:</strong>
                            {{ $bookInformation->isActive }}
                        </div>
                        <div class="form-group">
                            <strong>Summarka Raqam:</strong>
                            {{ $bookInformation->summarka_raqam }}
                        </div>
                        <div class="form-group">
                            <strong>Arrived Year:</strong>
                            {{ $bookInformation->arrived_year }}
                        </div>
                        <div class="form-group">
                            <strong>Kutubxonada Bor:</strong>
                            {{ $bookInformation->kutubxonada_bor }}
                        </div>
                        <div class="form-group">
                            <strong>Elektronni Bor:</strong>
                            {{ $bookInformation->elektronni_bor }}
                        </div>
                        <div class="form-group">
                            <strong>Branch Id:</strong>
                            {{ $bookInformation->branch_id }}
                        </div>
                        <div class="form-group">
                            <strong>Deportmetn Id:</strong>
                            {{ $bookInformation->deportmetn_id }}
                        </div>
                        
                        <div class="form-group">
                            <strong>Book Id:</strong>
                            {{ $bookInformation->book_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created By:</strong>
                            {{ $bookInformation->created_by }}
                        </div>
                        <div class="form-group">
                            <strong>Updated By:</strong>
                            {{ $bookInformation->updated_by }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
