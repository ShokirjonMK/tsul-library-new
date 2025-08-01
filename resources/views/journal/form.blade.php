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
                                            <input type="hidden" class="form-control " name="locale_{{ $k }}"
                                                id="locale_{{ $k }}" value="{{ $k }}" />
                                            <div class="form-group">
                                                <label class="required"
                                                    for="title_{{ $k }}">{{ __('Title') }}
                                                    {{ $k }}:</label>
                                                @php
                                                    $title = null;
                                                     if (count($journal->journalTranslations) > 0 && isset($journal->journalTranslations[$step]) && $journal->journalTranslations[$step]->locale == $k) {
                                                        $title = $journal->journalTranslations[$step]->title;
                                                    }
                                                   if($title==null){
                                                    $title=old('title_'.$k);
                                                   }
                                                @endphp

                                                <input type="text" class="form-control " name="title_{{ $k }}"
                                                 id="title_{{ $k }}" placeholder="{{ __('Title') }}"
                                                       value="{{ old('title_'.$k, $title) }}"  />
                                                @error('title_{{ $k }}')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required"
                                                    for="body_{{ $k }}">{{ __('Body') }}
                                                    {{ $k }}:</label>
                                                @php
                                                    $body = null;
                                                    if (count($journal->journalTranslations) > 0 && isset($journal->journalTranslations[$step]) && $journal->journalTranslations[$step]->locale == $k) {
                                                        $body = $journal->journalTranslations[$step]->body;
                                                    }
                                                    if($body==null){
                                                    $body=old('body_'.$k);
                                                   }
                                                @endphp
                                                <textarea name="body_{{ $k }}" class="body form-control ckeditor " id="body_{{ $k }}" cols="30" rows="10">{{ $body }}</textarea>
                                                @error('body_{{ $k }}')
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
                        if ($journal->count() > 0 && isset($journal->isActive)){
                            $isActive = $journal->isActive;
                        }
                    @endphp
                    <div class="form-group row">

                        <label for="isActive" class="form-label">{{ __('isActive') }}</label>
                        <select class="form-select" id="isActive" name="isActive">
                            <option value='0' {{ $isActive ? '' : 'selected' }}>{{ __('Passive') }}</option>
                            <option value='1' {{ $isActive ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                        @error('isActive')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        {{ Form::label('ISSN') }}
                        {{ Form::text('ISSN', $journal->ISSN, ['class' => 'form-control' . ($errors->has('ISSN') ? ' is-invalid' : ''), 'placeholder' => 'Issn']) }}
                        {!! $errors->first('ISSN', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Phone Number')) }}
                        {{ Form::text('phone_number', $journal->phone_number, ['class' => 'form-control' . ($errors->has('phone_number') ? ' is-invalid' : ''), 'placeholder' => __('Phone Number')]) }}
                        {!! $errors->first('phone_number', '<div class="invalid-feedback">:message</div>') !!}
                    </div>


                    <div class="form-group">
                        {{ Form::label(__('Subjects')) }}
                        {!! Form::select('subjects[]', $subjects, json_decode($journal->subjects), ['class' => 'js-example-basic-single-with-tags form-control '. ($errors->has('subjects') ? ' is-invalid' : ''), 'multiple']) !!}
                        {!! $errors->first('subjects', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Fax')) }}
                        {{ Form::text('fax', $journal->fax, ['class' => 'form-control' . ($errors->has('fax') ? ' is-invalid' : ''), 'placeholder' => 'Fax']) }}
                        {!! $errors->first('fax', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Email')) }}
                        {{ Form::text('email', $journal->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Website')) }}
                        {{ Form::text('website', $journal->website, ['class' => 'form-control' . ($errors->has('website') ? ' is-invalid' : ''), 'placeholder' => 'Website']) }}
                        {!! $errors->first('website', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('editor_in_chiefs')) }}
                        {{ Form::text('editor_in_chiefs', $journal->editor_in_chiefs, ['class' => 'form-control' . ($errors->has('editor_in_chiefs') ? ' is-invalid' : ''), 'placeholder' => __('editor_in_chiefs')]) }}

                        {!! $errors->first('editor_in_chiefs', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('editorial_members')) }}
                        {!! Form::select('editorial_members[]', $authors, json_decode($journal->editorial_members), ['class' => 'js-example-basic-single-with-tags form-control '. ($errors->has('editorial_members') ? ' is-invalid' : ''), 'multiple']) !!}

                        {!! $errors->first('editorial_members', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label(__('Organization')) }}
                        {!! Form::select('organization_id', $organizations, $journal->organization_id, ['class' => ' form-control '. ($errors->has('organization_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('organization_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Books Type')) }}
                        {!! Form::select('books_type_id', $bookTypes, $journal->books_type_id, ['class' => ' form-control '. ($errors->has('books_type_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('books_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Text')) }}
                        {!! Form::select('book_text_id', $bookTexts, $journal->book_text_id, ['class' => ' form-control '. ($errors->has('book_text_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('book_text_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Text Type')) }}
                        {!! Form::select('book_text_type_id', $bookTextTypes, $journal->book_text_type_id, ['class' => ' form-control '. ($errors->has('book_text_type_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('book_text_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Access Type')) }}
                         {!! Form::select('book_access_type_id', $bookAccessTypes, $journal->book_access_type_id, ['class' => ' form-control '. ($errors->has('book_access_type_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('book_access_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="form-group">

                        {{ Form::label(__('Image') ) }}
                        <input type="file" name="file" class='form-control' />
                        @if ($journal->image_path)
                            <img src="{{ asset('/storage/journals/photo/' . $journal->image_path) }}" width="100px">
                        @endif
                        {!! $errors->first('image_path', '<div class="invalid-feedback">:message</div>') !!}
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

