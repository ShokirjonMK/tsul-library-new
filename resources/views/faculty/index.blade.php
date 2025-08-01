@extends('layouts.app')

@section('template_title')
    {{ __('Faculties') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Faculties') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Faculties') }}
                </p>
            </div>
            <div>
                <a href="{{ route('faculties.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                    {{ __('Create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('faculties.index', app()->getLocale()) }}" method="GET"
                              accept-charset="UTF-8" role="search" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="keyword"
                                           placeholder="{{ __('Keyword') }}..." value="{{ $keyword }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    @if ($organizations->count() > 0)
                                        <div class="form-group">
                                            {!! Form::select('organization_id', $organizations, $organization_id, [
                                                'class' => 'border  p-2 bg-white',
                                                'placeholder' => __('Organization'),
                                            ]) !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    @if ($branchs->count() > 0)
                                        <div class="form-group">
                                            {!! Form::select('branch_id', $branchs, $branch_id, [
                                                'class' => 'border  p-2 bg-white',
                                                'placeholder' => __('Branch'),
                                            ]) !!}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="col-md-12 d-flex justify-content-between align-items-center ">

                                    <button type="submit"
                                            class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                    <a href="{{ route('faculties.index', app()->getLocale()) }}"
                                       class="btn btn-sm btn-info ">{{ __('Clear') }}</a>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="container">

                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between align-items-center">
                                <span> {!! __('Number of records is :attribute', ['attribute' => $faculties->total()]) !!} </span>
                                @if (env('LOGIN_WITH_HEMIS')==true)
                                    <livewire:admin.hemis.get-references-component :referenceType="'faculty'"/>

                                @endif
                                <span> {!! __('Number of Users is :attribute', ['attribute' => $totalUsers]) !!} </span>
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
                                    <th>{{ __('Branch') }}</th>

                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('IsActive') }}</th>
                                    <th>{{ __('HEMIS Code') }}</th>
                                    <th>{{ __('User count') }}</th>


                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($faculties as $faculty)

                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{!! $faculty->organization ? $faculty->organization->title : '' !!}</td>
                                        <td>{!! $faculty->branch ? $faculty->branch->title:''!!}</td>

                                        <td>
                                            {{ $faculty->title }}
                                        </td>
                                        <td>{!! $faculty->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                        <td>{{ $faculty->code }}</td>
                                        <td>{{ $faculty->profiles_count }}</td>

                                        <td>
                                            <form
                                                action="{{ route('faculties.destroy',[app()->getLocale(), $faculty->id]) }}"
                                                method="POST">
                                                <a class="btn btn-sm btn-primary "
                                                   href="{{ route('faculties.show', [app()->getLocale(), $faculty->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success"
                                                   href="{{ route('faculties.edit', [app()->getLocale(), $faculty->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                            @if (Auth::user()->hasRole('SuperAdmin'))
                                                <br>
                                                <form method="POST"
                                                      action="{{ route('faculties.delete', [app()->getLocale(), 'id' => $faculty->id]) }}">
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
                        @if ($faculties->count() > 0)
                            {!! $faculties->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
