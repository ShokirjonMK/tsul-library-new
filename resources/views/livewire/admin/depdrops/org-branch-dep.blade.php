<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @if ($type == 'inline')
        <div class="row">
            <div class="col-md-4">

                <div class="form-group">
                    <label for="organization_id">{{ __('Organization') }}</label>
                    <div wire:ignore>
                        <select id="organization_id" name="organization_id"
                            class=" form-select form-control {{ $errors->has('organization_id') ? ' is-invalid' : '' }}"
                            wire:model="organization_id">
                            <option value="0">{{ __('Choose') }}</option>
                            @foreach ($organizations as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                    {!! $errors->first('organization_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    @if ($organization_id > 0)
                        <label for="branch_id">{{ __('Branches') }}</label>
                        <div>
                            <select id="branch_id" name="branch_id"
                                class=" form-select form-control {{ $errors->has('branch_id') ? ' is-invalid' : '' }}"
                                wire:model="branch_id">
                                <option value="0">{{ __('Choose') }}</option>
                                @foreach ($branches as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <label for="branch_id">{{ __('Branches') }}</label>
                        <select id="branch_id"
                            class=" form-select form-control {{ $errors->has('branch_id') ? ' is-invalid' : '' }}"
                            wire:model="branch_id">
                            <option value="0">{{ __('Choose') }}</option>
                        </select>
                    @endif
                    {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>
            <div class="col-md-4">

                <div class="form-group">
                    <label for="department_id">{{ __('Departments') }}</label>
                    @if ($organization_id > 0 && $branch_id > 0)
                        <div>
                            <select id="department_id" name="department_id"
                                class=" form-select form-control {{ $errors->has('department_id') ? ' is-invalid' : '' }}"
                                wire:model="department_id">
                                <option value="0">{{ __('Choose') }}</option>
                                @foreach ($departments as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div>
                            <select id="department_id"
                                class=" form-select form-control {{ $errors->has('department_id') ? ' is-invalid' : '' }}"
                                wire:model="department_id">
                                <option value="0">{{ __('Choose') }}</option>
                            </select>
                    @endif
                    {!! $errors->first('department_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">

                <div class="form-group ">
                    @if (!is_null($organization_id) && !is_null($branch_id))

                        <label for="faculty_id">{{ __('Faculties') }}</label>
                        <select wire:model="faculty_id"
                            class="form-control {{ $errors->has('faculty_id') ? ' is-invalid' : '' }}" id="faculty_id"
                            name="faculty_id">
                            <option value="" selected>{{ __('Choose') }}</option>
                            @foreach ($faculties as $k => $city)
                                <option value="{{ $k }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    @else
                        <label for="faculty_id">{{ __('Faculties') }}</label>
                        <select wire:model="faculty_id"
                            class="form-control {{ $errors->has('faculty_id') ? ' is-invalid' : '' }}" id="faculty_id"
                            name="faculty_id">
                            <option value="" selected>{{ __('Choose') }}</option>
                        </select>
                    @endif
                    {!! $errors->first('faculty_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>
            <div class="col-md-4">

                <div class="form-group ">
                    @if (!is_null($organization_id) && !is_null($branch_id) && !is_null($faculty_id))
                        <label for="chair_id">{{ __('Chairs') }}</label>
                        <select wire:model="chair_id"
                            class="form-control {{ $errors->has('chair_id') ? ' is-invalid' : '' }}" id="chair_id"
                            name="chair_id">
                            <option value="" selected>{{ __('Choose') }}</option>
                            @foreach ($chairs as $k => $city)
                                <option value="{{ $k }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    @else
                        <label for="chair_id">{{ __('Chairs') }}</label>
                        <select wire:model="chair_id"
                            class="form-control {{ $errors->has('chair_id') ? ' is-invalid' : '' }}" name="chair_id"
                            id="chair_id">
                            <option value="" selected>{{ __('Choose') }}</option>
                        </select>

                    @endif
                    {!! $errors->first('chair_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>
            <div class="col-md-4">

                <div class="form-group ">
                    @if (!is_null($organization_id) && !is_null($branch_id) && !is_null($faculty_id) && !is_null($chair_id))
                        <label for="group_id">{{ __('Groups') }}</label>
                        <select wire:model="group_id"
                            class="form-control {{ $errors->has('group_id') ? ' is-invalid' : '' }}" id="group_id"
                            name="group_id">
                            <option value="" selected>{{ __('Choose') }}</option>
                            @foreach ($groups as $k => $city)
                                <option value="{{ $k }}">{{ $city }}</option>
                            @endforeach
                        </select>
                    @else
                        <label for="group_id">{{ __('Groups') }}</label>
                        <select wire:model="group_id"
                            class="form-control {{ $errors->has('group_id') ? ' is-invalid' : '' }}" name="group_id"
                            id="group_id">
                            <option value="" selected>{{ __('Choose') }}</option>
                        </select>

                    @endif
                    {!! $errors->first('group_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>
        </div>
    @endif



</div>
