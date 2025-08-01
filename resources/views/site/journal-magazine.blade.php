@extends('layouts.site')

@section('template_title')
    {{ __('AKBT') }}
@endsection

@section('content')

     <!-- ====== MAIN CONTENT ====== -->
     <div class="page-header border-bottom">
        <div class="container">
            <div class="d-md-flex justify-content-between align-items-center py-4">
                <h1 class="page-title font-size-3 font-weight-medium m-0 text-lh-lg">{{ $magazine->title }}</h1>
                <nav class="woocommerce-breadcrumb font-size-2">
                    <a href="/" class="h-primary">{{ __('Home') }}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>
                    <a href="{{ url(app()->getLocale() . '/journals') }}" class="h-primary">{{ __('Journals') }}</a>
                    <span class="breadcrumb-separator mx-1"><i class="fas fa-angle-right"></i></span>{{ $magazine->title }}
                </nav>
            </div>
        </div>
    </div>
    <div class="site-content" id="content">
        <div class="container">
            <div class="row  space-top-2">
                <div  class="content-area">
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
                                                    @if ($magazine->image_path)
                                                        <img src="/storage/magazineIssues/photo/{{ $magazine->image_path }}"
                                                            class="mx-auto img-fluid" alt="{{ $magazine->title }}"
                                                            title="{{ $magazine->title }}">
                                                    @else
                                                        <img src="/magazine_no_photo.jpg" class="mx-auto img-fluid"
                                                            alt="{{ $magazine->title }}" title="{{ $magazine->title }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="col-lg-7 pl-lg-0 summary entry-summary">
                                        <div class="px-lg-4 px-xl-6">
                                            <h1 class="product_title entry-title font-size-7 mb-3">{{ $magazine->title }}
                                            </h1>
                                             
                                            <div class="woocommerce-product-details__short-description font-size-2 mb-4">
                                                <p class="">{{ $magazine->description }}
                                                </p>
                                            </div>

                                            <div class="table-responsive mb-4">
                                                <table class="table table-hover table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Dc Subjects') }}: </th>
                                                            <td class="">

                                                                @if ($journal->subjects != null && $journal->subjects != "null" && $journal->subjects)
                                                                    | @foreach (json_decode($journal->subjects) as $key => $value)
                                                                        {{ \App\Models\BookSubject::GetTitleById($value) }} |
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                        </tr>
                                                         
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('ISSN') }}:</th>
                                                            <td>{{ $journal->ISSN }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Dc Date') }}:</th>
                                                            <td>{{ $magazine->published_year }} {{ __('Year') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('fourth_number') }}:</th>
                                                            <td>{{ $magazine->fourth_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Book file') }}:</th>
                                                            <td>
                                                                @if ($magazine->full_text_path)
                                                                    <a href="/storage/magazineIssues/full-text/{{ $magazine->full_text_path }}"
                                                                        target="__blank">{{ __('Download') }}</a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-4 px-xl-5">{{ __('Betlar Soni') }}:</th>
                                                            <td>{{ $magazine->betlar_soni }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div> 
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
                                            {{ __('Details') }}
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
                                            <div class="form-group">
                                                <strong>{{ __('Organization') }}:</strong>
                                                {!! $journal->organization_id ? $journal->organization->title : '' !!}
                                            </div>
                                            <div class="form-group">
                                                <strong>{{ __('Title') }}:</strong>
                                                {{ $journal->title }}
                                            </div>
                                            <div class="form-group">
                                                <strong>{{ __('Phone Number') }}:</strong>
                                                <a href="tel:{{ $journal->phone_number }}">{{ $journal->phone_number }}</a>
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
                                                <a href="mailto:{{ $journal->email }}">{{ $journal->email }}</a>
                                            </div>
                                            <div class="form-group">
                                                <strong>{{ __('Website') }}:</strong>
                                                <a href="{{ $journal->website }}" target="__blank">{{ $journal->website }}</a>
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
                                <!-- End Tab Content -->
                                
                            </div>
                            <!-- End Features Section -->
                        </div>
                    </main>
                </div>
            </div>
            
            


        </div>
    </div>
    <!-- ====== END MAIN CONTENT ====== -->


@endsection