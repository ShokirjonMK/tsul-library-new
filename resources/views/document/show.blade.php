@extends('layouts.app')

@section('template_title')
    {{ $document->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Document') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/documents') }}">{{ __('Document') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/documents') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div> 
    </div>
    @include('document.detail', ['document'=>$document])
 
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body"> 
                        <livewire:admin.documents.crud-documents :document_id="$document->id" />
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> 
@endsection
