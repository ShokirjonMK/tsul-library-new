@extends('layouts.app')

@section('template_title')
    {{ $import->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Import') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/imports') }}">{{ __('Import') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/imports') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $import->title }}
                        </div>
                        <div class="form-group">
                            <strong>Authors:</strong>
                            {{ $import->authors }}
                        </div>
                        <div class="form-group">
                            <strong>Udk:</strong>
                            {{ $import->UDK }}
                        </div>
                        <div class="form-group">
                            <strong>Bbk:</strong>
                            {{ $import->BBK }}
                        </div>
                        <div class="form-group">
                            <strong>Publisher:</strong>
                            {{ $import->publisher }}
                        </div>
                        <div class="form-group">
                            <strong>Published City:</strong>
                            {{ $import->published_city }}
                        </div>
                        <div class="form-group">
                            <strong>Published Year:</strong>
                            {{ $import->published_year }}
                        </div>
                        <div class="form-group">
                            <strong>Isbn:</strong>
                            {{ $import->ISBN }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $import->description }}
                        </div>
                        <div class="form-group">
                            <strong>Published Date:</strong>
                            {{ $import->published_date }}
                        </div>
                        <div class="form-group">
                            <strong>Authors Mark:</strong>
                            {{ $import->authors_mark }}
                        </div>
                        <div class="form-group">
                            <strong>From What System:</strong>
                            {{ $import->from_what_system }}
                        </div>
                        <div class="form-group">
                            <strong>Betlar Soni:</strong>
                            {{ $import->betlar_soni }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $import->price }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $import->status }}
                        </div>
                        <div class="form-group">
                            <strong>Extra1:</strong>
                            {{ $import->extra1 }}
                        </div>
                        <div class="form-group">
                            <strong>Extra2:</strong>
                            {{ $import->extra2 }}
                        </div>
                        <div class="form-group">
                            <strong>Extra3:</strong>
                            {{ $import->extra3 }}
                        </div>
                        <div class="form-group">
                            <strong>Extra4:</strong>
                            {{ $import->extra4 }}
                        </div>
                        <div class="form-group">
                            <strong>Created By:</strong>
                            {{ $import->created_by }}
                        </div>
                        <div class="form-group">
                            <strong>Updated By:</strong>
                            {{ $import->updated_by }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
