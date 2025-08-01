<div>
    <div class="row">
        <div class="form-group">
            <label for="journal_id">{{ __('Journals') }}</label>
            <div wire:ignore>
                <select id="journal_id" name="journal_id"
                    class=" form-select form-control {{ $errors->has('journal_id') ? ' is-invalid' : '' }}"
                    wire:model="journal_id">
                    <option value="null">{{ __('Choose') }}</option>
                    @foreach ($journals as $k => $v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select> 
            </div>
            
            {!! $errors->first('journal_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            @if ($journal_id > 0)
                <label for="magazine_issue_id">{{ __('Magazine Issue') }}</label>
                <div>
                    <select id="magazine_issue_id" name="magazine_issue_id"
                        class=" form-select form-control {{ $errors->has('magazine_issue_id') ? ' is-invalid' : '' }}"
                        wire:model="magazine_issue_id">
                        <option value="null">{{ __('Choose') }}</option>
                        @foreach ($magazines as $k => $v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <label for="magazine_issue_id">{{ __('Magazine Issue') }}</label>
                <select id="magazine_issue_id"
                    class=" form-select form-control {{ $errors->has('magazine_issue_id') ? ' is-invalid' : '' }}"
                    wire:model="magazine_issue_id">
                    <option value="null">{{ __('Choose') }}</option>
                </select>
            @endif
            {!! $errors->first('magazine_issue_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
</div>
