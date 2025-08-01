<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="form-group">
        <label for="organization_id">{{ __('Organization') }}</label>
        <select wire:model="organization_id" class="form-control {{ $errors->has('organization_id') ? ' is-invalid' : '' }}"
            name="organization_id" id="organization_id">
            <option value="" selected>{{ __('Choose') }}</option>
            @foreach ($organizations as $k => $state)
                <option value="{{ $k }}">{{ $state }}</option>
            @endforeach
        </select>
        {!! $errors->first('organization_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    @if (!is_null($organization_id))
        <div class="form-group ">
            <label for="branch_id">{{ __('Branch') }}</label>
            <select wire:model="branch_id" class="form-control" id="branch_id" name="branch_id">
                <option value="" selected>{{ __('Choose') }}</option>
                @foreach ($branches as $k => $city)
                    <option value="{{ $k }}">{{ $city }}</option>
                @endforeach
            </select>
        </div>
    @else
        <div class="form-group ">
            <label for="branch_id">{{ __('Branch') }}</label>
        </div>
    @endif
    @if (!is_null($organization_id) && !is_null($branch_id))
        <div class="form-group ">
            <label for="faculty_id">{{ __('Faculties') }}</label>
            <select wire:model="faculty_id" class="form-control" id="faculty_id" name="faculty_id">
                <option value="" selected>{{ __('Choose') }}</option>
                @foreach ($faculties as $k => $city)
                    <option value="{{ $k }}">{{ $city }}</option>
                @endforeach
            </select>
        </div>
    @else
        <div class="form-group ">
            <label for="faculty_id">{{ __('Faculties') }}</label>
        </div>
    @endif
</div>
