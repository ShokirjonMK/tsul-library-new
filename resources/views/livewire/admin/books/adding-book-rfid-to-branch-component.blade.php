<div>

    <form method="POST" role="form" enctype="multipart/form-data" wire:submit.prevent="save">
        <div class="row">
            <div class="col-xl-7 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="box box-info padding-1">
                            <div class="box-body">
                                @if (in_array('SuperAdmin', $roles))

                                    <div class="form-group">
                                        <label for="organization">{{ __('Organization') }} </label>
                                        @if ($organizations->count() > 0)
                                            <select wire:model="organization_id"
                                                    class="form-control {{ $errors->has('organization') ? ' is-invalid' : '' }}"
                                                    name="organization_id" id="organization_id">
                                                <option value="" selected>{{ __('Choose') }}</option>
                                                @foreach ($organizations as $k => $state)
                                                    <option value="{{ $k }}">{{ $state }}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('organization_id', '<div class="invalid-feedback">:message</div>') !!}
                                        @endif
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="branch_id">{{ __('Branches') }}</label>
                                    @if (!is_null($organization_id))
                                        <div>
                                            <select id="branch_id"
                                                    class=" form-select form-control {{ $errors->has('branch_id') ? ' is-invalid' : '' }}"
                                                    wire:model="branch_id">
                                                <option value="">{{ __('Choose') }}</option>
                                                @foreach ($branches as $k => $v)
                                                    <option value="{{ $k }}">{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}

                                </div>
                                <div class="form-group">
                                    <label for="department_id">{{ __('Departments') }}  </label>

                                    @if ($organization_id > 0 && $branch_id > 0)
                                        <div>
                                            <select id="department_id"
                                                    class=" form-select form-control {{ $errors->has('department_id') ? ' is-invalid' : '' }}"
                                                    wire:model="department_id">
                                                <option value="">{{ __('Choose') }}</option>
                                                @foreach ($departments as $k => $v)
                                                    <option value="{{ $k }}">{{ $v }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    {!! $errors->first('department_id', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-5 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form">
                            <div class="form-group">
                                <div class="form-checkbox-box">
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" name="kutubxonada_bor" wire:model="kutubxonada_bor">
                                            {{ __('Is it in the library?') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-checkbox-box">
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" name="elektronni_bor" wire:model="elektronni_bor">
                                            {{ __('Is it in electronic format?') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-checkbox-box">
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" name="isActive" wire:model="isActive">
                                            {{ __('isActive') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ __('RFID') }} : <strong>{{$rfid_tag}}</strong>
                            </div>
                            <div class="row">
                                <div class="col-12 box-footer mt20">
                                    @if($isRFIDSave)
                                        <button type="submit"
                                                class="btn btn-primary"
                                                wire:loading.attr="disabled"
                                                wire:target="save">
                                                <span wire:loading.remove wire:target="save">
                                                    {{ __('Add RFID') }}
                                                </span>
                                                                                        <span wire:loading wire:target="save">
                                                    <i class="spinner-border spinner-border-sm" role="status"></i>
                                                    {{ __('Adding...') }}
                                                </span>
                                        </button>


{{--                                        <button type="submit" class="btn btn-primary">{{ __('Add RFID') }}</button>--}}
                                    @else
                                       <span class="btn btn-danger"> {{ __('This tag already exists') }}</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
