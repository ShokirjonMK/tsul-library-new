@extends('layouts.app')

@section('template_title')
    {{ $resource->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Resource') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/resources') }}">{{ __('Resource') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/resources') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $resource->title }}
                        </div>
                        <div class="form-group">
                            <strong>Authors:</strong>
                            {{ $resource->authors }}
                        </div>
                        <div class="form-group">
                            <strong>Type Id:</strong>
                            {{ $resource->type_id }}
                        </div>
                        <div class="form-group">
                            <strong>Publisher Id:</strong>
                            {{ $resource->publisher_id }}
                        </div>
                        <div class="form-group">
                            <strong>Published Year:</strong>
                            {{ $resource->published_year }}
                        </div>
                        <div class="form-group">
                            <strong>Published City:</strong>
                            {{ $resource->published_city }}
                        </div>
                        <div class="form-group">
                            <strong>Copies:</strong>
                            {{ $resource->copies }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $resource->price }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $resource->status }}
                        </div>
                        <div class="form-group">
                            <strong>{{__('Consignment Note')}}:</strong>
                            {{ $resource->consignment_note }}
                        </div>
                        <div class="form-group">
                            <strong>{{__('Act Number')}}:</strong>
                            {{ $resource->act_number }}
                        </div>
                        <div class="form-group">
                            <strong>Ksu:</strong>
                            {{ $resource->ksu }}
                        </div>
                        <div class="form-group">
                            <strong>Who Id:</strong>
                            {{ $resource->who_id }}
                        </div>
                        <div class="form-group">
                            <strong>Basic Id:</strong>
                            {{ $resource->basic_id }}
                        </div>
                        <div class="form-group">
                            <strong>Organization Id:</strong>
                            {{ $resource->organization_id }}
                        </div>
                        <div class="form-group">
                            <strong>Branch Id:</strong>
                            {{ $resource->branch_id }}
                        </div>
                        <div class="form-group">
                            <strong>Deportmetn Id:</strong>
                            {{ $resource->deportmetn_id }}
                        </div>
                        <div class="form-group">
                            <strong>Comment:</strong>
                            {{ $resource->comment }}
                        </div>
                        <div class="form-group">
                            <strong>Extra1:</strong>
                            {{ $resource->extra1 }}
                        </div>
                        <div class="form-group">
                            <strong>Extra2:</strong>
                            {{ $resource->extra2 }}
                        </div>
                        <div class="form-group">
                            <strong>Extra3:</strong>
                            {{ $resource->extra3 }}
                        </div>
                        <div class="form-group">
                            <strong>Extra4:</strong>
                            {{ $resource->extra4 }}
                        </div>
                        <div class="form-group">
                            <strong>Created By:</strong>
                            {{ $resource->created_by }}
                        </div>
                        <div class="form-group">
                            <strong>Updated By:</strong>
                            {{ $resource->updated_by }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
