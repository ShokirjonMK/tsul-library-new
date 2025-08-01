<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <button class='btn btn-sm btn-primary'
                                wire:click="show({{ 99 }})">{{ __('ALL') }} </button>
                            <button class='btn btn-sm btn-primary'
                                wire:click="show({{ 1 }})">{{ __('GIVEN') }} </button>
                            <button class='btn btn-sm btn-success' wire:click="show({{ 2 }})">{{ __('TAKEN') }} </button>
                            <button class='btn btn-sm btn-success' wire:click="show({{ 98 }})">{{ __('Debtors') }} </button>
                            <button class='btn btn-sm btn-danger' wire:click="show({{ 0 }})">{{ __('DELETED') }} </button>
                            <br>
                            {!! __('Number of records is :attribute', ['attribute' => $debtors->count() ]) !!}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Reader') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone Number') }}</th>
                                    <th>{{ __('Inventar Number') }}</th>
                                    <th>{{ __('Inventar Number') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($debtors as $debtor)
                                    <tr >
                                        <td>{{ $debtor->id }}</td>
                                        <td>
                                            {!! $debtor->reader ? $debtor->reader->name : '' !!}
                                        </td>
                                        <td><a href="mailTo:{!! $debtor->reader ? $debtor->reader->email : '' !!}">{!! $debtor->reader ? $debtor->reader->email : '' !!}</a></td>
                                        <td> <a href="tel:{!! $debtor->reader ? $debtor->reader->profile->phone_number : '' !!}">{!! $debtor->reader ? $debtor->reader->profile->phone_number : '' !!}</a></td>
                                        <td>
                                            <div class="text-center">
                                                @if(($debtor->reader->inventar_number))

                                                    @if (env('USER_BAR_CODE_TYPE')=='QRCODE')
                                                        {!! QrCode::size(100)->generate($debtor->reader->inventar_number); !!}
                                                    @else
                                                        @php
                                                            $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                            echo $generator->getBarcode($debtor->reader->inventar_number, $generator::TYPE_CODE_128, 2.30);
                                                        @endphp
                                                    @endif
                                                @endif
                                                <br>
                                                {{ $debtor->reader->inventar_number }}
                                            </div>
                                        </td>


                                        <td>
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('debtors.show', [app()->getLocale(), $debtor->reader_id, 'status' => $status]) }}">
                                                    {{ __('Show') }}</a>
                                                {{-- <a class="btn btn-sm btn-success" href="{{ route('debtors.edit', [app()->getLocale(), $debtor->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- @if ($debtors->count() > 0)
                        {!! $debtors->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif --}}
                </div>
            </div>
        </div>
    </div>


</div>
