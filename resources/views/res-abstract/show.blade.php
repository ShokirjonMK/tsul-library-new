@extends('layouts.app')

@section('template_title')
    {{ $scientificPublication->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Abstracts') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/res-abstracts') }}">{{ __('Abstracts') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/res-abstracts') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $scientificPublication->isActive == 1
                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $scientificPublication->title }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Authors') }}:</strong>
                            {{ $scientificPublication->authors }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Description') }}:</strong>
                            {{ $scientificPublication->description }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Content') }}:</strong>
                            {{ $scientificPublication->content }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Keywords') }}:</strong>
                            {{ $scientificPublication->keywords }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Published Country') }}:</strong>
                            {{ $scientificPublication->country }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Place Protection') }}:</strong>
                            {{ $scientificPublication->place_protection }}
                        </div>
                        <div class="form-group">
                            <strong>{{__('Copies')}}:</strong>
                            {{ $scientificPublication->copies }}
                        </div>

                        <div class="form-group">
                            <strong>{{__('Published Year')}}:</strong>
                            {{ $scientificPublication->publication_year }}
                        </div>
                        <div class="form-group">
                            <strong>{{__('Page Number')}}:</strong>
                            {{ $scientificPublication->page_number }}
                        </div>
                        {{-- <div class="form-group">
                            <strong>Permission:</strong>
                            {{ $scientificPublication->permission }}
                        </div> --}}
                        <div class="form-group">
                            <strong>{{ __('Bar code') }}:</strong>
                            <br>
                            @if (env('BAR_CODE_TYPE')=='QRCODE')
                                {!! QrCode::size(100)->generate($scientificPublication->barcode) !!}
                            @else
                                @php

                                    $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                    echo $generator->getBarcode($scientificPublication->barcode, $generator::TYPE_CODE_128, 2.30);
                                @endphp
                            @endif

                            <br>
                            {{ $scientificPublication->barcode }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Inventar Number') }}:</strong>

                            {{ $scientificPublication->inventar_number }}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('Image') }}:</strong>
                            @if ($scientificPublication->image_path)
                                <img src="{{ asset('/storage/scientificPublications/photo/' . $scientificPublication->image_path) }}"
                                    width="100px">
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Full Text Path') }}:</strong>
                            @if ($scientificPublication->file_path)
                                <a href="{{ asset('/storage/scientificPublications/full-text/' . $scientificPublication->file_path) }}"
                                    target="__blank">{{ __('Download') }}</a>
                            @endif
                        </div>

                        <div class="form-group">
                            <strong>{{ __('Resource language') }}:</strong>
                            {!! $scientificPublication->resTypeLang ? $scientificPublication->resTypeLang->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Resource Type') }}:</strong>
                            {!! $scientificPublication->resType ? $scientificPublication->resType->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Resource Field') }}:</strong>
                            {!! $scientificPublication->resField ? $scientificPublication->resField->title : '' !!}

                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $scientificPublication->created_by ? $scientificPublication->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $scientificPublication->updated_by ? $scientificPublication->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $scientificPublication->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $scientificPublication->updated_at  }}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
