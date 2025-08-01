<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="ec-cat-list card card-default">
            <div class="card">
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('Book') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Taken Time') }}</th>
                                    <th>{{ __('Return Time') }}</th>
                                    <th>{{ __('Returned Time') }}</th>
                                    <th>{{ __('How Many Days') }}</th>
                                    <th>{{ __('Dates of use') }}</th>
                                    <th>{{ __('Given By') }}</th>
                                    <th>{{ __('Taken By') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total = 0;
                            @endphp
                                @foreach ($debtors as $debtor)  
                                    <tr>
                                        <td>{{ $debtor->id }}</td>
                                        <td>
                                            {!!\App\Models\Book::GetBibliographicById($debtor->book_id )!!}
                                            <br>
                                            @if ($debtor->bookInventar!=null)
                                                <div class="text-center">
                                                    @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                        {!! QrCode::size(100)->generate($debtor->bookInventar->bar_code); !!}
                                                    @else
                                                        @php
                                                            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($debtor->bookInventar->bar_code, $generator::TYPE_CODE_128)) . '">';
                                                        @endphp
                                                    @endif 
                                                    <br>
                                                    {{ $debtor->bookInventar->bar_code }}

                                                </div>                                                        
                                            @endif
                                        </td>
                                        <td>{!! \App\Models\Debtor::GetStatus($debtor->status) !!}</td>

                                        <td>{{ $debtor->taken_time }}</td>
                                        <td>{{ $debtor->return_time }}</td>
                                        <td>{{ $debtor->returned_time }}</td>
                                        <td>{{ $debtor->how_many_days }}</td>
                                        <td>
                                            @php
                                                $today = date('Y-m-d');

                                                if ( $debtor->returned_time != null) {
                                                    $from = date_create($debtor->returned_time);
                                                   
                                                } else {
                                                    $from = date_create($today);
                                                }

                                                $to = date_create($debtor->taken_time);
                                                $diff = date_diff($to, $from);
                                                $total += intval($diff->format('%a'));
                                                echo $diff->format('%a');
                                            @endphp
                                        </td>
                                        <td>{!! $debtor->created_by ? $debtor->createdBy->name : '' !!}</td>
                                        <td>{!! $debtor->updated_by ? $debtor->updatedBy->name : '' !!}</td>



                                        <td>

                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6"></td>
                                    <td>{{ __('Total') }}</td>
                                    <td>{{ $total }} {{ __('Days') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if ($debtors->count() > 0)
                        {!! $debtors->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
 