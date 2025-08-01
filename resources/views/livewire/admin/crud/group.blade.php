<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @if ($updateMode)
        <form method="POST" role="form" enctype="multipart/form-data" wire:submit.prevent="update">
        @else
            <form method="POST" role="form" enctype="multipart/form-data" wire:submit.prevent="save">
    @endif

    <div class="row">

        <div class="col-xl-8 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card-body">
                    <div class="profile-content-right profile-right-spacing py-5">
                        <div class="tab-content px-3 px-xl-5" id="myTabContent">
                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input type="text"
                                    class="form-control  {{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Title') }}" name="title" id="title" wire:model="title">

                                {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="ec-cat-list card card-default mb-24px">
                <div class="card-body">
                    <div class="ec-cat-form">
                        <div class="form-group row">
                            <label for="isActive" class="form-label">{{ __('HEMIS Code') }}</label>
                            <input class="form-control" placeholder="{{ __('HEMIS Code') }}" name="code" type="text" wire:model="code">
                        </div>


                        <div class="form-group row">
                            <label for="isActive" class="form-label">{{ __('isActive') }}</label>
                            <select class="form-select" id="isActive" name="isActive" wire:model="isActive">

                                <option value='0' {{ $isActive ? '' : 'selected' }}>{{ __('Passive') }}
                                </option>
                                <option value='1' {{ $isActive ? 'selected' : '' }}>{{ __('Active') }}
                                </option>
                            </select>
                            @error('isActive')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="organization_id">{{ __('Organization') }}</label>
                            <select wire:model="organization_id"
                                class="form-control {{ $errors->has('organization_id') ? ' is-invalid' : '' }}"
                                name="organization_id" id="organization_id">
                                <option value="" selected>{{ __('Choose') }}</option>
                                @foreach ($organizations as $k => $state)
                                    <option value="{{ $k }}">{{ $state }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('organization_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group ">
                            @if (!is_null($organization_id))
                                <label for="branch_id">{{ __('Branch') }}</label>

                                <select wire:model="branch_id"
                                    class="form-control {{ $errors->has('branch_id') ? ' is-invalid' : '' }}"
                                    id="branch_id" name="branch_id">
                                    <option value="" selected>{{ __('Choose') }}</option>
                                    @foreach ($branches as $k => $city)
                                        <option value="{{ $k }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                            @else
                                <label for="branch_id">{{ __('Branch') }}</label>
                                <select wire:model="branch_id"
                                    class="form-control {{ $errors->has('branch_id') ? ' is-invalid' : '' }}"
                                    id="branch_id" name="branch_id">
                                    <option value="" selected>{{ __('Choose') }}</option>
                                </select>
                            @endif
                            {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group ">
                            @if (!is_null($organization_id) && !is_null($branch_id))

                                <label for="faculty_id">{{ __('Faculties') }}</label>
                                <select wire:model="faculty_id"
                                    class="form-control {{ $errors->has('faculty_id') ? ' is-invalid' : '' }}"
                                    id="faculty_id" name="faculty_id">
                                    <option value="" selected>{{ __('Choose') }}</option>
                                    @foreach ($faculties as $k => $city)
                                        <option value="{{ $k }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                            @else
                                <label for="faculty_id">{{ __('Faculties') }}</label>
                                <select wire:model="faculty_id"
                                    class="form-control {{ $errors->has('faculty_id') ? ' is-invalid' : '' }}"
                                    id="faculty_id" name="faculty_id">
                                    <option value="" selected>{{ __('Choose') }}</option>
                                </select>
                            @endif
                            {!! $errors->first('faculty_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group ">
                            @if (!is_null($organization_id) && !is_null($branch_id) && !is_null($faculty_id))
                                <label for="chair_id">{{ __('Chairs') }}</label>
                                <select wire:model="chair_id"
                                    class="form-control {{ $errors->has('chair_id') ? ' is-invalid' : '' }}"
                                    id="chair_id" name="chair_id">
                                    <option value="" selected>{{ __('Choose') }}</option>
                                    @foreach ($chairs as $k => $city)
                                        <option value="{{ $k }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                            @else
                                <label for="chair_id">{{ __('Chairs') }}</label>
                                <select wire:model="chair_id"
                                    class="form-control {{ $errors->has('chair_id') ? ' is-invalid' : '' }}"
                                    name="chair_id" id="chair_id">
                                    <option value="" selected>{{ __('Choose') }}</option>
                                </select>

                            @endif
                            {!! $errors->first('chair_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="row">
                            <div class="col-12 box-footer mt20">
                                <button type="submit" class="btn btn-primary"
                                    wire:loading.attr='disabled'>{{ __('Save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </form>

</div>
