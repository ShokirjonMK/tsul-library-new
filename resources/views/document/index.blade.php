@extends('layouts.app')

@section('template_title')
    {{ __('Document') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Document') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Document') }}
                </p>
            </div>
            <div>
                <a href="{{ route('documents.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('documents.index', app()->getLocale()) }}" method="GET"
                            accept-charset="UTF-8" role="search" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group input-daterange">

                                        <label for="type" class="form-label">{{ __('Type') }}:&nbsp;</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value='1' {{ $type ? '' : 'selected' }}>{{ __('Monthly') }}
                                            </option>
                                        </select>&nbsp;&nbsp;&nbsp;

                                        <input type="date" class="form-control" name="from"
                                            placeholder="{{ __('From') }}..." value="{{ $from }}">
                                        <div class="input-group-addon" style="margin: auto 11px;">{{ __('From') }}</div>
                                        <input type="date" class="form-control" name="to"
                                            placeholder="{{ __('To') }}..." value="{{ $to }}">
                                        <div class="input-group-addon" style="margin: auto 11px;">{{ __('To') }}</div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                <a href="{{ url(app()->getLocale() . '/admin/documents') }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>
                                @if ($from != null && $to != null)
                                    <a href="{{ route('documents.bymonth', [app()->getLocale(), 'type' => $type, 'from' => $from, 'to' => $to]) }}"
                                        class="btn btn-sm btn-success float-right">
                                        <i class="mdi  mdi-file-word"></i>
                                        {{ __('Download') }}
                                    </a>
                                @endif
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
                                        <th>{{ __('Number') }}</th>
                                        <th>{{ __('Arrived Date') }}</th>
                                        <th>{{ __('Copies') }}</th>
                                        <th>{{ __('Total price') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $document)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $document->title }}</td>
                                            <td>{{ $document->number }}</td>
                                            <td>{{ $document->arrived_date }}</td>
                                            <td>
                                                @php
                                                    $copies = 0;
                                                    if ($document->resourcesDocuments != null) {
                                                        foreach ($document->resourcesDocuments as $key => $value) {
                                                            $copies += $value->resource->copies;
                                                        }
                                                    }
                                                    echo $copies;
                                                @endphp
                                            </td>
                                            <td>
                                                @php
                                                    $price = 0;
                                                    if ($document->resourcesDocuments != null) {
                                                        foreach ($document->resourcesDocuments as $key => $value) {
                                                            $price +=
                                                                $value->resource->price * $value->resource->copies;
                                                        }
                                                    }
                                                    echo number_format($price, 2, '.', ' ');

                                                @endphp
                                            </td>

                                            <td>
                                                <form
                                                    action="{{ route('documents.destroy', [app()->getLocale(), $document->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('documents.show', [app()->getLocale(), $document->id]) }}">
                                                        {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('documents.edit', [app()->getLocale(), $document->id]) }}">
                                                        {{ __('Edit') }}</a>
                                                    <a class="btn btn-sm btn-warning "
                                                        href="{{ route('documents.word', [app()->getLocale(), $document->id]) }}"><i
                                                            class="mdi  mdi-file-word"></i> {{ __('Download') }}</a>

                                                    {{-- @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button> --}}
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($documents->count() > 0)
                            {!! $documents->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
