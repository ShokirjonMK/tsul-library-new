@extends('layouts.site')

@section('template_title')
    {{ __('AKBT') }}
@endsection

@section('content')
    <!-- ====== MAIN CONTENT ====== -->
    <div class="page-header border-bottom mb-8">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{ __('Udc') }}</h1>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="/" class="h-primary">{{ __('Home') }}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>{{ __('Udc') }}
                </nav>
            </div>
        </div>
    </div>


    <div class="site-content space-bottom-3" id="content">
        <div class="container">
            <div class="row" style="display: block">
                <div  class="content-area order-2">
                
            <div class="ec-vendor-list card card-default">
                <div class="card-header" >
                    {{__("Number of UDCS")}}: <b> {{$udcs->total()}} ta</b>
                    <form action="{{ route('site.udcs', app()->getLocale()) }}" method="GET"
                        accept-charset="UTF-8" role="search" style="width: 100%;">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="keyword"
                                placeholder="{{ __('Keyword') }}..."
                                value="{{ $keyword }}">
                            </div>
                        </div> 
                        <div class="card-footer">
                            
                            <button type="submit"
                                class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>
                                <a href="{{ route('site.udcs', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info">{{ __('Clear') }}</a>
                                    
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

                                        <td></td>
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
    </div>
    <!-- ====== END MAIN CONTENT ====== -->
 
@endsection
