@extends('layouts.app')

@section('template_title')
    {{ __('Book Language') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Book Language') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Book Language') }}
                </p>
            </div>
            <div>
                <a href="{{ route('book-languages.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('book-languages.index', app()->getLocale()) }}" method="GET"
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

                                <a href="{{ route('book-languages.index', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>
                                <a href="{{ route('book-languages.export', [app()->getLocale(), 'keyword'=>$keyword]) }}" class="btn btn-sm btn-success float-right">
                                    {{ __('Export to Excel') }}
                                </a> 
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <br>
                                {!! __('Number of records is :attribute', ['attribute' => $bookLanguages->total()]) !!}
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
                                        <th>{{ __('Bibliographic record') }}</th>
                                        <th>{{ __('Number of books') }}</th>
                                        <th>{{ __('Books in Copy') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookLanguages as $bookLanguage)
                                        {{-- <tr class="clickable-row" data-href="{{ route('book-languages.show', [app()->getLocale(), $bookLanguage->id]) }}"> --}}
                                        <tr >
                                            <td>{{ $bookLanguage->id }}</td>
                                            <td>{!! $bookLanguage->isActive == 1
                                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $bookLanguage->title }}</td>
                                            <td>{{ $bookLanguage->books_count }}</td>
                                            <td>{!! \App\Models\BookLanguage::GetCountBookByBookTypeId($bookLanguage->id) !!}</td>
                                            <td>
                                                {!! \App\Models\BookLanguage::GetCountBookCopiesByBookTypeId($bookLanguage->id) !!}
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('book-languages.destroy', [app()->getLocale(), $bookLanguage->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('book-languages.show', [app()->getLocale(), $bookLanguage->id]) }}">
                                                        {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('book-languages.edit', [app()->getLocale(), $bookLanguage->id]) }}">
                                                        {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                                </form>
                                                @if (Auth::user()->hasRole('SuperAdmin'))
                                                    <br>
                                                    <form method="POST"
                                                        action="{{ route('book-languages.delete', [app()->getLocale(), 'id' => $bookLanguage->id]) }}">
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
                        @if ($bookLanguages->count() > 0)
                            {!! $bookLanguages->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
