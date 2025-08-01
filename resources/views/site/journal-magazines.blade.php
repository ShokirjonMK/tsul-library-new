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

                <div   class="content-area order-2">
                    @if ($magazines != null && $magazines->count() > 0)
                        <div
                            class="shop-control-bar d-lg-flex justify-content-between align-items-center mb-5 text-center text-md-left">
                            <div class="shop-control-bar__left mb-4 m-lg-0">
                                {{-- <p class="woocommerce-result-count m-0">Showing 1–12 of 126 results</p> --}}
                            </div>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-one-example1" role="tabpanel"
                                aria-labelledby="pills-one-example1-tab">
                                <!-- Mockup Block -->
                                <ul
                                    class="products list-unstyled row no-gutters row-cols-2 row-cols-lg-3 row-cols-wd-5 border-top border-left mb-6">
                                    @foreach ($magazines as $k => $magazine)
                                        <li class="product col">
                                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                                <div
                                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                    <div class="woocommerce-loop-product__thumbnail">
                                                        <a href="{{ url(app()->getLocale() . '/journals/' . $journal->slug . '/' . $magazine->slug) }}"
                                                            title="{{ $magazine->title }}" class="d-block">
                                                            @if ($magazine->image_path)
                                                                <img src="/storage/magazineIssues/photo/{{ $magazine->image_path }}"
                                                                    class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                    alt="{{ $magazine->title }}"
                                                                    title="{{ $magazine->title }}">
                                                            @else
                                                                <img src="/book_no_photo.jpg"
                                                                    class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                    alt="{{ $magazine->title }}"
                                                                    title="{{ $magazine->title }}">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                        {{-- <div class="text-uppercase font-size-1 mb-1 text-truncate"><a
                                                                href="{{ url(app()->getLocale() . '/journals/' . $magazine->slug) }}"
                                                                title="{{ $magazine->title }}">{{ $magazine->booksType->title }}</a>
                                                        </div> --}}
                                                        <h2
                                                            class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                            <a href="{{ url(app()->getLocale() . '/journals/' . $journal->slug . '/' . $magazine->slug) }}"
                                                                title="{{ $magazine->title }}">{{ $magazine->title }}</a>
                                                        </h2>
                                                        <div class="font-size-2  mb-1 text-truncate">
                                                            {{ $magazine->published_year }}-{{ $magazine->fourth_number }}
                                                        </div>
                                                    </div>
                                                    <div class="product__hover d-flex align-items-center">
                                                        <a href="{{ url(app()->getLocale() . '/journals/' . $journal->slug . '/' . $magazine->slug) }}"
                                                            class="text-uppercase text-dark h-dark font-weight-medium mr-auto"
                                                            data-toggle="tooltip" data-placement="right"
                                                            title="{{ $magazine->published_year }}-{{ $magazine->fourth_number }}"
                                                            data-original-title="{{ $magazine->published_year }}-{{ $magazine->fourth_number }}"
                                                            title="{{ $journal->title }}-{{ $magazine->published_year }}-{{ $magazine->fourth_number }}">
                                                            <span
                                                                class="product__add-to-cart">{{ $magazine->published_year }}-{{ $magazine->fourth_number }}
                                                            </span>
                                                            <span class="product__add-to-cart-icon font-size-4"><i
                                                                    class="flaticon-icon-126515"></i>{{ $magazine->published_year }}-{{ $magazine->fourth_number }}</span>
                                                        </a>
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


                        @if ($magazines->count() > 0)
                        {!! $magazines->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                    @endif
                    <div class="tab-content" id="pills-tabContent1">
                        <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9 show active"
                            id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">
                            <!-- Mockup Block -->
                            <div class="table-responsive mb-4">
                                <div class="form-group">
                                    <strong>{{ __('Organization') }}:</strong>
                                    {!! $journal->organization_id ? $journal->organization->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Title') }}:</strong>
                                    {{ $journal->title }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('ISSN') }}:</strong>
                                    {{ $journal->ISSN }}
                                </div>
    
                                <div class="form-group">
                                    <strong>{{ __('Phone Number') }}:</strong>
                                    {{ $journal->phone_number }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Subjects') }}:</strong>
                                    @php
                                        if($journal->subjects!="null"){
                                            foreach (json_decode($journal->subjects) as $key => $value) {
                                                echo  (\App\Models\BookSubject::GetById($value))?\App\Models\BookSubject::GetById($value)->title.', ':'';
                                            }
                                        }
                                    @endphp
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Fax') }}:</strong>
                                    {{ $journal->fax }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Email') }}:</strong>
                                    {{ $journal->email }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Website') }}:</strong>
                                    {{ $journal->website }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('editor_in_chiefs') }}:</strong>
                                    {{ $journal->editor_in_chiefs }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('editorial_members') }}:</strong>
                                    @php
                                        if($journal->editorial_members){
                                            foreach (json_decode($journal->editorial_members) as $key => $value) {
                                                echo  (\App\Models\Author::GetById($value))?\App\Models\Author::GetById($value)->title.', ':'';
                                            }
                                        }
                                    @endphp
                                </div>
    
                                <div class="form-group">
                                    <strong>{{ __('Image') }}:</strong>
                                    @if ($journal->image_path)
                                        <img src="{{ asset('/storage/journals/photo/' . $journal->image_path) }}"
                                            width="100px">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Books Type') }}:</strong>
                                    {!! $journal->booksType ? $journal->booksType->title : '' !!}
    
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Book Text') }}:</strong>
                                    {!! $journal->bookText ? $journal->bookText->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Book Text Type') }}:</strong>
                                    {!! $journal->bookTextType ? $journal->bookTextType->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Book Access Type') }}:</strong>
                                    {!! $journal->bookAccessType ? $journal->bookAccessType->title : '' !!}
                                </div>
    
                                <hr>
                                {!! $journal->body !!}
                            </div>
                            <!-- End Mockup Block -->
                        </div>
                    </div>
                </div>



                <div id="secondary" class="sidebar widget-area order-1" role="complementary">

                    <div id="widgetAccordion">


                        {{-- @if ($bookSubjects != null && $bookSubjects->count() > 0)
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
                        @endif --}}
                        {{-- @if ($journalLanguages != null && $journalLanguages->count() > 0)
                            <div id="Language" class="widget p-4d875 border">
                                <div id="widgetHeading22" class="widget-head">
                                    <a class="d-flex align-items-center justify-content-between text-dark" href="#"
                                        data-toggle="collapse" data-target="#widgetCollapse22" aria-expanded="true"
                                        aria-controls="widgetCollapse22">

                                        <h3 class="widget-title mb-0 font-weight-medium font-size-3">{{ __('All Book Languages') }}</h3>

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

                                <div id="widgetCollapse22" class="mt-4 widget-content collapse show"
                                    aria-labelledby="widgetHeading22" data-parent="#widgetAccordion">
                                    <ul class="product-categories">
                                        @foreach ($journalLanguages as $item)
                                            <li class="cat-item cat-item-9 cat-parent">
                                                <a
                                                    href="{{ url(app()->getLocale() . '/books') }}/?type={{ $type }}&language={{ $item->id }}">{{ $item->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif --}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
