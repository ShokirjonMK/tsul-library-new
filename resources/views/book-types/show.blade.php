@extends('layouts.app')

@section('template_title')
    {{ $booksType->name ?? __('Show') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Books Type') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span><a href="{{ route('book-types.index', app()->getLocale()) }}">{{ __('Books Type') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
                </p>
            </div>
            <div>
                <a class="btn btn-primary float-right" href="{{ route('book-types.index', app()->getLocale()) }}">
                    {{ __('Back') }}</a> 
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                    <div class="card-body">
                    
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $booksType->title }}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $booksType->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Image') }}:</strong>
                            @if ($booksType->image_path)
                                <img src="{{ asset('/storage/booksTypes/photo/' . $booksType->image_path) }}"
                                    width="100px">
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $booksType->created_by ? $booksType->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $booksType->updated_by ? $booksType->updatedBy->name : '' !!}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $booksType->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $booksType->updated_at  }}
                        </div>

                    </div>
                    </div>
                    
                </div>
            </div>
        </div>        
         

    </div>
@endsection
