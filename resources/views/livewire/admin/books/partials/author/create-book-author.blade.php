<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="where_id">{{ __('Extra Author') }}</label>
                <div wire:ignore>
                    <select id="extra_author_id"
                        class=" form-select form-control {{ $errors->has('extra_author_id') ? ' is-invalid' : '' }}"
                        wire:model.defer="extra_author_id">
                        <option value="{{null}}">{{ __('Choose') }}</option>

                        @foreach ($authorTypes as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select> 
                </div>
                {!! $errors->first('extra_author_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="fio">{{ __('Author') }}</label>
                <input type="text" class="form-control  {{ $errors->has('fio') ? ' is-invalid' : '' }}"
                    placeholder="{{ __('Author') }}" name="fio" id="fio"
                    wire:model.defer="fio">
                {!! $errors->first('fio', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div> 
    </div>
    <button wire:click="save()" class="btn btn-primary">{{ __('Save') }}</button>
</div>
