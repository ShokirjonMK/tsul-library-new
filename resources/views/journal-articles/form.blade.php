<div class="row">

    <div class="col-xl-8 col-lg-12">
        <div class="ec-cat-list card card-default">
            <div class="card-body">

                <div class="profile-content-right profile-right-spacing py-5">
                    <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
                        @foreach (config('app.locales') as $k => $locale)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $k == 'uz' ? 'active' : '' }}"
                                    id="language-tab-{{ $k }}" data-bs-toggle="tab"
                                    data-bs-target="#language-{{ $k }}" type="button" role="tab"
                                    aria-controls="language-{{ $k }}"
                                    aria-selected="{{ $k == 'uz' ? 'true' : 'false' }}">{{ $locale }}</button>
                            </li>
                        @endforeach

                    </ul>
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">

                        @php
                            $step = 0;
                        @endphp
                        @foreach (config('app.locales') as $k => $locale)
                            <div class="tab-pane fade {{ $k == 'uz' ? 'active show' : '' }}"
                                id="language-{{ $k }}" role="tabpanel"
                                aria-labelledby="language-tab-{{ $k }}">
                                <div class="tab-widget mt-5">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" class="form-control "
                                                name="locale_{{ $k }}" id="locale_{{ $k }}"
                                                value="{{ $k }}" />
                                            <div class="form-group">
                                                <label class="required"
                                                    for="title_{{ $k }}">{{ __('Title') }}
                                                    {{ $k }}:</label>
                                                @php
                                                    $title = null;
                                                    if (count($scientificPublication->scientificPublicationTranslations) > 0 && isset($scientificPublication->scientificPublicationTranslations[$step]) && $scientificPublication->scientificPublicationTranslations[$step]->locale == $k) {
                                                        $title = $scientificPublication->scientificPublicationTranslations[$step]->title;
                                                    }
                                                    if($title==null){
                                                    $title=old('title_'.$k);
                                                   }
                                                @endphp
                                                <input type="text" class="form-control "
                                                    name="title_{{ $k }}" id="title_{{ $k }}"
                                                    placeholder="{{ __('Title') }}" value="{{ $title }}" />

                                                    
                                                @error('title_{{ $k }}')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="authors_{{ $k }}">{{ __('Authors') }}
                                                    {{ $k }}:</label>
                                                @php
                                                    $authors = null;
                                                    if (count($scientificPublication->scientificPublicationTranslations) > 0 && isset($scientificPublication->scientificPublicationTranslations[$step]) && $scientificPublication->scientificPublicationTranslations[$step]->locale == $k) {
                                                        $authors = $scientificPublication->scientificPublicationTranslations[$step]->authors;
                                                    }
                                                    if($authors==null){
                                                    $authors=old('authors_'.$k);
                                                   }
                                                @endphp
                                                <input type="text" class="form-control "
                                                    name="authors_{{ $k }}"
                                                    id="authors_{{ $k }}" placeholder="{{ __('Authors') }}"
                                                    value="{{ $authors }}" data-role="tagsinput" />
                                                @error('authors_{{ $k }}')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description_{{ $k }}">{{ __('Description') }}
                                                    {{ $k }}:</label>
                                                @php
                                                    $description = null;
                                                    if (count($scientificPublication->scientificPublicationTranslations) > 0 && isset($scientificPublication->scientificPublicationTranslations[$step]) && $scientificPublication->scientificPublicationTranslations[$step]->locale == $k) {
                                                        $description = $scientificPublication->scientificPublicationTranslations[$step]->description;
                                                    }
                                                    if($description==null){
                                                    $description=old('description_'.$k);
                                                   }
                                                @endphp

                                                <textarea class="form-control" name="description_{{ $k }}" id="description_{{ $k }}"
                                                    rows="3">{{ $description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="content_{{ $k }}">{{ __('Content') }}
                                                    {{ $k }}:</label>
                                                @php
                                                    $content = null;
                                                    if (count($scientificPublication->scientificPublicationTranslations) > 0 && isset($scientificPublication->scientificPublicationTranslations[$step]) && $scientificPublication->scientificPublicationTranslations[$step]->locale == $k) {
                                                        $content = $scientificPublication->scientificPublicationTranslations[$step]->content;
                                                    }
                                                    if($content==null){
                                                    $content=old('content_'.$k);
                                                   }
                                                @endphp

                                                <textarea class="form-control" name="content_{{ $k }}" id="content_{{ $k }}" rows="5">{{ $content }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="required"
                                                    for="keywords_{{ $k }}">{{ __('Keywords') }}
                                                    {{ $k }}:</label>
                                                @php
                                                    $keywords = null;
                                                    if (count($scientificPublication->scientificPublicationTranslations) > 0 && isset($scientificPublication->scientificPublicationTranslations[$step]) && $scientificPublication->scientificPublicationTranslations[$step]->locale == $k) {
                                                        $keywords = $scientificPublication->scientificPublicationTranslations[$step]->keywords;
                                                    }
                                                    if($keywords==null){
                                                    $keywords=old('keywords_'.$k);
                                                   }
                                                @endphp
                                                <input type="text" class="form-control "
                                                    name="keywords_{{ $k }}"
                                                    id="keywords_{{ $k }}"
                                                    placeholder="{{ __('Keywords') }}" value="{{ $keywords }}"
                                                    data-role="tagsinput" />
                                                @error('keywords_{{ $k }}')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $step++;
                            @endphp
                        @endforeach

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            <div class="card-body">
                <div class="ec-cat-form">
                    @php
                        $isActive = 1;
                        if ($scientificPublication->count() > 0 && isset($scientificPublication->isActive)) {
                            $isActive = $scientificPublication->isActive;
                        }
                        
                    @endphp
                    
                    <div class="form-group row">

                        <label for="isActive" class="form-label">{{ __('isActive') }}</label>
                        <select class=" form-select form-control " id="isActive" name="isActive">
                            <option value='0' {{ $isActive ? '' : 'selected' }}>{{ __('Passive') }}</option>
                            <option value='1' {{ $isActive ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                        @error('isActive')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <livewire:admin.depdrops.journal-magazine-drop-down :journal_id="$scientificPublication->journal_id" :magazine_issue_id="$scientificPublication->magazine_issue_id" />
                      
                    <div class="form-group">
                        {{ Form::label(__('Resource language')) }}
                        {!! Form::select('res_lang_id', $resourceLanguages, $scientificPublication->res_lang_id, [
                            'class' => 'form-select ' . ($errors->has('res_lang_id') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('res_lang_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Resource Type')) }}
                        {!! Form::select('res_type_id', $resourceTypes, $scientificPublication->res_type_id, [
                            'class' => 'form-select ' . ($errors->has('res_type_id') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('res_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Resource Field')) }}
                        {!! Form::select('res_field_id', $resourceFields, $scientificPublication->res_field_id, [
                            'class' => 'form-select ' . ($errors->has('res_field_id') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('res_field_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::hidden('key', 'journal-article', ['class' => 'form-control' . ($errors->has('key') ? ' is-invalid' : ''), 'placeholder' => 'Key']) }}
                        {!! $errors->first('key', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Published Year')) }}
                        {{ Form::text('publication_year', $scientificPublication->publication_year, ['class' => 'form-control' . ($errors->has('publication_year') ? ' is-invalid' : ''), 'placeholder' => __('Published Year')]) }}
                        {!! $errors->first('publication_year', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    {{-- <div class="form-group">
                        {{ Form::label(__('Page Number')) }}
                        {{ Form::text('page_number', $scientificPublication->page_number, ['class' => 'form-control' . ($errors->has('page_number') ? ' is-invalid' : ''), 'placeholder' => __('Page Number')]) }}
                        {!! $errors->first('page_number', '<div class="invalid-feedback">:message</div>') !!}
                    </div> --}}

                    {{-- <div class="form-group">
                        {{ Form::label(__('Bar code')) }}
                        {{ Form::text('barcode', $scientificPublication->barcode, ['class' => 'form-control' . ($errors->has('barcode') ? ' is-invalid' : ''), 'placeholder' => __('Bar code')]) }}
                        {!! $errors->first('barcode', '<div class="invalid-feedback">:message</div>') !!}
                    </div> --}}
                    {{-- <div class="form-group">
                        {{ Form::label(__('Inventar Number')) }}
                        {{ Form::text('inventar_number', $scientificPublication->inventar_number, ['class' => 'form-control' . ($errors->has('inventar_number') ? ' is-invalid' : ''), 'placeholder' => __('Inventar Number')]) }}
                        {!! $errors->first('inventar_number', '<div class="invalid-feedback">:message</div>') !!}
                    </div> --}}

                    <div class="form-group">
                        {{ Form::label(__('Image')) }}
                        <input type="file" name="file" class='form-control' />
                        @if ($scientificPublication->image_path)
                            <img src="{{ asset('/storage/scientificPublications/photo/' . $scientificPublication->image_path) }}"
                                width="100px">
                        @endif
                        {!! $errors->first('image_path', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('full_text_path')) }}
                        <input type="file" name="file_path" class='form-control' />
                        @if ($scientificPublication->file_path)
                            <a href="{{ asset('/storage/scientificPublications/full-text/' . $scientificPublication->file_path) }}"
                                target="__blank">{{ __('Download') }}</a>
                        @endif
                        {!! $errors->first('file_path', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
