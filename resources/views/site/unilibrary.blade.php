@extends('layouts.site')

@section('template_title')
    {{ __('AKBT') }}
@endsection

@section('content')
    <!-- ====== MAIN CONTENT ====== -->
    <div class="page-header border-bottom mb-8">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg"><a href="https://unilibrary.uz/"
                                                                                        target="_blank">{{ __('Unilibrary') }}</a>.
                    Oliy ta'lim muassasalarining yagona elektron kutubxona axborot tizimi. </h1>
                <h4 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">Barcha ma'lumotlar “Unilibrary” platformasidan olindi</h4>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="/" class="h-primary">{{ __('Home') }}</a>
                    <span class="breadcrumb-separator mx-1"><i
                            class="fas fa-angle-right"></i></span>{{ __('Unilibrary') }}
                </nav>
            </div>
        </div>
    </div>

    <div class="site-content space-bottom-3" id="content">
        <div class="container">
            <div class="row">
                <div id="primary" class="content-area order-2">
                    <div
                        class="shop-control-bar d-lg-flex justify-content-between align-items-center mb-5 text-center text-md-left">
                        <div class="shop-control-bar__left mb-4 m-lg-0">
                            <p class="woocommerce-result-count m-0"> {{__("Total")}}:
                                <b>{{number_format($paginator->total())}}</b> {{__("ta kitob")}}</p>
                        </div>
                        <div class="shop-control-bar__right d-md-flex align-items-center">
                            <ul class="nav nav-tab ml-lg-4 justify-content-center justify-content-md-start ml-md-auto"
                                id="pills-tab" role="tablist">
                                <li class="nav-item border">
                                    <a class="nav-link p-0 height-38 width-38 justify-content-center d-flex align-items-center active"
                                       id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1"
                                       role="tab"
                                       aria-controls="pills-one-example1" aria-selected="true">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             width="17px" height="17px">
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M-0.000,0.000 L3.000,0.000 L3.000,3.000 L-0.000,3.000 L-0.000,0.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M7.000,0.000 L10.000,0.000 L10.000,3.000 L7.000,3.000 L7.000,0.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M14.000,0.000 L17.000,0.000 L17.000,3.000 L14.000,3.000 L14.000,0.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M-0.000,7.000 L3.000,7.000 L3.000,10.000 L-0.000,10.000 L-0.000,7.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M7.000,7.000 L10.000,7.000 L10.000,10.000 L7.000,10.000 L7.000,7.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M14.000,7.000 L17.000,7.000 L17.000,10.000 L14.000,10.000 L14.000,7.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M-0.000,14.000 L3.000,14.000 L3.000,17.000 L-0.000,17.000 L-0.000,14.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M7.000,14.000 L10.000,14.000 L10.000,17.000 L7.000,17.000 L7.000,14.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M14.000,14.000 L17.000,14.000 L17.000,17.000 L14.000,17.000 L14.000,14.000 Z"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="nav-item border">
                                    <a class="nav-link p-0 height-38 width-38 justify-content-center d-flex align-items-center"
                                       id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1"
                                       role="tab"
                                       aria-controls="pills-two-example1" aria-selected="false">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             width="23px" height="17px">
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M-0.000,0.000 L3.000,0.000 L3.000,3.000 L-0.000,3.000 L-0.000,0.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M7.000,0.000 L23.000,0.000 L23.000,3.000 L7.000,3.000 L7.000,0.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M-0.000,7.000 L3.000,7.000 L3.000,10.000 L-0.000,10.000 L-0.000,7.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M7.000,7.000 L23.000,7.000 L23.000,10.000 L7.000,10.000 L7.000,7.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M-0.000,14.000 L3.000,14.000 L3.000,17.000 L-0.000,17.000 L-0.000,14.000 Z"/>
                                            <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                                  d="M7.000,14.000 L23.000,14.000 L23.000,17.000 L7.000,17.000 L7.000,14.000 Z"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>


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
                                                    <a href="https://unilibrary.uz/literature/{{  $book['id'] }}" target="_blank"
                                                       title="{{ $book['name']}}" class="d-block">
                                                        <img src="/book_no_photo.jpg"
                                                             class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                             alt="{{ $book['name']}}"
                                                             title="{{ $book['name']}}">
                                                    </a>
                                                </div>
                                                <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                    <div class="text-uppercase font-size-1 mb-1 text-truncate"><a
                                                            href="https://unilibrary.uz/literature/{{  $book['id'] }}" target="_blank"
                                                            title="{{ $book['name']}}">{{ $book['resource_type_name']}}</a>
                                                    </div>
                                                    <h2
                                                        class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                        <a href="https://unilibrary.uz/literature/{{  $book['id'] }}" target="_blank"
                                                           title="{{ $book['name']}}">{{ $book['name']}}</a>
                                                    </h2>
                                                    <div class="font-size-2  mb-1 text-truncate">
                                                            <a href="https://unilibrary.uz/literature/{{  $book['id'] }}" target="_blank"
                                                               class="text-gray-700">
                                                                {{ $book['authors'] }},
                                                            </a>
                                                    </div>
                                                </div>
                                                <div class="product__hover d-flex align-items-center">
                                                    <h6>{{$book['resource_field_name']}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- End Mockup Block -->
                        </div>
                        <div class="tab-pane fade" id="pills-two-example1" role="tabpanel"
                             aria-labelledby="pills-two-example1-tab">
                            <!-- Mockup Block -->
                            <ul class="products list-unstyled mb-6">
                                @foreach ($paginator as $k => $book)

                                    <li class="product product__list">
                                        <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                            <div
                                                class="woocommerce-LoopProduct-link woocommerce-loop-product__link row position-relative">
                                                <div
                                                    class="col-md-auto woocommerce-loop-product__thumbnail mb-3 mb-md-0">
                                                    <a href="https://unilibrary.uz/literature/{{  $book['id'] }}" target="_blank"
                                                       title="{{ $book['name']}}" class="d-block">
                                                        <img src="/book_no_photo.jpg"
                                                             class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                             alt="{{ $book['name']}}"
                                                             title="{{ $book['name']}}"
                                                             style="max-width: 300px;">
                                                    </a>
                                                </div>
                                                <div
                                                    class="col-md woocommerce-loop-product__body product__body pt-3 bg-white mb-3 mb-md-0">
                                                    <div class="text-uppercase font-size-1 mb-1 text-truncate">
                                                        <a href="https://unilibrary.uz/literature/{{  $book['id'] }}" target="_blank"
                                                           title="{{ $book['name']}}">{{ $book['resource_type_name'] }}</a>
                                                    </div>
                                                    <h2
                                                        class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 crop-text-2 h-dark">
                                                        <a href="https://unilibrary.uz/literature/{{  $book['id'] }}" target="_blank"
                                                           title="{{ $book['name']}}"
                                                           tabindex="{{$k}}">{{ $book['name']}}</a>
                                                    </h2>
                                                    <div class="font-size-2  mb-2 text-truncate">
                                                        <a href="https://unilibrary.uz/literature/{{  $book['id'] }}" target="_blank"
                                                           class="text-gray-700">
                                                            {{$book['authors']}}
                                                        </a>

                                                    </div>
                                                    <p class="font-size-2 mb-2 crop-text-2">{{$book['abstract_name']}}</p>
                                                    <div
                                                        class="price d-flex align-items-center font-weight-medium font-size-3">
<span class="woocommerce-Price-amount amount"><span
        class="woocommerce-Price-currencySymbol"></span></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-auto d-flex align-items-center">

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
                <div id="secondary" class="sidebar widget-area order-1" role="complementary">
                    <div id="widgetAccordion">
                        @if ($resourceTypes != null && count($resourceTypes) > 0)
                            <div id="woocommerce_product_categories-2"
                                 class="widget p-4d875 border woocommerce widget_product_categories">
                                <div id="widgetHeadingOne" class="widget-head">
                                    <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                       data-toggle="collapse" data-target="#widgetCollapseOne" aria-expanded="true"
                                       aria-controls="widgetCollapseOne">

                                        <h3 class="widget-title mb-0 font-weight-medium font-size-3">
                                            {{ __('All Book Types') }}</h3>

                                        <svg class="mins" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="2px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)"
                                                  d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z"/>
                                        </svg>

                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)"
                                                  d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z"/>
                                        </svg>
                                    </a>
                                </div>

                                <div id="widgetCollapseOne" class="mt-3 widget-content collapse show"
                                     aria-labelledby="widgetHeadingOne" data-parent="#widgetAccordion">
                                    <ul class="product-categories">
                                        @foreach ($resourceTypes as $item)
                                            <li class="cat-item cat-item-9 cat-parent">
                                                <a href="{{ url(app()->getLocale() . '/unilibrary') }}/?resource_type_id={{ $item['id'] }}&page={{$page}} "
                                                   @if ($item['id'] == $resource_type_id) style="color: #f75454;" @endif>{{ $item['name'] }}  </a>
                                            </li>
                                        @endforeach
                                        <li class="cat-item cat-item-9 cat-parent">
                                            <a href="{{ url(app()->getLocale() . '/unilibrary') }}/">{{__("All")}}  </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== END MAIN CONTENT ====== -->

@endsection
