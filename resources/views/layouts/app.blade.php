<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AKBT') }}</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@4/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4/dist/js/bootstrap.bundle.min.js" type="module"></script> --}}

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- GOOGLE FONTS -->
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <link href="{{ asset('material/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('material/css/materialdesignicons.min.css') }}" rel="stylesheet" /> --}}
    
    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

    <!-- Ekka CSS -->
    <link id="ekka-css" href="{{ asset('assets/css/ekka.css') }}" rel="stylesheet" />

    <!-- FAVICON -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="shortcut icon" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    @livewireStyles

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <script src="{{ asset('livewire/components/pdf-viewer.js') }}"></script>
    <link href="{{ asset('tagsinput.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('typeahead.bundle.js') }}"></script>
</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">
    @include('sweetalert::alert')

    <!--  WRAPPER  -->
    <div class="wrapper">
       

        <!-- LEFT MAIN SIDEBAR -->
        @include('layouts.partials.sidebar')

        <!--  PAGE WRAPPER -->
        <div class="ec-page-wrapper">

            <!-- Header -->
            @include('layouts.partials.navbar')
            {{-- Main content --}}
            <!-- CONTENT WRAPPER -->
            <div class="ec-content-wrapper">
                @yield('content')
            </div> <!-- End Content Wrapper -->



            <!-- Footer -->
            @include('layouts.partials.footer')

        </div> <!-- End Page Wrapper -->
    </div> <!-- End Wrapper -->



    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <!-- Common Javascript -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-zoom/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>

    <!-- Chart -->
    <script src="{{ asset('assets/plugins/charts/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>

    <!-- Google map chart -->
    {{-- <script src="{{ asset('css/app.css') }}assets/plugins/charts/google-map-loader.js"></script>
	<script src="{{ asset('css/app.css') }}assets/plugins/charts/google-map.js"></script> --}}

    <!-- Date Range Picker -->
    <script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/date-range.js') }}"></script>

    <!-- Option Switcher -->
    <script src="{{ asset('assets/plugins/options-sidebar/optionswitcher.js') }}"></script>

    <!-- Ekka Custom -->
    <script src="{{ asset('assets/js/ekka.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $(".js-example-basic-single-with-tags").select2({
                tags: true,
            })
        });
    </script>
    @yield('scripts')
    @yield('page-js-script')
    @stack('scripts')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    <script>
        window.livewire.on('dataSaved', () => {
            $('#productData')[0].reset();
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    {{-- <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script> --}}
    <script type="text/javascript">
        var title = "<?= __('Are you sure you want to delete this record?') ?>";
        var text = "<?= __('If you delete this, it will be gone forever.') ?>";
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: title,
                    text: text,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
     <script>
        var barcode = '';
        var interval;
        document.addEventListener('keydown', function(evt) {
            if (interval)
                clearInterval(interval);
            if (evt.code == 'Enter') {
                if (barcode) {
                    console.log(barcode);
                    // handleBarcode(barcode);
                    Livewire.emit('getLatitudeForInput', barcode);
                }
                barcode = '';
                return;
            }
            if (evt.key != 'Shift')
                barcode += evt.key;
            interval = setInterval(() => barcode = '', 20);
        });
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
        $(document).ready(function() {

            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });

            $('#state').on('change', function() {
                var stateID = $(this).val();
                if (stateID) {
                    $.ajax({
                        url: '/uz/admin/findCityWithStateID/' + stateID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            //console.log(data);
                            if (data) {
                                $('#city').empty();
                                $('#city').focus;
                                $('#city').append(
                                    '<option value="">----</option>');
                                $.each(data, function(key, value) {
                                    $('select[name="city"]').append('<option value="' +
                                        key + '">' + value + '</option>');
                                });
                            } else {
                                $('#city').empty();
                            }
                        }
                    });
                } else {
                    $('#city').empty();
                }
            });
        });
    </script>
        <script src="{{ asset('tagsinput.js') }}"></script>
        
</body>

</html>
