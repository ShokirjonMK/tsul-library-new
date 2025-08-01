@extends('layouts.app')

@section('template_title')
    {{ __('My debts') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('My debts') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Books') }}
            </p>
        </div>
        <div>
            
        </div>
    </div>
   
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
