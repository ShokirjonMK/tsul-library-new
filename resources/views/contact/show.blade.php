@extends('layouts.app')

@section('template_title')
    {{ $contact->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Contact') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/contacts') }}">{{ __('Contact') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/contacts') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>{{ __('Code') }}:</strong>
                            {{ $contact->code }}
                        </div> 

                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $contact->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $contact->title }}
                        </div> 
                        <div class="form-group">
                            <strong>{{ __('Address') }}:</strong>
                            {{ $contact->street_address }}
                        </div> 
                        
                        <div class="form-group">
                            <strong>{{ __('Logo') }}:</strong>
                            @if ($contact->logo)
                                <img src="{{ asset('/storage/contacts/logo/' . $contact->logo) }}"
                                    width="100px">
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Email') }}:</strong>
                            {{ $contact->email }}
                        </div>
                         
                        <div class="form-group">
                            <strong>{{ __('Phone') }}:</strong>
                            {{ $contact->phone }}
                        </div>
                        
                        <div class="form-group">
                            <strong>{{ __('Fax') }}:</strong>
                            {{ $contact->fax }}
                        </div>
                         
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $contact->created_by ? $contact->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $contact->updated_by ? $contact->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $contact->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $contact->updated_at  }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
