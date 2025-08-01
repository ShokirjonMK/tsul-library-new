<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <style>
        [x-cloak] {
            display: none;
        }

        @media print {

            header,
            footer,
            aside,
            form,
            .notprint {
                display: none;
            }

            #printElement {
                display: flex;
            }

            .Details {
                color: white;
                text-align: center;
                padding: 4px;
                font-size: 15px;
                background-color: #8338ec !important;
                -webkit-print-color-adjust: exact;
            }

        }

        .font {
            height: 375px;
            width: 250px;
            position: relative;
            border-radius: 10px;
        }



        .bottom {
            height: 70%;
            width: 100%;
            background-color: white;
            position: absolute;
        }

        .top img {
            height: 120px;
            width: 120px;
            border-radius: 10px;
            left: 30px;
            top: 5px;
        }

        .bottom p {
            position: relative;
            top: 60px;
            text-align: center;
            text-transform: capitalize;
            font-weight: bold;
            font-size: 20px;
            text-emphasis: spacing;
        }

        .bottom .desi {
            font-size: 12px;
            color: grey;
            font-weight: normal;
        }

        .bottom .no {
            font-size: 15px;
            font-weight: normal;
        }

        .barcode img {
            background-color: #fff;
            margin-bottom: 5px;
        }

        .barcode {
            text-align: center; 
        }

        .back {
            /* height: 310px;
            width: 540px; */
            /* background-color: #ffffff;
            border: 1px solid #000; */
        }

        .qr img {
            height: 80px;
            width: 100%;
            margin: 20px;
            background-color: white;
        }

        .Details {
            color: white;
            text-align: center;
            padding: 4px;
            font-size: 15px;
            background-color: #8338ec;
        }


        .details-info {
            line-height: 8px;
        }

        .logo {
            width: 46%;
            height: 40px;
        }

    </style>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    @if (count($users) > 0)
                                        <div class="row">
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach ($users as $k=>$user)

                                                @if ($user->profile != null)
                                                    <div class="col-md-6" style="max-height: 310px; min-height:245px">
                                                        <div class="back">
                                                            <h1 class="Details">{!! $user->profile->organization ? $user->profile->organization->title : '' !!}</h1>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="top text-center">
                                                                        <div class="form-group">
                                                                            
                                                                            
                                                                            @if ($user->profile->image)

                                                                            <img src="/storage/{{ $user->profile->image }}" style="width: 100px;max-width: 120px;">
                                                    
                                                                            @else
                                                                                {{ __('No image') }}
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <strong>{{ $user->name }}</strong>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <div class="details-info">
                                                                        <div class="barcode">
                                                                            @php
                                                                                if ($user->inventar_number) {
                                                                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128)) . '" >';
                                                                                }
                                                                            @endphp
                                                                            <center>{{ $user->inventar_number }}</center>
                                                                            <br>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="mb-10">
                                                                                <b>{{ __('Email') }}:</b> {{ $user->email }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <b>{{ __('Phone Number') }}:</b> {{ $user->profile->phone_number }}
                                                                        </div>
                                                                        @if ($user->profile->date_of_birth)
                                                                            <div class="form-group mb-10">
                                                                                <b>{{ __('Date Of Birth') }}:</b> {{ $user->profile->date_of_birth }}
                                                                            </div>    
                                                                        @endif
                                                                        @if ($user->profile->faculty_id)
                                                                            <div class="mb-10">
                                                                                <b>{{ __('Faculty') }}:</b> {!! $user->profile->faculty_id ? $user->profile->faculty->title : '' !!}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                             <div class="form-group text-center"  >
                                                                <hr>
                                                                <span
                                                                    style="font-size: 10px;display:block;margin-top:-12px;line-height: 15px;">
                                                                    {!! $user->profile->organization ? $user->profile->organization->address: '' !!}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if( $i%10==0)
                                                         <div class="col-md-12">
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br> 
                                                             {{-- <h1>&nbsp;</h1> --}}
                                                        </div>

                                                 @endif
                                                 @php
                                                     $i++;
                                                 @endphp
                                            @endforeach

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('dist/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>

    {{-- <script src="{{asset('dist/js/jquery.min.js')}}"></script> --}}

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- InputMask -->
    <script src="{{ asset('dist/js/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('dist/js/bootstrap-switch.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('dist/js/select2.full.min.js') }}"></script>

    <script>
        window.onload = function() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 1);
        }
    </script>

</body>

</html>
