@extends('layouts.app')

@section('template_title')
    {{ __('Journal') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Journal') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Journal') }}
                </p>
            </div>
            <div>
                <a href="{{ route('journals.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('journals.index', app()->getLocale()) }}" method="GET"
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

                                <a href="{{ route('journals.index', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>
                                {{-- <a href="{{ route('journals.export', [app()->getLocale(), 'keyword' => $keyword]) }}"
                                    class="btn btn-sm btn-success float-right">
                                    {{ __('Export to Excel') }}
                                </a> --}}
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <br>
                                {!! __('Number of records is :attribute', ['attribute' => $journals->total()]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('Organization') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('IsActive') }}</th>
                                        <th>{{ __('ISSN') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Website') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($journals as $journal)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{!! $journal->organization_id ? $journal->organization->title : '' !!}</td>

                                            <td>{{ $journal->title }}</td>
                                            <td>{!! $journal->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>

                                            <td>{{ $journal->ISSN }}</td>
                                            <td>{{ $journal->email }}</td>
                                            <td>{{ $journal->website }}</td>
                                            <td>
                                                @if ($journal->image_path)
                                                    <img src="{{ asset('/storage/journals/photo/' . $journal->image_path) }}"
                                                        width="100px">
                                                @endif
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('journals.destroy', [app()->getLocale(), $journal->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('journals.show', [app()->getLocale(), $journal->id]) }}">
                                                        {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('journals.edit', [app()->getLocale(), $journal->id]) }}">
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
                        @if ($journals->count() > 0)
                            {!! $journals->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
