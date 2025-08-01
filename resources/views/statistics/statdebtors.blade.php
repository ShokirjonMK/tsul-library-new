@extends('layouts.app')

@section('template_title')
    {{ __('Roles') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Statdebtors') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Statdebtors') }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('admin.statdebtors', app()->getLocale()) }}" method="GET"
                              accept-charset="UTF-8" role="search" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group input-daterange">
                                        <input type="date" class="form-control" name="from"
                                               placeholder="{{ __('From') }}..." value="{{ $from }}">
                                        <div class="input-group-addon" style="margin: auto 11px;">{{ __('From') }}</div>
                                        <input type="date" class="form-control" name="to"
                                               placeholder="{{ __('To') }}..." value="{{ $to }}">
                                        <div class="input-group-addon" style="margin: auto 11px;">{{ __('To') }}</div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                        class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                <a href="{{ route('admin.statdebtors', app()->getLocale()) }}"
                                   class="btn btn-sm btn-info ">{{ __('Clear') }}</a>
                                {{-- <a href="{{ route('statdebtors.export', [app()->getLocale(), 'keyword' => $keyword]) }}"
                                class="btn btn-sm btn-success float-right">
                                {{ __('Export to Excel') }}
                            </a> --}}
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        @if ($counts != null && $counts->count() > 0)
                            <div class="form-group">
                                <strong><span class='btn btn-sm btn-primary'>{{ __('GIVEN') }}</span>:</strong>
                                @if (isset($counts[1]))
                                    {{ $counts[1] }}
                                @else
                                    0
                                @endif
                            </div>
                            <div class="form-group">
                                <strong><span class='btn btn-sm btn-primary'>{{ __('TAKEN') }}</span>:</strong>
                                @if (isset($counts[2]))
                                    {{ $counts[2] }}
                                @else
                                    0
                                @endif
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Reader') }}</th>
                                    <th>{{ __('GIVEN') }}</th>
                                    <th>{{ __('TAKEN') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($statdebtor_by_readers as $debtor)
                                    <tr>
                                        <td>{{ $debtor->id }}</td>
                                        <td>
                                            {!! $debtor->reader ? $debtor->reader->name : '' !!}
                                            <br>
                                            {{ __('Email') }} : <a
                                                href="mailTo:{!! $debtor->reader ? $debtor->reader->email : '' !!}">{!! $debtor->reader ? $debtor->reader->email : '' !!}</a>
                                            <br>
                                            {{ __('Phone Number') }} : <a
                                                href="tel:{!! $debtor->reader ? $debtor->reader->profile->phone_number : '' !!}">{!! $debtor->reader ? $debtor->reader->profile->phone_number : '' !!}</a>
                                            <br>
                                            {{ __('Inventar Number') }} :
                                            <div class="text-left">
                                                @if ($debtor->reader != null)
                                                    @if(($debtor->reader->inventar_number))

                                                        @if (env('USER_BAR_CODE_TYPE')=='QRCODE')
                                                            {!! QrCode::size(100)->generate($debtor->reader->inventar_number); !!}
                                                        @else
                                                            @php
                                                                $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                                echo $generator->getBarcode($debtor->reader->inventar_number, $generator::TYPE_CODE_128, 2.30);
                                                            @endphp
                                                        @endif
                                                    @endif

                                                    <br>
                                                    {{ $debtor->reader->inventar_number }}
                                                @endif
                                            </div>
                                        </td>
                                        <td>{!! \App\Models\Debtor::GetStatusCount($debtor->reader_id, $from, $to, \App\Models\Debtor::$GIVEN) !!} </td>
                                        <td>{!! \App\Models\Debtor::GetStatusCount($debtor->reader_id, $from, $to, \App\Models\Debtor::$TAKEN) !!} </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary "
                                               href="{{ route('statdebtors.show', [app()->getLocale(), $debtor->reader_id, 'from' => $from, 'to'=>$to]) }}">
                                                {{ __('Show') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($statdebtor_by_readers->count() > 0)
                            {{-- {{ $statdebtor_by_readers->links() }} --}}


                            {!! $statdebtor_by_readers->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
