@extends('layouts.app')

@section('template_title')
    {{ __('Magazine Issue') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Magazine Issue') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Magazine Issue') }}
                </p>
            </div>
            <div>
                <a href="{{ route('magazine-issues.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('magazine-issues.index', app()->getLocale()) }}" method="GET"
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

                                <a href="{{ route('magazine-issues.index', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>
                                {{-- <a href="{{ route('magazine-issues.export', [app()->getLocale(), 'keyword' => $keyword]) }}"
                                    class="btn btn-sm btn-success float-right">
                                    {{ __('Export to Excel') }}
                                </a> --}}
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <br>
                                {!! __('Number of records is :attribute', ['attribute' => $magazineIssues->total()]) !!}
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('Journal') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('IsActive') }}</th> 
                                        <th>{{ __('Published Year') }}</th>
                                        <th>{{ __('fourth_number') }}</th>
                                       
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Full Text Path') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($magazineIssues as $magazineIssue)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                {!! $magazineIssue->journal ? $magazineIssue->journal->title:''!!}</td>
                                            <td>{{ $magazineIssue->title }}</td>
                                            <td>{!! $magazineIssue->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $magazineIssue->published_year }}</td>
                                            <td>{{ $magazineIssue->fourth_number }}</td>
                                             <td>
                                                @if ($magazineIssue->image_path)
                                                    <img src="{{ asset('/storage/magazineIssues/photo/' . $magazineIssue->image_path) }}"
                                                        width="100px">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($magazineIssue->full_text_path)
                                                    <a href="{{ asset('/storage/magazineIssues/full-text/' . $magazineIssue->full_text_path) }}"
                                                        target="__blank">{{ __('Download') }}</a>
                                                @endif
                                            </td>



                                            <td>
                                                <form
                                                    action="{{ route('magazine-issues.destroy', [app()->getLocale(), $magazineIssue->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('magazine-issues.show', [app()->getLocale(), $magazineIssue->id]) }}">
                                                        {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('magazine-issues.edit', [app()->getLocale(), $magazineIssue->id]) }}">
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
                        @if ($magazineIssues->count() > 0)
                            {!! $magazineIssues->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
