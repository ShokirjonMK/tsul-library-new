@extends('layouts.app')

@section('template_title')
    {{ __('Order') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Order') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Order') }}
            </p>
        </div>
        <div>
            <a href="{{ route('orders.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create') }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Order Number') }}</th>
                                    <th>{{ __('Order Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Reader') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="{{ route('orders.index', app()->getLocale()) }}" method="GET" accept-charset="UTF-8"
                                    role="search">
                                <tr>
                                    <th>No</th>
                                    <th>
                                        <div class="form-group">
                                            <input type="text" class="form-control " name="order_number"
                                                id="order_number" value="{{ $order_number }}"
                                                placeholder="{{ __('Order Number') }}" />
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <input type="date" class="form-control " name="order_date"
                                            id="order_date" value="{{ $order_date }}"
                                            placeholder="{{ __('Order Date') }}" />
                                        </div>
                                    </th>
                                    <th>
                                        <div class="form-group">
                                            <select name="status" class="border shadow p-2 bg-white">
                                                <option value=''>{{ __('Choose') }}</option>
                                                <option value=0 {!! ($status==0)?'selected':'' !!} >{{ __("DELETED") }}</option>
                                                <option value=1 {!! ($status==1)?'selected':'' !!}>{{ __("SENT") }}</option>
                                                <option value=2 {!! ($status==2)?'selected':'' !!}>{{__("ACCEPTED") }}</option>
                                                <option value=3 {!! ($status==3)?'selected':'' !!}>{{__("READY") }}</option>
                                                <option value=4 {!! ($status==4)?'selected':'' !!}>{{ __("TAKEN_BY_READER") }}</option>
                                            </select>
                                        </div>
                                    </th>
                                    <th></th>
                                    <th width="280px">
                                        <div class="input-group">
                                            <a href="{{ route('orders.index', app()->getLocale()) }}"
                                                class="btn btn-sm btn-info">{{ __('Clear') }}</a>
                                            <button type="submit"
                                                class="btn btn-sm btn-primary float-right">{{ __('Search') }}</button>
                                        </div>
                                    </th>
                                </tr>
                                </form>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                            <td>{{ $order->order_number }}</td>
											<td>{{ $order->order_date }}</td>
											<td>{!! App\Models\Order::GetStatus($order->status) !!}</td>
											<td>
                                                {!! $order->reader ? $order->reader->name : '' !!}
                                                <br>
                                                <b>{{ __('Email') }}</b>: <a href="mailTo:{!! $order->reader ? $order->reader->email : '' !!}">{!! $order->reader ? $order->reader->email : '' !!}</a>
                                                <br>
                                                <b>{{ __('Phone Number') }}: </b><a href="tel:{!! $order->reader ? $order->reader->profile->phone_number : '' !!}">{!! $order->reader ? $order->reader->profile->phone_number : '' !!}</a>
                                            </td>
                                        <td>
                                            <form action="{{ route('orders.destroy',[app()->getLocale(), $order->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('orders.show', [app()->getLocale(), $order->id]) }}"> {{ __('Show') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                            <form action="{{ route('orders.change',[app()->getLocale(), $order->id]) }}" method="POST">
                                                <input type="hidden" name="detail_id" value="{{$order->id}}">
                                                <input type="hidden" name="type" value="accept_detail">
                                                <div class="form-group">
                                                    <select class=" form-select form-control " id="status" name="status">
                                                        {{-- <option value='0' >{{ __('DELETED') }}</option>
                                                         --}}

                                                        @if ($order->status==1)
                                                            <option value='1' selected>{{ __('SENT') }}</option>
                                                        @else
                                                            <option value='1' >{{ __('SENT') }}</option>
                                                        @endif

                                                        @if ($order->status==2)
                                                            <option value='2' selected>{{ __('ACCEPTED') }}</option>
                                                        @else
                                                            <option value='2' >{{ __('ACCEPTED') }}</option>
                                                        @endif
                                                        @if ($order->status==3)
                                                            <option value='3' selected>{{ __('READY') }}</option>
                                                        @else
                                                            <option value='3'>{{ __('READY') }}</option>
                                                        @endif
                                                        @if ($order->status==4)
                                                            <option value='4' selected>{{ __('TAKEN_BY_READER') }}</option>
                                                        @else
                                                            <option value='4' >{{ __('TAKEN_BY_READER') }}</option>
                                                        @endif
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-primary btn-sm">{{ __('Save') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($orders->count() > 0)
                        {!! $orders->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
