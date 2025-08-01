<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('phone_number') }}
            {{ Form::text('phone_number', $userProfile->phone_number, ['class' => 'form-control' . ($errors->has('phone_number') ? ' is-invalid' : ''), 'placeholder' => 'Phone Number']) }}
            {!! $errors->first('phone_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('pnf_code') }}
            {{ Form::text('pnf_code', $userProfile->pnf_code, ['class' => 'form-control' . ($errors->has('pnf_code') ? ' is-invalid' : ''), 'placeholder' => 'Pnf Code']) }}
            {!! $errors->first('pnf_code', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('passport_seria_number') }}
            {{ Form::text('passport_seria_number', $userProfile->passport_seria_number, ['class' => 'form-control' . ($errors->has('passport_seria_number') ? ' is-invalid' : ''), 'placeholder' => 'Passport Seria Number']) }}
            {!! $errors->first('passport_seria_number', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('passport_copy') }}
            {{ Form::text('passport_copy', $userProfile->passport_copy, ['class' => 'form-control' . ($errors->has('passport_copy') ? ' is-invalid' : ''), 'placeholder' => 'Passport Copy']) }}
            {!! $errors->first('passport_copy', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('image') }}
            {{ Form::text('image', $userProfile->image, ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''), 'placeholder' => 'Image']) }}
            {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('date_of_birth') }}
            {{ Form::text('date_of_birth', $userProfile->date_of_birth, ['class' => 'form-control' . ($errors->has('date_of_birth') ? ' is-invalid' : ''), 'placeholder' => 'Date Of Birth']) }}
            {!! $errors->first('date_of_birth', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('kursi') }}
            {{ Form::text('kursi', $userProfile->kursi, ['class' => 'form-control' . ($errors->has('kursi') ? ' is-invalid' : ''), 'placeholder' => 'Kursi']) }}
            {!! $errors->first('kursi', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('gender_id') }}
            {{ Form::text('gender_id', $userProfile->gender_id, ['class' => 'form-control' . ($errors->has('gender_id') ? ' is-invalid' : ''), 'placeholder' => 'Gender Id']) }}
            {!! $errors->first('gender_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_type_id') }}
            {{ Form::text('user_type_id', $userProfile->user_type_id, ['class' => 'form-control' . ($errors->has('user_type_id') ? ' is-invalid' : ''), 'placeholder' => 'User Type Id']) }}
            {!! $errors->first('user_type_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $userProfile->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('branch_id') }}
            {{ Form::text('branch_id', $userProfile->branch_id, ['class' => 'form-control' . ($errors->has('branch_id') ? ' is-invalid' : ''), 'placeholder' => 'Branch Id']) }}
            {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('department_id') }}
            {{ Form::text('department_id', $userProfile->department_id, ['class' => 'form-control' . ($errors->has('department_id') ? ' is-invalid' : ''), 'placeholder' => 'Department Id']) }}
            {!! $errors->first('department_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_by') }}
            {{ Form::text('created_by', $userProfile->created_by, ['class' => 'form-control' . ($errors->has('created_by') ? ' is-invalid' : ''), 'placeholder' => 'Created By']) }}
            {!! $errors->first('created_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated_by') }}
            {{ Form::text('updated_by', $userProfile->updated_by, ['class' => 'form-control' . ($errors->has('updated_by') ? ' is-invalid' : ''), 'placeholder' => 'Updated By']) }}
            {!! $errors->first('updated_by', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</div>
