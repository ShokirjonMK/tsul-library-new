@extends('layouts.app')

@section('template_title')
    {{ __('Udc') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Udc') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Udc') }}
            </p>
        </div>
        <div>
            <a href="{{ route('udcs.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create') }}  
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-header" >
                    {{__("Number of UDCS")}}: <b> {{$udcs->total()}} ta</b>
                    <form action="{{ route('udcs.index', app()->getLocale()) }}" method="GET"
                        accept-charset="UTF-8" role="search" style="width: 100%;">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="keyword"
                                placeholder="{{ __('Keyword') }}..."
                                value="{{ $keyword }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('udcs.index', app()->getLocale()) }}"
                                class="btn btn-sm btn-info">{{ __('Clear') }}</a>
                            <button type="submit"
                                class="btn btn-sm btn-primary float-right">{{ __('Search') }}</button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    
										<th>{{__('Udc Number')}}</th>
										<th>{{__('Description')}}</th>
										<th>{{__('Number Of Codes')}}</th>
										<th>{{__('Notes')}}</th>
										<th>{{__('Parent')}}</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($udcs as $udc)
                                    <tr>
                                        <td>{{ $udc->id }}</td>
                                        
											<td>{{ $udc->udc_number }}</td> 
											<td>{{ $udc->description }}</td>
											<td>{{ $udc->number_of_codes }}</td>
											<td>{{ $udc->notes }}</td>
											<td>{!! $udc->parent ? $udc->parent->udc_number : '' !!}</td> 
 
                                        <td>
                                            <form action="{{ route('udcs.destroy',[app()->getLocale(), $udc->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('udcs.show', [app()->getLocale(), $udc->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('udcs.edit', [app()->getLocale(), $udc->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @if(count($udc->subcategory))
                                        {{-- @include('layouts.partials.subCategoryView') --}}
                                        @include('layouts.partials.subCategoryView',['subcategories' => $udc->subcategory, 'dataParent' => $udc->id , 'dataLevel' => 1, 'show'=>false])
                                    @endif
                                @endforeach                                    
                            </tbody>
                        </table>
                    </div>
                    @if ($udcs->count() > 0)
                        {!! $udcs->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
