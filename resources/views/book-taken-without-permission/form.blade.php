<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $bookTakenWithoutPermission->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('bar_code') }}
            {{ Form::text('bar_code', $bookTakenWithoutPermission->bar_code, ['class' => 'form-control' . ($errors->has('bar_code') ? ' is-invalid' : ''), 'placeholder' => 'Bar Code']) }}
            {!! $errors->first('bar_code', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('rfid_tag_id') }}
            {{ Form::text('rfid_tag_id', $bookTakenWithoutPermission->rfid_tag_id, ['class' => 'form-control' . ($errors->has('rfid_tag_id') ? ' is-invalid' : ''), 'placeholder' => 'Rfid Tag Id']) }}
            {!! $errors->first('rfid_tag_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('comment') }}
            {{ Form::text('comment', $bookTakenWithoutPermission->comment, ['class' => 'form-control' . ($errors->has('comment') ? ' is-invalid' : ''), 'placeholder' => 'Comment']) }}
            {!! $errors->first('comment', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_id') }}
            {{ Form::text('book_id', $bookTakenWithoutPermission->book_id, ['class' => 'form-control' . ($errors->has('book_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Id']) }}
            {!! $errors->first('book_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_information_id') }}
            {{ Form::text('book_information_id', $bookTakenWithoutPermission->book_information_id, ['class' => 'form-control' . ($errors->has('book_information_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Information Id']) }}
            {!! $errors->first('book_information_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_inventar_id') }}
            {{ Form::text('book_inventar_id', $bookTakenWithoutPermission->book_inventar_id, ['class' => 'form-control' . ($errors->has('book_inventar_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Inventar Id']) }}
            {!! $errors->first('book_inventar_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('organization_id') }}
            {{ Form::text('organization_id', $bookTakenWithoutPermission->organization_id, ['class' => 'form-control' . ($errors->has('organization_id') ? ' is-invalid' : ''), 'placeholder' => 'Organization Id']) }}
            {!! $errors->first('organization_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('branch_id') }}
            {{ Form::text('branch_id', $bookTakenWithoutPermission->branch_id, ['class' => 'form-control' . ($errors->has('branch_id') ? ' is-invalid' : ''), 'placeholder' => 'Branch Id']) }}
            {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('deportmetn_id') }}
            {{ Form::text('deportmetn_id', $bookTakenWithoutPermission->deportmetn_id, ['class' => 'form-control' . ($errors->has('deportmetn_id') ? ' is-invalid' : ''), 'placeholder' => 'Deportmetn Id']) }}
            {!! $errors->first('deportmetn_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
