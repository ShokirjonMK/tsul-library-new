@extends('layouts.app')

@section('template_title')
    {{ $orderDetail->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Order Detail') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/order-details') }}">{{ __('Order Detail') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/order-details') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $orderDetail->status }}
                        </div>
                        <div class="form-group">
                            <strong>Order Id:</strong>
                            {{ $orderDetail->order_id }}
                        </div>
                        <div class="form-group">
                            <strong>Book Id:</strong>
                            {{ $orderDetail->book_id }}
                        </div>
                        <div class="form-group">
                            <strong>Updated By:</strong>
                            {{ $orderDetail->updated_by }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
