<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('locale') }}
            {{ Form::text('locale', $educationTypeTranslation->locale, ['class' => 'form-control' . ($errors->has('locale') ? ' is-invalid' : ''), 'placeholder' => 'Locale']) }}
            {!! $errors->first('locale', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('education_type_id') }}
            {{ Form::text('education_type_id', $educationTypeTranslation->education_type_id, ['class' => 'form-control' . ($errors->has('education_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Education Type Id']) }}
            {!! $errors->first('education_type_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('title') }}
            {{ Form::text('title', $educationTypeTranslation->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('slug') }}
            {{ Form::text('slug', $educationTypeTranslation->slug, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), 'placeholder' => 'Slug']) }}
            {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
