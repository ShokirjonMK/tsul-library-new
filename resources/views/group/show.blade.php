@extends('layouts.app')

@section('template_title')
    {{ $group->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Groups') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/groups') }}">{{ __('Groups') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/groups') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $group->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('Organization') }}:</strong>
                            {!! $group->organization ? $group->organization->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Branch') }}:</strong>
                            {!! $group->branch ? $group->branch->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Faculty') }}:</strong>
                            {!! $group->faculty ? $group->faculty->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Chair') }}:</strong>
                            {!! $group->chair ? $group->chair->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $group->title }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('HEMIS Code') }}:</strong>
                            {{ $group->code }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $group->created_by ? $group->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $group->updated_by ? $group->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $group->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $group->updated_at  }}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
