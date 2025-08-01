@extends('layouts.app')

@section('template_title')
    {{ __('Debtors') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Debtors') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/books/inventar') }}">{{ __('Inventar Numbers') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ __('Show') }}
                </p>
            </div>
            <div>
                <a href="{{ url(app()->getLocale() . '/admin/books/inventar') }}"
                    class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @include('book.bookdetail', ['book'=>$book])
                                <hr>
                                @if ($book_information != null)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{ __('Branches') }}:</strong>
                                        {!! $book_information->branch ? $book_information->branch->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Departments') }}:</strong>
                                        {!! $book_information->department ? $book_information->department->title : '' !!}
                                    </div>
                                </div>
                                @endif

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{ __('Inventar Number') }}:</strong>
                                        <div class=" text-center">
                                            <br>
                                            {{ $bookInventar->inventar_number }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{ __('Bar code') }}:</strong>
                                        <div class=" text-center">
                                            @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                {!! QrCode::size(100)->generate($bookInventar->bar_code); !!}
                                            @else
                                                @php
                                                    $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                    echo $generator->getBarcode($bookInventar->bar_code, $generator::TYPE_CODE_128, 2.30);

//                                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($bookInventar->bar_code, $generator::TYPE_CODE_128)) . '">';
                                                @endphp
                                            @endif
                                            <br>
                                            {{ $bookInventar->bar_code }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{ __('RFID') }}:</strong>
                                        {{ $bookInventar->rfid_tag_id }}
                                    </div>
                                </div>


                            </div>
                            <div class="row">

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>{{ __('Status') }}</th>

                                                <th>{{ __('Reader') }}</th>
                                                <th>{{ __('Taken Time') }}</th>
                                                <th>{{ __('Return Time') }}</th>
                                                <th>{{ __('Returned Time') }}</th>
                                                <th>{{ __('Given for a few days') }}</th>
                                                <th>{{ __('Dates of use') }}</th>
                                                <th>{{__('Who gave the book?')}}</th>
                                                <th>{{__('Who got the book back?')}}</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($debtors as $debtor)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{!! \App\Models\Debtor::GetStatus($debtor->status) !!}</td>
                                                    <td>{!! $debtor->reader ? $debtor->reader->name : '' !!}</td>
                                                    <td>{{ $debtor->taken_time }}</td>
                                                    <td>{{ $debtor->return_time }}</td>
                                                    <td>{{ $debtor->returned_time }}</td>
                                                    <td>{{ $debtor->how_many_days }}</td>
                                                    <td>
                                                        @php
                                                            $today = date('Y-m-d');
                                                            if ($debtor->returned_time != null) {
                                                                $from = date_create($debtor->returned_time);
                                                            } else {
                                                                $from = date_create($today);
                                                            }
                                                            $to = date_create($debtor->taken_time);
                                                            $diff = date_diff($to, $from);
                                                            $total += intval($diff->format('%a'));
                                                            echo $diff->format('%a');
                                                        @endphp
                                                    </td>
                                                    <td>{!! $debtor->created_by ? $debtor->createdBy->name : '' !!}</td>
                                                    <td>{!! $debtor->updated_by ? $debtor->updatedBy->name : '' !!}</td>

                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="6"></td>
                                                <td>{{ __('Total') }}</td>
                                                <td>{{ $total }} {{ __('Days') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if ($debtors->count() > 0)
                                    {!! $debtors->appends(Request::all())->links('vendor.pagination.default') !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
