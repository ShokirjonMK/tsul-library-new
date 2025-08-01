@extends('layouts.app')

@section('content')
    <style>
        .home-img {
            max-width: 50px;
        }

        .home-book-img {
            max-width: 765px;
        }
    </style>
    <div class="content">
        <!-- Top Statistics -->
        <div class="row">

            <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                <div class="card card-mini dash-card card-1">
                    <a href="{{ url(app()->getLocale() . '/admin/books') }}">
                        <div class="card-body">
                            <h2 class="mb-1">{{number_format(\App\Models\Book::count(), 0, ',', ' ')}}</h2>
                            <p>{{__('Bibliographic record')}} </p>
                            <span class="mdi mdi-book"></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                <div class="card card-mini dash-card card-2">
                    <a href="{{ url(app()->getLocale() . '/admin/books') }}">
                        <div class="card-body">
                            <h2 class="mb-1">{{number_format(\App\Models\Book::totalAll(), 0, ',', ' ')}}</h2>
                            <p>{{__('Number of books')}} </p>
                            <span class="mdi mdi-book"></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                <div class="card card-mini dash-card card-3">
                    <a href="{{ url(app()->getLocale() . '/admin/books/inventar') }}">

                        <div class="card-body">
                            <h2 class="mb-1">{{number_format(\App\Models\BookInventar::bookActive()->count(), 0, ',', ' ')}}</h2>
                            <p>{{__('Books in Copy')}}</p>
                            <span class="mdi mdi-book-multiple"></span>
                        </div>
                    </a>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                <div class="card card-mini dash-card card-3">
                    <div class="card-body">
                        <h2 class="mb-1">0</h2>
                        <p>Onlayn buyurtmalar soni</p>
                        <span class="mdi mdi-package-variant"></span>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                <div class="card card-mini dash-card card-4">
                    <a href="{{ url(app()->getLocale() . '/admin/users') }}">
                        <div class="card-body">
                            <h2 class="mb-1">{{number_format(\App\Models\User::active()->count(), 0, ',', ' ')}}</h2>
                            <p>{{__('Number of users')}}</p>
                            <span class="mdi mdi-account-arrow-left"></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                <div class="card card-mini dash-card card-2">
                    <a href="{{ url(app()->getLocale() . '/admin/books?status=3') }}">
                        <div class="card-body">
                            <h2 class="mb-1">{{number_format(\App\Models\Book::scopeTotalAllPdf(), 0, ',', ' ')}}</h2>
                            <p>{{__('Total Fulltext Count')}}</p>
                            <span class="mdi mdi-book"></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 p-b-15 lbl-card">
                <div class="card card-mini dash-card card-2">
                    <a href="{{ url(app()->getLocale() . '/admin/books?status=4') }}">
                        <div class="card-body">
                            <h2 class="mb-1">{{ number_format(\App\Models\Book::scopeTotalAllDcSourcePdf(), 0, ',', ' ') }}</h2>
                            <p>{{__('Total number of external links')}} </p>
                            <span class="mdi mdi-book"></span>
                        </div>
                    </a>
                </div>


            </div>
        </div>
        <livewire:admin.charts.book-type-charts/>

        <div class="row">
            <div class="col-xl-6 col-md-12 lbl-card">
                <!-- New Users -->
                <div class="card ec-cust-card card-table-border-none card-default">
                    <div class="card-header justify-content-between ">
                        <h2>{{__('New Users')}}</h2>
                        <div>
                            <button class="text-black-50 mr-2 font-size-20">
                                <i class="mdi mdi-cached"></i>
                            </button>
                            {{-- <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                    id="dropdown-customar" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" data-display="static">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item"><a href="#">Action</a></li>
                                    <li class="dropdown-item"><a href="#">Another action</a></li>
                                    <li class="dropdown-item"><a href="#">Something else here</a></li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                    @if ($new_users != null && $new_users->count()>0)

                        <div class="card-body pt-0 pb-15px">
                            <table class="table ">
                                <tbody>
                                @foreach ($new_users as $k=> $item)
                                    @if ($item->profile != null && $item->profile->count()>0)

                                        <tr>
                                            <td>
                                                <div class="media">
                                                    <div class="media-image mr-3 rounded-circle">
                                                        <a href="{{ route('users.show', [app()->getLocale(), $item->id]) }}">
                                                            @if ($item->profile->image)
                                                                <div class="align-items-left">
                                                                    <img src="/storage/{{ $item->profile->image }}"
                                                                         class="home-img">
                                                                </div>
                                                            @else
                                                                <img
                                                                    class="profile-img rounded-circle w-45"
                                                                    src="/assets/img/user/u1.jpg"
                                                                    alt="customer image">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="media-body align-self-center">
                                                        <a href="{{ route('users.show', [app()->getLocale(), $item->id]) }}">
                                                            <h6 class="mt-0 text-dark font-weight-medium">{{$item->name}}</h6>
                                                        </a>
                                                        <small><a
                                                                href="mailto:{{$item->email}}">{{$item->email}}</a></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{$item->profile->phone_number}}</td>
                                        </tr>
                                    @endif

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-xl-6 col-md-12 lbl-card">
                <!-- New Books -->
                <div class="card card-default ec-card-top-prod">
                    <div class="card-header justify-content-between">
                        <h2>{{__('New Books')}}</h2>
                        <div>
                            <button class="text-black-50 mr-2 font-size-20"><i
                                    class="mdi mdi-cached"></i></button>
                            <div class="dropdown show d-inline-block widget-dropdown">
                                {{-- <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                    id="dropdown-product" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" data-display="static">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item"><a href="#">Update Data</a></li>
                                    <li class="dropdown-item"><a href="#">Detailed Log</a></li>
                                    <li class="dropdown-item"><a href="#">Statistics</a></li>
                                    <li class="dropdown-item"><a href="#">Clear Data</a></li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-10px mb-10px py-0">

                        @if ($new_books != null && $new_books->count()>0)
                            @foreach ($new_books as $k=> $item)

                                <div class="row media d-flex pt-15px pb-15px">
                                    <div
                                        class="col-lg-3 col-md-3 col-2 media-image align-self-center rounded">
                                        <a href="{{ route('books.show', [app()->getLocale(), $item->id]) }}">

                                            @if ($item->image_path)
                                                <img src="/storage/{{ $item->image_path }}" class="home-book-img">
                                            @else
                                                <img src="/assets/img/products/p1.jpg" alt="customer image">
                                            @endif


                                        </a>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-10 media-body align-self-center ec-pos">
                                        <a href="{{ route('books.show', [app()->getLocale(), $item->id]) }}">
                                            <h6 class="mb-10px text-dark font-weight-medium">{!! $item->BooksType ? $item->BooksType->title : '' !!}</h6>
                                        </a>
                                        {{-- <p class="float-md-right sale"><span class="mr-2">58</span>Sales</p> --}}
                                        <p class="d-none d-md-block">{{$item->dc_title}}</p>
                                        <p class="mb-0 ec-price">
                                            <span class="text-dark">{{$item->price}} soʻm</span>
                                        </p>
                                    </div>
                                </div>

                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-md-12 lbl-card">
                  <!-- Doughnut Chart -->
                  <input type="hidden" id="erkak" value="6922">
                  <input type="hidden" id="ayol" value="3287">

                  <div class="card card-default">
                    <div class="card-header justify-content-center">
                        <h2>{{__('Count by genders')}}</h2>
                    </div>
                    <div class="card-body">
                        <canvas id="doChart"></canvas>
                    </div>
                </div>
            </div> --}}
        </div>
        <br>

        @if ($new_orders != null && $new_orders->count()>0)

            <div class="row">
                <div class="col-12 p-b-15">
                    <!-- Recent Order Table -->
                    <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                        <div class="card-header justify-content-between">
                            <h2>{{__('Recent Orders')}}</h2>
                            <div class="date-range-report">

                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <table class="table card-table table-responsive table-responsive-large"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Order Number') }}</th>
                                    <th>{{ __('Order Date') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Reader') }}</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($new_orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{!! App\Models\Order::GetStatus($order->status) !!}</td>
                                        <td>
                                            {!! $order->reader ? $order->reader->name : '' !!}
                                            <br>
                                            <b>{{ __('Email') }}</b>: <a
                                                href="mailTo:{!! $order->reader ? $order->reader->email : '' !!}">{!! $order->reader ? $order->reader->email : '' !!}</a>
                                            <br>
                                            <b>{{ __('Phone Number') }}: </b><a
                                                href="tel:{!! $order->reader ? $order->reader->profile->phone_number : '' !!}">{!! $order->reader ? $order->reader->profile->phone_number : '' !!}</a>
                                        </td>
                                        <td class="text-right">
                                            <form
                                                action="{{ route('orders.destroy',[app()->getLocale(), $order->id]) }}"
                                                method="POST">
                                                <a class="btn btn-sm btn-primary "
                                                   href="{{ route('orders.show', [app()->getLocale(), $order->id]) }}"> {{ __('Show') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        @endif
        <div class="row">
            <div class="col-12 p-b-15">
                <!-- Recent Order Table -->
                <div class="card card-table-border-none card-default recent-orders" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <h3>{{ __('Monthly statistics of employee') }}</h3>
                        <div class="date-range-report">

                        </div>
                    </div>
                    <div class="ec-vendor-list card card-default">

                        <div class="card-header">
                            <form action="{{ route('admin.home', app()->getLocale()) }}"
                                  method="GET" accept-charset="UTF-8" role="search" style="width: 100%;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group input-daterange">
                                            <select class="form-control" name="year">
                                                <option disabled>{{ __('Select Year') }}</option>
                                                @foreach ($years as $y)
                                                    @if ($year == $y)
                                                        <option value="{{ $y }}" selected>
                                                            {{ $y }} </option>
                                                    @else
                                                        <option value="{{ $y }}">
                                                            {{ $y }} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                    <a href="{{ route('admin.home', app()->getLocale()) }}"
                                       class="btn btn-sm btn-info ">{{ __('Clear') }}</a>

                                </div>
                            </form>

                        </div>

                        <div class="card-body pt-0 pb-5">
                            <table class="table table-striped table-hover">

                                <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    @foreach ($months as $k => $month)
                                        <th>{{ $month }}</th>
                                    @endforeach

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="13" class="text text-center">
                                        <h3>{{__('Statistics on inclusion of books in the database')}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text text-right">
                                        {{__('Bibliographic record')}}: <br>
                                        {{__('Those attached to the branch')}}: <br>
                                        {{ __('In copy') }}: <br>
                                    </td>
                                    @foreach ($months as $k => $month)
                                        <td>
                                            <b>{!! \App\Models\Book::GetCountBookByUserByMonth(null, $year, $k)!!}</b>
                                            <br>
                                            <b>{!! \App\Models\BookInformation::GetCountBookInformationByUserByMonth(null, $year, $k)!!}</b>
                                            <br>
                                            <b>{!! \App\Models\BookInventar::GetCountBookCopyByUserByMonth(null, $year, $k)!!}</b>
                                            <br>
                                        </td>
                                    @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- {!! QrCode::siz e(300)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') !!} --}}


</div> <!-- End Content -->


@endsection
