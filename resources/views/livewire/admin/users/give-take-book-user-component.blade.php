<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-header ">
                    <div class="container">

                        <div class="row">
                            <h4>{{__('Number of services provided to the user')}}</h4>
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
