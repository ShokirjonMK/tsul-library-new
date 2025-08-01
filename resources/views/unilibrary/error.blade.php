@extends('layouts.app')

@section('template_title')
    {{ __('Unilibrary') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Unilibrary') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/unilibrary') }}">{{ __('Unilibrary') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ $book->title ?? __('Show') }}

                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                        <div class="card-body">
                            <span class="text text-danger">
                                {{$error}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
