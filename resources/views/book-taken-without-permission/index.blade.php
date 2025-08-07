@extends('layouts.app')

@section('template_title')
    {{ __('Book Taken Without Permission') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Book Taken Without Permission') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Book Taken Without Permission') }}
                </p>
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
                                    <th>{{ __('Organization') }}</th>
                                    <th>{{ __('Branch') }}</th>
                                    <th>{{ __('Department') }}</th>
                                    <th>{{ __('Bibliographic record') }}</th>

                                    <th>{{ __('Bar code') }}</th>
                                    <th>{{ __('RFID Tag') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($bookTakenWithoutPermissions as $bookTakenWithoutPermission)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{!! $bookTakenWithoutPermission->organization ? $bookTakenWithoutPermission->organization->title : '' !!}</td>
                                        <td>{!! $bookTakenWithoutPermission->branch ? $bookTakenWithoutPermission->branch->title:''!!}</td>
                                        <td>{!! $bookTakenWithoutPermission->department ? $bookTakenWithoutPermission->department->title:''!!}</td>

                                        <td>
                                            {!! \App\Models\Book::GetBibliographicById( $bookTakenWithoutPermission->book_id) !!}
                                        </td>

                                        <td class="text-center">
                                            @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                {!! QrCode::size(100)->generate($bookTakenWithoutPermission->bar_code) !!}
                                            @else
                                                @php
                                                        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                        echo $generator->getBarcode($bookTakenWithoutPermission->bar_code, $generator::TYPE_CODE_128, 2.30);
                                                @endphp
                                            @endif
                                            <br>
                                            {{ $bookTakenWithoutPermission->bar_code }}
                                        </td>
                                        <td>{{ $bookTakenWithoutPermission->rfid_tag_id }}</td>

                                        <td>
                                            {{--                                            <form action="{{ route('book-taken-without-permissions.destroy',[app()->getLocale(), $bookTakenWithoutPermission->id]) }}" method="POST">--}}
                                            {{--                                                <a class="btn btn-sm btn-primary " href="{{ route('book-taken-without-permissions.show', [app()->getLocale(), $bookTakenWithoutPermission->id]) }}"> {{ __('Show') }}</a>--}}
                                            {{--                                                <a class="btn btn-sm btn-success" href="{{ route('book-taken-without-permissions.edit', [app()->getLocale(), $bookTakenWithoutPermission->id]) }}"> {{ __('Edit') }}</a>--}}
                                            {{--                                                @csrf--}}
                                            {{--                                                @method('DELETE')--}}
                                            {{--                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>--}}
                                            {{--                                            </form>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($bookTakenWithoutPermissions->count() > 0)
                            {!! $bookTakenWithoutPermissions->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
