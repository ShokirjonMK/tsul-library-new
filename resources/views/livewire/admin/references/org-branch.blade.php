<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="form-group">
        <label for="organization">{{ __('Organization') }}</label>
        <select wire:model="organization" class="form-control {{ $errors->has('organization') ? ' is-invalid' : '' }}"
            name="organization_id" id="organization_id">
            <option value="" selected>{{ __('Choose') }}</option>
            @foreach ($organizations as $k => $state)
                <option value="{{ $k }}">{{ $state }}</option>
            @endforeach
        </select>
        {!! $errors->first('organization', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    @if (!is_null($organization))
        <div class="form-group ">
            <label for="branch_id">{{ __('Branch') }}</label>
            <select wire:model="selectedBranch" class="form-control" id="branch_id" name="branch_id">
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
</div>
