@extends('layouts.site')

@section('template_title')
    {{ __('AKBT') }}
@endsection

@section('content')
    <!-- ====== MAIN CONTENT ====== -->
    <div class="page-header border-bottom mb-8">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <div class="site-search ml-xl-0 ml-md-auto w-r-100 my-2 my-xl-0">
                    <form action="{{ route('site.andqxai', app()->getLocale()) }}" method="GET"
                          accept-charset="UTF-8" role="search" class="form-inline">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <i
                                    class="glph-icon flaticon-loupe input-group-text py-2d75 bg-white-100 border-white-100"></i>
                            </div>
                            <input
                                class="form-control bg-white-100 min-width-380 py-2d75 height-4 border-white-100"
                                type="search" placeholder="{{ __('Search by Keyword') }} ..."
                                aria-label="Search" name="keyword" value="{{$search}}">
                        </div>
                        <button class="btn btn-outline-success my-2 my-sm-0 "
                                type="submit">{{ __('Search') }}</button> |
                        <a href="{{ route('site.andqxai', app()->getLocale()) }}" class="btn btn-outline-primary my-2 my-sm-0 "
                                type="submit">{{ __('Clear') }}</a>
                        |                             <p class="woocommerce-result-count m-0"> {{__("Total")}}:
                            <b>{{number_format($paginator->total())}}</b> {{__("ta kitob")}}</p>
                    </form>
                </div>

                <h4 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">Barcha ma'lumotlar <a
                        href="https://library.andqxai.uz/#/"
                        target="_blank">{{ __('Andqxai') }}</a>dan olindi</h4>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="/" class="h-primary">{{ __('Home') }}</a>
                </nav>
            </div>
        </div>
    </div>

    <div class="site-content space-bottom-3" id="content">
        <div class="container">
            <div class="row">
                <div id="full" class="content-area order-2">
                    <!-- Tab Content -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-one-example1" role="tabpanel"
                             aria-labelledby="pills-one-example1-tab">
                            <!-- Mockup Block -->
                            <ul
                                class="products list-unstyled row no-gutters row-cols-2 row-cols-lg-3 row-cols-wd-4 border-top border-left mb-6">
                                @foreach ($paginator as $k => $book)

                                    <li class="product col">
                                        <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                            <div
                                                class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                <div class="woocommerce-loop-product__thumbnail">
                                                    <a href="https://library.andqxai.uz/#/book/{{  $book['id'] }}/view"
                                                       target="_blank"
                                                       title="{{ $book['name']}}" class="d-block">


                                                        <img src="https://library.andqxai.uz/uploads/{{$book['imageUrl']}}"
                                                             class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                             alt="{{ $book['name']}}"
                                                             title="{{ $book['name']}}">
                                                    </a>
                                                </div>
                                                <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                    <div class="text-uppercase font-size-1 mb-1 text-truncate">
                                                        <a
                                                            href="https://library.andqxai.uz/#/book/{{  $book['id'] }}/view"
                                                            target="_blank"
                                                            title="{{ $book['name']}}"> {{$book['categoryName']}} </a>
                                                    </div>
                                                    <h2
                                                        class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                        <a href="https://library.andqxai.uz/#/book/{{  $book['id'] }}/view"
                                                           target="_blank"
                                                           title="{{ $book['name']}}">{{ $book['name']}}</a>
                                                    </h2>
                                                    <div class="font-size-2  mb-1 text-truncate">
                                                        <a href="https://library.andqxai.uz/#/book/{{  $book['id'] }}/view"
                                                           target="_blank"
                                                           class="text-gray-700">
                                                            {{$book['author']}} | {{$book['year']}}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product__hover d-flex align-items-center">
                                                    <h6> {{$book['departmentName']}} </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- End Mockup Block -->
                        </div>

                    </div>
                    <!-- End Tab Content -->
                    {{ $paginator->appends(Request::all())->links('vendor.pagination.front') }}
                </div>

            </div>
        </div>
    </div>
    <!-- ====== END MAIN CONTENT ====== -->

@endsection
