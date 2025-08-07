<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Label</title>

    <style type="text/css" media="print">
        @page {
            size: 60mm 40mm landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .label {
            width: 60mm;
            height: 38mm;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            page-break-after: always;
        }

        .label:last-child {
            page-break-after: auto;
        }

        .barcode, .qr_code {
            text-align: center;
        }

        .barcode-value {
            margin-top: 4px;
            font-size: 10px;
        }

        svg {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body translate="no">

<div class="label">
    @if (env('BAR_CODE_TYPE') === 'QRCODE')
        <div class="qr_code">
            {!! QrCode::format('svg')->size(100)->generate($bookInventar->bar_code) !!}
            <div class="barcode-value" style="font-size: 20px; font-weight: bold;">{{ $bookInventar->bar_code }}</div>
        </div>
    @else
        <div class="barcode">
            @php
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($bookInventar->bar_code, $generator::TYPE_CODE_128)) . '">';
            @endphp
            <div class="barcode-value" style="font-size: 20px; font-weight: bold;">{{ $bookInventar->bar_code }}</div>
        </div>
    @endif
</div>

<script>
    window.onload = function () {
        window.print();
        setTimeout(() => window.close(), 500);
    }
</script>
</body>

</html>
