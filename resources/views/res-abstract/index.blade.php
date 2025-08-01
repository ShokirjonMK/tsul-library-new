@extends('layouts.app')

@section('template_title')
    {{ __('Abstracts') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Abstracts') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Abstracts') }}
                </p>
            </div>
            <div>
                <a href="{{ route('res-abstracts.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('res-abstracts.index', app()->getLocale()) }}" method="GET"
                            accept-charset="UTF-8" role="search" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="keyword"
                                        placeholder="{{ __('Keyword') }}..." value="{{ $keyword }}">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label(__('Resource language')) }}
                                        {!! Form::select('res_lang_id', $resourceLanguages, $res_lang_id, [
                                            'class' => 'form-select ' . ($errors->has('res_lang_id') ? ' is-invalid' : ''), 'placeholder' => __('Choose')
                                        ]) !!}
                                        {!! $errors->first('res_lang_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label(__('Resource Type')) }}
                                        {!! Form::select('res_type_id', $resourceTypes, $res_type_id, [
                                            'class' => 'form-select ' . ($errors->has('res_type_id') ? ' is-invalid' : ''), 'placeholder' => __('Choose')
                                        ]) !!}
                                        {!! $errors->first('res_type_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label(__('Resource Field')) }}
                                        {!! Form::select('res_field_id', $resourceFields, $res_field_id, [
                                            'class' => 'form-select ' . ($errors->has('res_field_id') ? ' is-invalid' : ''), 'placeholder' => __('Choose')
                                        ]) !!}
                                        {!! $errors->first('res_field_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                <a href="{{ route('res-abstracts.index', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>

                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <br>
                                {!! __('Number of records is :attribute', ['attribute' => $scientificPublications->total()]) !!}
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
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Published Year') }}</th>
                                        <th class="text-center">{{ __('Bar code') }}</th>
                                        <th>{{ __('Inventar Number') }}</th>
                                        <th>{{ __('Resource language') }}</th>
                                        <th>{{ __('Resource Type') }}</th>
                                        <th>{{ __('Resource Field') }}</th>

                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Full Text Path') }}</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($scientificPublications as $scientificPublication)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{!! $scientificPublication->isActive == 1
                                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $scientificPublication->title }}</td>
                                            <td>{{ $scientificPublication->publication_year }}</td>
                                            <td class="text-center">
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
                                            </td>
                                            <td>{{ $scientificPublication->inventar_number }}</td>
                                            <td>
                                                {!! $scientificPublication->resTypeLang ? $scientificPublication->resTypeLang->title : '' !!}
                                            </td>
                                            <td>
                                                {!! $scientificPublication->resType ? $scientificPublication->resType->title : '' !!}
                                            </td>
                                            <td>
                                                {!! $scientificPublication->resField ? $scientificPublication->resField->title : '' !!}
                                            </td>
                                            <td class="text-center">

                                                {{ $scientificPublication->inventar_number }}
                                            </td>
                                            <td>
                                                @if ($scientificPublication->image_path)
                                                    <img src="{{ asset('/storage/scientificPublications/photo/' . $scientificPublication->image_path) }}"
                                                        width="100px">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($scientificPublication->file_path)
                                                    <a href="{{ asset('/storage/scientificPublications/full-text/' . $scientificPublication->file_path) }}"
                                                        target="__blank">{{ __('Download') }}</a>
                                                @endif
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('res-abstracts.destroy', [app()->getLocale(), $scientificPublication->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('res-abstracts.show', [app()->getLocale(), $scientificPublication->id]) }}">
                                                        {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('res-abstracts.edit', [app()->getLocale(), $scientificPublication->id]) }}">
                                                        {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($scientificPublications->count() > 0)
                            {!! $scientificPublications->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
