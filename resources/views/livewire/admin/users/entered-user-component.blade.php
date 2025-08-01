<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-header ">
                    <div class="container">

                        <div class="row">
                            <h4>{{__('User records entered by user')}}</h4>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>{{ __('From') }}</label>
                                <input type="date" class="form-control" wire:model="fromDate">
                            </div>

                            <div class="col-md-4">
                                <label>{{ __('To') }}</label>
                                <input type="date" class="form-control" wire:model="toDate">
                            </div>

                            <div class="col-md-4 d-flex align-items-end">
                                <button class="btn btn-primary" wire:click="$refresh">{{ __('Search') }}</button>
                                <button class="btn btn-secondary ml-2"
                                        wire:click="resetFilters">{{ __('Clear') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                            <tr>
                                <th>#</th>
                                <th>{{ __('IsActive') }}</th>
                                <th>{{ __('Bar code') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Roles') }}</th>
                                <th width="280px">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $key => $profile)
                                <tr>
                                    <td>{{ $profile->user->id }}</td>
                                    <td>{!! $profile->user->status == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                    <td class="text-center">
                                        @if(($profile->user->inventar_number))
                                            @if (env('USER_BAR_CODE_TYPE')=='QRCODE')
                                                {!! QrCode::size(100)->generate($profile->user->inventar_number); !!}
                                            @else
                                                @php
                                                    $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                    echo $generator->getBarcode($profile->user->inventar_number, $generator::TYPE_CODE_128, 2.30);
                                                @endphp
                                            @endif
                                        @endif
                                        <br>
                                        {{ $profile->user->inventar_number }}
                                    </td>
                                    <td>{{ $profile->user->name }}</td>
                                    <td>{{ $profile->user->created_at }}</td>
                                    <td>{{ $profile->user->email }}</td>
                                    <td>
                                        @if(!empty($profile->user->getRoleNames()))
                                            @foreach($profile->user->getRoleNames() as $val)
                                                <label class="badge badge-purple">{{ $val }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $role = $profile->user->getRoleNames()->toArray();
                                        @endphp
                                        @if((in_array('SuperAdmin', $role) || in_array('Admin', $role) || in_array('Manager', $role) ) && !Auth::user()->hasRole('SuperAdmin'))

                                        @else
                                            <a class="btn btn-sm btn-primary "
                                               href="{{ route('users.show', [app()->getLocale(), $profile->user->id]) }}"> {{ __('Show') }}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($users->count() > 0)
                        {!! $users->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
