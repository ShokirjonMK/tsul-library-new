<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .toPrint {
            position: relative;
            top: 40%;
            display: table;
            margin: -50px auto;
            padding: 10px;
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
    </style>
<style type="text/css">
     
    @page {
        size: 2.16535in 1.1811in landscape;
        margin: 0;
    }
    </style>
</head>

<body translate="no">

    <div class="toPrint d-flex align-content-start flex-wrap">
        <div class="barcode text-center">
            @php
                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128)) . '">';
            @endphp
            <center>{{ $user->inventar_number }}</center>
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
