<div>

    <header id="site-header" class="site-header__v1">
        <div class="topbar border-bottom d-none d-md-block">
            <div class="container-fluid px-2 px-md-5 px-xl-8d75">
                <div class="topbar__nav d-md-flex justify-content-between align-items-center">
                    <ul class="topbar__nav--left nav ml-md-n3">
                        <li class="nav-item"><a href="#" class="nav-link link-black-100"><i class="glph-icon flaticon-question mr-2"></i>Sizga yordam bera olamizmi?</a></li>
                        {{-- @if ($contact !=null && $contact->count()>0)
                            <li class="nav-item"><a href="tel:{{$contact->phone}}" class="nav-link link-black-100"><i class="glph-icon flaticon-phone mr-2"></i>{{$contact->phone}}</a></li>
                        @endif --}}
                        @if ($socials !=null && $socials->count()>0)
                            @foreach ($socials as $social)
                                <li class="nav-item"> <a class="nav-link link-black-100" title="{{$social->title}}" href="{{$social->link}}" target="__blank"><span class="fab {{$social->fa_icon_class}}"> {{$social->title}}</span></a></li>
                            @endforeach
                        @endif

                    </ul>

                    <ul class="topbar__nav--right nav mr-md-n3">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item"><a href="{{ url(app()->getLocale() . '/home') }}"
                                        class="nav-link link-black-100"> {{ __('Home') }}</a></li>
                            @else
                                <li class="nav-item"><a href="{{ route('login', app()->getLocale()) }}"
                                        class="nav-link link-black-100"><i
                                            class="glph-icon flaticon-user"></i>{{ __('Login') }}</a></li>

                                @if (Route::has('register'))
                                    <li class="nav-item"><a href="{{ route('register', app()->getLocale()) }}"
                                            class="nav-link link-black-100"><i
                                                class="glph-icon flaticon-user"></i>{{ __('Register') }}</a></li>
                                @endif
                            @endauth

                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ config('app.locales')[App::getLocale()] }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (config('app.locales') as $lang => $language)
                                @if ($lang != App::getLocale())
                                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                @endif
                            @endforeach
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
        <div class="masthead border-bottom position-relative" style="margin-bottom: -1px;">
            <div class="container-fluid px-3 px-md-5 px-xl-8d75 py-2 py-md-0">

                <div class="d-flex align-items-center position-relative flex-wrap">
                    <div class="offcanvas-toggler mr-4 mr-lg-8">
                        <a id="sidebarNavToggler2" href="javascript:;" role="button" class="cat-menu"
                            aria-controls="sidebarContent2" aria-haspopup="true" aria-expanded="false"
                            data-unfold-event="click" data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent2" data-unfold-type="css-animation"
                            data-unfold-overlay='{
                            "className": "u-sidebar-bg-overlay",
                            "background": "rgba(0, 0, 0, .7)",
                            "animationSpeed": 100
                        }'
                            data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft"
                            data-unfold-duration="100">
                            <svg width="20px" height="18px">
                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                    d="M-0.000,-0.000 L20.000,-0.000 L20.000,2.000 L-0.000,2.000 L-0.000,-0.000 Z" />
                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                    d="M-0.000,8.000 L15.000,8.000 L15.000,10.000 L-0.000,10.000 L-0.000,8.000 Z" />
                                <path fill-rule="evenodd" fill="rgb(25, 17, 11)"
                                    d="M-0.000,16.000 L20.000,16.000 L20.000,18.000 L-0.000,18.000 L-0.000,16.000 Z" />
                            </svg>
                        </a>
                    </div>
                    <div class="site-branding pr-md-4">
                        <a href="/" class="d-block mb-1">
                            <img src="/logo.png" alt="" style="width: 200px;">
                        </a>
                    </div>
                    <div class="site-navigation mr-auto d-none d-xl-block">
                        <ul class="nav">

                            <li class="nav-item">
                                <a  href="{{ url(app()->getLocale() . '/') }}" class=" nav-link link-black-100 mx-4 px-0 py-5 font-weight-medium d-flex align-items-center"
                                    aria-haspopup="true" aria-expanded="false" data-unfold-event="hover"
                                    data-unfold-target="#featuresDropdownMenu" data-unfold-type="css-animation"
                                    data-unfold-duration="200" data-unfold-delay="50"
                                    data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                                    data-unfold-animation-out="fadeOut">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{ url(app()->getLocale() . '/books/') }}" class=" nav-link link-black-100 mx-4 px-0 py-5 font-weight-medium d-flex align-items-center"
                                    aria-haspopup="true" aria-expanded="false" data-unfold-event="hover"
                                    data-unfold-target="#featuresDropdownMenu" data-unfold-type="css-animation"
                                    data-unfold-duration="200" data-unfold-delay="50"
                                    data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                                    data-unfold-animation-out="fadeOut">
                                    {{ __('Books') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a  href="{{ url(app()->getLocale() . '/unilibrary/') }}" class=" nav-link link-black-100 mx-4 px-0 py-5 font-weight-medium d-flex align-items-center"
                                    aria-haspopup="true" aria-expanded="false" data-unfold-event="hover"
                                    data-unfold-target="#featuresDropdownMenu" data-unfold-type="css-animation"
                                    data-unfold-duration="200" data-unfold-delay="50"
                                    data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                                    data-unfold-animation-out="fadeOut">
                                    {{ __('Unilibrary') }}
                                </a>
                            </li>
                            @if (env('GET_ANDQXAI_BOOKS'))
                                <li class="nav-item">
                                    <a  href="{{ url(app()->getLocale() . '/andqxai/') }}" class=" nav-link link-black-100 mx-4 px-0 py-5 font-weight-medium d-flex align-items-center"
                                        aria-haspopup="true" aria-expanded="false" data-unfold-event="hover"
                                        data-unfold-target="#featuresDropdownMenu" data-unfold-type="css-animation"
                                        data-unfold-duration="200" data-unfold-delay="50"
                                        data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                                        data-unfold-animation-out="fadeOut">
                                        {{ __('ANDQXAI') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <ul class="d-md-none nav mr-md-n3 ml-auto">
                        <li class="nav-item">
                            <!-- Account Sidebar Toggle Button - Mobile -->
                            <a id="sidebarNavToggler9" href="{{ route('login', app()->getLocale()) }}"
                                role="button" class="px-2 nav-link link-black-100" aria-controls="sidebarContent9"
                                aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent9"
                                data-unfold-type="css-animation"
                                data-unfold-overlay='{
                                    "className": "u-sidebar-bg-overlay",
                                    "background": "rgba(0, 0, 0, .7)",
                                    "animationSpeed": 500
                                }'
                                data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight"
                                data-unfold-duration="500">
                                <i class="glph-icon flaticon-user"></i>
                            </a>
                            <!-- End Account Sidebar Toggle Button - Mobile -->
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ config('app.locales')[App::getLocale()] }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @foreach (config('app.locales') as $lang => $language)
                                @if ($lang != App::getLocale())
                                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                @endif
                            @endforeach
                            </div>
                        </li>
                    </ul>
                    <div class="site-search ml-xl-0 ml-md-auto w-r-100 my-2 my-xl-0">
                            <form action="{{ route('site.books', app()->getLocale()) }}" method="GET"
                                accept-charset="UTF-8" role="search" class="form-inline">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <i
                                        class="glph-icon flaticon-loupe input-group-text py-2d75 bg-white-100 border-white-100"></i>
                                </div>
                                <input
                                    class="form-control bg-white-100 min-width-380 py-2d75 height-4 border-white-100"
                                    type="search" placeholder="{{ __('Search by Keyword') }} ..."
                                    aria-label="Search" name="keyword">
                            </div>
                            <button class="btn btn-outline-success my-2 my-sm-0 "
                                type="submit">{{ __('Search') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
