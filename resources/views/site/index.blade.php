@extends('layouts.site')

@section('template_title')
    {{ __('AKBT') }}
@endsection

@section('content')
    <!-- ====== MAIN CONTENT ====== -->
    {{-- <section class="space-bottom-3">
        <div class="bg-gray-200 space-2 space-lg-0 bg-img-hero"
            style="background-image: url(../../front/assets/img/1920x588/img1.jpg);">
            <div class="container">
                <div class="js-slick-carousel u-slick"
                    data-pagi-classes="text-center u-slick__pagination position-absolute right-0 left-0 mb-n8 mb-lg-4 bottom-0">
                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <div class="media-body mr-wd-4 align-self-center mb-4 mb-md-0">
                                    <p class="hero__pretitle text-uppercase font-weight-bold text-gray-400 mb-2"
                                        data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">The Bookworm
                                        Editors'</p>
                                    <h2 class="hero__title font-size-14 mb-4" data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="hero__title-line-1 font-weight-regular d-block">Featured Books of
                                            the</span>
                                        <span class="hero__title-line-2 font-weight-bold d-block">February</span>
                                    </h2>
                                    <a href="../shop/v1.html" class="btn btn-dark btn-wide rounded-0 hero__btn"
                                        data-scs-animation-in="fadeInLeft" data-scs-animation-delay="400">See More</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-wd-6" data-scs-animation-in="fadeInRight"
                                data-scs-animation-delay="500">
                                <img class="img-fluid" src="#" alt="image-description">

                            </div>
                        </div>
                    </div>

                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <div class="media-body mr-wd-4 align-self-center mb-4 mb-md-0">
                                    <p class="hero__pretitle text-uppercase font-weight-bold text-gray-400 mb-2"
                                        data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">The Bookworm
                                        Editors'</p>
                                    <h2 class="hero__title font-size-14 mb-4" data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="hero__title-line-1 font-weight-regular d-block">Featured Books of
                                            the</span>
                                        <span class="hero__title-line-2 font-weight-bold d-block">February</span>
                                    </h2>
                                    <a href="../shop/v1.html" class="btn btn-dark btn-wide rounded-0 hero__btn"
                                        data-scs-animation-in="fadeInLeft" data-scs-animation-delay="400">See More</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-wd-6" data-scs-animation-in="fadeInRight"
                                data-scs-animation-delay="500">
                                <img class="img-fluid" src="#" alt="image-description">
                            </div>
                        </div>
                    </div>

                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <div class="media-body mr-wd-4 align-self-center mb-4 mb-md-0">
                                    <p class="hero__pretitle text-uppercase font-weight-bold text-gray-400 mb-2"
                                        data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">The Bookworm
                                        Editors'</p>
                                    <h2 class="hero__title font-size-14 mb-4" data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="hero__title-line-1 font-weight-regular d-block">Featured Books of
                                            the</span>
                                        <span class="hero__title-line-2 font-weight-bold d-block">February</span>
                                    </h2>
                                    <a href="../shop/v1.html" class="btn btn-dark btn-wide rounded-0 hero__btn"
                                        data-scs-animation-in="fadeInLeft" data-scs-animation-delay="400">See More</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-wd-6" data-scs-animation-in="fadeInRight"
                                data-scs-animation-delay="500">
                                <img class="img-fluid" src="#/" alt="image-description">
                            </div>
                        </div>
                    </div>

                    <div class="js-slide">
                        <div class="hero row min-height-588 align-items-center">
                            <div class="col-lg-7 col-wd-6 mb-4 mb-lg-0">
                                <div class="media-body mr-wd-4 align-self-center mb-4 mb-md-0">
                                    <p class="hero__pretitle text-uppercase font-weight-bold text-gray-400 mb-2"
                                        data-scs-animation-in="fadeInUp" data-scs-animation-delay="200">The Bookworm
                                        Editors'</p>
                                    <h2 class="hero__title font-size-14 mb-4" data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="300">
                                        <span class="hero__title-line-1 font-weight-regular d-block">Featured Books of
                                            the</span>
                                        <span class="hero__title-line-2 font-weight-bold d-block">February</span>
                                    </h2>
                                    <a href="../shop/v1.html" class="btn btn-dark btn-wide rounded-0 hero__btn"
                                        data-scs-animation-in="fadeInLeft" data-scs-animation-delay="400">See More</a>
                                </div>
                            </div>
                            <div class="col-lg-5 col-wd-6" data-scs-animation-in="fadeInRight"
                                data-scs-animation-delay="500">
                                <img class="img-fluid" src="#/" alt="image-description">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <br>
    <livewire:site.main.books-by-category /> 

    @if ($topBooks != null && $topBooks->count() > 0)
        <section class="space-bottom-3">
            <div class="container">
                <header class="mb-5 d-md-flex justify-content-between align-items-center">
                    <h2 class="font-size-7 mb-3 mb-md-0">{{ __('The most demandable books') }}</h2>
                </header>
                <div class="js-slick-carousel u-slick products border"
                    data-pagi-classes="text-center u-slick__pagination mt-md-8 mt-4 position-absolute right-0 left-0"
                    data-slides-show="3"
                    data-responsive='[{
                    "breakpoint": 992,
                    "settings": {
                        "slidesToShow": 2
                    }
                    }, {
                    "breakpoint": 768,
                    "settings": {
                        "slidesToShow": 1
                    }
                    }, {
                    "breakpoint": 554,
                    "settings": {
                        "slidesToShow": 1
                    }
                    }]'>
                    @foreach ($topBooks as $k => $item)
                        {!! \App\Models\Book::GetBookTopTemplateById($item->book_id) !!}
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($journals != null && $journals->count() > 0)
        <section class="space-bottom-3">
            <div class="container">
                <header class="mb-5 d-md-flex justify-content-between align-items-center">
                    <h2 class="font-size-7 mb-3 mb-md-0">{{ __('Journals') }}</h2>
                    <a href="{{ url(app()->getLocale() . '/journals') }}" class="h-primary d-block">{{ __('View All') }}
                        <i class="glyph-icon flaticon-next"></i></a>
                </header>

                <div class="js-slick-carousel products no-gutters border-top border-left border-right"
                    data-pagi-classes="d-xl-none text-center position-absolute right-0 left-0 u-slick__pagination mt-4 mb-0"
                    data-arrows-classes="d-none d-xl-block u-slick__arrow u-slick__arrow-centered--y"
                    data-arrow-left-classes="fas fa-chevron-left u-slick__arrow-inner u-slick__arrow-inner--left ml-lg-n10"
                    data-arrow-right-classes="fas fa-chevron-right u-slick__arrow-inner u-slick__arrow-inner--right mr-lg-n10"
                    data-slides-show="5"
                    data-responsive='[{
                                                   "breakpoint": 1500,
                                                   "settings": {
                                                     "slidesToShow": 4
                                                   }
                                                },{
                                                   "breakpoint": 1199,
                                                   "settings": {
                                                     "slidesToShow": 3
                                                   }
                                                },{
                                                   "breakpoint": 992,
                                                   "settings": {
                                                     "slidesToShow": 2
                                                   }
                                                }, {
                                                   "breakpoint": 768,
                                                   "settings": {
                                                     "slidesToShow": 1
                                                   }
                                                }, {
                                                   "breakpoint": 554,
                                                   "settings": {
                                                     "slidesToShow": 1
                                                   }
                                                }]'>
                    @foreach ($journals as $k => $item)
                        <div class="product">
                            <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                <div
                                    class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                    <div class="woocommerce-loop-product__thumbnail">
                                        <a href="{{ url(app()->getLocale() . '/journals/' . $item->slug) }}"
                                            class="d-block">
                                            @if ($item->image_path)
                                                <img src="/storage/journals/photo/{{ $item->image_path }}"
                                                    class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                    alt="{{ $item->title }}">
                                            @else
                                                <img src="/book_no_photo.jpg"
                                                    class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                    alt="{{ $item->title }}" title="{{ $item->title }}">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                        <div class="text-uppercase font-size-1 mb-1 text-truncate"><a
                                                href="{{ url(app()->getLocale() . '/journals/' . $item->slug) }}">{{ $item->booksType->title }}</a>
                                        </div>
                                        <h2
                                            class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                            <a
                                                href="{{ url(app()->getLocale() . '/journals/' . $item->slug) }}">{{ $item->title }}</a>
                                        </h2>

                                        <div class="font-size-2  mb-1 text-truncate">

                                        </div>
                                        <div class="price d-flex align-items-center font-weight-medium font-size-3">

                                        </div>
                                    </div>
                                    <div class="product__hover d-flex align-items-center">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($magazines != null && $magazines->count() > 0)
        <section class="space-bottom-3">
            <header class="mb-4 container">
                <h2 class="font-size-7 text-center">{{ __('New magazine articles') }}</h2>
            </header>
            <div class="container">
                <div class="tab-content" id="featuredBooksContent">
                    <div class="tab-pane fade show active" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                        <ul
                            class="products list-unstyled row no-gutters row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-wd-6 border-top border-left my-0">
                            @foreach ($magazines as $magazine)
                                <li class="product col">
                                    <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                        <div
                                            class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                            <div class="woocommerce-loop-product__thumbnail">
                                                <a href="{{ url(app()->getLocale() . '/journals/' . $magazine->journal->slug . '/' . $magazine->slug) }}"
                                                    title="{{ $magazine->title }}" class="d-block">
                                                    @if ($magazine->image_path)
                                                        <img src="/storage/magazineIssues/photo/{{ $magazine->image_path }}"
                                                            class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                            alt="{{ $magazine->title }}" title="{{ $magazine->title }}">
                                                    @else
                                                        <img src="/book_no_photo.jpg"
                                                            class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                            alt="{{ $magazine->title }}" title="{{ $magazine->title }}">
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
                                                    <a href="{{ url(app()->getLocale() . '/journals/' . $magazine->journal->slug . '/' . $magazine->slug) }}"
                                                        title="{{ $magazine->title }}">
                                                        {{ $magazine->title }}
                                                    </a>
                                                </h2>
                                                <div class="font-size-2  mb-1 text-truncate">
                                                    {{ $magazine->published_year }}-{{ $magazine->fourth_number }}
                                                </div>
                                            </div>
                                            <div class="product__hover d-flex align-items-center">
                                                <a href="{{ url(app()->getLocale() . '/journals/' . $magazine->journal->slug . '/' . $magazine->slug) }}"
                                                    class="text-uppercase text-dark h-dark font-weight-medium mr-auto"
                                                    data-toggle="tooltip" data-placement="right"
                                                    title="{{ $magazine->published_year }}-{{ $magazine->fourth_number }}"
                                                    data-original-title="{{ $magazine->published_year }}-{{ $magazine->fourth_number }}"
                                                    title="{{ $magazine->journal->title }}-{{ $magazine->published_year }}-{{ $magazine->fourth_number }}">
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
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- ====== END MAIN CONTENT ====== -->
@endsection
