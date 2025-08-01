<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="card">
        <div class="card-header">
            <div class="row">

                <div class="float-right">
                    <form method="get">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="{{ __('Keyword') }}..."
                                   wire:model="search" class="form-control">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-primary">{{ __('Search') }}</button>
                            </span>
                        </div>
                    </form>
                    <div wire:loading>{{ __('Searching') }}...</div>
                    <div wire:loading.remove></div>
                    <span id="card_title">
                    </span>
                </div>


            </div>
        </div>
        <div class="card-body">
            <div class="float-left">
                {!! __('Users :attribute', ['attribute' => $users->total()]) !!}
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>{{ __('IsActive') }}</th>
                        <th>{{ __('Data') }}</th>
                        <th>{{ __('Bar code') }}</th>
                        <th class="text-center">{{ __('is RFID isset?') }}</th>

                        <th>{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>

                            <td>

                                {!! $user->status == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                            </td>
                            <td>
                               <strong>{{ __('Name') }}</strong>: {{ $user->name }} <br>
                                <strong>{{ __('Email') }}</strong>: {{ $user->email }} <br>

                            </td>
                            <td class="text-center">
                                @if(($user->inventar_number))

                                    @if (env('USER_BAR_CODE_TYPE')=='QRCODE')
                                        {!! QrCode::size(100)->generate($user->inventar_number); !!}
                                    @else
                                        @php
                                            $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                            echo $generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128, 2.30);

//                                                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                        @endphp
                                    @endif
                                @endif
                                <br>
                                {{ $user->inventar_number }}
                            </td>
                            <td>
                                {!! $user->rfid_tag_id != null
                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                            </td>
                            <td>
                                <button wire:click.prevent="giveRfid('{{ $rfid_tag }}', {{ $user->id }})" class="btn btn-sm btn-success">
                                    {{ __('Give RFID') }}
                                </button>
{{--                                <a class="btn btn-sm btn-success"--}}
{{--                                   href="{{ route('books.rfidgive', [app()->getLocale(), $rfid_tag, $user->id]) }}">--}}
{{--                                    {{ __('Give RFID') }}</a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($users->count() > 0)
                {!! $users->appends(Request::all())->links() !!}
            @endif
        </div>

    </div>

</div>
