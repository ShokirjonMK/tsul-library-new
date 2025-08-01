<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="float-right">
                    <form method="get">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="{{ __('Inventar Number') }}..."
                                wire:model="term" class="form-control">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-primary">{{ __('Search') }}</button>
                            </span>
                        </div>
                    </form>
                    <div wire:loading>{{ __('Searching') }}...</div>
                    <div wire:loading.remove></div>
                    <span id="card_title">
                        {{-- {{ __('Barcode') }} {{ $term }} --}}

                        @if (Request::all() != null)
                            <a href="{{ route('books.exportInventarAllByFromTo', [app()->getLocale(), 'sort']) }}"
                                class="btn bt-sm btn-primary float-right" data-placement="left" target="_blank">
                                {{ __('Export to Pdf') }}
                            </a> 
                        @else
                            <a href="{{ route('books.inventar', [app()->getLocale(), 'all']) }}"
                                class="btn bt-sm btn-primary float-right" data-placement="left" target="_blank">
                                {{ __('Export to Pdf') }}
                            </a>
                        @endif

                    </span>
                </div>

                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>{{ __('IsActive') }}</th>
                            <th>{{ __('Branches') }}</th>
                            <th>{{ __('Departments') }}</th>
                            <th>{{ __('Inventar Number') }}</th>
                            <th>{{ __('Bar code') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barcodes as $book_inventar)
                            <tr>
                                <td>{{ $book_inventar->id }}</td>

                                <td>{!! $book_inventar->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                <td>{!! $book_inventar->branch ? $book_inventar->branch->title : '' !!}</td>
                                <td>{!! $book_inventar->department ? $book_inventar->department->title : '' !!}</td>
                                <td class="text-center">
                                    {{ $book_inventar->inventar_number }}
                                </td>
                                <td class="text-center">
                                    @if (env('BAR_CODE_TYPE')=='QRCODE')
                                        {!! QrCode::size(100)->generate($book_inventar->bar_code); !!}
                                    @else
                                        @php
                                            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($book_inventar->bar_code, $generator::TYPE_CODE_128)) . '">';
                                        @endphp
                                    @endif
                                    <br>
                                    {{ $book_inventar->bar_code }}
                                </td>
                                <td>
                                    <a href="{{ route('books.inventar', [app()->getLocale(), $book_inventar->id]) }}"
                                        rel="noopener" target="_blank" class="btn-sm btn btn-success "
                                        target="__blank"><i class="mdi mdi-18px mdi-printer"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($barcodes->count() > 0)
                {!! $barcodes->appends(Request::all())->links() !!}
            @endif
        </div>

    </div>
</div>
