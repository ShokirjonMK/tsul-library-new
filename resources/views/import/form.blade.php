<div class="box box-info padding-1">
    <div class="box-body">
        @php
           // dd($import);
        @endphp
        <div class="form-group">
            {{ Form::label('title') }}
            {{ Form::text('title', $import->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('authors') }}
            {{ Form::text('authors', $import->authors, ['class' => 'form-control' . ($errors->has('authors') ? ' is-invalid' : ''), 'placeholder' => 'Authors']) }}
            {!! $errors->first('authors', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('UDK') }}
            {{ Form::text('UDK', $import->UDK, ['class' => 'form-control' . ($errors->has('UDK') ? ' is-invalid' : ''), 'placeholder' => 'Udk']) }}
            {!! $errors->first('UDK', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('BBK') }}
            {{ Form::text('BBK', $import->BBK, ['class' => 'form-control' . ($errors->has('BBK') ? ' is-invalid' : ''), 'placeholder' => 'Bbk']) }}
            {!! $errors->first('BBK', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('publisher') }}
            {{ Form::text('publisher', $import->publisher, ['class' => 'form-control' . ($errors->has('publisher') ? ' is-invalid' : ''), 'placeholder' => 'Publisher']) }}
            {!! $errors->first('publisher', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('published_city') }}
            {{ Form::text('published_city', $import->published_city, ['class' => 'form-control' . ($errors->has('published_city') ? ' is-invalid' : ''), 'placeholder' => 'Published City']) }}
            {!! $errors->first('published_city', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('published_year') }}
            {{ Form::text('published_year', $import->published_year, ['class' => 'form-control' . ($errors->has('published_year') ? ' is-invalid' : ''), 'placeholder' => 'Published Year']) }}
            {!! $errors->first('published_year', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ISBN') }}
            {{ Form::text('ISBN', $import->ISBN, ['class' => 'form-control' . ($errors->has('ISBN') ? ' is-invalid' : ''), 'placeholder' => 'Isbn']) }}
            {!! $errors->first('ISBN', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $import->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div> 
        <div class="form-group">
            {{ Form::label('published_date') }}
            {{ Form::text('published_date', $import->published_date, ['class' => 'form-control' . ($errors->has('published_date') ? ' is-invalid' : ''), 'placeholder' => 'Published Date']) }}
            {!! $errors->first('published_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('authors_mark') }}
            {{ Form::text('authors_mark', $import->authors_mark, ['class' => 'form-control' . ($errors->has('authors_mark') ? ' is-invalid' : ''), 'placeholder' => 'Authors Mark']) }}
            {!! $errors->first('authors_mark', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('from_what_system') }}
            {{ Form::text('from_what_system', $import->from_what_system, ['class' => 'form-control' . ($errors->has('from_what_system') ? ' is-invalid' : ''), 'placeholder' => 'From What System']) }}
            {!! $errors->first('from_what_system', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('betlar_soni') }}
            {{ Form::text('betlar_soni', $import->betlar_soni, ['class' => 'form-control' . ($errors->has('betlar_soni') ? ' is-invalid' : ''), 'placeholder' => 'Betlar Soni']) }}
            {!! $errors->first('betlar_soni', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('price') }}
            {{ Form::text('price', $import->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Price']) }}
            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $import->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra1') }}
            {{ Form::text('extra1', $import->extra1, ['class' => 'form-control' . ($errors->has('extra1') ? ' is-invalid' : ''), 'placeholder' => 'Extra1']) }}
            {!! $errors->first('extra1', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra2') }}
            {{ Form::text('extra2', $import->extra2, ['class' => 'form-control' . ($errors->has('extra2') ? ' is-invalid' : ''), 'placeholder' => 'Extra2']) }}
            {!! $errors->first('extra2', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra3') }}
            {{ Form::text('extra3', $import->extra3, ['class' => 'form-control' . ($errors->has('extra3') ? ' is-invalid' : ''), 'placeholder' => 'Extra3']) }}
            {!! $errors->first('extra3', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extra4') }}
            {{ Form::text('extra4', $import->extra4, ['class' => 'form-control' . ($errors->has('extra4') ? ' is-invalid' : ''), 'placeholder' => 'Extra4']) }}
            {!! $errors->first('extra4', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_by') }}
            {{ Form::text('created_by', $import->created_by, ['class' => 'form-control' . ($errors->has('created_by') ? ' is-invalid' : ''), 'placeholder' => 'Created By']) }}
            {!! $errors->first('created_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated_by') }}
            {{ Form::text('updated_by', $import->updated_by, ['class' => 'form-control' . ($errors->has('updated_by') ? ' is-invalid' : ''), 'placeholder' => 'Updated By']) }}
            {!! $errors->first('updated_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
