<div>
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                {{-- Number of records is :attribute --}}
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <br>
                            {!! __('Number of records is :attribute', ['attribute' => $resDocuments->total()]) !!} | {!! __('Copy count :attribute', ['attribute' => $totalCopies]) !!} | {!! __('The total amount is :attribute soums', ['attribute' => $totalPrice]) !!} 
                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="ec-cat-form">

                        @if ($updateMode)
                            @include('livewire.admin.documents.partials.update-resource')
                        @else
                            @include('livewire.admin.documents.partials.create-resource')
                        @endif

                    </div>
                    <hr> 
                    @if ($updateMode != true && $resDocuments->count() > 0)
                        <div class="col-12 col-sm-12 col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>{{ __('Book Title') }} </th>
                                            <th>{{ __('Book Type') }}</th>
                                            {{-- <th>{{ __('Book Publishers') }}</th> --}}
                                            {{-- <th>{{ __('Where') }}</th> --}}
                                            {{-- <th>{{ __('Basics') }}</th> --}} 
                                            <th>{{ __('Copies') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Total price') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $copies=0;
                                            $total=0;
                                        @endphp
                                        @foreach ($resDocuments as $resDocument)
                                            <tr>
                                                <td>{{ $resDocument->id }}</td>
                                                <td>
                                                    <b> {{ __('Book Author') }}:</b>
                                                    {{ $resDocument->resource->authors }}
                                                    <br>
                                                    <b>{{ __('Book Title') }}:</b> {{ $resDocument->resource->title }}
                                                    <br>
                                                    <b>{{ __('Publisher') }}:</b>
                                                    {!! $resDocument->resource->publisher_id ? $resDocument->resource->publisher->title : '' !!}
                                                    <br>
 
                                                    <b>{{ __('Published City') }}:</b>
                                                    {{ $resDocument->resource->published_city }} <br>
                                                    <b>{{ __('Published Year') }}:</b>
                                                    {{ $resDocument->resource->published_year }} <br>
                                                    
                                                </td>

                                                <td>
                                                    {!! $resDocument->resource->type_id ? $resDocument->resource->genType->title : '' !!}

                                                </td>
                                                {{-- <td>
                                                    {!! $resDocument->resource->publisher_id ? $resDocument->resource->publisher->title : '' !!}

                                                </td> --}}
                                                {{-- <td>

                                                    {!! $resDocument->resource->where_id ? $resDocument->resource->where->title : '' !!}
                                                </td> --}}
                                                {{-- <td>
                                                    {!! $resDocument->resource->basic_id ? $resDocument->resource->basic->title : '' !!}
                                                </td> --}}
                                                <td>
                                                    {{ $resDocument->resource->copies }} 
                                                </td>
                                                <td>
                                                    {{ number_format($resDocument->resource->price, 2, '.', ' ') }}
                                                </td>
                                                <td>
                                                    {{ number_format($resDocument->resource->copies *  $resDocument->resource->price, 2, '.', ' ')}}
                                                </td>
                                                <th>
                                                    <a href="#" class="btn btn-sm btn-success"
                                                        wire:click.prevent="edit({{ $resDocument->resource_id  }})">{{ __('Edit') }}</a>

                                                    <br>
                                                    <button type="button"
                                                        wire:click="deleteRes({{ $resDocument->resource_id}}, {{$resDocument->id}})"
                                                        class="btn btn-sm btn-danger btn-flat" data-toggle="modal"
                                                        data-target="#exampleModal">{{ __('Delete from DataBase') }}</button>

                                                </th>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($resDocuments->count() > 0)
                            {!! $resDocuments->appends(Request::all())->links() !!}
                        @endif
                    @endif
                </div>
                 <!-- Modal -->
                 <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1"
                 role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">
                                 {{ __('If you delete this, it will be gone forever.') }}
                             </h5>
                             <button type="button" class="close"
                                 data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true close-btn">×</span>
                             </button>
                         </div>
                         <div class="modal-body">
                             <p>{{ __('Are you sure you want to delete this record?') }}
                             </p>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary close-btn"
                                 data-dismiss="modal">{{ __('Close') }}</button>
                             <button type="button" wire:click.prevent="delete()"
                                 class="btn btn-danger close-modal"
                                 data-dismiss="modal">{{ __('Yes, Delete') }}</button>
                         </div>
                     </div>
                 </div>
             </div>
            </div>
        </div>
    </div>




</div>
