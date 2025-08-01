@extends('layouts.app')

@section('template_title')
    {{ $userProfile->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('User Profile') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/user-profiles') }}">{{ __('User Profile') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/user-profiles') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Phone Number:</strong>
                            {{ $userProfile->phone_number }}
                        </div>
                        <div class="form-group">
                            <strong>Pnf Code:</strong>
                            {{ $userProfile->pnf_code }}
                        </div>
                        <div class="form-group">
                            <strong>Passport Seria Number:</strong>
                            {{ $userProfile->passport_seria_number }}
                        </div>
                        <div class="form-group">
                            <strong>Passport Copy:</strong>
                            {{ $userProfile->passport_copy }}
                        </div>
                        <div class="form-group">
                            <strong>Image:</strong>
                            {{ $userProfile->image }}
                        </div>
                        <div class="form-group">
                            <strong>Date Of Birth:</strong>
                            {{ $userProfile->date_of_birth }}
                        </div>
                        <div class="form-group">
                            <strong>Kursi:</strong>
                            {{ $userProfile->kursi }}
                        </div>
                        <div class="form-group">
                            <strong>Gender Id:</strong>
                            {{ $userProfile->gender_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Type Id:</strong>
                            {{ $userProfile->user_type_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $userProfile->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Branch Id:</strong>
                            {{ $userProfile->branch_id }}
                        </div>
                        <div class="form-group">
                            <strong>Department Id:</strong>
                            {{ $userProfile->department_id }}
                        </div>
                        <div class="form-group">
                            <strong>Created By:</strong>
                            {{ $userProfile->created_by }}
                        </div>
                        <div class="form-group">
                            <strong>Updated By:</strong>
                            {{ $userProfile->updated_by }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
