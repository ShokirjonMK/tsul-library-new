@extends('layouts.app')

@section('template_title')
    {{ __('Scientific publications') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>{{ __('Scientific publications') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Scientific publications') }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">

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
                                        <form action="{{ route('admin.readerdis', app()->getLocale()) }}" method="GET" accept-charset="UTF-8" role="search">

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
                                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Search') }}</button>

                                                <a href="{{ route('admin.readerdis', app()->getLocale()) }}" class="btn btn-sm btn-info  float-right">{{ __('Clear') }}</a>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <br>
                                {!! __('Number of bibliographic records is :attribute', ['attribute' => $scientificPublications->total()]) !!}
                            </div>
                        </div>
                    </div>



                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Authors') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Keywords') }}</th>
                                    <th>{{ __('Published Year') }}</th>
                                    <th>{{ __('Resource language') }}</th>
                                    <th>{{ __('Resource Type') }}</th>
                                    <th>{{ __('Resource Field') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Image') }}</th>

                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($scientificPublications as $scientificPublication)
                                    <tr>
                                        <td>{{ ++$i }}</td>

                                        <td>{{ $scientificPublication->title }}</td>
                                        <td>{{ $scientificPublication->authors }}</td>
                                        <td>{{ $scientificPublication->description }}</td>
                                        <td>{{ $scientificPublication->keywords }}</td>
                                        <td>{{ $scientificPublication->publication_year }}</td>
                                        <td>
                                            {!! $scientificPublication->resTypeLang ? $scientificPublication->resTypeLang->title : '' !!}
                                        </td>
                                        <td>
                                            {!! $scientificPublication->resType ? $scientificPublication->resType->title : '' !!}
                                        </td>
                                        <td>
                                            {!! $scientificPublication->resField ? $scientificPublication->resField->title : '' !!}
                                        </td>
                                        <td>
                                            @if($scientificPublication->key=='abstract')
                                                {{ __('Abstract') }}
                                            @endif
                                            @if($scientificPublication->key=='dissertation')
                                                {{ __('Dissertation') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($scientificPublication->image_path)
                                                <img src="{{ asset('/storage/scientificPublications/photo/' . $scientificPublication->image_path) }}"
                                                     width="100px">
                                            @endif
                                        </td>
                                        <td>

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
