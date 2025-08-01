@extends('layouts.app')

@section('template_title')
    {{ __('Inventar Number') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Inventar Numbers') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/books') }}">{{ __('Books') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ __('Show') }}
                </p>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card card-default">
                    {{-- <livewire:admin.books.inventar-list  /> --}}
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card-header card-header-border-bottom d-flex justify-content-between">
                        </div>
                        <div class="card-body">

                            <div class="box box-info padding-1">
                                <table class="table table-striped table-hover">
                                    <tr>
                                        <th>{{ __('Bibliographic record') }}:</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            {!! \App\Models\Book::GetBibliographicById($book->id) !!}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <livewire:admin.books.adding-book-rfid-to-branch-component :book_id="$book->id" :rfid_tag="$rfid_tag_id" />

                    <div class="col-12 col-sm-12 col-lg-12">

                        @if ($book_informations->count() > 0)
                            <div class="table-responsive">

                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('IsActive') }}</th>
                                        <th>{{ __('Organization') }}</th>
                                        <th>{{ __('Branches') }}</th>
                                        <th>{{ __('Departments') }}</th>
                                        <th>{{ __('Copy count') }}</th>
                                        <th>{{ __('Is it in the library?') }}</th>
                                        <th>{{ __('Is it in electronic format?') }}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($book_informations as $k => $item)
                                        <tr>
                                            <td>
                                                {{ $k + 1 }}
                                            </td>
                                            <td>

                                                {!! $item->isActive == 1
                                                    ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                                    : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}

                                            </td>
                                            <td>{!! $item->organization ? $item->organization->title : '' !!}</td>
                                            <td>{!! $item->branch ? $item->branch->title : '' !!}</td>
                                            <td>{!! $item->department ? $item->department->title : '' !!}</td>

                                            @php
                                                $total += $item->bookInventar->count();
                                            @endphp
                                            <td>{{ $item->bookInventar->count() }}</td>

                                            <td>{!! $item->kutubxonada_bor == 1
                                    ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                    : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{!! $item->elektronni_bor == 1
                                    ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                    : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>
                                                <div class="btn-group">


                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td colspan="4">{{ __('Total') }}:</td>
                                        <td>
                                            {{ $total }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <hr>
                        @endif
                    </div>
                    @if ($bookinventars->count() > 0)

                        <div class="col-12 col-sm-12 col-lg-12">

                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('IsActive') }}</th>
                                        <th>{{ __('Organization') }}</th>
                                        <th>{{ __('Branches') }}</th>
                                        <th>{{ __('Departments') }}</th>
                                        <th>{{ __('Reason for shutdown') }}</th>
                                        <th class="text-center">{{ __('Inventar Number') }}</th>
                                        <th class="text-center">{{ __('Bar code') }}</th>
                                        <th class="text-center">{{ __('is RFID isset?') }}</th>

                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($bookinventars as $book_inventar)
                                        <tr>
                                            <td>
                                                {{ $book_inventar->id }}
                                            </td>


                                            <td>
                                                {{-- {!! $book_inventar->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!} --}}
                                                {!! \App\Models\BookInventar::GetStatus($book_inventar->isActive) !!}

                                            </td>
                                            <td>{!! $book_inventar->organization ? $book_inventar->organization->title : '' !!}</td>
                                            <td>{!! $book_inventar->branch ? $book_inventar->branch->title : '' !!}</td>
                                            <td>{!! $book_inventar->department ? $book_inventar->department->title : '' !!}</td>
                                            <td>{{ $book_inventar->comment }}</td>
                                            <td class="text-center">
                                                {{ $book_inventar->inventar_number }}
                                            </td>
                                            <td class="text-center">
                                                @if ($book_inventar->bar_code)
                                                    @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                        {!! QrCode::size(100)->generate($book_inventar->bar_code) !!}
                                                    @else
                                                        @php
                                                            $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                            echo $generator->getBarcode($book_inventar->bar_code, $generator::TYPE_CODE_128, 2.30);

                                                        @endphp
                                                    @endif

                                                    <br>
                                                @endif
                                                {{ $book_inventar->bar_code }}
                                            </td>
                                            <td>
                                                {!! $book_inventar->rfid_tag_id != null
                                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                                            </td>
                                            <td>
                                                    <form method="POST"
                                                          action="{{ route('books.addrfidinventar', [app()->getLocale(), 'id' => $book_inventar->id, 'rfid_tag_id' => $rfid_tag_id]) }}">
                                                        @csrf

                                                        <button type="submit"
                                                                class="btn btn-sm btn-success btn-flat "
                                                                data-toggle="tooltip">{{ __('Add RFID') }}</button>
                                                    </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        @if ($bookinventars->count() > 0)
                            {!! $bookinventars->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif

                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
