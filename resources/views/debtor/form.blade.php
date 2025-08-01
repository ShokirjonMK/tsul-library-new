<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $debtor->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('taken_time') }}
            {{ Form::text('taken_time', $debtor->taken_time, ['class' => 'form-control' . ($errors->has('taken_time') ? ' is-invalid' : ''), 'placeholder' => 'Taken Time']) }}
            {!! $errors->first('taken_time', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('return_time') }}
            {{ Form::text('return_time', $debtor->return_time, ['class' => 'form-control' . ($errors->has('return_time') ? ' is-invalid' : ''), 'placeholder' => 'Return Time']) }}
            {!! $errors->first('return_time', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('returned_time') }}
            {{ Form::text('returned_time', $debtor->returned_time, ['class' => 'form-control' . ($errors->has('returned_time') ? ' is-invalid' : ''), 'placeholder' => 'Returned Time']) }}
            {!! $errors->first('returned_time', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('count_prolong') }}
            {{ Form::text('count_prolong', $debtor->count_prolong, ['class' => 'form-control' . ($errors->has('count_prolong') ? ' is-invalid' : ''), 'placeholder' => 'Count Prolong']) }}
            {!! $errors->first('count_prolong', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('how_many_days') }}
            {{ Form::text('how_many_days', $debtor->how_many_days, ['class' => 'form-control' . ($errors->has('how_many_days') ? ' is-invalid' : ''), 'placeholder' => 'How Many Days']) }}
            {!! $errors->first('how_many_days', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('reader_id') }}
            {{ Form::text('reader_id', $debtor->reader_id, ['class' => 'form-control' . ($errors->has('reader_id') ? ' is-invalid' : ''), 'placeholder' => 'Reader Id']) }}
            {!! $errors->first('reader_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_id') }}
            {{ Form::text('book_id', $debtor->book_id, ['class' => 'form-control' . ($errors->has('book_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Id']) }}
            {!! $errors->first('book_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_information_id') }}
            {{ Form::text('book_information_id', $debtor->book_information_id, ['class' => 'form-control' . ($errors->has('book_information_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Information Id']) }}
            {!! $errors->first('book_information_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_inventar_id') }}
            {{ Form::text('book_inventar_id', $debtor->book_inventar_id, ['class' => 'form-control' . ($errors->has('book_inventar_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Inventar Id']) }}
            {!! $errors->first('book_inventar_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('branch_id') }}
            {{ Form::text('branch_id', $debtor->branch_id, ['class' => 'form-control' . ($errors->has('branch_id') ? ' is-invalid' : ''), 'placeholder' => 'Branch Id']) }}
            {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('department_id') }}
            {{ Form::text('department_id', $debtor->department_id, ['class' => 'form-control' . ($errors->has('department_id') ? ' is-invalid' : ''), 'placeholder' => 'Department Id']) }}
            {!! $errors->first('department_id', '<div class="invalid-feedback">:message</div>') !!}
        </div> 

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
