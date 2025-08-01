<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="form-group">
        <label for="organization_id">{{ __('Organization') }}</label>
        <select wire:model="organization_id"
            class="form-control {{ $errors->has('organization_id') ? ' is-invalid' : '' }}" name="organization_id"
            id="organization_id">
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

            <select wire:model="branch_id" class="form-control" id="branch_id" name="branch_id">
                <option value="" selected>{{ __('Choose') }}</option>
                @foreach ($branches as $k => $city)
                    <option value="{{ $k }}">{{ $city }}</option>
                @endforeach
            </select>
        @else
            <label for="branch_id">{{ __('Branch') }}</label>
            <select wire:model="branch_id" class="form-control" id="branch_id" name="branch_id">
                <option value="" selected>{{ __('Choose') }}</option>
            </select>
        @endif
        {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group ">
        @if (!is_null($organization_id) && !is_null($branch_id))

            <label for="faculty_id">{{ __('Faculties') }}</label>
            <select wire:model="faculty_id" class="form-control" id="faculty_id" name="faculty_id">
                <option value="" selected>{{ __('Choose') }}</option>
                @foreach ($faculties as $k => $city)
                    <option value="{{ $k }}">{{ $city }}</option>
                @endforeach
            </select>
        @else
            <label for="faculty_id">{{ __('Faculties') }}</label>
            <select wire:model="faculty_id" class="form-control" id="faculty_id" name="faculty_id">
                <option value="" selected>{{ __('Choose') }}</option>
            </select>
        @endif
        {!! $errors->first('faculty_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group ">
        @if (!is_null($organization_id) && !is_null($branch_id) && !is_null($faculty_id))
            <label for="chair_id">{{ __('Chairs') }}</label>
            <select wire:model="chair_id" class="form-control" id="chair_id" name="chair_id">
                <option value="" selected>{{ __('Choose') }}</option>
                @foreach ($chairs as $k => $city)
                    <option value="{{ $k }}">{{ $city }}</option>
                @endforeach
            </select>
        @else
            <label for="chair_id">{{ __('Chairs') }}</label>
            <select wire:model="chair_id" class="form-control {{ $errors->has('chair_id') ? ' is-invalid' : '' }}"
                name="chair_id" id="chair_id">
                <option value="" selected>{{ __('Choose') }}</option>
            </select>

        @endif
        {!! $errors->first('chair_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>

</div>
