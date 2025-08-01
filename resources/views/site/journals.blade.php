@extends('layouts.site')

@section('template_title')
    {{ __('AKBT') }}
@endsection

@section('content')
    <!-- ====== MAIN CONTENT ====== -->
    <div class="page-header border-bottom mb-8">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{ __('Journals') }}</h1>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="/" class="h-primary">{{ __('Home') }}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>{{ __('Journals') }}
                </nav>
            </div>
        </div>
    </div>

    <div class="site-content space-bottom-3" id="content">
        <div class="container">
            <div class="row">
                <div id="primary" class="content-area order-2">
                    @if ($journals != null && $journals->count() > 0)
                        <div
                            class="shop-control-bar d-lg-flex justify-content-between align-items-center mb-5 text-center text-md-left">
                            <div class="shop-control-bar__left mb-4 m-lg-0">
                                <p class="woocommerce-result-count m-0"> {{ __('Total') }}:
                                    <b>{{ $journals->total() }}</b> {{ __('ta jurnallar') }}</p>
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-one-example1" role="tabpanel"
                                aria-labelledby="pills-one-example1-tab">
                                <!-- Mockup Block -->
                                <ul
                                    class="products list-unstyled row no-gutters row-cols-2 row-cols-lg-3 row-cols-wd-5 border-top border-left mb-6">
                                    @foreach ($journals as $k => $journal)
                                        <li class="product col">
                                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                                <div
                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                    <div class="woocommerce-loop-product__thumbnail">
                                                        <a href="{{ url(app()->getLocale() . '/journals/' . $journal->slug) }}"
                                                            title="{{ $journal->title }}" class="d-block">
                                                            @if ($journal->image_path)
                                                                <img src="/storage/journals/photo/{{ $journal->image_path }}"
                                                                    class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                    alt="{{ $journal->title }}"
                                                                    title="{{ $journal->title }}">
                                                            @else
                                                                <img src="/book_no_photo.jpg"
                                                                    class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                    alt="{{ $journal->title }}"
                                                                    title="{{ $journal->title }}">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                        <div class="text-uppercase font-size-1 mb-1 text-truncate"><a
                                                                href="{{ url(app()->getLocale() . '/journals/' . $journal->slug) }}"
                                                                title="{{ $journal->title }}">{{ $journal->booksType->title }}</a>
                                                        </div>
                                                        <h2
                                                            class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                            <a href="{{ url(app()->getLocale() . '/journals/' . $journal->slug) }}"
                                                                title="{{ $journal->title }}">{{ $journal->title }}</a>
                                                        </h2>
                                                        <div class="font-size-2  mb-1 text-truncate">

                                                        </div>
                                                    </div>
                                                    <div class="product__hover d-flex align-items-center">
                                                        {{-- <a href="#"
                                                            class="text-uppercase text-dark h-dark font-weight-medium mr-auto"
                                                            data-toggle="tooltip" data-placement="right" title=""
                                                            data-original-title="{{ __('ADD TO CART') }}"
                                                            title="{{ $journal->title }}">
                                                            <span
                                                                class="product__add-to-cart">{{ __('ADD TO CART') }}</span>
                                                            <span class="product__add-to-cart-icon font-size-4"><i
                                                                    class="flaticon-icon-126515"></i></span>
                                                        </a> --}}

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
                        @if ($journals->count() > 0)
                            {!! $journals->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    @else
                        <div class="tab-content" id="pills-tabContent1">
                            <h1>{{ __('Nothing found') }}</h1>
                        </div>
                    @endif
                </div>
            
                <div id="secondary" class="sidebar widget-area order-1" role="complementary">
                    <div id="widgetAccordion">
                        @if ($bookSubjects != null && $bookSubjects->count() > 0)
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
                                                d="M0.000,-0.000 L15.000,-0.000 L15.000,2.000 L0.000,2.000 L0.000,-0.000 Z" />
                                        </svg>

                                        <svg class="plus" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="15px">
                                            <path fill-rule="evenodd" fill="rgb(22, 22, 25)"
                                                d="M15.000,8.000 L9.000,8.000 L9.000,15.000 L7.000,15.000 L7.000,8.000 L0.000,8.000 L0.000,6.000 L7.000,6.000 L7.000,-0.000 L9.000,-0.000 L9.000,6.000 L15.000,6.000 L15.000,8.000 Z" />
                                        </svg>
                                    </a>
                                </div>

                                <div id="widgetCollapseOne" class="mt-3 widget-content collapse show"
                                    aria-labelledby="widgetHeadingOne" data-parent="#widgetAccordion">
                                    <ul class="product-categories">
                                        @foreach ($bookSubjects as $item)
                                            <li class="cat-item cat-item-9 cat-parent">
                                                <a
                                                    href="{{ url(app()->getLocale() . '/journals') }}/?type={{ $item->id }}">{{ $item->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
