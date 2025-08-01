@extends('layouts.app')

@section('template_title')
    {{ __('Update') }}
@endsection

@section('content')
<div class="content">

    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Order') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/orders') }}">{{ __('Order') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Update') }}
            </p>
        </div>
        <div>
            <a href="{{ url(app()->getLocale() . '/admin/orders') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>

    @includeif('partials.errors')
    <form method="POST" action="{{ route('orders.update', [app()->getLocale(), $order->id]) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf

        @include('order.form')

    </form> 

</div>

@endsection
