<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Print Labels</title>

    <style>
        @page {
            size: 60mm 40mm;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background: #fff;
            text-align: center;
        }

        .label {
            width: 60mm;
            height: 40mm;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            page-break-after: always;
            page-break-inside: avoid;
        }

        .barcode-value {
            margin-top: 4px;
            font-size: 10px;
            word-break: break-word;
        }
    </style>
</head>

<body>
@if (env('BAR_CODE_TYPE') === 'QRCODE')
    @foreach ($bookInventars as $book_inventar)
        <div class="label">
            {!! QrCode::size(95)->generate($book_inventar->bar_code) !!}
            <div class="barcode-value">{{ $book_inventar->bar_code }}</div>
        </div>
    @endforeach
@else
    @foreach ($bookInventars as $book_inventar)
        <div class="label">
            @php
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($book_inventar->bar_code, $generator::TYPE_CODE_128)) . '">';
            @endphp
            <div class="barcode-value" style="font-size: 20px; font-weight: bold;">
                {{ $book_inventar->bar_code }}
            </div>
        </div>
    @endforeach
@endif

<script>
    window.onload = function() {
        window.print();
        setTimeout(function() {
            window.close();
        }, 500);
    };
</script>
</body>
</html>
