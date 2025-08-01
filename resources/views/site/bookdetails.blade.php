@extends('layouts.site')

@section('template_title')
    {{ __('AKBT') }}
@endsection

@section('content')
    <!-- ====== MAIN CONTENT ====== -->
    <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{ $book->dc_title }}</h1>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="/" class="h-primary">{{ __('Home') }}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="{{ url(app()->getLocale() . '/books') }}" class="h-primary">{{ __('Books') }}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>{{ $book->dc_title }}
                </nav>
            </div>
        </div>
    </div>
    <div class="site-content" id="content">
        <div class="container">
            <div class="row  space-top-2">
                <div class="content-area">
                    <main id="main" class="site-main ">
                        <div class="product">
                            <div class="container">
                                <div class="row">
                                    <div
                                        class="col-lg-5 woocommerce-product-gallery woocommerce-product-gallery--with-images images">
                                        <figure class="woocommerce-product-gallery__wrapper mb-0">
                                            <div class="js-slick-carousel u-slick"
                                                data-pagi-classes="text-center u-slick__pagination my-4">
                                                <div class="js-slide">
                                                    @if ($book->image_path)
                                                        <img src="/storage/{{ $book->image_path }}"
                                                            class="mx-auto img-fluid" alt="{{ $book->dc_title }}"
                                                            title="{{ $book->dc_title }}">
                                                    @else
                                                        <img src="/book_no_photo.jpg" class="mx-auto img-fluid"
                                                            alt="{{ $book->dc_title }}" title="{{ $book->dc_title }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-lg-7 pl-lg-0 summary entry-summary">
                                        <div class="px-lg-4 px-xl-6">
                                            <h1 class="product_title entry-title font-size-7 mb-3">{{ $book->dc_title }}
                                            </h1>
                                            <div class="font-size-2 mb-4">
                                                <span class="ml-3 font-weight-medium">{{ __('Dc Authors') }}</span>
                                                @if ($book->dc_authors)
                                                    @foreach (json_decode($book->dc_authors) as $author)
                                                        {{-- <a href="{{ url(app()->getLocale() . '/authors/' . $author->slug) }}" class="text-gray-700"> --}}
                                                        <span class="ml-2 text-gray-600"> {{ $author }},</span>
                                                        {{-- </a> --}}
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="woocommerce-product-details__short-description font-size-2 mb-4">
                                                <p class="">{{ $book->dc_description }}
                                                </p>
                                            </div>

                                            <div class="table-responsive mb-4">
                                                <table class="table table-hover table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Book Subject') }}: </th>
                                                            <td class="">
                                                                @if ($book->dc_subjects != "null" && $book->dc_subjects != null)
                                                                    | @foreach (json_decode($book->dc_subjects) as $key => $value)
                                                                        {{ $value }} |
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Dc UDK') }}</th>
                                                            <td>{{ $book->dc_UDK }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Dc Publisher') }}: </th>
                                                            <td>{{ $book->dc_publisher }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Dc Published City') }}:
                                                            </th>
                                                            <td> {{ $book->dc_published_city }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('ISBN') }}:</th>
                                                            <td>{{ $book->ISBN }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Dc Date') }}:</th>
                                                            <td>{{ $book->dc_date }} {{ __('Year') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Betlar Soni') }}:</th>
                                                            <td>{{ $book->betlar_soni }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            {{-- <button type="submit" name="add-to-cart" value="7145" class="btn btn-dark border-0 rounded-0 p-3 btn-block ml-md-4 single_add_to_cart_button button alt">{{ __('ADD TO CART') }}</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Features Section -->
                            <div class="woocommerce-tabs wc-tabs-wrapper mb-10 row">
                                <!-- Nav Classic -->
                                <ul class="col-lg-4 col-xl-3 pt-9 border-top d-lg-block tabs wc-tabs nav justify-content-lg-center flex-nowrap flex-lg-wrap overflow-auto overflow-lg-visble"
                                    id="pills-tab" role="tablist">
                                    <li class="flex-shrink-0 flex-lg-shrink-1 nav-item mb-3">
                                        <a class="py-1 d-inline-block nav-link font-weight-medium active"
                                            id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1"
                                            role="tab" aria-controls="pills-one-example1" aria-selected="true">
                                            {{ __('Book Details') }}
                                        </a>
                                    </li>
                                </ul>
                                <!-- End Nav Classic -->
                                <!-- Tab Content -->
                                <div class="tab-content col-lg-8 col-xl-9 border-top" id="pills-tabContent">
                                    <div class="woocommerce-Tabs-panel panel entry-content wc-tab tab-pane fade border-left pl-4 pt-4 pl-lg-6 pt-lg-6 pl-xl-9 pt-xl-9 show active"
                                        id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab">
                                        <!-- Mockup Block -->
                                        <div class="table-responsive mb-4">
                                            <table class="table table-hover table-borderless">
                                                <tbody>

                                                    @if ($book->dc_source)
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Dc Source') }}:</th>
                                                            <td> <a href="{{ $book->dc_source }}"
                                                                    target="__blank">{{ __('Download') }}</a></td>
                                                        </tr>
                                                    @endif


                                                    @if ($book->full_text_path && !Auth::guest())
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Book file') }}:</th>
                                                            <td>

                                                                @if ($book->file_format=='pdf')
                                                                <a href="{{ url(app()->getLocale() . '/books/' . $book->id) }}/pdf"
                                                                    target="__blank">{{ __('Download') }}</a>
                                                                @else
                                                                <a href="/storage/{{ $book->full_text_path }}"
                                                                    target="__blank">{{ __('Download') }}</a>
                                                                @endif
                                                                    
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <th class="px-4 px-xl-5 text-danger">To‘liq matnni ko‘chirib olish uchun kutubxonaga a'zo bo‘lish shart</th>
                                                            <td></td>
                                                        </tr>
                                                    @endif
                                                    @if ($book->file_format)
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('File Format') }}:</th>
                                                            <td>{{ $book->file_format }}</td>
                                                        </tr>
                                                    @endif
                                                    @if ($book->file_format_type)
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('File Format Type') }}:</th>
                                                            <td>{{ $book->file_format_type }}</td>
                                                        </tr>
                                                    @endif

                                                    @if ($book->file_size)
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('File Size') }}:</th>
                                                            <td>{{ number_format($book->file_size / 1024 / 1024, 2, '.', '') }}
                                                                MB</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <th class="px-4 px-xl-5">{{ __('Books Type') }}:</th>
                                                        <td>{!! $book->books_type_id ? $book->booksType->title : '' !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-4 px-xl-5">{{ __('Book Language') }}:</th>
                                                        <td>{!! $book->book_language_id ? $book->bookLanguage->title : '' !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-4 px-xl-5">{{ __('Book Text') }}:</th>
                                                        <td> {!! $book->book_text_id ? $book->bookText->title : '' !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-4 px-xl-5">{{ __('Book Text Type') }}:</th>
                                                        <td> {!! $book->book_text_type_id ? $book->bookTextType->title : '' !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-4 px-xl-5">{{ __('Book Access Type') }}:</th>
                                                        <td>{!! $book->book_access_type_id ? $book->bookAccessType->title : '' !!}</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- End Mockup Block -->
                                        {!! QrCode::size(200)->generate(URL::current()); !!}

                                    </div>
                                </div>
                                <!-- End Tab Content -->
                            </div>
                            <!-- End Features Section -->
                        </div>
                    </main>
                </div>
            </div>
            @if ($books != null && $books->count() > 0)
                <section class="space-bottom-3">
                    <div class="container">
                        <header class="mb-5 d-md-flex justify-content-between align-items-center">
                            <h2 class="font-size-7 mb-3 mb-md-0">{{ __('Book-related books') }}</h2>
                        </header>

                        <div class="js-slick-carousel products no-gutters border-top border-left border-right"
                            data-arrows-classes="u-slick__arrow u-slick__arrow-centered--y"
                            data-arrow-left-classes="fas fa-chevron-left u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-n10"
                            data-arrow-right-classes="fas fa-chevron-right u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-n10"
                            data-slides-show="5" data-responsive='[{
                                               "breakpoint": 1500,
                                               "settings": {
                                                 "slidesToShow": 4
                                               }
                                            },{
                                               "breakpoint": 1199,
                                               "settings": {
                                                 "slidesToShow": 3
                                               }
                                            }, {
                                               "breakpoint": 992,
                                               "settings": {
                                                 "slidesToShow": 2
                                               }
                                            }, {
                                               "breakpoint": 554,
                                               "settings": {
                                                 "slidesToShow": 2
                                               }
                                            }]'>
                            @foreach ($books as $item)
                                <div class="product">
                                    <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                        <div
                                            class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                            <div class="woocommerce-loop-product__thumbnail">
                                                <a href="{{ url(app()->getLocale() . '/books/' . $item->id) }}"
                                                    class="d-block">
                                                    @if ($item->image_path)
                                                        <img src="/storage/{{ $item->image_path }}"
                                                            class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                            alt="{{ $item->dc_title }}">
                                                    @else
                                                        <img src="/book_no_photo.jpg"
                                                            class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                            alt="{{ $book->dc_title }}" title="{{ $book->dc_title }}">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                <div class="text-uppercase font-size-1 mb-1 text-truncate"><a
                                                        href="{{ url(app()->getLocale() . '/books/' . $item->id) }}">{{ $item->booksType->title }}</a>
                                                </div>
                                                <h2
                                                    class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                    <a
                                                        href="{{ url(app()->getLocale() . '/books/' . $item->id) }}">{{ $item->dc_title }}</a>
                                                </h2>

                                                <div class="font-size-2  mb-1 text-truncate">
                                                    @if ($item->dc_authors)
                                                        @foreach (json_decode($item->dc_authors) as $author)
                                                            {{-- <a href="{{ url(app()->getLocale() . '/authors/' . $author->slug) }}" class="text-gray-700"> --}}
                                                            {{ $author }},
                                                            {{-- </a> --}}
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="price d-flex align-items-center font-weight-medium font-size-3">

                                                </div>
                                            </div>
                                            <div class="product__hover d-flex align-items-center">
                                                <a href="#"
                                                    class="text-uppercase text-dark h-dark font-weight-medium mr-auto">
                                                    <span class="product__add-to-cart">{{ __('ADD TO CART') }}</span>
                                                    <span class="product__add-to-cart-icon font-size-4"><i
                                                            class="flaticon-icon-126515"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </section>
            @endif


        </div>
    </div>
    <!-- ====== END MAIN CONTENT ====== -->



@endsection
