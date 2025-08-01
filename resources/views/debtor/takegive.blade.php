@extends('layouts.app')

@section('template_title')
    {{ __('Takegive') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Takegive') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Takegive') }}
            </p>
        </div>
    </div>
    <livewire:admin.qarzdorlar.kitob-olish-berish />
</div>
@endsection
