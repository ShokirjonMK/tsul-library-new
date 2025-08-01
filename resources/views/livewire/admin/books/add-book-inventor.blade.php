<div>

    @if ($book_information != null && $book_information->count() > 0)
        <div class="row">

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>{{ __('IsActive') }}</th>
                            <th>{{ __('Summarka Raqam') }}</th>
                            <th>{{ __('Arrived Year') }}</th>
                            <th>{{ __('Organization') }}</th>
                            <th>{{ __('Branches') }}</th>
                            <th>{{ __('Departments') }}</th>

                            <th>{{ __('Is it in the library?') }}</th>
                            <th>{{ __('Is it in electronic format?') }}</th>
                            <th>{{ __('Copy count') }}</th>
                            <th>{{ __('Created By') }}</th>
                            <th>{{ __('Updated By') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ $book_information->id }}
                            </td>
                            <td>{!! $book_information->isActive == 1
                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                            <td>{{ $book_information->summarka_raqam }}</td>
                            <td>{{ $book_information->arrived_year }}</td>
                            <td>{!! $book_information->organization ? $book_information->organization->title : '' !!}</td>
                            <td>{!! $book_information->branch ? $book_information->branch->title : '' !!}</td>
                            <td>{!! $book_information->department ? $book_information->department->title : '' !!}</td>
                            <td>{!! $book_information->kutubxonada_bor == 1
                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                            <td>{!! $book_information->elektronni_bor == 1
                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                            <td>{{ $book_information->bookInventar->count() }}</td>
                            <td>
                                {!! $book_information->created_by ? $book_information->createdBy->name : '' !!}
                            </td>
                            <td>
                                {!! $book_information->updated_by ? $book_information->updatedBy->name : '' !!}
                            </td>

                            <td>
                                <div class="btn-group mb-1">

                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    @endif
    <div class="row">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">

                        <div class="box box-info padding-1">
                            <div class="box-body">

                                @if ($updateMode)
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" role="form" enctype="multipart/form-data">
                                        <div class="row align-items-center justify-content-center">
                                            <input type="hidden" wire:model="book_inventar_id">

                                            <div class="col-6 col-sm-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="bar_code">{{ __('Bar code') }}</label>
                                                    <input type="number" class="form-control"
                                                        wire:model.defer="bar_code" placeholder="{{ __('Bar code') }}"
                                                        id="bar_code">

                                                    @error('bar_code')
                                                        <span class="invalid-feedback error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-6 col-lg-6">
                                                <div class="form-group">
                                                    <label for="inventar_number">{{ __('Inventar Number') }}</label>
                                                    <input type="text" class="form-control"
                                                        wire:model="inventar_number"
                                                        placeholder="{{ __('Inventar Number') }}" id="inventar_number">

                                                    @error('inventar_number')
                                                        <span class="invalid-feedback error">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="col-12 col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <div class="form-checkbox-box">
                                                        <div class="form-check form-check-inline">
                                                            <label>
                                                                <input type="checkbox" name="isActive"
                                                                    wire:model="isActive">
                                                                {{ __('isActive') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 box-footer mt20">
                                                    <button wire:click.prevent="update"
                                                        class="btn btn-primary">{{ __('Update') }}</button>

                                                    <button wire:click.prevent="clearPage"
                                                        class="btn btn-success">{{ __('Clear') }}</button>

                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </form>
                                @else
                                    <form role="form" enctype="multipart/form-data">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col-3 col-sm-3 col-lg-3">
                                                <div class="form-group">
                                                    <label
                                                        for="inventarNumberGenerator">{{ __('Inventar Number') }}</label>
                                                    <input type="text" class="form-control"
                                                        wire:model.defer="inventarNumberGenerator"
                                                        placeholder="{{ __('Inventar Number') }}"
                                                        id="inventarNumberGenerator">

                                                    @error('inventarNumberGenerator')
                                                        <span class="invalid-feedback error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-2 col-sm-2 col-lg-2">
                                                <div class="form-group">
                                                    <label for="key">{{ __('Key') }}</label>
                                                    <input type="text" class="form-control" wire:model.defer="key"
                                                        placeholder="{{ __('Key') }}" id="key">

                                                    @error('key')
                                                        <span class="invalid-feedback error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-2 col-sm-2 col-lg-2">

                                                <div class="form-group">
                                                    <label for="from">{{ __('Bar code') }},
                                                        {{ __('from') }}</label>
                                                    <input type="number" class="form-control" wire:model.defer="from"
                                                        placeholder="{{ __('from') }}" id="from">

                                                    @error('from')
                                                        <span class="invalid-feedback error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-2 col-sm-2 col-lg-2">

                                                <div class="form-group">
                                                    <label for="to">{{ __('Bar code') }},
                                                        {{ __('to') }}</label>
                                                    <input type="number" class="form-control" wire:model.defer="to"
                                                        placeholder="{{ __('to') }}" id="to">

                                                    @error('to')
                                                        <span class="invalid-feedback error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-2 col-sm-2 col-lg-3box-footer mt20">
                                                <button class="btn btn-primary"
                                                    wire:click.prevent="generate">{{ __('Generate') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <form role="form" enctype="multipart/form-data">
                                        @foreach ($inputs as $key => $input)
                                            <div class="row align-items-center justify-content-center">

                                                <div class="col-6 col-sm-6 col-lg-6">
                                                    <div class="form-group">

                                                        <label
                                                            for="bar_code{{ $key }}">{{ __('Bar code') }}</label>
                                                        <input type="number" class="form-control"
                                                            wire:model.defer="inputs.{{ $key }}.bar_code"
                                                            placeholder="{{ __('Bar code') }}"
                                                            id="bar_code{{ $key }}">

                                                        @error('inputs.' . $key . '.bar_code')
                                                            <span
                                                                class="invalid-feedback error">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="inventar_number{{ $key }}">{{ __('Inventar Number') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model.defer="inputs.{{ $key }}.inventar_number"
                                                            placeholder="{{ __('Inventar Number') }}"
                                                            id="inventar_number{{ $key }}">

                                                        @error('inputs.' . $key . '.inventar_number')
                                                            <span
                                                                class="invalid-feedback error">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-12 box-footer mt20">
                                            <button class="btn btn-primary"
                                                wire:click.prevent="save">{{ __('Save') }}</button>
                                        </div>
                                        <hr>
                                    </form>
                                @endif

                                @if ($bookinventars->count() > 0)
                                    <div class="col-12 col-sm-12 col-lg-12">
                                        <a href="{{ route('books.inventaronebarcode', [app()->getLocale(), '0', 'book_information' => $book_information->id]) }}"
                                            class="btn btn-primary float-right" data-placement="left"
                                            target="_blank">
                                            <i class="mdi mdi-18px mdi-barcode"></i>
                                        </a>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="thead">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>{{ __('IsActive') }}</th>
                                                        <th>{{ __('Inventar Number') }}</th>
                                                        <th class="text-center">{{ __('Bar code') }}</th>
                                                        <th>{{ __('Created By') }}</th>
                                                        <th>{{ __('Updated By') }}</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bookinventars as $book_inventar)
                                                        <tr>
                                                            <td>
                                                                {{ $book_inventar->id }}
                                                            </td>
                                                            <td>

                                                                {{-- {!! $book_inventar->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!} --}}
                                                                {!! \App\Models\BookInventar::GetStatus($book_inventar->isActive) !!}


                                                            </td>
                                                            <td>{{ $book_inventar->inventar_number }}</td>
                                                            <td class="text-center">
                                                                @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                                    {!! QrCode::size(100)->generate($book_inventar->bar_code) !!}
                                                                @else
                                                                    @php
                                                                        $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                                        echo $generator->getBarcode($book_inventar->bar_code, $generator::TYPE_CODE_128, 2.30);

                                                                    @endphp
                                                                @endif
                                                                <br>
                                                                {{ $book_inventar->bar_code }}
                                                            </td>
                                                            <td>
                                                                {!! $book_inventar->created_by ? $book_inventar->createdBy->name : '' !!}

                                                            </td>
                                                            <td>
                                                                {!! $book_inventar->updated_by ? $book_inventar->updatedBy->name : '' !!}
                                                            </td>
                                                            <td>
                                                                <div class="btn-group mb-1">
                                                                    {{-- <button class="dropdown-item" wire:click="edit({{$book_inventar->id}})">{{ __('Edit') }}</button>
                                                                <button class="dropdown-item" wire:click="destroy({{$book_inventar->id}})">{{ __('Delete') }}</button> --}}
                                                                    <a href="{{ route('books.inventarone', [app()->getLocale(), $book_inventar->id]) }}"
                                                                        rel="noopener" target="_blank"
                                                                        class="btn-sm btn btn-success "
                                                                        target="__blank"><i
                                                                            class="mdi mdi-18px mdi-printer"></i></a>
                                                                    @if ($book_inventar->isActive == 1 || $book_inventar->isActive == 0)
                                                                        <a href="#"
                                                                            class="btn btn-sm btn-success"
                                                                            wire:click.prevent="edit({{ $book_inventar->id }})">{{ __('Edit') }}</a>
                                                                        <a href="#"
                                                                            class="btn btn-danger btn-sm"
                                                                            wire:click.prevent="removeInventar({{ $book_inventar->id }})">{{ __('Delete') }}</a>
                                                                    @endif
                                                                </div>
                                                                @if (Auth::user()->hasRole('SuperAdmin'))
                                                                    <br>
                                                                    <button type="button"
                                                                        wire:click="deleteInventar({{ $book_inventar->id }})"
                                                                        class="btn btn-sm btn-danger btn-flat"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModal">{{ __('Delete from DataBase') }}</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

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
                                    @if ($bookinventars->count() > 0)
                                        {!! $bookinventars->appends(Request::all())->links() !!}
                                    @endif
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
