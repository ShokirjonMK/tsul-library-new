@extends('layouts.app')

@section('template_title')
    {{ __('Depository list') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Depository list') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Depository list') }}
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
                                        <th>{{ __('comment') }}</th>
                                        <th>{{ __('Bibliographic record') }}</th>

                                        <th class="text-center">{{ __('Inventar Number') }}</th>
                                        <th class="text-center">{{ __('Bar code') }}</th>

                                        <th>{{ __('Book Information Data') }}</th>
                                         <th>
                                            {{ __('Branches') }}
                                            <br>
                                            {{ __('Departments') }}
                                        </th>


                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($depositories as $depository)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td class="text-center">{{ $depository->comment }}</td>

                                            <td>{!! \App\Models\Book::GetBibliographicById($depository->book_id) !!}</td>
                                            <td class="text-center">{{ $depository->inventar_number }}</td>
                                            <td class="text-center">
                                                @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                    {!! QrCode::size(100)->generate($depository->bar_code) !!}
                                                @else
                                                    @php
                                                        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                        echo $generator->getBarcode($depository->bar_code, $generator::TYPE_CODE_128, 2.30);

//                                                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($depository->bar_code, $generator::TYPE_CODE_128)) . '">';
                                                    @endphp
                                                @endif

                                                <br>
                                                {{ $depository->bar_code }}

                                            </td>
                                            <td>
                                            @if ($depository->bookInformation)
                                                {{$depository->bookInformation->organization->title}}     <br>
                                                {{$depository->bookInformation->branch->title }}              <br>
                                                {{$depository->bookInformation->department->title }}
                                            @endif
                                            </td>
                                             <td>

                                                {!! $depository->branch ? $depository->branch->title : '' !!}
                                                <br>
                                                {!! $depository->department ? $depository->department->title : '' !!}
                                            </td>


                                            <td>
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('depositories.show', [app()->getLocale(), $depository->id]) }}">
                                                    {{ __('Show') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($depositories->count() > 0)
                            {!! $depositories->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
