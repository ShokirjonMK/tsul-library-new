@extends('layouts.app')

@section('template_title')
    {{ __('Unilibrary') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Unilibrary') }}</h1>
                <p class="breadcrumbs"><span><a
                                href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Unilibrary') }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">


            </div>
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                                    <div class="card-header">
                                        <div class="accordion" id="accordionExample" style="width: 100%;">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        {{ __('Advanced search') }}
                                                    </button>
                                                </h2>
                                                <div id="collapseOne"
                                                    class="accordion-collapse collapse  @if ($show_accardion) show @endif"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <form action="{{ route('unilibrary.index', app()->getLocale()) }}" method="GET"
                                                            accept-charset="UTF-8" role="search">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="hidden" class="form-control " name="muallif" id="muallif" value="{{ $muallif }}"/>
                                                                    <input type="hidden" class="form-control " name="title" id="title" value="{{ $title }}" />
                                                                    @if (count($resourceTypes) > 0)
                                                                        <div class="form-group">
                                                                            {!! Form::label('book_types', __('Books Type')) !!} :
                                                                            <br>
                                                                            <select class="form-select" id="resource_type_id" name="resource_type_id">
                                                                                <option value=0 >{{ __("Choose") }}</option>
                                                                                @foreach($resourceTypes as $k=>$v)
                                                                                    <option value='{{$v['id']}}'
                                                                                            @if($resource_type_id==$v['id']) SELECTED @endif

                                                                                    >{{ $v['name'] }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="card-footer">
                                                                <button type="submit" class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>
                                                                <a href="{{ route('unilibrary.index', app()->getLocale()) }}" class="btn btn-sm btn-info float-right">{{ __('Clear') }}</a>
                                                            </div>
                                                            <br>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <br>
                                                {!!__("Number of books is :attribute",['attribute' => number_format($paginator->total()) ])!!}
                                            </div>
                                        </div>
                                    </div>


                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('IsActive') }}</th>
                                    <th>{{ __('Dc Title') }}</th>
                                    <th>{{ __('Dc Authors') }}</th>
                                    <th width="280px">{{ __('Action') }}</th>
                                </tr>
                                </thead>

                                <tbody>
                                <form action="{{ route('unilibrary.index', app()->getLocale()) }}" method="GET"
                                      accept-charset="UTF-8" role="search">
                                    <tr>
                                        <th colspan="2"></th>
                                        <th>
                                            <div class="form-group" style="width: 200px">
                                                <input type="text" class="form-control " name="title"
                                                       id="title" value="{{ $title }}"
                                                       placeholder="{{ __('Dc Title') }}" />
                                            </div>
                                        </th>
                                        <th>

                                            <input type="hidden" id="resource_type_id" name="resource_type_id" value="{{$resource_type_id}}">
{{--                                            <input type="text" name="page" id="page" value="{{$page}}">--}}
                                            <div class="form-group">
                                                <input type="text" class="form-control " name="muallif" id="muallif" value="{{ $muallif }}" placeholder="{{ __('Authors') }}" />
                                            </div>

                                        </th>
                                        <th>
                                            <div class="input-group">
                                                <a href="{{ route('unilibrary.index', app()->getLocale()) }}"
                                                   class="btn btn-sm btn-info">{{ __('Clear') }}</a>
                                                <button type="submit"
                                                        class="btn btn-sm btn-primary float-right">{{ __('Search') }}</button>
                                            </div>
                                        </th>
                                    </tr>
                                </form>
                                @foreach ($paginator->items()  as $key => $book)
                                    <tr>
                                        <td>{{$book['id']}}</td>
                                        <td> {!! $book['status'] == "active"
                                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!} </td>
                                        <td>{{$book['name']}}</td>
                                        <td>{{$book['authors']}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-success"
                                               href="{{ route('unilibrary.edit', [app()->getLocale(), $book['id']]) }}">
                                                {{ __('Add to catalogue') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $paginator->appends(Request::all())->links('vendor.pagination.default') }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
