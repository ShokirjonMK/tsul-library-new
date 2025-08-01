<div>
    {{-- Stop trying to control. --}}


    @if ($bookTypes != null && $bookTypes->count() > 0)
        <section class="space-bottom-3">
            <div class="container">
                <header class="d-md-flex justify-content-between align-items-center mb-5">
                    <h2 class="font-size-7 mb-4 mb-md-0">{{ __('Featured Book Types') }}</h2>
                    <a href="{{ url(app()->getLocale() . '/books') }}"
                        class="d-flex h-primary">{{ __('View All') }}<span
                            class="flaticon-next font-size-3 ml-2"></span></a>
                </header>
                <ul class="px-5 nav justify-content-between bg-gray-200 rounded-md pb-2 py-md-3 mb-5 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visible"
                    role="tablist">
                    @foreach ($bookTypes as $k => $item)
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1">
                            <a class="nav-link font-weight-medium @if ($item->id == $book_type_id) active @endif nav-link-caret"
                                id="pills-one-example2-tab" data-toggle="pill" href="#pills-one-example2" role="tab"
                                aria-controls="pills-one-example2" aria-selected="true"
                                wire:click="getBooks('{{ $item->id }}')">
                                <div class="text-center">
                                    <figure class="d-md-block mb-0 text-primary-indigo">

                                        @if ($item->image_path)
                                            <img src="{{ asset('/storage/booksTypes/photo/' . $item->image_path) }}"
                                                style="width: 80px;">
                                        @else
                                            <i class="glyph-icon flaticon-resume font-size-12"></i>
                                        @endif
                                    </figure>
                                    <span
                                        class="tabtext font-size-3 font-weight-medium text-dark">{{ $item->title }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="container">
                <div class="tab-content">
                    <div class="tab-pane active show" id="pills-one-example2" role="tabpanel"
                        aria-labelledby="pills-one-example2-tab">
                        
                        @if ($books != null && $books->count() > 0)
                            <div class="pt-2">
                                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-wd-6 ">
                                    @foreach ($books as $k => $book)
                                        <div class="col">
                                            <div class="mb-5 products">
                                                <div class="product product__space border rounded-md bg-white">
                                                    <div class="product__inner overflow-hidden p-3 p-md-4d875">
                                                        <div
                                                            class="woocommerce-LoopProduct-link woocommerce-loop-product__link d-block position-relative">
                                                            <div class="woocommerce-loop-product__thumbnail">
                                                                <a href="{{ url(app()->getLocale() . '/books/' . $book->id) }}"
                                                                    alt="{{ $book->dc_title }}"
                                                                    title="{{ $book->dc_title }}"
                                                                    class="d-block">
                                                                    @if ($book->image_path)
                                                                        <img src="/storage/{{ $book->image_path }}"
                                                                            class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                            alt="{{ $book->dc_title }}"
                                                                            title="{{ $book->dc_title }}">
                                                                    @else
                                                                        <img src="/book_no_photo.jpg"
                                                                            class="img-fluid d-block mx-auto attachment-shop_catalog size-shop_catalog wp-post-image img-fluid"
                                                                            alt="{{ $book->dc_title }}"
                                                                            title="{{ $book->dc_title }}">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div
                                                                class="woocommerce-loop-product__body product__body pt-3 bg-white">
                                                                <div
                                                                    class="text-uppercase font-size-1 mb-1 text-truncate">
                                                                    <a href="{{ url(app()->getLocale() . '/books/' . $book->id) }}"
                                                                        alt="{{ $book->dc_title }}"
                                                                        title="{{ $book->dc_title }}">{{ $book->booksType->title }}</a>
                                                                </div>
                                                                <h2
                                                                    class="woocommerce-loop-product__title product__title h6 text-lh-md mb-1 text-height-2 crop-text-2 h-dark">
                                                                    <a href="{{ url(app()->getLocale() . '/books/' . $book->id) }}"
                                                                        alt="{{ $book->dc_title }}"
                                                                        title="{{ $book->dc_title }}">{{ $book->dc_title }}</a>
                                                                </h2>
                                                                <div class="font-size-2  mb-1 text-truncate">
                                                                    <a href="{{ url(app()->getLocale() . '/books/' . $book->id) }}"
                                                                        alt="{{ $book->dc_title }}"
                                                                        title="{{ $book->dc_title }}"
                                                                        class="text-gray-700">
                                                                        @if ($book->dc_authors)
                                                                            @foreach (json_decode($book->dc_authors) as $author)
                                                                                {{-- <a href="{{ url(app()->getLocale() . '/authors/' . $author->slug) }}" class="text-gray-700"> --}}
                                                                                {{ $author }},
                                                                                {{-- </a> --}}
                                                                            @endforeach
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div
                                                                    class="price d-flex align-items-center font-weight-medium font-size-3">
                                                                    <span class="woocommerce-Price-amount amount"><span
                                                                            class="woocommerce-Price-currencySymbol"></span></span>
                                                                </div>
                                                                <div class="product__rating d-none align-items-center font-size-2">
                                                                     
                                                                </div>
                                                            </div>
                                                            <div class="product__hover d-flex align-items-center">
                                                                @if ($book->dc_subjects != "null" && $book->dc_subjects != null)
                                                                        @foreach (json_decode($book->dc_subjects) as $subject)
                                                                            {{-- <a href="{{ url(app()->getLocale() . '/authors/' . $author->slug) }}" class="text-gray-700"> --}}
                                                                            {{ $subject }},
                                                                            {{-- </a> --}}
                                                                        @endforeach
                                                                    @endif
                                                                {{-- <a href="../shop/single-product-v3.html"
                                                                    class="mr-1 h-p-bg btn btn-outline-dark border-0">
                                                                    <i class="flaticon-switch"></i>
                                                                </a>
                                                                <a href="../shop/single-product-v3.html"
                                                                    class="h-p-bg btn btn-outline-dark border-0">
                                                                    <i class="flaticon-heart"></i>
                                                                </a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        @else
                            <h3>Hech nima topilmadi</h3>
                        @endif
                    </div>

                </div>
            </div>
        </section>
    @endif

</div>
