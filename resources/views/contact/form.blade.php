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
                                                    if (count($contact->contactTranslations) > 0 && isset($contact->contactTranslations[$step]) && $contact->contactTranslations[$step]->locale == $k) {
                                                        $title = $contact->contactTranslations[$step]->title;
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
                                                <label class="required"
                                                    for="street_address_{{ $k }}">{{ __('Address') }}
                                                    {{ $k }}:</label>
                                                @php
                                                    $street_address = null;
                                                    if (count($contact->contactTranslations) > 0 && isset($contact->contactTranslations[$step]) && $contact->contactTranslations[$step]->locale == $k) {
                                                        $street_address = $contact->contactTranslations[$step]->street_address;
                                                    }
                                                   
                                                @endphp
                                                <input type="text" class="form-control "
                                                    name="street_address_{{ $k }}" id="street_address_{{ $k }}"
                                                    placeholder="{{ __('Title') }}" value="{{ $street_address }}" />
                                                @error('street_address_{{ $k }}')
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
                    <div class="form-group">
                        {{ Form::label('code') }}
                        {{ Form::text('code', $contact->code, ['class' => 'form-control' . ($errors->has('code') ? ' is-invalid' : ''), 'placeholder' => 'Code']) }}
                        {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    @php
                        $isActive = 1;
                        if ($contact->count() > 0 && isset($contact->isActive)) {
                            $isActive = $contact->isActive;
                        }
                        
                    @endphp

                    <div class="form-group">

                        <label for="isActive" class="form-label">{{ __('isActive') }}</label>
                        <select class="form-control" id="isActive" name="isActive">
                            <option value='0' {{ $isActive ? '' : 'selected' }}>{{ __('Passive') }}</option>
                            <option value='1' {{ $isActive ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                        @error('isActive')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        {{ Form::label('email') }}
                        {{ Form::text('email', $contact->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label('phone') }}
                        {{ Form::text('phone', $contact->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Phone']) }}
                        {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
                    </div>


                    <div class="form-group">
                        {{ Form::label('fax') }}
                        {{ Form::text('fax', $contact->fax, ['class' => 'form-control' . ($errors->has('fax') ? ' is-invalid' : ''), 'placeholder' => 'Fax']) }}
                        {!! $errors->first('fax', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Image') ) }}
                        <input type="file" name="file" class='form-control' />
                        @if ($contact->logo)
                            <img src="{{ asset('/storage/contacts/logo/' . $contact->logo) }}" width="100px">
                        @endif
                        {!! $errors->first('logo', '<div class="invalid-feedback">:message</div>') !!}
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
