<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('record') }}
            {{ Form::text('record', $bibliographicrecord->record, ['class' => 'form-control' . ($errors->has('record') ? ' is-invalid' : ''), 'placeholder' => 'Record']) }}
            {!! $errors->first('record', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('workPage') }}
            {{ Form::text('workPage', $bibliographicrecord->workPage, ['class' => 'form-control' . ($errors->has('workPage') ? ' is-invalid' : ''), 'placeholder' => 'Workpage']) }}
            {!! $errors->first('workPage', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('countOf') }}
            {{ Form::text('countOf', $bibliographicrecord->countOf, ['class' => 'form-control' . ($errors->has('countOf') ? ' is-invalid' : ''), 'placeholder' => 'Countof']) }}
            {!! $errors->first('countOf', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('purrentID') }}
            {{ Form::text('purrentID', $bibliographicrecord->purrentID, ['class' => 'form-control' . ($errors->has('purrentID') ? ' is-invalid' : ''), 'placeholder' => 'Purrentid']) }}
            {!! $errors->first('purrentID', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fileName') }}
            {{ Form::text('fileName', $bibliographicrecord->fileName, ['class' => 'form-control' . ($errors->has('fileName') ? ' is-invalid' : ''), 'placeholder' => 'Filename']) }}
            {!! $errors->first('fileName', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fileSiize') }}
            {{ Form::text('fileSiize', $bibliographicrecord->fileSiize, ['class' => 'form-control' . ($errors->has('fileSiize') ? ' is-invalid' : ''), 'placeholder' => 'Filesiize']) }}
            {!! $errors->first('fileSiize', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('creator') }}
            {{ Form::text('creator', $bibliographicrecord->creator, ['class' => 'form-control' . ($errors->has('creator') ? ' is-invalid' : ''), 'placeholder' => 'Creator']) }}
            {!! $errors->first('creator', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $bibliographicrecord->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
