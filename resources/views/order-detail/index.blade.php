@extends('layouts.app')

@section('template_title')
    {{ __('Order Detail') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Order Detail') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Order Detail') }}
            </p>
        </div>
        <div>
            <a href="{{ route('order-details.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
										<th>Status</th>
										<th>Order Id</th>
										<th>Book Id</th>
										<th>Updated By</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($orderDetails as $orderDetail)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $orderDetail->status }}</td>
											<td>{{ $orderDetail->order_id }}</td>
											<td>{{ $orderDetail->book_id }}</td>
											<td>{{ $orderDetail->updated_by }}</td>

                                        <td>
                                            <form action="{{ route('order-details.destroy',[app()->getLocale(), $orderDetail->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('order-details.show', [app()->getLocale(), $orderDetail->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('order-details.edit', [app()->getLocale(), $orderDetail->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach                                    
                            </tbody>
                        </table>
                    </div>
                    @if ($orderDetails->count() > 0)
                        {!! $orderDetails->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
