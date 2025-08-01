@extends('layouts.app')

@section('template_title')
    {{ $depository->name ?? __('Show') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Depository list') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/depositories') }}">{{ __('Depository list') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
                </p>
            </div>
            <div>
                <a href="{{ url(app()->getLocale() . '/admin/depositories') }}"
                    class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <strong>{{ __('Bibliographic record') }}:</strong>
                                {!! \App\Models\Book::GetBibliographicById($depository->book_id) !!}
                            </div>

                            <div class="form-group">
                                <strong>{{ __('comment') }}:</strong>
                                {{ $depository->comment }}
                            </div>

                            <div class="form-group">
                                <strong>{{ __('Inventar Number') }}:</strong>
                                {{ $depository->inventar_number }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Bar code') }}:</strong>
                                <br>
                                @if (env('BAR_CODE_TYPE')=='QRCODE')
                                    {!! QrCode::size(100)->generate($depository->bar_code) !!}
                                @else
                                    @php
                                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($depository->bar_code, $generator::TYPE_CODE_128)) . '">';
                                    @endphp
                                @endif

                                <br>
                                {{ $depository->bar_code }}

                            </div>

                            <div class="form-group">
                                <strong>{{ __('Book Information Data') }}:</strong>
                                <br>
                                @if ($depository->bookInformation)
                                    {{ $depository->bookInformation->organization->title }} <br>
                                    {{ $depository->bookInformation->branch->title }} <br>
                                    {{ $depository->bookInformation->department->title }}
                                @endif
                            </div>

                            <div class="form-group">
                                <strong>{{ __('Branches') }}:</strong>
                                {!! $depository->branch ? $depository->branch->title : '' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Departments') }}:</strong>
                                {!! $depository->department ? $depository->department->title : '' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Created By') }}:</strong>
                                {!! $depository->created_by ? $depository->createdBy->name : '' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Updated By') }}:</strong>
                                {!! $depository->updated_by ? $depository->updatedBy->name : '' !!}
                            </div>

                            <div class="form-group">
                                <strong>{{ __('Created At') }}:</strong>
                                {{ $depository->created_at }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Updated At') }}:</strong>
                                {{ $depository->updated_at }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
