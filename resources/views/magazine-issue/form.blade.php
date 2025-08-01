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
                                                    if (count($magazineIssue->magazineIssueTranslations) > 0 && isset($magazineIssue->magazineIssueTranslations[$step]) && $magazineIssue->magazineIssueTranslations[$step]->locale == $k) {
                                                        $title = $magazineIssue->magazineIssueTranslations[$step]->title;
                                                    }
                                                    $step++;
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
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        if ($magazineIssue->count() > 0 && isset($magazineIssue->isActive)) {
                            $isActive = $magazineIssue->isActive;
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
                        {{ Form::label( __('Journal') ) }}
                        {!! Form::select('journal_id', $journals, $magazineIssue->journal ? $magazineIssue->journal_id : null, ['class' => ' form-control '. ($errors->has('journal_id') ? ' is-invalid' : '')]) !!}
                        {!! $errors->first('journal_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label(__('Published Year')) }}
                        {{ Form::number('published_year', $magazineIssue->published_year, ['class' => 'form-control' . ($errors->has('published_year') ? ' is-invalid' : ''), 'placeholder' => __('Published Year')]) }}
                        {!! $errors->first('published_year', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('fourth_number')) }}
                        {{ Form::number('fourth_number', $magazineIssue->fourth_number, ['class' => 'form-control' . ($errors->has('fourth_number') ? ' is-invalid' : ''), 'placeholder' => __('fourth_number')]) }}
                        {!! $errors->first('fourth_number', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Image')) }}
                        <input type="file" name="file" class='form-control' />
                        @if ($magazineIssue->image_path)
                            <img src="{{ asset('/storage/magazineIssues/photo/' . $magazineIssue->image_path) }}"
                                width="100px">
                        @endif
                        {!! $errors->first('image_path', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('full_text_path')) }}
                        <input type="file" name="full_text_path" class='form-control' />
                        @if ($magazineIssue->full_text_path)
                             
                                <a href="{{ asset('/storage/magazineIssues/full-text/' . $magazineIssue->full_text_path) }}" target="__blank">{{__('Download')}}</a>
                        @endif
                        {!! $errors->first('full_text_path', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
 
                    <div class="form-group">
                        {{ Form::label(__('Betlar Soni')) }}
                        {{ Form::number('betlar_soni', $magazineIssue->betlar_soni, ['class' => 'form-control' . ($errors->has('betlar_soni') ? ' is-invalid' : ''), 'placeholder' => __('Betlar Soni')]) }}
                        {!! $errors->first('betlar_soni', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Price')) }}
                        {{ Form::text('price', $magazineIssue->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => __('Price')]) }}
                        {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
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
