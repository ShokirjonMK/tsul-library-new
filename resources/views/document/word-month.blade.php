<?php
header('Content-Type: application/vnd.msword');
header('Content-Disposition: attachment; filename="' . $document_name . '"');
header('Cache-Control: private, max-age=0, must-revalidate');
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AKBT') }}</title>
    {{-- <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'> --}}

    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> --}}
    <link href="{{ asset('bootstrap-5/css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('bootstrap-5/bootstrap.min.js') }}"></script>

    <style>
        body {
            font-family: "Times New Roman", Times, serif;
        }
         
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 align="right">Tasdiqlayman</h2>
                <h2 align="right">______ Axborot – resurs</h2>
                <h2 align="right">markazi direktori <br> _____________________</h2>
                <br />
                <center>
                    {{-- <h1>{{$document->title}} № {{$document->number}}</h1> --}}
                </center>
                <div class="d-flex justify-content-between">
                    <div>
                        
                    </div>
                    <div>
                        {{-- {{ $document->deed_date }} --}}
                    </div>
                </div>

                {{-- Bizlar, quyida imzo chekuvchilar: Toshkent davlat yuridik universiteti Axborot-resurs markazi bosh
                kutubxonachisi Olimova Z.Yu., bibliograf Usmonaliyeva N.M., ushbu dalolatnomani tuzdik shu haqdakim,
                TDYU tipografiyasidan nakl. №9. 9.01.2023y. 3 nomda 120 nusxada 1 663 580 (Bir million olti yuz oltmish
                uch ming besh yuz sakson soʻmli) 40 tiyinli adabiyotlar qabul qilindi. --}}
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">Kim tomonidan tushgan va tashkilotning nomi</th>
                            <th scope="col">Kirim hujjati nomi va Sanasi</th>
                            <th scope="col">Kirim dalolatnomasi raqami  va sanasi</th>
                            <th scope="col">Asosida</th>
                            <th scope="col">Tushgan kitob soni</th>
                            <th scope="col">Fonddan chiqan t.s</th>
                            <th scope="col">Broshyuralar soni</th>
                            <th scope="col">Plakat</th>
                            <th scope="col">Buklet</th>
                            <th scope="col">Davriy obuna(jurnallar)</th>
                            <th scope="col">Balansga olinmaydigan adabiyetlar summasi</th>
                            <th scope="col">Balansdan chiqarilgan kitoblar summasi</th>
                            <th scope="col">Balansga olingan kitoblar summasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total=0;
                            $totalPrice=0;
                        @endphp
                        @foreach ($documents as $resDocument)
                            @php
                                // dd($resDocument);
                            @endphp
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}.</th>
                                <td>
                                    {{ $resDocument->where->title }}
                                </td>
                                <td>
                                    {{ $resDocument->consignment_note }} <br>
                                    {{ $resDocument->arrived_date }} 
                                </td>
                                <td>
                                    {{ $resDocument->title }} {{$resDocument->number}} <br>
                                    {{ $resDocument->arrived_date }} 
                                </td>
                                <td>Olindi</td>
                                <td>
                                    @php
                                        $copies=0;
                                        if ($resDocument->resourcesDocuments != null ) {
                                            foreach ($resDocument->resourcesDocuments as $key => $value) {
                                                $copies += $value->resource->copies;
                                            }
                                        }
                                        $total += $copies;
                                        echo $copies;
                                    @endphp

                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    @php
                                    $price=0;
                                    if ($resDocument->resourcesDocuments != null ) {
                                        foreach ($resDocument->resourcesDocuments as $key => $value) {
                                            $price += $value->resource->price * $value->resource->copies;
                                        }
                                    }
                                    $totalPrice += $price;
                                    echo number_format($price, 2, '.', ' ') 

                                @endphp

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" colspan="4">{{__('Total')}}</th>
                            <th scope="col">{{ $total}}</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">{{number_format($totalPrice, 2, '.', ' ') }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
