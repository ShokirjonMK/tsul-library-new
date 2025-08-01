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
        body{
    font-family: "Times New Roman", Times, serif;
}
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col" >
                <h2 align="right">Tasdiqlayman</h2>
                <h2 align="right">______ Axborot – resurs</h2>
                <h2 align="right">markazi direktori <br> _____________________</h2>
                <br/>
                <center>
                    <h1>{{$document->title}} № {{$document->number}}</h1>
                </center>
                <div class="d-flex justify-content-between">
                    <div>
                        Toshkent
                    </div>
                    <div>
                        {{ $document->deed_date }}
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
                        <th scope="col">Kitob nomi, muallifi,nashr yili</th>
                        <th scope="col">Soni</th>
                        <th scope="col">Narxi</th>
                        <th scope="col">Um. summa.</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $copies=0;
                            $total=0;
                        @endphp
                        @foreach ($resDocuments as $resDocument)
                            <tr>
                                <th scope="row">{{ $loop->index+1 }}.</th>
                                <td>
                                    {{ $resDocument->resource->title }}. {{ $resDocument->resource->authors }}.<span class="dashes">-</span>
                                    {{-- {!! $resDocument->resource->publisher_id ? $resDocument->resource->publisher->title : '' !!} --}}
                                    {{ strtoupper(substr($resDocument->resource->published_city, 0, 1)) }}.,
                                    {{ $resDocument->resource->published_year }}
                                </td>
                                <td>
                                    @php
                                        $copies += $resDocument->resource->copies;
                                        $total += ($resDocument->resource->copies *  $resDocument->resource->price);
                                    @endphp
                                    {{ $resDocument->resource->copies }}</td>
                                <td>{{ number_format($resDocument->resource->price, 2, '.', ' ') }}</td>
                                <td>{{ number_format($resDocument->resource->copies *  $resDocument->resource->price, 2, '.', ' ')}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td> <b> {{__('Total')}}:</b></td>
                            <td>{{$copies}}</td>
                            <td></td>
                            <td>{{ number_format($total,2, '.', ' ') }} </td>
                        </tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

</body>

</html>
