<div class="row">

    <div class="col-xl-8 col-lg-12">
        <div class="ec-cat-list card card-default">
            <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    {{ Form::label(__('Name')) }}
                    {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => __('Name')]) }}
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label(__('Inventar Number')) }}
                    {{ Form::text('inventar_number', $user->inventar_number, ['class' => 'form-control' . ($errors->has('inventar_number') ? ' is-invalid' : ''), 'placeholder' => __('Inventar Number')]) }}
                    @error('inventar_number')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {{ Form::label(__('Email')) }}
                    {!! Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => __('Email')]) !!}
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="required" for="password">{{ __('Password') }}:</label>
                    {!! Form::password('password', ['placeholder' => __('Password'), 'class' => 'form-control']) !!}
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="required" for="confirm_password">{{ __('Confirm Password') }}:</label>
                    {!! Form::password('password_confirmation', ['placeholder' => __('Confirm Password'), 'class' => 'form-control']) !!}
                    @error('password_confirmation')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            <div class="card-body">
                <div class="ec-cat-form">
                    @php
                        $status = 1;
                        if ($user->count() > 0 && isset($user->status)) {
                            $status = $user->status;
                        }
                    @endphp

                    <div class="form-group">

                        <label for="status" class="form-label">{{ __('Status') }}</label>
                        <select class="form-control" id="status" name="status">
                            <option value='0' {{ $status ? '' : 'selected' }}>{{ __('Passive') }}</option>
                            <option value='1' {{ $status ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label>{{ __('Role') }}:</label>
                            {!! Form::select('roles[]', $roles, $userRole, ['class' => 'js-example-basic-single form-control', 'multiple']) !!}
                            @error('role_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                         
                        <br>
                        @error('role_id') <span
                                class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
