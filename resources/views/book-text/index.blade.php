@extends('layouts.app')

@section('template_title')
    {{ __('Book Text') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Book Text') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Book Text') }}
                </p>
            </div>
            <div>
                <a href="{{ route('book-texts.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('book-texts.index', app()->getLocale()) }}" method="GET"
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

                                <a href="{{ route('book-texts.index', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>
                                <a href="{{ route('book-texts.export', [app()->getLocale(), 'keyword' => $keyword]) }}"
                                    class="btn btn-sm btn-success float-right">
                                    {{ __('Export to Excel') }}
                                </a>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <br>
                                {!! __('Number of records is :attribute', ['attribute' => $bookTexts->total()]) !!}
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
                                        <th>{{ __('Journals count') }}</th>
                                        <th>{{ __('Bibliographic record') }}</th>
                                        <th>{{ __('Number of books') }}</th>
                                        <th>{{ __('Books in Copy') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookTexts as $bookText)
                                        {{-- <tr class="clickable-row" data-href="{{ route('book-texts.show', [app()->getLocale(), $bookText->id]) }}"> --}}
                                        <tr>
                                            <td>{{ $bookText->id }}</td>
                                            <td>{!! $bookText->isActive == 1
                                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $bookText->title }}</td>
                                            <td>{{ $bookText->journals_count }}</td>
                                            <td>{{ $bookText->books_count }}</td>
                                            <td>{!! \App\Models\BookText::GetCountBookByBookTypeId($bookText->id) !!}</td>
                                            <td>
                                                {!! \App\Models\BookText::GetCountBookCopiesByBookTypeId($bookText->id) !!}
                                            </td>

                                            <td>
                                                <form
                                                    action="{{ route('book-texts.destroy', [app()->getLocale(), $bookText->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('book-texts.show', [app()->getLocale(), $bookText->id]) }}">
                                                        {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('book-texts.edit', [app()->getLocale(), $bookText->id]) }}">
                                                        {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                                </form>
                                                @if (Auth::user()->hasRole('SuperAdmin'))
                                                    <br>
                                                    <form method="POST"
                                                        action="{{ route('book-texts.delete', [app()->getLocale(), 'id' => $bookText->id]) }}">
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
                        @if ($bookTexts->count() > 0)
                            {!! $bookTexts->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
