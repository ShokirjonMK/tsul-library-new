<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('locale') }}
            {{ Form::text('locale', $contactTranslation->locale, ['class' => 'form-control' . ($errors->has('locale') ? ' is-invalid' : ''), 'placeholder' => 'Locale']) }}
            {!! $errors->first('locale', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('contact_id') }}
            {{ Form::text('contact_id', $contactTranslation->contact_id, ['class' => 'form-control' . ($errors->has('contact_id') ? ' is-invalid' : ''), 'placeholder' => 'Contact Id']) }}
            {!! $errors->first('contact_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('title') }}
            {{ Form::text('title', $contactTranslation->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('slug') }}
            {{ Form::text('slug', $contactTranslation->slug, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), 'placeholder' => 'Slug']) }}
            {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('site_name') }}
            {{ Form::text('site_name', $contactTranslation->site_name, ['class' => 'form-control' . ($errors->has('site_name') ? ' is-invalid' : ''), 'placeholder' => 'Site Name']) }}
            {!! $errors->first('site_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('site_name2') }}
            {{ Form::text('site_name2', $contactTranslation->site_name2, ['class' => 'form-control' . ($errors->has('site_name2') ? ' is-invalid' : ''), 'placeholder' => 'Site Name2']) }}
            {!! $errors->first('site_name2', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('footer_menu') }}
            {{ Form::text('footer_menu', $contactTranslation->footer_menu, ['class' => 'form-control' . ($errors->has('footer_menu') ? ' is-invalid' : ''), 'placeholder' => 'Footer Menu']) }}
            {!! $errors->first('footer_menu', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('footer_info') }}
            {{ Form::text('footer_info', $contactTranslation->footer_info, ['class' => 'form-control' . ($errors->has('footer_info') ? ' is-invalid' : ''), 'placeholder' => 'Footer Info']) }}
            {!! $errors->first('footer_info', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('contacts_info') }}
            {{ Form::text('contacts_info', $contactTranslation->contacts_info, ['class' => 'form-control' . ($errors->has('contacts_info') ? ' is-invalid' : ''), 'placeholder' => 'Contacts Info']) }}
            {!! $errors->first('contacts_info', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('home_description') }}
            {{ Form::text('home_description', $contactTranslation->home_description, ['class' => 'form-control' . ($errors->has('home_description') ? ' is-invalid' : ''), 'placeholder' => 'Home Description']) }}
            {!! $errors->first('home_description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('footer_description') }}
            {{ Form::text('footer_description', $contactTranslation->footer_description, ['class' => 'form-control' . ($errors->has('footer_description') ? ' is-invalid' : ''), 'placeholder' => 'Footer Description']) }}
            {!! $errors->first('footer_description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('address_locality') }}
            {{ Form::text('address_locality', $contactTranslation->address_locality, ['class' => 'form-control' . ($errors->has('address_locality') ? ' is-invalid' : ''), 'placeholder' => 'Address Locality']) }}
            {!! $errors->first('address_locality', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('street_address') }}
            {{ Form::text('street_address', $contactTranslation->street_address, ['class' => 'form-control' . ($errors->has('street_address') ? ' is-invalid' : ''), 'placeholder' => 'Street Address']) }}
            {!! $errors->first('street_address', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('street_address2') }}
            {{ Form::text('street_address2', $contactTranslation->street_address2, ['class' => 'form-control' . ($errors->has('street_address2') ? ' is-invalid' : ''), 'placeholder' => 'Street Address2']) }}
            {!! $errors->first('street_address2', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $contactTranslation->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('body') }}
            {{ Form::text('body', $contactTranslation->body, ['class' => 'form-control' . ($errors->has('body') ? ' is-invalid' : ''), 'placeholder' => 'Body']) }}
            {!! $errors->first('body', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra1') }}
            {{ Form::text('extra1', $contactTranslation->extra1, ['class' => 'form-control' . ($errors->has('extra1') ? ' is-invalid' : ''), 'placeholder' => 'Extra1']) }}
            {!! $errors->first('extra1', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra2') }}
            {{ Form::text('extra2', $contactTranslation->extra2, ['class' => 'form-control' . ($errors->has('extra2') ? ' is-invalid' : ''), 'placeholder' => 'Extra2']) }}
            {!! $errors->first('extra2', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
