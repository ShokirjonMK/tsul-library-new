<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        html {
            height: 100%;
        }

        body {
            height: 100%;
            padding: 0;
            background: #e0e0e0;
        }

        /* * {
            font-family: DejaVu Sans !important;
        } */
    </style>
    <title>Template</title>

    <!-- Theme style -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <style type="text/css" media="print">
        @page {
            size: landscape;
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        }

        .text-center {
            margin: 0 auto;
            text-align: center;
            background-color: #fff;
            clear: both;
            display: block;
            text-align: center;
            margin: 0 auto;
            text-align: center;
        }

        @media print {
            size: landscape;
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);

            page {
                size: landscape;
                margin: 0 auto;
                text-align: center;
            }

            .text-center {
                margin: 0 auto;
                text-align: center;
                background-color: #fff;
                clear: both;
                display: block;
                text-align: center;
                margin: 0 auto;
                text-align: center;
            }

            .pagebreak {
                page-break-before: always;
            }



        }
    </style>
    <!-- REQUIRED SCRIPTS -->
    <style type="text/css">
        @moduleWidth: 2px;
        @barColor: #404040;
        @bgColor: #f0f0f0;
        @digitHeight: 18px;
        @digitFontSize: 14px;
        @digitColor: #802020;

        html {
            height: 100%;
        }

        body {
            height: 100%;
            padding: 0;
            background: #e0e0e0;
        }


        .toPrint,
        .barcode {
            margin: 0;
            padding: 0;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .toPrint {
            margin: auto auto;
            padding: 0;
            position: relative;
            top: 35%;

            display: table;
            background: @bgColor;
            /* box-shadow: 0px 1px 10px -5px #000; */
            border-radius: 3px;
        }

        .barcode {
            display: table-cell;
            position: relative;
            width: 7 * @moduleWidth;
            overflow: hidden;
        }

        .barcode2 {
            display: block;
            margin: 0 auto;
            align-content: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        @page {
            size: 1.16535mm 1.1811mm landscape;
            margin: 0;
        }

        .qr_code {
            text-align: center;
        }

        col {
            text-align: center;
            width: 20%;
        }
        .barcodeOne{
            margin: auto auto;
            padding: 0;
            position: relative;
            display: table;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row toPrint d-flex align-content-start flex-wrap">

            @foreach ($bookInventars as $k => $book_inventar)
                
                @if (env('BAR_CODE_TYPE')=='QRCODE')
                    <div class="col">
                        <div class=" text-center">
                            <div class="qr_code">
                                <br>
                                <br>
                                {!! QrCode::size(98)->generate($book_inventar->inventar_number) !!}
                                <br>
                                {{ $book_inventar->inventar_number }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col">
                        <div class=" text-center">
                            <div class="qr_code barcodeOne text-center">
                                <br>
                                @php
                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                    echo '<img style="display: block" src="data:image/png;base64,' . base64_encode($generator->getBarcode($book_inventar->bar_code, $generator::TYPE_CODE_128)) . '">';
                                    echo $book_inventar->bar_code;
                                @endphp
                            </div>
                        </div>
                    </div>
                @endif
                @if ($k%50==0)
                    <br>
                    <br>
                @endif
            @endforeach

        </div>
    </div>

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
