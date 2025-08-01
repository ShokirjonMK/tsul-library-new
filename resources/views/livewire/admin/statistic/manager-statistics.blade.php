<div>
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Monthly statistics of employee') }}</h1>
            </div> 
        </div>

        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">

                    <div class="card-header">
                        <form style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    {{$year}}  |  <input wire:model="message" type="text">
                                    <h1>{{ $message }}</h1>

                                    <div class="input-group input-daterange" wire:ignore>
                                        <select class="form-control" wire:model="year">
                                            <option>{{ __('Select Year') }}</option>
                                            @foreach ($years as $y)
                                                @if ($year==$y)
                                                    <option value="{{$y}}" selected> {{$y}} </option>
                                                @else
                                                    <option value="{{$y}}"> {{$y}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
 
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('Title') }}</th>
                                        @foreach ($months as $k => $month)
                                            <th>{{ $month }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($bookLanguages as $booksType) --}}
                                        {{-- <tr class="clickable-row" data-href="{{ route('book-types.show', [app()->getLocale(), $booksType->id]) }}"> --}}
                                        <tr>
                                            <td>#</td> 
                                            <td class="text text-right">
                                                {{-- {{ $booksType->title }} <br> {{ __('In the name') }}:<br> --}}
                                                {{-- {{ __('In copy') }}: --}}
                                            </td>
                                            @foreach ($months as $k => $month)
                                                <td>
                                                    <br>
                                                    {{-- {{ $booksType->id }} {{ $k }}, {{ $month }} --}} 
                                                    {{-- <b>{!! \App\Models\BookLanguage::GetCountBookByBookTypeByMonthAndId($booksType->id, $year, $k)!!}</b> <br>
                                                    <b>{!! \App\Models\BookLanguage::GetCountBookCopiesByBookTypeByMonthAndId($booksType->id, $year, $k)!!}</b> --}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>

                        </div>

                        <div class="clear"></div>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
