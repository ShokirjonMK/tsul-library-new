<div class="box box-info padding-1">
    <div class="box-body">
        
        @php
            $isActive = 1;
            if ($social->count() > 0 && isset($social->isActive)){
                $isActive = $social->isActive;
            }
        @endphp
        <div class="form-group row">
            <label for="isActive" class="form-label">{{ __('isActive') }}</label>
            <select class="form-select" id="isActive" name="isActive">
                <option value='0' {{ $isActive ? '' : 'selected' }}>{{ __('Passive') }}</option>
                <option value='1' {{ $isActive ? 'selected' : '' }}>{{ __('Active') }}</option>
            </select>
            @error('isActive')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
         
        <div class="form-group">
            {{ Form::label('link') }}
            {{ Form::text('link', $social->link, ['class' => 'form-control' . ($errors->has('link') ? ' is-invalid' : ''), 'placeholder' => 'Link']) }}
            {!! $errors->first('link', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('title') }}
            {{ Form::text('title', $social->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fa_icon_class') }}
            {{ Form::text('fa_icon_class', $social->fa_icon_class, ['class' => 'form-control' . ($errors->has('fa_icon_class') ? ' is-invalid' : ''), 'placeholder' => 'Fa Icon Class']) }}
            {!! $errors->first('fa_icon_class', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        @php
            $isMain = 1;
            if ($social->count() > 0 && isset($social->isMain)){
                $isMain = $social->isMain;
            }
        @endphp
        <div class="form-group row">
            <label for="isMain" class="form-label">{{ __('isMain') }}</label>
            <select class="form-select" id="isMain" name="isMain">
                <option value='0' {{ $isMain ? '' : 'selected' }}>{{ __('Passive') }}</option>
                <option value='1' {{ $isMain ? 'selected' : '' }}>{{ __('Active') }}</option>
            </select>
            @error('isMain')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        
        <div class="form-group">
            {{ Form::label('order') }}
            {{ Form::text('order', $social->order, ['class' => 'form-control' . ($errors->has('order') ? ' is-invalid' : ''), 'placeholder' => 'Order']) }}
            {!! $errors->first('order', '<div class="invalid-feedback">:message</div>') !!}
        </div> 

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
