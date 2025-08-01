@extends('layouts.app')

@section('template_title')
    {{ $book->name ?? __('Show') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Books') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                                href="{{ url(app()->getLocale() . '/admin/books') }}">{{ __('Books') }}</a></span>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                        <div class="card-body">
                            {{ __('RFID Tag') }} : <strong>{{$rfid_tag_id}}</strong>
                            <br>
                            @if($bookInventar != null)
                                @include('book.bookdetail', ['book'=>$bookInventar->book])

                                <div class="box box-info padding-1">

                                    <table class="table table-striped table-hover">
                                        <tr>
                                            <th>{{ __('Bibliographic record') }}:</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                {!! \App\Models\Book::GetBibliographicById($bookInventar->book->id) !!}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>{{ __('IsActive') }}</th>
                                                <th>
                                                    {{ __('Dc Title') }}
                                                </th>
                                                <th>
                                                    {{ __('Branches') }}
                                                    <br>
                                                    {{ __('Departments') }}
                                                </th>

                                                <th class="text-center">{{ __('Inventar Number') }}</th>
                                                <th class="text-center">{{ __('Bar code') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>

                                                    <td>{{ $bookInventar->id }}</td>
                                                    <td>
                                                        {!! \App\Models\BookInventar::GetStatus($bookInventar->isActive) !!}
                                                        @if ($bookInventar->isActive==\App\Models\BookInventar::$WAREHOUSE)
                                                            {!! \App\Models\Depository::GET_COMMENT_BY_INVENTAR_ID($bookInventar->id) !!}

                                                        @endif
                                                    </td>
                                                    <td>

                                                        @if ($bookInventar->book_id)
                                                            <a
                                                                href="{{ route('books.show', [app()->getLocale(), $bookInventar->book_id]) }}">
                                                                {!! $bookInventar->book ? $bookInventar->book->dc_title : '' !!}
                                                            </a>

                                                        @endif
                                                    </td>
                                                    <td>
                                                        {!! $bookInventar->organization ? $bookInventar->organization->title : '' !!}
                                                        <br>
                                                        {!! $bookInventar->branch ? $bookInventar->branch->title : '' !!}
                                                        <br>
                                                        {!! $bookInventar->department ? $bookInventar->department->title : '' !!}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $bookInventar->inventar_number }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                            {!! QrCode::size(100)->generate($bookInventar->bar_code) !!}
                                                        @else
                                                            @php
                                                                $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                                echo $generator->getBarcode($bookInventar->bar_code, $generator::TYPE_CODE_128, 2.30);
                                                            @endphp
                                                        @endif

                                                        <br>
                                                        {{ $bookInventar->bar_code }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('books.inventarone', [app()->getLocale(), $bookInventar->id]) }}"
                                                           rel="noopener" target="_blank" class="btn-sm btn btn-success "
                                                           target="__blank"><i class="mdi mdi-18px mdi-printer"></i></a>

                                                        <a href="{{ route('books.inventarshow', [app()->getLocale(), $bookInventar->id, 'book_id' => $bookInventar->book_id]) }}"
                                                           rel="noopener" class="btn-sm btn btn-success "><i
                                                                class="mdi mdi-18px mdi-eye"></i></a>
                                                        @if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))

                                                            <br>
                                                            <button class="btn-sm btn btn-warning open_modal"
                                                                    data-inventar="{{$bookInventar->id}}">
                                                                {{ __('To the storage') }}
                                                            </button>
                                                        @endif
                                                        @if (Auth::user()->hasRole('SuperAdmin'))
                                                            <br>
                                                            <form method="GET"
                                                                  action="{{ route('books.inventarremove', [app()->getLocale(), 'id' => $bookInventar->id]) }}">
                                                                @csrf
                                                                <input name="type" type="hidden" value="DELETE">
                                                                <button type="submit"
                                                                        class="btn btn-sm btn-danger btn-flat show_confirm"
                                                                        data-toggle="tooltip">{{ __('Delete from DataBase') }}</button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            @else
                                 <livewire:admin.books.inventar-list :rfid_tag="$rfid_tag_id" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
