@extends('layouts.app')

@section('template_title')
    {{ __('Subjects') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Monthly statistics on subjects of literature') }}</h1>
                <p class="breadcrumbs"><span><a
                                href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Subjects') }}
                </p>
            </div>
            <div>


            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">

                    <div class="card-header">
                        <form action="{{ route('admin.statbooksubjects', app()->getLocale()) }}" method="GET"
                              accept-charset="UTF-8" role="search" style="width: 100%;">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="keyword"
                                               placeholder="{{ __('Keyword') }}..." value="{{ $keyword }}">
                                    </div>
                                </div>

                                <div class="col-md-12">

                                    <div class="input-group input-daterange">

                                        <select class="form-control" name="year">
                                            <option>{{ __('Select Year') }}</option>
                                            @foreach ($years as $y)
                                                @if ($year==$y)
                                                    <option value="{{$y}}" selected> {{$y}} </option>
                                                @else
                                                    <option value="{{$y}}"> {{$y}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <a href="{{ route('admin.statbooksubjects', [app()->getLocale(), 'year' => $year, 'excel'=>1]) }}"
                                           class="btn btn-sm btn-success float-right">
                                            {{ __('Export to Excel') }}
                                        </a>
                                    </div>

                                </div>


                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                    <a href="{{ route('admin.statbooksubjects', app()->getLocale()) }}"
                                       class="btn btn-sm btn-info ">{{ __('Clear') }}</a>

                                </div>
                        </form>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Title') }}</th>
                                    @foreach ($months as $k => $month)
                                        <th>{{ $month }} </th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($booksTypes as $booksType)
                                    <tr>
                                        <td>{{ $booksType->id }}</td>
                                        <td class="text text-right">
                                            {{ $booksType->title }} <br>
                                            {{ __('In the name') }}:<br>
                                            {{ __('In copy') }}:
                                        </td>
                                        @foreach ($months as $k => $month)
                                            <td>
                                                @php
                                                    $data = isset($subjectCounts[$booksType->id]) ? collect($subjectCounts[$booksType->id])->firstWhere('month', $k) : null;
                                                   $bookCount = $data->book_count ?? 0;
                                                   $copyCount = $data->copy_count ?? 0;
                                                @endphp
                                                <b>{{ $bookCount }}</b>
                                                <br>
                                                <b>{{ $copyCount }}</b>
                                            </td>
                                        @endforeach


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div class="clear"></div>
                        @if ($booksTypes->count() > 0)
                            {!! $booksTypes->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
