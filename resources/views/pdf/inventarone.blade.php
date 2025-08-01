<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            padding: 0;
            background: #e0e0e0;
        }
 

        .toPrint,
        .barcode {
            margin: 0;
            padding: 0;
            list-style: none; 
        }
        .barcodeOne{
            margin: auto auto;
            padding: 0;
            position: relative;
            display: table;
        }
        .toPrint {
            margin: auto auto;
            padding: 0;
            position: relative;
            top: 30%;

            display: table;
            background: @bgColor;
            /* box-shadow: 0px 1px 10px -5px #000; */
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
    </style>
</head>

<body  translate="no" style="text-align: center">

    <div class="toPrint d-flex align-content-start flex-wrap">
        <div class="barcode text-center">
            @if (env('BAR_CODE_TYPE')=='QRCODE')
                <div class="qr_code">
                    {!! QrCode::size(95)->generate($bookInventar->bar_code) !!}
                    <center>{{ $bookInventar->bar_code }}</center>
                </div>
            @else
                <div class="col" style="width: 60mm;">
                    @php
                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($bookInventar->bar_code, $generator::TYPE_CODE_128)) . '">';
                    @endphp
                    <center>{{ $bookInventar->bar_code }}</center>
                </div>
            @endif
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
