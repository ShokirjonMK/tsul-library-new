<div>

    <form>
        <div class=" add-input">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="resTitle">{{ __('Book Title') }} </label>
                        <input type="text" class="form-control" wire:model.defer="resTitle"
                            placeholder="{{ __('Book Title') }}" id="resTitle">
                        @error('resTitle')
                            <span class="invalid-feedback error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="resAuthors">{{ __('Book Author') }} </label>
                        <input type="text" class="form-control" wire:model.defer="resAuthors" {{-- data-role="tagsinput" --}}
                            placeholder="{{ __('Book Author') }}" id="resAuthors">
                        @error('resAuthors')
                            <span class="invalid-feedback error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="published_year">{{ __('Published Year') }} </label>
                        <input type="number" class="form-control" wire:model.defer="published_year"
                            placeholder="{{ __('Published Year') }}" id="published_year">
                        @error('published_year')
                            <span class="invalid-feedback error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="published_city">{{ __('Published City') }} </label>
                        <input type="text" class="form-control" wire:model.defer="published_city"
                            placeholder="{{ __('Published City') }}" id="published_city">
                        @error('published_city')
                            <span class="invalid-feedback error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="copies">{{ __('Copies') }} </label>
                        <input type="number" class="form-control" wire:model.defer="copies"
                            placeholder="{{ __('Copies') }}" id="copies">
                        @error('copies')
                            <span class="invalid-feedback error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price">{{ __('Price') }} </label>
                        <input type="number" class="form-control" wire:model.defer="price"
                            placeholder="{{ __('Price') }}" id="price">
                        @error('price')
                            <span class="invalid-feedback error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="publisher_id">{{ __('From whom or where it came from') }}</label>
                        <div wire:ignore>
                            <select id="publisher_id" class=" form-select form-control " wire:model.defer="publisher_id">
                                <option value=0>{{ __('Please select') }}</option>

                                @foreach ($resPublishers as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        {!! $errors->first('publisher_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div> 
                    <div class="form-group">
                        <label for="type_id">{{ __('Book Type') }} </label>
                        <div>
                            <select id="type_id" class=" form-select form-control " wire:model.defer="type_id">
                                <option value=0>{{ __('Please select') }}</option>
                                @foreach ($resTypes as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        {!! $errors->first('type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    {{-- <div class="form-group">
                        <label for="publisher_id">{{ __('Book Publishers') }}</label>
                        <div wire:ignore>
                            <select id="publisher_id" class=" form-select form-control "
                                wire:model.defer="publisher_id">
                                <option value=0>{{ __('Please select') }}</option>

                                @foreach ($resPublishers as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        {!! $errors->first('publisher_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div> --}}

                    {{-- <div class="form-group">
                        <label for="where_id">{{ __('Where') }}</label>
                        <div wire:ignore>
                            <select id="where_id" class=" form-select form-control " wire:model.defer="where_id">
                                <option value=0>{{ __('Please select') }}</option>

                                @foreach ($resWheres as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        {!! $errors->first('where_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div> --}}
                    <div class="form-group">
                        <label for="book_language_id">{{ __('Book Language') }}</label>
                        <div wire:ignore>
                            <select id="book_language_id" class=" form-select form-control " wire:model.defer="book_language_id">
                                <option value=0>{{ __('Please select') }}</option>

                                @foreach ($bookLanguage as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        {!! $errors->first('book_language_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="book_text_id">{{ __('Book Text') }}</label>
                        <div wire:ignore>
                            <select id="book_text_id" class=" form-select form-control " wire:model.defer="book_text_id">
                                <option value=0>{{ __('Please select') }}</option>

                                @foreach ($bookTexts as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        {!! $errors->first('book_text_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="basic_id">{{ __('Basics') }}</label>
                        <div wire:ignore>
                            <select id="basic_id" class=" form-select form-control " wire:model.defer="basic_id">
                                <option value=0>{{ __('Please select') }}</option>

                                @foreach ($resBasics as $k => $v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                        {!! $errors->first('basic_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    
                    <div class="form-group">
                        <div class="form-checkbox-box">
                            <div class="form-check form-check-inline">
                                <label>
                                    <input type="checkbox" name="taken_into_account" wire:model="taken_into_account">
                                    {{ __('Is it taken into account?') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="button" wire:click.prevent="store()" class="btn btn-success btn-sm">{{ __('Save') }}</button>
            </div>
        </div>
    </form>

</div>


@push('scripts')
    <script>
        $(document).ready(function() {

            $('#type_id').select2({
                tags: true,
            });
            $('#type_id').on('change', function(e) {
                let data = $(this).val();

                @this.set('type_id', data);
            });

            $('#publisher_id').select2({
                tags: true,
            });

            $('#publisher_id').on('change', function(e) {
                let data = $(this).val();

                @this.set('publisher_id', data);
            });

            $('#where_id').select2({
                tags: true,
            });

            $('#where_id').on('change', function(e) {
                let data = $(this).val();

                @this.set('where_id', data);
            });

            $('#basic_id').select2({
                tags: true,
            });

            $('#basic_id').on('change', function(e) {
                let data = $(this).val();

                @this.set('basic_id', data);
            });

        });
    </script>
@endpush
