@extends('layouts.app')

@section('template_title')
    {{ $udc->name ?? __('Show') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Udc') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/udcs') }}">{{ __('Udc') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
                </p>
            </div>
            <div>
                <a href="{{ url(app()->getLocale() . '/admin/udcs') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <strong>{{ __('Udc Number') }}:</strong>
                                {{ $udc->udc_number }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Description') }}:</strong>
                                {{ $udc->description }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Number Of Codes') }}:</strong>
                                {{ $udc->number_of_codes }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Notes') }}:</strong>
                                {{ $udc->notes }}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Parent') }}:</strong>
                                {!! $udc->parent ? $udc->parent->udc_number : '' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Created By') }}:</strong>
                                {!! $udc->created_by ? $udc->createdBy->name : '' !!}
                            </div>
                            <div class="form-group">
                                <strong>{{ __('Updated By') }}:</strong>
                                {!! $udc->updated_by ? $udc->updatedBy->name : '' !!}
                            </div>
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>{{ __('Udc Number') }}</th>
                                        <th>{{ __('Description') }}</th>
                                        <th>{{ __('Number Of Codes') }}</th>
                                        <th>{{ __('Notes') }}</th>
                                        <th>{{ __('Parent') }}</th>


                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($udc->subcategory))
                                        {{-- @include('layouts.partials.subCategoryView') --}}
                                        @include('layouts.partials.subCategoryView', [
                                            'subcategories' => $udc->subcategory,
                                            'dataParent' => $udc->id,
                                            'dataLevel' => 1,
                                            'show'=>false,
                                        ])
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
