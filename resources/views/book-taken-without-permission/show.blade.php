@extends('layouts.app')

@section('template_title')
    {{ $bookTakenWithoutPermission->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Book Taken Without Permission') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/book-taken-without-permissions') }}">{{ __('Book Taken Without Permission') }}</a></span>
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
                            <strong>Status:</strong>
                            {{ $bookTakenWithoutPermission->status }}
                        </div>
                        <div class="form-group">
                            <strong>Bar Code:</strong>
                            {{ $bookTakenWithoutPermission->bar_code }}
                        </div>
                        <div class="form-group">
                            <strong>Rfid Tag Id:</strong>
                            {{ $bookTakenWithoutPermission->rfid_tag_id }}
                        </div>
                        <div class="form-group">
                            <strong>Comment:</strong>
                            {{ $bookTakenWithoutPermission->comment }}
                        </div>
                        <div class="form-group">
                            <strong>Book Id:</strong>
                            {{ $bookTakenWithoutPermission->book_id }}
                        </div>
                        <div class="form-group">
                            <strong>Book Information Id:</strong>
                            {{ $bookTakenWithoutPermission->book_information_id }}
                        </div>
                        <div class="form-group">
                            <strong>Book Inventar Id:</strong>
                            {{ $bookTakenWithoutPermission->book_inventar_id }}
                        </div>
                        <div class="form-group">
                            <strong>Organization Id:</strong>
                            {{ $bookTakenWithoutPermission->organization_id }}
                        </div>
                        <div class="form-group">
                            <strong>Branch Id:</strong>
                            {{ $bookTakenWithoutPermission->branch_id }}
                        </div>
                        <div class="form-group">
                            <strong>Deportmetn Id:</strong>
                            {{ $bookTakenWithoutPermission->deportmetn_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
