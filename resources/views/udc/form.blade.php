<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label(__('Udc Number')) }}
            {{ Form::text('udc_number', $udc->udc_number, ['class' => 'form-control' . ($errors->has('udc_number') ? ' is-invalid' : ''), 'placeholder' => __('Udc Number')]) }}
            {!! $errors->first('udc_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
         
        <div class="form-group">
            {{ Form::label(__('Description')) }}
            {{ Form::text('description', $udc->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => __('Description')]) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('Number Of Codes')) }}
            {{ Form::text('number_of_codes', $udc->number_of_codes, ['class' => 'form-control' . ($errors->has('number_of_codes') ? ' is-invalid' : ''), 'placeholder' => __('Number Of Codes')]) }}
            {!! $errors->first('number_of_codes', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('Notes')) }}
            {{ Form::text('notes', $udc->notes, ['class' => 'form-control' . ($errors->has('notes') ? ' is-invalid' : ''), 'placeholder' => __('Notes')]) }}
            {!! $errors->first('notes', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(__('Parent', ['class' => 'form-label', 'for' => 'parent_id'])) }}
            {!! Form::select('parent_id', $udcs, $udc->parent_id, ['class' => 'js-example-basic-single form-select ' . ($errors->has('parent_id') ? ' is-invalid' : ''), 'placeholder' => __('Choose')]) !!} 

            {!! $errors->first('parent_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
