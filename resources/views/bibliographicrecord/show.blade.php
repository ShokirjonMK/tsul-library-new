@extends('layouts.app')

@section('template_title')
    {{ $bibliographicrecord->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Bibliographicrecord') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/bibliographicrecords') }}">{{ __('Bibliographicrecord') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/bibliographicrecords') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Record:</strong>
                            {{ $bibliographicrecord->record }}
                        </div>
                        <div class="form-group">
                            <strong>Workpage:</strong>
                            {{ $bibliographicrecord->workPage }}
                        </div>
                        <div class="form-group">
                            <strong>Countof:</strong>
                            {{ $bibliographicrecord->countOf }}
                        </div>
                        <div class="form-group">
                            <strong>Purrentid:</strong>
                            {{ $bibliographicrecord->purrentID }}
                        </div>
                        <div class="form-group">
                            <strong>Filename:</strong>
                            {{ $bibliographicrecord->fileName }}
                        </div>
                        <div class="form-group">
                            <strong>Filesiize:</strong>
                            {{ $bibliographicrecord->fileSiize }}
                        </div>
                        <div class="form-group">
                            <strong>Creator:</strong>
                            {{ $bibliographicrecord->creator }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $bibliographicrecord->status }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
