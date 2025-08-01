<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('order_date') }}
            {{ Form::text('order_date', $order->order_date, ['class' => 'form-control' . ($errors->has('order_date') ? ' is-invalid' : ''), 'placeholder' => 'Order Date']) }}
            {!! $errors->first('order_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('order_number') }}
            {{ Form::text('order_number', $order->order_number, ['class' => 'form-control' . ($errors->has('order_number') ? ' is-invalid' : ''), 'placeholder' => 'Order Number']) }}
            {!! $errors->first('order_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('type') }}
            {{ Form::text('type', $order->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type']) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $order->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('reader_id') }}
            {{ Form::text('reader_id', $order->reader_id, ['class' => 'form-control' . ($errors->has('reader_id') ? ' is-invalid' : ''), 'placeholder' => 'Reader Id']) }}
            {!! $errors->first('reader_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
