@extends('layouts.app')

@section('template_title')
    {{ __('Takegive') }}
@endsection

@section('content')
{{--    <link rel="stylesheet" href="{{ asset('rfid/style.css') }}" type="text/css">--}}
    <script>
        var baseUrl = 'http://localhost:9094';
    </script>
    <script src="{{ asset('rfid/Jquery.js') }}"></script>
    <script src="{{ asset('rfid/Log.js') }}"></script>
    <script src="{{ asset('rfid/FreqInfo.js') }}"></script>
    <script src="{{ asset('rfid/Devicepara.js') }}"></script>
    <script src="{{ asset('rfid/Reader.js') }}"></script>
    <script src="{{ asset('rfid/SerialConnect.js') }}"></script>
    <script src="{{ asset('rfid/NetConnect.js') }}"></script>
    <script src="{{ asset('rfid/ChannelRegion.js') }}"></script>

    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Takegive') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Takegive') }}
                </p>
            </div>
        </div>
{{--        <livewire:admin.rfid.connection-devices />--}}

        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">
                <div class="left">
                    <div class="action-panel">
                        <div class="connect-cfg">
                            <fieldset>
                                <legend>Serial Connect</legend>
                                <ul class="form-wrap">
                                    <li class="form-item">
                                        <label>port:</label>
                                        <div class="contrl-wrap">
                                            <div class="form-group row">
                                                <select id="port" class="form-select" ></select>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="form-item">
                                        <label>buad:</label>
                                        <div class="contrl-wrap">
                                            <div class="form-group row">

                                                <select id="cmbComBaud" class="form-select" >
                                                    <option value="0">9600</option>
                                                    <option value="1">19200</option>
                                                    <option value="2">38400</option>
                                                    <option value="3">57600</option>
                                                    <option value="4">115200</option>
                                                </select>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="form-item">
                                        <div class="contrl-wrap tc">
                                            <button class="btn btn-success" id="btnSportOpen">OPEN(O)</button>&nbsp;&nbsp;&nbsp;&nbsp;<button
                                                class="btn btn-danger" id="btnSportClose">CLOSE(C)
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </fieldset>
                            <hr>
                            <fieldset>
                                <legend>Net Connect</legend>
                                <ul class="form-wrap">
                                    <li class="form-item">
                                        <label>IP Addr:</label>
                                        <div class="contrl-wrap">
                                            <div class="form-group row">
                                                <input type="text" id="idAddr" value="192.168.1.200" class="form-control "/>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="form-item">
                                        <label>port:</label>
                                        <div class="contrl-wrap">
                                            <div class="form-group row">
                                                <input type="text" id="net_port" value="2022" class="form-control "/>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="form-item">
                                        <div class="contrl-wrap tc">
                                            <button class="btn btn-success" id="btnConnect">CONNECT(C)</button>&nbsp;&nbsp;&nbsp;&nbsp;<button
                                                class="btn btn-danger" id="btnDisConnect">DISCONNECT(C)
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </fieldset>

                        </div>
                        <hr>
                        <div class="other-cfg">
                            <ul class="form-wrap mt20">
                                <li class="form-item">
                                    <div class="contrl-wrap space-around">
                                        <button class="btn btn-success  start" style="width:30%" id="btnInventoryActive">Start
                                        </button>
                                        <button class="btn btn-danger stop" style="width:30%" id="btninvStop">Stop</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                            <tr>
                                <th>No.</th>
                                <th>Data</th>
                                <th>Len</th>
                                <th>Cnt(Ant1/2/3/4)</th>
                                <th>RSSI(dBm)</th>
                                <th>Channel</th>
                            </tr>
                            </thead>
                            <tbody id="data_table_body">

                            </tbody>
                        </table>
                    </div>

                    <p class="tr" style="margin-right:10px">
                        <button class="btn" id="btnClear">Clear</button>
                    </p>
                </div>


                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">
                        <div class="right">
                            <ul id="log">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var devicepara = new Devicepara();
        Reader.init();
        ChannelRegion.init()
        SerialConnect.init();
        NetConnect.init();
        console.log(window.location.hostname);
        console.log(window.location.host);
        console.log(window.location.origin);

    </script>
@endsection
