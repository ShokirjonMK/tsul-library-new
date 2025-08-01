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
                        @if ($debtors->count() > 0)
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <br>
                                        {!! __('The number of my debts is :attribute', ['attribute' => $debtors->total()]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>

                                            <th>{{ __('Book') }}</th>
                                            <th class="text-center">
                                                {{ __('Dc Authors') }}
                                            </th>
                                            <th class="text-center">
                                                {{ __('Inventar Number') }}
                                            </th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Taken Time') }}</th>
                                            <th>{{ __('Return Time') }}</th>
                                            <th>{{ __('Returned Time') }}</th>
                                            <th>{{ __('How Many Days') }}</th>
                                            <th class="text-center">
                                                {{ __('How many days do you have to return the book?') }}
                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($debtors as $debtor)
                                            @php
                                                $today = date('Y-m-d');
                                                // echo $item->return_time;
                                                // $qaytarish_vaqti = strtotime($item->return_time . '- ' . $item->how_many_days . ' days');
                                                // returned time kkmas
                                                $date1 = date_create($debtor->today);
                                                $date2 = date_create($debtor->return_time);
                                                $diff = date_diff($date1, $date2);
                                                $day_diff = $diff->format('%R%a');
                                            @endphp
                                            <tr
                                                @if ($day_diff < 1) class="alert alert-danger" @else class="alert alert-primary" @endif>
                                                <td>{{ $debtor->id }}</td>

                                                <td>{!! $debtor->book ? $debtor->book->dc_title : '' !!}</td>
                                                <td>
                                                    @foreach (json_decode($debtor->book->dc_authors) as $k => $value)
                                                        {!! $value . ',<br>' !!}
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                        {!! QrCode::size(100)->generate($debtor->bookInventar->bar_code) !!}
                                                    @else
                                                        @php
                                                            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($debtor->bookInventar->bar_code, $generator::TYPE_CODE_128)) . '">';
                                                        @endphp
                                                    @endif
                                                    <br>
                                                    {{ $debtor->bookInventar->bar_code }}
                                                </td>
                                                <td>{!! \App\Models\Debtor::GetStatus($debtor->status) !!}</td>
                                                <td>{{ $debtor->taken_time }}</td>
                                                <td>{{ $debtor->return_time }}</td>
                                                <td>{{ $debtor->returned_time }}</td>
                                                <td>{{ $debtor->how_many_days }}</td>
                                                <td class="text-center">
                                                    @if ($day_diff < 1)
                                                        {{ __('The deadline for submission of books is :attribute days', ['attribute' => $diff->format('%a')]) }}
                                                    @else
                                                        {{ __('The deadline is :attribute days', ['attribute' => $diff->format('%a')]) }}
                                                    @endif
                                                </td>

                                                <td>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {!! $debtors->appends(Request::all())->links('vendor.pagination.default') !!}
                        @else
                            <h3>{{ __('No debt') }}</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
