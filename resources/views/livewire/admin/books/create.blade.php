<div>
    <form method="POST" role="form" enctype="multipart/form-data" wire:submit.prevent="save">
        <div class="row">
            <div class="col-xl-7 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card-body">

                        <div class="box box-info padding-1">
                            <div class="box-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="dc_title">{{ __('Dc Title') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('dc_title') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Dc Title') }}" name="dc_title" id="dc_title"
                                        wire:model="dc_title">
                                    {!! $errors->first('dc_title', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="authors_mark">{{ __("Author's mark") }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('authors_mark') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __("Author's mark") }}" name="authors_mark" id="authors_mark"
                                        wire:model="authors_mark">
                                    {!! $errors->first('authors_mark', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="dc_published_city">{{ __('Dc Published City') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('dc_published_city') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Dc Published City') }}" name="dc_published_city"
                                        id="dc_published_city" wire:model="dc_published_city">
                                    {!! $errors->first('dc_published_city', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="dc_publisher">{{ __('Dc Publisher') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('dc_publisher') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Dc Publisher') }}" name="dc_publisher" id="dc_publisher"
                                        wire:model="dc_publisher">
                                    {!! $errors->first('dc_publisher', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <br>


                                <div class="form-group">
                                    <label for="author-dropdown">{{ __('Dc Authors') }}</label>
                                    <div wire:ignore>
                                        <select id="author-dropdown"
                                            class=" form-select form-control {{ $errors->has('dc_authors') ? ' is-invalid' : '' }}"
                                            multiple wire:model.lazy="dc_authors">

                                            @foreach ($bookAuthors as $k => $v)
                                                <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @php
                                        // dd($dc_authors);
                                    @endphp
                                    {!! $errors->first('dc_authors', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <br>



                                <div class="form-group">
                                    <label for="dc_UDK">{{ __('Dc UDK') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('dc_UDK') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Dc UDK') }}" name="dc_UDK" id="dc_UDK"
                                        wire:model="dc_UDK">
                                    {!! $errors->first('dc_UDK', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="ISBN">{{ __('ISBN') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('ISBN') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('ISBN') }}" name="ISBN" id="ISBN"
                                        wire:model="ISBN">
                                    {!! $errors->first('ISBN', '<div class="invalid-feedback">:message</div>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="dc_description">{{ __('Dc Description') }}</label>
                                    <textarea name="dc_description" class="body form-control" id="dc_description" rows="3"
                                        wire:model.defer="dc_description">
                                        {{ $dc_description }}
                                    </textarea>
                                    {!! $errors->first('dc_description', '<div class="invalid-feedback">:message</div>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="dc_source">{{ __('Dc Source') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('dc_source') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Dc Source') }}" name="dc_source" id="dc_source"
                                        wire:model="dc_source">
                                    {!! $errors->first('dc_source', '<div class="invalid-feedback">:message</div>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="dc_date">{{ __('Dc Date') }}</label>
                                    <input type="number"
                                        class="form-control  {{ $errors->has('dc_date') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Dc Date') }}" name="dc_date" id="dc_date"
                                        wire:model="dc_date">
                                    {!! $errors->first('dc_date', '<div class="invalid-feedback">:message</div>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="betlar_soni">{{ __('Betlar Soni') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('betlar_soni') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Betlar Soni') }}" name="betlar_soni" id="betlar_soni"
                                        wire:model="betlar_soni">
                                    {!! $errors->first('betlar_soni', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="price">{{ __('Price') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('price') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Price') }}" name="price" id="price"
                                        wire:model="price">
                                    {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
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
                                <label for="status" class="form-label">{{ __('IsActive') }}</label>
                                <select class="form-select" id="status" name="status" wire:model="status">
                                    <option value='0' {{ $status ? '' : 'selected' }}>{{ __('Passive') }}
                                    </option>
                                    <option value='1' {{ $status ? 'selected' : '' }}>{{ __('Active') }}
                                    </option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="subject-dropdown">{{ __('Dc Subjects') }}</label>
                                <div wire:ignore>
                                    <select id="subject-dropdown" class=" form-select form-control " multiple
                                        wire:model="subjects">
                                        @foreach ($bookSubjects as $k => $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('dc_subjects', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="books_type">{{ __('Books Type') }}</label>
                                <div wire:ignore>
                                    <select id="books_type"
                                        class=" form-select form-control {{ $errors->has('books_type') ? ' is-invalid' : '' }}"
                                        wire:model="books_type">
                                        <option value>{{ __('Choose') }}</option>
                                        @foreach ($bookTypes as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('books_type', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="book_language_id">{{ __('Book Language') }}</label>
                                <div wire:ignore>
                                    <select id="book_language_id"
                                        class=" form-select form-control {{ $errors->has('book_language_id') ? ' is-invalid' : '' }}"
                                        wire:model="book_language">
                                        <option value>{{ __('Choose') }}</option>

                                        @foreach ($bookLanguages as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('book_language_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="book_text_id">{{ __('Book Text') }}</label>
                                <div wire:ignore>
                                    <select id="book_text_id"
                                        class=" form-select form-control {{ $errors->has('book_text_id') ? ' is-invalid' : '' }}"
                                        wire:model="book_text">
                                        <option value>{{ __('Choose') }}</option>
                                        @foreach ($bookTexts as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('book_text_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="book_text_type_id">{{ __('Book Text Type') }}</label>
                                <div wire:ignore>
                                    <select id="book_text_type_id"
                                        class=" form-select form-control {{ $errors->has('book_text_type_id') ? ' is-invalid' : '' }}"
                                        wire:model="book_text_type">
                                        <option value>{{ __('Choose') }}</option>
                                        @foreach ($bookTextTypes as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('book_text_type_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="book_access_type_id">{{ __('Book Access Type') }}</label>
                                <div wire:ignore>
                                    <select id="book_access_type_id"
                                        class=" form-select form-control {{ $errors->has('book_access_type_id') ? ' is-invalid' : '' }}"
                                        wire:model="book_access_type">
                                        <option value>{{ __('Choose') }}</option>
                                        @foreach ($bookAccessTypes as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('book_access_type_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="book_file_type_id">{{ __('Book File Type') }}</label>
                                <div wire:ignore>
                                    <select id="book_file_type_id"
                                        class=" form-select form-control {{ $errors->has('book_file_type_id') ? ' is-invalid' : '' }}"
                                        wire:model="book_file_type">
                                        <option value="0">{{ __('Choose') }}</option>
                                        @foreach ($bookFileTypes as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('book_file_type_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="new_subject">{{ __('Subjects') }}</label>
                                <div wire:ignore>
                                    <select id="new_subject"
                                        class=" form-select form-control {{ $errors->has('new_subject') ? ' is-invalid' : '' }}"
                                        wire:model="new_subject">
                                        <option value="0">{{ __('Choose') }}</option>

                                        @foreach ($new_subjects as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('new_subject', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="where_id">{{ __('Where') }}</label>
                                <div wire:ignore>
                                    <select id="where_id"
                                        class=" form-select form-control {{ $errors->has('where_id') ? ' is-invalid' : '' }}"
                                        wire:model="where_id">
                                        <option value="0">{{ __('Choose') }}</option>
                                        @foreach ($wheres as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('where_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="who_id">{{ __('Who') }}</label>
                                <div wire:ignore>
                                    <select id="who_id"
                                        class=" form-select form-control {{ $errors->has('who_id') ? ' is-invalid' : '' }}"
                                        wire:model="who_id">
                                        <option value="0">{{ __('Choose') }}</option>
                                        @foreach ($whos as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('who_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label(__('Book face image')) }}
                                <br>
                                <input type="file" wire:model="book_face_image" accept="image/*">

                                <div wire:loading wire:target="book_face_image">{{ __('Uploading') }}...</div>

                                @if ($book_face_image)
                                    <br>
                                    {{ __('Photo Preview') }}:
                                    <div class="align-items-left">
                                        <img src="{{ $book_face_image->temporaryUrl() }}" width="100">
                                    </div>
                                @endif
                                @error('book_face_image')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">

                                {{ Form::label(__('Book file')) }}
                                <br>
                                <input type="file" wire:model="book_full_text">

                                <div wire:loading wire:target="book_full_text">{{ __('Uploading') }}...</div>
                                {!! $errors->first('book_full_text', '<div class="invalid-feedback">:message</div>') !!}

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
@push('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
<script>
    Dropzone.options.fileDropzone = {
        url: '{{ route('file.store', app()->getLocale()) }}',
        // acceptedFiles: ".pdf",
        // addRemoveLinks: true,
        dictDefaultMessage: "Файлни шу ерга юкланг",
        // dictFallbackMessage = "Браузерингиз драг н дроп файлларни юклашни қўллаб-қувватламайди.",
        // dictInvalidFileType = "Бундай турдаги файлларни юклай олмайсиз.",
        // dictCancelUpload = "Юклашни бекор қилиш",
        // dictCancelUploadConfirmation = "Ҳақиқатан ҳам бу юклашни бекор қилмоқчимисиз?",
        // dictRemoveFile = "Файлни олиб ташланг",
        // dictMaxFilesExceeded = "Сиз бошқа файл юклай олмайсиз.",
        timeout: 180000,

        maxFilesize: 50,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        removedfile: function(file) {
            var name = file.upload.filename;
            $.ajax({
                type: 'POST',
                url: '{{ route('file.remove', app()->getLocale()) }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    name: name
                },
                success: function(data) {
                    console.log("File has been successfully removed!!");
                },
                error: function(e) {
                    console.log(e);
                }
            });
            var fileRef;
            return (fileRef = file.previewElement) != null ?
                fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function(file, response) {
            console.log(response.success);
            console.log(file);
        },
    }
</script> --}}
    <script>
        $(document).ready(function() {
            $('#author-dropdown').select2({
                tags: true,
            });
            // $("#author-dropdown").append(...@this.get('dc_authors')).trigger('change');
            $('#author-dropdown').on('change', function(e) {
                let data = $(this).val();
                @this.set('dc_authors', data);
            });
            // document.addEventListener('livewire:load', function() {
            //     $('#author-dropdown').on('select2:close', (e) => {
            //         @this.emit('locationUsersSelected', $('#author-dropdown').select2('val'));
            //     });

            //     $('#author-dropdown').val(@this.get('dc_authors')).trigger('change');
            // });
            // var serverRenderData = @this.get('dc_authors');
            // //usually we render data by this way, but select2 will auto sorting
            // // $("select").val(serverRenderData).trigger('change');
            // console.log(serverRenderData);
            // //so we re-append select data
            // var options = [];
            // for (var i = 0; i < serverRenderData.length; i++) {
            //     options.push($("select option[value=" + serverRenderData[i] + "]"));
            // }
            // $("#subject-dropdown").append(...options).trigger('change');
            // window.livewire.on('productStore', () => {
            //     $('#author-dropdown').select2({
            // 	    tags: true,
            //     });
            // });
            $('#subject-dropdown').select2({
                tags: true,
            });
            $('#subject-dropdown').on('change', function(e) {
                let data = $(this).val();
                @this.set('subjects', data);
            });
            $('#new_subject').select2({
                tags: true,
            });
            $('#new_subject').on('change', function(e) {
                let data = $(this).val();
                @this.set('new_subject', data);
            });
        });
    </script>
@endpush
