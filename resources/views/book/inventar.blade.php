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
                <a href="{{ url(app()->getLocale() . '/admin/books') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    {{-- <livewire:admin.books.inventar-list  /> --}}
                    <div class="card">
                        <div class="container">
                            <div class="row" style="padding: 20px 20px 0px 20px">
                                <form action="{{ route('admin.inventar', app()->getLocale()) }}" method="GET"
                                    accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                                    <div class="row">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="inventar" id="inventar"
                                                    value="{{ $inventar }}"
                                                    placeholder="{{ __('Inventar Number') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="from" id="from"
                                                    value="{{ $from }}" placeholder="{{ __('from') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="to" id="to"
                                                    value="{{ $to }}" placeholder="{{ __('to') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <span class="input-group-append">
                                                    <button type="submit"
                                                        class="btn  btn-primary">{{ __('Search') }}</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <a href="{{ url(app()->getLocale() . '/admin/books/inventar') }}"
                                                    class="btn btn-success">{{ __('Clear') }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            @if ($from && $to)
                                                <a href="{{ route('books.inventarone', [app()->getLocale(), '10', 'from' => $from, 'to' => $to, 'inventar' => $inventar]) }}"
                                                    class="btn btn-primary float-right" data-placement="left"
                                                    target="_blank">
                                                    <i class="mdi mdi-18px mdi-printer"></i>
                                                </a>
                                                <a href="{{ route('books.inventaronebarcode', [app()->getLocale(), '0', 'from' => $from, 'to' => $to, 'inventar' => $inventar]) }}"
                                                    class="btn btn-primary float-right" data-placement="left"
                                                    target="_blank">
                                                    <i class="mdi mdi-18px mdi-barcode"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('books.inventarone', [app()->getLocale(), 'all']) }}"
                                                    class="btn   btn-primary float-right" data-placement="left"
                                                    target="_blank">
                                                    <i class="mdi mdi-18px mdi-printer"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <br>
                                    {!! __('Number of bar code records is :attribute', ['attribute' => $barcodes->total()]) !!}
                                    {{-- , | {!!__("Number of books is :attribute",['attribute' => $books->total() ])!!} --}}
                                </div>
                            </div>
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
                                        @foreach ($barcodes as $book_inventar)
                                            {{-- <tr class="clickable-row" data-href="{{ route('books.inventarshow', [app()->getLocale(), $book_inventar->id,  "book_id"=>$book_inventar->book_id]) }}"> --}}
                                            <tr>

                                                <td>{{ $book_inventar->id }}</td>
                                                <td>
                                                    {!! \App\Models\BookInventar::GetStatus($book_inventar->isActive) !!}
                                                    @if ($book_inventar->isActive==\App\Models\BookInventar::$WAREHOUSE)
                                                        {!! \App\Models\Depository::GET_COMMENT_BY_INVENTAR_ID($book_inventar->id) !!}

                                                    @endif
                                                </td>
                                                <td>

                                                    @if ($book_inventar->book_id)
                                                    <a
                                                        href="{{ route('books.show', [app()->getLocale(), $book_inventar->book_id]) }}">
                                                        {!! $book_inventar->book ? $book_inventar->book->dc_title : '' !!}
                                                    </a>
                                                        
                                                    @endif
                                                </td>
                                                <td>
                                                    {!! $book_inventar->organization ? $book_inventar->organization->title : '' !!} <br>
                                                    {!! $book_inventar->branch ? $book_inventar->branch->title : '' !!}
                                                    <br>
                                                    {!! $book_inventar->department ? $book_inventar->department->title : '' !!}
                                                </td>
                                                <td class="text-center">
                                                    {{ $book_inventar->inventar_number }}
                                                </td>
                                                <td class="text-center">

@if (env('BAR_CODE_TYPE') == 'QRCODE')
    {!! QrCode::size(100)->generate($book_inventar->bar_code) !!}
@else
    @php
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        echo '<img src="data:image/png;base64,' . base64_encode(
            $generator->getBarcode($book_inventar->bar_code, $generator::TYPE_CODE_128)
        ) . '">';
    @endphp
@endif

                                                     <br>
                                                    {{ $book_inventar->bar_code }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('books.inventarone', [app()->getLocale(), $book_inventar->id]) }}"
                                                        rel="noopener" target="_blank" class="btn-sm btn btn-success "
                                                        target="__blank"><i class="mdi mdi-18px mdi-printer"></i></a>

                                                    <a href="{{ route('books.inventarshow', [app()->getLocale(), $book_inventar->id, 'book_id' => $book_inventar->book_id]) }}"
                                                        rel="noopener" class="btn-sm btn btn-success "><i
                                                            class="mdi mdi-18px mdi-eye"></i></a>
                                                    @if (Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
                                                       
                                                    <br>
                                                        <button class="btn-sm btn btn-warning open_modal" data-inventar="{{$book_inventar->id}}" >
                                                            {{ __('To the storage') }}
                                                        </button>
                                                    @endif
                                                    @if (Auth::user()->hasRole('SuperAdmin'))
                                                        <br>
                                                        <form method="GET"
                                                            action="{{ route('books.inventarremove', [app()->getLocale(), 'id' => $book_inventar->id]) }}">
                                                            @csrf
                                                            <input name="type" type="hidden" value="DELETE">
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger btn-flat show_confirm"
                                                                data-toggle="tooltip">{{ __('Delete from DataBase') }}</button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            @if ($barcodes->count() > 0)
                                {!! $barcodes->appends(Request::all())->links('vendor.pagination.default') !!}
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL SECTION -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                </div> 
                <form action="{{ route('admin.inventarstorage', app()->getLocale()) }}"  role="form" enctype="multipart/form-data"  class="form-horizontal" method="POST">
                    @csrf

                    <div class="modal-body">
                        <input type="hidden" id="inventar_id"  name="inventar_id" placeholder="inventar_id" >
                     
                        <div class="form-group error">
                            <label for="inputName" class="col-sm-3 control-label">{{__('Comment')}}</label>
                            <div class="col-sm-9">
                                <input type="text" required class="form-control has-error" id="comment" name="comment"
                                    placeholder="{{__('Comment')}}" >
                            </div>
                        </div>
                         
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save" value="add">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        //display modal form for product EDIT ***************************
        $(document).on('click', '.open_modal', function() {
            $('#myModal').modal('show');
            var inventar_id=$(this).data('inventar');
            $('#inventar_id').val(inventar_id);
            console.log(inventar_id);
           
             
        });
    </script>
@endpush
