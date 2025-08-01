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

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
                padding: 5px;
                font-size: 20px;
                background-color: #8338ec;
                margin-bottom: 15px;
                text-transform: uppercase;
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
            /* height: 150px;
            width: 150px;
            border-radius: 10px;
            left: 30px;
            top: 5px; */
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
            height: 150px;
            width: 150px;
            text-align: center;
        }

        .barcode {
            text-align: center;
            position: absolute;
            top: -7px;
            right: -10px;
        }


        .back {
            height: 243px;
            width: 490px;
            background-color: #ffffff;
            border: 1px solid #8338ec;
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
            padding: 5px;
            font-size: 15px;
            background-color: #8338ec;
            margin-bottom: 10px;
            text-transform: uppercase;
        }


        .details-info {
            line-height: 8px;
        }

        .logo {
            width: 46%;
            height: 40px;
        }

        .mb-10 {
            margin-bottom: 10px
        }

    </style>

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @if ($users->count() > 0)

                        @php
                            $i = 1;
                        @endphp
                        @foreach ($users as $k => $user)
                            @if ($user->profile != null)
                                <div class="back">
                                    <h1 class="Details"> {!! $user->profile->organization ? $user->profile->organization->title : '' !!}</h1>
                                    <div class="row">
                                        <div class="col-md-4" style="width: 40%;">
                                            <div class="top text-center">
                                                <div class="">
                                                    @if ($user->profile->image)
                                                        <div class="align-items-left">
                                                            <img
                                                                src="/storage/{{ $user->profile->image }}"
                                                                style="width: 120px;max-width: 150px; height: 120px">
                                                        </div>
                                                    @else
                                                        {{ __('No image') }}
                                                    @endif
                                                </div>
                                                <div class="">
                                                    <strong>{{ $user->name }}</strong>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-7" style="width: 60%;">
                                            <div class="details-info">
                                                <div class=" text-center"
                                                     style="line-height: 17px;">
                                                    @if(($user->inventar_number))

                                                        @if (env('USER_BAR_CODE_TYPE')=='QRCODE')
                                                            {!! QrCode::size(100)->generate($user->inventar_number); !!}
                                                        @else
                                                            @php
                                                                $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                                echo $generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128, 2.30);

                                                            @endphp
                                                        @endif
                                                    @endif
                                                    <br>
                                                    <span>{{ $user->inventar_number }}</span>
                                                </div>

                                                <div class="mb-10">
                                                    <strong>{{ __('Email') }}:</strong>
                                                    <span
                                                        style="display:block; margin-top:8px">{{ $user->email }}</span>
                                                </div>
                                                <div class="mb-10">
                                                    <strong>{{ __('Phone Number') }}:</strong>
                                                    <span
                                                        style="display:block; margin-top:8px">{{ $user->profile->phone_number }}</span>
                                                </div>
                                                @if ($user->profile->date_of_birth)
                                                    <div class="mb-10">
                                                        <strong>{{ __('Date Of Birth') }}:</strong>
                                                        <span
                                                            style="display:block; margin-top:8px">{{ $user->profile->date_of_birth }}</span>
                                                    </div>

                                                @endif

                                                @if ($user->profile->faculty_id)
                                                    <div class="mb-10">
                                                        <strong>{{ __('Faculty') }}:</strong>
                                                        {!! $user->profile->faculty_id ? $user->profile->faculty->title : '' !!}
                                                    </div>

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group text-center">
                                                                <span
                                                                    style="display:block; margin-top:-12px;line-height: 15px;">
                                                                    {{-- Toshkent sh. Navoiy ko’chasi, 32 uy, 100011, Telefon(998-71)244-79-20 --}}
                                                                    {!! $user->profile->organization ? $user->profile->organization->address: '' !!}

                                                                </span>
                                    </div>
                                </div>
                            @endif
                            @if ($i % 10 == 0)
                                <div class="col-md-12">
                                    <br>
                                    <br>
                                    <h1>&nbsp;</h1>
                                </div>
                            @endif
                            @php
                                $i++;
                            @endphp
                        @endforeach

                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
<!-- ./wrapper -->


<script>
    window.onload = function () {
        window.print();
        setTimeout(function() {
            window.close();
        }, 1);
    }
</script>

</body>

</html>
