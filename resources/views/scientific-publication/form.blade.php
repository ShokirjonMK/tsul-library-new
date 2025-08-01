

<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('steps') }}
            {{ Form::text('steps', $scientificPublication->steps, ['class' => 'form-control' . ($errors->has('steps') ? ' is-invalid' : ''), 'placeholder' => 'Steps']) }}
            {!! $errors->first('steps', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('copies') }}
            {{ Form::text('copies', $scientificPublication->copies, ['class' => 'form-control' . ($errors->has('copies') ? ' is-invalid' : ''), 'placeholder' => 'Copies']) }}
            {!! $errors->first('copies', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('key') }}
            {{ Form::text('key', $scientificPublication->key, ['class' => 'form-control' . ($errors->has('key') ? ' is-invalid' : ''), 'placeholder' => 'Key']) }}
            {!! $errors->first('key', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('code') }}
            {{ Form::text('code', $scientificPublication->code, ['class' => 'form-control' . ($errors->has('code') ? ' is-invalid' : ''), 'placeholder' => 'Code']) }}
            {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('publication_year') }}
            {{ Form::text('publication_year', $scientificPublication->publication_year, ['class' => 'form-control' . ($errors->has('publication_year') ? ' is-invalid' : ''), 'placeholder' => 'Publication Year']) }}
            {!! $errors->first('publication_year', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('page_number') }}
            {{ Form::text('page_number', $scientificPublication->page_number, ['class' => 'form-control' . ($errors->has('page_number') ? ' is-invalid' : ''), 'placeholder' => 'Page Number']) }}
            {!! $errors->first('page_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('permission') }}
            {{ Form::text('permission', $scientificPublication->permission, ['class' => 'form-control' . ($errors->has('permission') ? ' is-invalid' : ''), 'placeholder' => 'Permission']) }}
            {!! $errors->first('permission', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('barcode_key') }}
            {{ Form::text('barcode_key', $scientificPublication->barcode_key, ['class' => 'form-control' . ($errors->has('barcode_key') ? ' is-invalid' : ''), 'placeholder' => 'Barcode Key']) }}
            {!! $errors->first('barcode_key', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('barcode') }}
            {{ Form::text('barcode', $scientificPublication->barcode, ['class' => 'form-control' . ($errors->has('barcode') ? ' is-invalid' : ''), 'placeholder' => 'Barcode']) }}
            {!! $errors->first('barcode', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('inventar_number') }}
            {{ Form::text('inventar_number', $scientificPublication->inventar_number, ['class' => 'form-control' . ($errors->has('inventar_number') ? ' is-invalid' : ''), 'placeholder' => 'Inventar Number']) }}
            {!! $errors->first('inventar_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('isActive') }}
            {{ Form::text('isActive', $scientificPublication->isActive, ['class' => 'form-control' . ($errors->has('isActive') ? ' is-invalid' : ''), 'placeholder' => 'Isactive']) }}
            {!! $errors->first('isActive', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('image_path') }}
            {{ Form::text('image_path', $scientificPublication->image_path, ['class' => 'form-control' . ($errors->has('image_path') ? ' is-invalid' : ''), 'placeholder' => 'Image Path']) }}
            {!! $errors->first('image_path', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('file_path') }}
            {{ Form::text('file_path', $scientificPublication->file_path, ['class' => 'form-control' . ($errors->has('file_path') ? ' is-invalid' : ''), 'placeholder' => 'File Path']) }}
            {!! $errors->first('file_path', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('journal_id') }}
            {{ Form::text('journal_id', $scientificPublication->journal_id, ['class' => 'form-control' . ($errors->has('journal_id') ? ' is-invalid' : ''), 'placeholder' => 'Journal Id']) }}
            {!! $errors->first('journal_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('magazine_issue_id') }}
            {{ Form::text('magazine_issue_id', $scientificPublication->magazine_issue_id, ['class' => 'form-control' . ($errors->has('magazine_issue_id') ? ' is-invalid' : ''), 'placeholder' => 'Magazine Issue Id']) }}
            {!! $errors->first('magazine_issue_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('res_lang_id') }}
            {{ Form::text('res_lang_id', $scientificPublication->res_lang_id, ['class' => 'form-control' . ($errors->has('res_lang_id') ? ' is-invalid' : ''), 'placeholder' => 'Res Lang Id']) }}
            {!! $errors->first('res_lang_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('res_type_id') }}
            {{ Form::text('res_type_id', $scientificPublication->res_type_id, ['class' => 'form-control' . ($errors->has('res_type_id') ? ' is-invalid' : ''), 'placeholder' => 'Res Type Id']) }}
            {!! $errors->first('res_type_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('res_field_id') }}
            {{ Form::text('res_field_id', $scientificPublication->res_field_id, ['class' => 'form-control' . ($errors->has('res_field_id') ? ' is-invalid' : ''), 'placeholder' => 'Res Field Id']) }}
            {!! $errors->first('res_field_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_by') }}
            {{ Form::text('created_by', $scientificPublication->created_by, ['class' => 'form-control' . ($errors->has('created_by') ? ' is-invalid' : ''), 'placeholder' => 'Created By']) }}
            {!! $errors->first('created_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated_by') }}
            {{ Form::text('updated_by', $scientificPublication->updated_by, ['class' => 'form-control' . ($errors->has('updated_by') ? ' is-invalid' : ''), 'placeholder' => 'Updated By']) }}
            {!! $errors->first('updated_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
