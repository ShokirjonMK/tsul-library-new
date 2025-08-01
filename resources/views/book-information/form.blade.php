<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('isActive') }}
            {{ Form::text('isActive', $bookInformation->isActive, ['class' => 'form-control' . ($errors->has('isActive') ? ' is-invalid' : ''), 'placeholder' => 'Isactive']) }}
            {!! $errors->first('isActive', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('summarka_raqam') }}
            {{ Form::text('summarka_raqam', $bookInformation->summarka_raqam, ['class' => 'form-control' . ($errors->has('summarka_raqam') ? ' is-invalid' : ''), 'placeholder' => 'Summarka Raqam']) }}
            {!! $errors->first('summarka_raqam', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('arrived_year') }}
            {{ Form::text('arrived_year', $bookInformation->arrived_year, ['class' => 'form-control' . ($errors->has('arrived_year') ? ' is-invalid' : ''), 'placeholder' => 'Arrived Year']) }}
            {!! $errors->first('arrived_year', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('kutubxonada_bor') }}
            {{ Form::text('kutubxonada_bor', $bookInformation->kutubxonada_bor, ['class' => 'form-control' . ($errors->has('kutubxonada_bor') ? ' is-invalid' : ''), 'placeholder' => 'Kutubxonada Bor']) }}
            {!! $errors->first('kutubxonada_bor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('elektronni_bor') }}
            {{ Form::text('elektronni_bor', $bookInformation->elektronni_bor, ['class' => 'form-control' . ($errors->has('elektronni_bor') ? ' is-invalid' : ''), 'placeholder' => 'Elektronni Bor']) }}
            {!! $errors->first('elektronni_bor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('branch_id') }}
            {{ Form::text('branch_id', $bookInformation->branch_id, ['class' => 'form-control' . ($errors->has('branch_id') ? ' is-invalid' : ''), 'placeholder' => 'Branch Id']) }}
            {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('deportmetn_id') }}
            {{ Form::text('deportmetn_id', $bookInformation->deportmetn_id, ['class' => 'form-control' . ($errors->has('deportmetn_id') ? ' is-invalid' : ''), 'placeholder' => 'Deportmetn Id']) }}
            {!! $errors->first('deportmetn_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_id') }}
            {{ Form::text('book_id', $bookInformation->book_id, ['class' => 'form-control' . ($errors->has('book_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Id']) }}
            {!! $errors->first('book_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_by') }}
            {{ Form::text('created_by', $bookInformation->created_by, ['class' => 'form-control' . ($errors->has('created_by') ? ' is-invalid' : ''), 'placeholder' => 'Created By']) }}
            {!! $errors->first('created_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated_by') }}
            {{ Form::text('updated_by', $bookInformation->updated_by, ['class' => 'form-control' . ($errors->has('updated_by') ? ' is-invalid' : ''), 'placeholder' => 'Updated By']) }}
            {!! $errors->first('updated_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
