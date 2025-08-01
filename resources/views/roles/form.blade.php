<div class="row">

    <div class="col-xl-12 col-lg-12">
        <div class="form-group">
            <strong>{{ __('Title') }}:</strong>
            {!! Form::text('name',  ($role)?$role->name:null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <strong>{{ __('Permission') }}:</strong>
            <br/>
            @foreach($permission as $value)
            @if ($isUpdateMode)
                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            @else 
            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                {{ $value->name }}</label>
            @endif

            
                <br/>

            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>