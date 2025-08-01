<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('isActive') }}
            {{ Form::text('isActive', $depository->isActive, ['class' => 'form-control' . ($errors->has('isActive') ? ' is-invalid' : ''), 'placeholder' => 'Isactive']) }}
            {!! $errors->first('isActive', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('comment') }}
            {{ Form::text('comment', $depository->comment, ['class' => 'form-control' . ($errors->has('comment') ? ' is-invalid' : ''), 'placeholder' => 'Comment']) }}
            {!! $errors->first('comment', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('inventar_number') }}
            {{ Form::text('inventar_number', $depository->inventar_number, ['class' => 'form-control' . ($errors->has('inventar_number') ? ' is-invalid' : ''), 'placeholder' => 'Inventar Number']) }}
            {!! $errors->first('inventar_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('bar_code') }}
            {{ Form::text('bar_code', $depository->bar_code, ['class' => 'form-control' . ($errors->has('bar_code') ? ' is-invalid' : ''), 'placeholder' => 'Bar Code']) }}
            {!! $errors->first('bar_code', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_id') }}
            {{ Form::text('book_id', $depository->book_id, ['class' => 'form-control' . ($errors->has('book_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Id']) }}
            {!! $errors->first('book_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_information_id') }}
            {{ Form::text('book_information_id', $depository->book_information_id, ['class' => 'form-control' . ($errors->has('book_information_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Information Id']) }}
            {!! $errors->first('book_information_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_inventar_id') }}
            {{ Form::text('book_inventar_id', $depository->book_inventar_id, ['class' => 'form-control' . ($errors->has('book_inventar_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Inventar Id']) }}
            {!! $errors->first('book_inventar_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('branch_id') }}
            {{ Form::text('branch_id', $depository->branch_id, ['class' => 'form-control' . ($errors->has('branch_id') ? ' is-invalid' : ''), 'placeholder' => 'Branch Id']) }}
            {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('department_id') }}
            {{ Form::text('department_id', $depository->department_id, ['class' => 'form-control' . ($errors->has('department_id') ? ' is-invalid' : ''), 'placeholder' => 'Department Id']) }}
            {!! $errors->first('department_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_by') }}
            {{ Form::text('created_by', $depository->created_by, ['class' => 'form-control' . ($errors->has('created_by') ? ' is-invalid' : ''), 'placeholder' => 'Created By']) }}
            {!! $errors->first('created_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated_by') }}
            {{ Form::text('updated_by', $depository->updated_by, ['class' => 'form-control' . ($errors->has('updated_by') ? ' is-invalid' : ''), 'placeholder' => 'Updated By']) }}
            {!! $errors->first('updated_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
