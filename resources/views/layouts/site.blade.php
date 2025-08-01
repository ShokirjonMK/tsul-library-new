<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Title -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AKBT') }}</title>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" href="./front/assets/img/favicon.png">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link href="{{ asset('front/assets/vendor/font-awesome/css/fontawesome-all.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('front/assets/vendor/flaticon/font/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front/assets/vendor/animate.css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('front/assets/vendor/slick-carousel/slick/slick.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css') }}"
        rel="stylesheet" type="text/css" />
     
    <!-- CSS Bookworm Template -->
    <link href="{{ asset('front/assets/css/theme.css') }}" rel="stylesheet" type="text/css" />
    @livewireStyles
</head>

<body class="left-sidebar">

    <!--===== HEADER CONTENT =====-->
    <livewire:site.header />


    <!--===== END HEADER CONTENT =====-->
    @yield('content')
    <!-- ========== FOOTER ========== -->

    <livewire:site.footer />

    <!-- ========== END FOOTER ========== -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('front/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/multilevel-sliding-mobile-menu/dist/jquery.zeynep.js') }}"></script>
    <script
        src="{{ asset('front/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}">
    </script>

    <!-- JS HS Components -->
    <script src="{{ asset('front/assets/js/hs.core.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.unfold.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.malihu-scrollbar.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.header.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.slick-carousel.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.slick-carousel.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.selectpicker.js') }}"></script>
    <script src="{{ asset('front/assets/js/components/hs.show-animation.js') }}"></script>
    <!-- JS Bookworm -->
    <!-- <script src="../../front/assets/js/bookworm.js"></script> -->
    <script>
        $(document).on('ready', function() {
            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

            // initialization of slick carousel
            $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

            // initialization of header
            $.HSCore.components.HSHeader.init($('#header'));

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // init zeynepjs
            var zeynep = $('.zeynep').zeynep({
                onClosed: function() {
                    // enable main wrapper element clicks on any its children element
                    $("body main").attr("style", "");

                    console.log('the side menu is closed.');
                },
                onOpened: function() {
                    // disable main wrapper element clicks on any its children element
                    $("body main").attr("style", "pointer-events: none;");

                    console.log('the side menu is opened.');
                }
            });

            // handle zeynep overlay click
            $(".zeynep-overlay").click(function() {
                zeynep.close();
            });

            // open side menu if the button is clicked
            $(".cat-menu").click(function() {
                if ($("html").hasClass("zeynep-opened")) {
                    zeynep.close();
                } else {
                    zeynep.open();
                }
            });
        });
    </script>
    @livewireScripts


</body>

</html>
