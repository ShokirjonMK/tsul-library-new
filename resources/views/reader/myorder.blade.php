@extends('layouts.app')

@section('template_title')
    {{ __('My Orders') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('My Orders') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('My Orders') }}
            </p>
        </div>
        <div>
            <a href="{{ route('myorders', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('View All') }}  
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                            <td>{{ $order->order_number }}</td>
											<td>{{ $order->order_date }}</td>
											<td>{!! App\Models\Order::GetStatus($order->status) !!}</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary " href="{{ route('myorders', [app()->getLocale(), 'orderid'=>$order->id]) }}"> {{ __('Show') }}</a>



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
