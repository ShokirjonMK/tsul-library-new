@extends('layouts.app')

@section('template_title')
    {{ $contactTranslation->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Contact Translation') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/contact-translations') }}">{{ __('Contact Translation') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/contact-translations') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Locale:</strong>
                            {{ $contactTranslation->locale }}
                        </div>
                        <div class="form-group">
                            <strong>Contact Id:</strong>
                            {{ $contactTranslation->contact_id }}
                        </div>
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $contactTranslation->title }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $contactTranslation->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Site Name:</strong>
                            {{ $contactTranslation->site_name }}
                        </div>
                        <div class="form-group">
                            <strong>Site Name2:</strong>
                            {{ $contactTranslation->site_name2 }}
                        </div>
                        <div class="form-group">
                            <strong>Footer Menu:</strong>
                            {{ $contactTranslation->footer_menu }}
                        </div>
                        <div class="form-group">
                            <strong>Footer Info:</strong>
                            {{ $contactTranslation->footer_info }}
                        </div>
                        <div class="form-group">
                            <strong>Contacts Info:</strong>
                            {{ $contactTranslation->contacts_info }}
                        </div>
                        <div class="form-group">
                            <strong>Home Description:</strong>
                            {{ $contactTranslation->home_description }}
                        </div>
                        <div class="form-group">
                            <strong>Footer Description:</strong>
                            {{ $contactTranslation->footer_description }}
                        </div>
                        <div class="form-group">
                            <strong>Address Locality:</strong>
                            {{ $contactTranslation->address_locality }}
                        </div>
                        <div class="form-group">
                            <strong>Street Address:</strong>
                            {{ $contactTranslation->street_address }}
                        </div>
                        <div class="form-group">
                            <strong>Street Address2:</strong>
                            {{ $contactTranslation->street_address2 }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $contactTranslation->description }}
                        </div>
                        <div class="form-group">
                            <strong>Body:</strong>
                            {{ $contactTranslation->body }}
                        </div>
                        <div class="form-group">
                            <strong>Extra1:</strong>
                            {{ $contactTranslation->extra1 }}
                        </div>
                        <div class="form-group">
                            <strong>Extra2:</strong>
                            {{ $contactTranslation->extra2 }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
