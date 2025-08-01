<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('title') }}
            {{ Form::text('title', $resource->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('authors') }}
            {{ Form::text('authors', $resource->authors, ['class' => 'form-control' . ($errors->has('authors') ? ' is-invalid' : ''), 'placeholder' => 'Authors']) }}
            {!! $errors->first('authors', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('type_id') }}
            {{ Form::text('type_id', $resource->type_id, ['class' => 'form-control' . ($errors->has('type_id') ? ' is-invalid' : ''), 'placeholder' => 'Type Id']) }}
            {!! $errors->first('type_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('publisher_id') }}
            {{ Form::text('publisher_id', $resource->publisher_id, ['class' => 'form-control' . ($errors->has('publisher_id') ? ' is-invalid' : ''), 'placeholder' => 'Publisher Id']) }}
            {!! $errors->first('publisher_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('published_year') }}
            {{ Form::text('published_year', $resource->published_year, ['class' => 'form-control' . ($errors->has('published_year') ? ' is-invalid' : ''), 'placeholder' => 'Published Year']) }}
            {!! $errors->first('published_year', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('published_city') }}
            {{ Form::text('published_city', $resource->published_city, ['class' => 'form-control' . ($errors->has('published_city') ? ' is-invalid' : ''), 'placeholder' => 'Published City']) }}
            {!! $errors->first('published_city', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('copies') }}
            {{ Form::text('copies', $resource->copies, ['class' => 'form-control' . ($errors->has('copies') ? ' is-invalid' : ''), 'placeholder' => 'Copies']) }}
            {!! $errors->first('copies', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('price') }}
            {{ Form::text('price', $resource->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Price']) }}
            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $resource->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('consignment_note') }}
            {{ Form::text('consignment_note', $resource->consignment_note, ['class' => 'form-control' . ($errors->has('consignment_note') ? ' is-invalid' : ''), 'placeholder' => 'Consignment Note']) }}
            {!! $errors->first('consignment_note', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('act_number') }}
            {{ Form::text('act_number', $resource->act_number, ['class' => 'form-control' . ($errors->has('act_number') ? ' is-invalid' : ''), 'placeholder' => 'Act Number']) }}
            {!! $errors->first('act_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ksu') }}
            {{ Form::text('ksu', $resource->ksu, ['class' => 'form-control' . ($errors->has('ksu') ? ' is-invalid' : ''), 'placeholder' => 'Ksu']) }}
            {!! $errors->first('ksu', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('who_id') }}
            {{ Form::text('who_id', $resource->who_id, ['class' => 'form-control' . ($errors->has('who_id') ? ' is-invalid' : ''), 'placeholder' => 'Who Id']) }}
            {!! $errors->first('who_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('basic_id') }}
            {{ Form::text('basic_id', $resource->basic_id, ['class' => 'form-control' . ($errors->has('basic_id') ? ' is-invalid' : ''), 'placeholder' => 'Basic Id']) }}
            {!! $errors->first('basic_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('organization_id') }}
            {{ Form::text('organization_id', $resource->organization_id, ['class' => 'form-control' . ($errors->has('organization_id') ? ' is-invalid' : ''), 'placeholder' => 'Organization Id']) }}
            {!! $errors->first('organization_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('branch_id') }}
            {{ Form::text('branch_id', $resource->branch_id, ['class' => 'form-control' . ($errors->has('branch_id') ? ' is-invalid' : ''), 'placeholder' => 'Branch Id']) }}
            {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('deportmetn_id') }}
            {{ Form::text('deportmetn_id', $resource->deportmetn_id, ['class' => 'form-control' . ($errors->has('deportmetn_id') ? ' is-invalid' : ''), 'placeholder' => 'Deportmetn Id']) }}
            {!! $errors->first('deportmetn_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('comment') }}
            {{ Form::text('comment', $resource->comment, ['class' => 'form-control' . ($errors->has('comment') ? ' is-invalid' : ''), 'placeholder' => 'Comment']) }}
            {!! $errors->first('comment', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra1') }}
            {{ Form::text('extra1', $resource->extra1, ['class' => 'form-control' . ($errors->has('extra1') ? ' is-invalid' : ''), 'placeholder' => 'Extra1']) }}
            {!! $errors->first('extra1', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra2') }}
            {{ Form::text('extra2', $resource->extra2, ['class' => 'form-control' . ($errors->has('extra2') ? ' is-invalid' : ''), 'placeholder' => 'Extra2']) }}
            {!! $errors->first('extra2', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra3') }}
            {{ Form::text('extra3', $resource->extra3, ['class' => 'form-control' . ($errors->has('extra3') ? ' is-invalid' : ''), 'placeholder' => 'Extra3']) }}
            {!! $errors->first('extra3', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra4') }}
            {{ Form::text('extra4', $resource->extra4, ['class' => 'form-control' . ($errors->has('extra4') ? ' is-invalid' : ''), 'placeholder' => 'Extra4']) }}
            {!! $errors->first('extra4', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_by') }}
            {{ Form::text('created_by', $resource->created_by, ['class' => 'form-control' . ($errors->has('created_by') ? ' is-invalid' : ''), 'placeholder' => 'Created By']) }}
            {!! $errors->first('created_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated_by') }}
            {{ Form::text('updated_by', $resource->updated_by, ['class' => 'form-control' . ($errors->has('updated_by') ? ' is-invalid' : ''), 'placeholder' => 'Updated By']) }}
            {!! $errors->first('updated_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
