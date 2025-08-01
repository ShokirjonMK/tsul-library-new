<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="where_id">{{ __('Where') }}</label>
                <div wire:ignore>
                    <select id="where_id"
                        class=" form-select  form-control {{ $errors->has('where_id') ? ' is-invalid' : '' }}"
                        wire:model="where_id">
                        <option value="{{null}}">{{ __('Choose') }}</option>

                        @foreach ($wheres as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>  
                {!! $errors->first('where_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                <label for="arrived_date">{{ __('Arrived Year') }}</label>
                <input type="number" class="form-control " name="arrived_date" wire:model="arrived_date"
                    id="arrived_date" placeholder="{{ __('Arrived Year') }}" />
                {!! $errors->first('arrived_date', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="summarka_raqam">{{ __('Summarka Raqam') }}</label>
                <input type="text" class="form-control  {{ $errors->has('summarka_raqam') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Summarka Raqam') }}" name="summarka_raqam" id="summarka_raqam"
                    wire:model="summarka_raqam">
                {!! $errors->first('summarka_raqam', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                <label for="price">{{ __('Price') }} ({{ __('Contract price') }})</label>
                <input type="text" class="form-control  {{ $errors->has('price') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Price') }}" name="price" id="price" wire:model="price">
                {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div> 
    </div>


    <button wire:click="store()" class="btn btn-primary">{{ __('Save') }}</button>
</div>
 