<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('where_id') }}
            {{ Form::text('where_id', $bookAct->where_id, ['class' => 'form-control' . ($errors->has('where_id') ? ' is-invalid' : ''), 'placeholder' => 'Where Id']) }}
            {!! $errors->first('where_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('price') }}
            {{ Form::text('price', $bookAct->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Price']) }}
            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('summarka_raqam') }}
            {{ Form::text('summarka_raqam', $bookAct->summarka_raqam, ['class' => 'form-control' . ($errors->has('summarka_raqam') ? ' is-invalid' : ''), 'placeholder' => 'Summarka Raqam']) }}
            {!! $errors->first('summarka_raqam', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('arrived_date') }}
            {{ Form::text('arrived_date', $bookAct->arrived_date, ['class' => 'form-control' . ($errors->has('arrived_date') ? ' is-invalid' : ''), 'placeholder' => 'Arrived Date']) }}
            {!! $errors->first('arrived_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('arrived_year') }}
            {{ Form::text('arrived_year', $bookAct->arrived_year, ['class' => 'form-control' . ($errors->has('arrived_year') ? ' is-invalid' : ''), 'placeholder' => 'Arrived Year']) }}
            {!! $errors->first('arrived_year', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('arrived_month') }}
            {{ Form::text('arrived_month', $bookAct->arrived_month, ['class' => 'form-control' . ($errors->has('arrived_month') ? ' is-invalid' : ''), 'placeholder' => 'Arrived Month']) }}
            {!! $errors->first('arrived_month', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('arrived_day') }}
            {{ Form::text('arrived_day', $bookAct->arrived_day, ['class' => 'form-control' . ($errors->has('arrived_day') ? ' is-invalid' : ''), 'placeholder' => 'Arrived Day']) }}
            {!! $errors->first('arrived_day', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('comment') }}
            {{ Form::text('comment', $bookAct->comment, ['class' => 'form-control' . ($errors->has('comment') ? ' is-invalid' : ''), 'placeholder' => 'Comment']) }}
            {!! $errors->first('comment', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra1') }}
            {{ Form::text('extra1', $bookAct->extra1, ['class' => 'form-control' . ($errors->has('extra1') ? ' is-invalid' : ''), 'placeholder' => 'Extra1']) }}
            {!! $errors->first('extra1', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('full_text_path') }}
            {{ Form::text('full_text_path', $bookAct->full_text_path, ['class' => 'form-control' . ($errors->has('full_text_path') ? ' is-invalid' : ''), 'placeholder' => 'Full Text Path']) }}
            {!! $errors->first('full_text_path', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('organization_id') }}
            {{ Form::text('organization_id', $bookAct->organization_id, ['class' => 'form-control' . ($errors->has('organization_id') ? ' is-invalid' : ''), 'placeholder' => 'Organization Id']) }}
            {!! $errors->first('organization_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('branch_id') }}
            {{ Form::text('branch_id', $bookAct->branch_id, ['class' => 'form-control' . ($errors->has('branch_id') ? ' is-invalid' : ''), 'placeholder' => 'Branch Id']) }}
            {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('deportmetn_id') }}
            {{ Form::text('deportmetn_id', $bookAct->deportmetn_id, ['class' => 'form-control' . ($errors->has('deportmetn_id') ? ' is-invalid' : ''), 'placeholder' => 'Deportmetn Id']) }}
            {!! $errors->first('deportmetn_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('book_id') }}
            {{ Form::text('book_id', $bookAct->book_id, ['class' => 'form-control' . ($errors->has('book_id') ? ' is-invalid' : ''), 'placeholder' => 'Book Id']) }}
            {!! $errors->first('book_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_by') }}
            {{ Form::text('created_by', $bookAct->created_by, ['class' => 'form-control' . ($errors->has('created_by') ? ' is-invalid' : ''), 'placeholder' => 'Created By']) }}
            {!! $errors->first('created_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated_by') }}
            {{ Form::text('updated_by', $bookAct->updated_by, ['class' => 'form-control' . ($errors->has('updated_by') ? ' is-invalid' : ''), 'placeholder' => 'Updated By']) }}
            {!! $errors->first('updated_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
