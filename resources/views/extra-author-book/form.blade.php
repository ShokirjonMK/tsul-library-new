<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('extra_author_id') }}
            {{ Form::text('extra_author_id', $extraAuthorBook->extra_author_id, ['class' => 'form-control' . ($errors->has('extra_author_id') ? ' is-invalid' : ''), 'placeholder' => 'Extra Author Id']) }}
            {!! $errors->first('extra_author_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_id') }}
            {{ Form::text('book_id', $extraAuthorBook->book_id, ['class' => 'form-control' . ($errors->has('book_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Id']) }}
            {!! $errors->first('book_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $extraAuthorBook->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('slug') }}
            {{ Form::text('slug', $extraAuthorBook->slug, ['class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''), 'placeholder' => 'Slug']) }}
            {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra1') }}
            {{ Form::text('extra1', $extraAuthorBook->extra1, ['class' => 'form-control' . ($errors->has('extra1') ? ' is-invalid' : ''), 'placeholder' => 'Extra1']) }}
            {!! $errors->first('extra1', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra2') }}
            {{ Form::text('extra2', $extraAuthorBook->extra2, ['class' => 'form-control' . ($errors->has('extra2') ? ' is-invalid' : ''), 'placeholder' => 'Extra2']) }}
            {!! $errors->first('extra2', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra3') }}
            {{ Form::text('extra3', $extraAuthorBook->extra3, ['class' => 'form-control' . ($errors->has('extra3') ? ' is-invalid' : ''), 'placeholder' => 'Extra3']) }}
            {!! $errors->first('extra3', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_by') }}
            {{ Form::text('created_by', $extraAuthorBook->created_by, ['class' => 'form-control' . ($errors->has('created_by') ? ' is-invalid' : ''), 'placeholder' => 'Created By']) }}
            {!! $errors->first('created_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated_by') }}
            {{ Form::text('updated_by', $extraAuthorBook->updated_by, ['class' => 'form-control' . ($errors->has('updated_by') ? ' is-invalid' : ''), 'placeholder' => 'Updated By']) }}
            {!! $errors->first('updated_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
