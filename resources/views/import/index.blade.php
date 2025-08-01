@extends('layouts.app')

@section('template_title')
    {{ __('Import') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div> 
                <h1>{{ __('Import') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Import') }}
                </p>
            </div>
            <div>
                <a href="{{ route('imports.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('imports.index', app()->getLocale()) }}" method="GET"
                            accept-charset="UTF-8" role="search" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="keyword"
                                        placeholder="{{ __('Keyword') }}..." value="{{ $keyword }}">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                <a href="{{ route('imports.index', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <br>
                                {!! __('Number of records is :attribute', ['attribute' => $imports->total()]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <form method="POST" action="{{ route('imports.store', app()->getLocale()) }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_import" id="type_import1" checked
                                    value="armat_marc21">
                                <label class="form-check-label" for="type_import1">
                                    ARMAT MARC21 formatida, Windows kodirovkada
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_import" id="type_import2"
                                    value="irbis_utf_8_marc21">
                                <label class="form-check-label" for="type_import2">
                                    IRBIS, 1995-2005 yilgi versiyadan (UTF-8 kodirovkada)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_import" id="type_import3"
                                    value="irbis_windows_marc21">
                                <label class="form-check-label" for="type_import3">
                                    IRBIS, boshqa versiyadan
                                </label>
                            </div>

                            <div class="form-group">
                                <input type="file" name="file" class='form-control' />
                                {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}

                            </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </div>
                        </form>

                        <div class="table-responsive">

                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('IsActive') }}</th> 
                                        <th>{{ __('Dc Title') }}</th> 
                                        <th>{{ __('Dc Publisher') }}</th>
                                        <th>{{ __('Dc Published City') }}</th>
                                        <th>{{ __('Dc Date') }}</th>
                                        <th>{{ __('ISBN') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="{{ route('imports.index', app()->getLocale()) }}" method="GET" accept-charset="UTF-8"
                                        role="search">
                                        <tr>
                                            <th colspan="2">
                                                <div class="form-group">
                                                    <input type="text" class="form-control " name="id"
                                                        id="id" value="{{ $id }}"
                                                        placeholder="{{ __('Id') }}" />
                                                </div>
                                            </th> 
                                            <th>
                                                <div class="form-group">
                                                    <input type="text" class="form-control " name="name" id="name"
                                                        value="{{ $name }}"
                                                        placeholder="{{ __('Dc Title') }}" />
                                                </div>    
                                            </th> 
                                            <th>
                                                <div class="form-group">
                                                    <input type="text" class="form-control " name="publisher" id="publisher"
                                                        value="{{ $publisher }}"
                                                        placeholder="{{ __('Dc Publisher') }}" />
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <input type="text" class="form-control " name="publisher_city" id="publisher_city"
                                                        value="{{ $publisher_city }}"
                                                        placeholder="{{ __('Dc Published City') }}" />
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <input type="text" class="form-control " name="date" id="date"
                                                        value="{{ $published_year }}"
                                                        placeholder="{{ __('Dc Date') }}" />
                                                </div>
                                            </th>
                                            <th>
                                                <div class="form-group">
                                                    <input type="text" class="form-control " name="isbn" id="isbn"
                                                        value="{{ $isbn }}"
                                                        placeholder="{{ __('ISBN') }}" />
                                                </div>
                                            </th>
                                            <th>
                                                <div class="input-group">
                                                    <a href="{{ route('imports.index', app()->getLocale()) }}"
                                                        class="btn btn-sm btn-info">{{ __('Clear') }}</a>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary float-right">{{ __('Search') }}</button>
                                                </div>
                                            </th>
                                        </tr>
                                    </form>
                                    @foreach ($imports as $import)
                                        <tr>
                                            <td>{{ $import->id }}</td>
                                            <td>
                                                @if ($import->status == 0)
                                                    <span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>
                                                @elseif($import->status == 1)
                                                    <span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>
                                                @elseif($import->status == 2)
                                                    {{__("Imported")}}
                                                @endif
                                                
                                            <td>{{ $import->title }}</td> 
                                            <td>{{ $import->publisher }}</td>
                                            <td>{{ $import->published_city }}</td>
                                            <td>{{ $import->published_year }}</td>
                                            <td>{{ $import->ISBN }}</td>  


                                            <td>
                                                <form
                                                    action="{{ route('imports.destroy', [app()->getLocale(), $import->id]) }}"
                                                    method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary "
                                                        href="{{ route('imports.show', [app()->getLocale(), $import->id]) }}">
                                                        {{ __('Show') }}</a> --}}
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('imports.edit', [app()->getLocale(), $import->id]) }}">
                                                        {{ __('Add to catalogue') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                                </form>
                                                @if (Auth::user()->hasRole('SuperAdmin'))
                                                    <br>
                                                    <form method="POST"
                                                        action="{{ route('imports.delete', [app()->getLocale(), 'id' => $import->id]) }}">
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
                        @if ($imports->count() > 0)
                            {!! $imports->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
