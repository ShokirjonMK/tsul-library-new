<div>

    <form method="POST" role="form" enctype="multipart/form-data" wire:submit.prevent="update">
        <div class="row">
            <div class="col-xl-7 col-lg-12">
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
                        <input type="hidden" wire:model="user_id">

                        <div class="box box-info padding-1">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Name') }}" name="name" id="name" wire:model="name">
                                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="inventar_number">{{ __('Inventar Number') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('inventar_number') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Inventar Number') }}" name="inventar_number"
                                        id="inventar_number" wire:model="inventar_number">
                                    {!! $errors->first('inventar_number', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input type="email"
                                        class="form-control  {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Email') }}" name="email" id="email" wire:model="email">
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input type="password"
                                        class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Password') }}" name="password" id="password"
                                        wire:model="password">
                                    {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                                    <input type="password"
                                        class="form-control  {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Confirm Password') }}" name="password_confirmation"
                                        id="password_confirmation" wire:model="password_confirmation">
                                    {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
                                </div>


                                <div class="form-group">
                                    <label for="phone_number">{{ __('Phone Number') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Phone Number') }}" name="phone_number" id="phone_number"
                                        wire:model="phone_number">
                                    {!! $errors->first('phone_number', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">{{ __('Date Of Birth') }}</label>
                                    <input type="date"
                                        class="form-control  {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Date Of Birth') }}" name="date_of_birth"
                                        id="date_of_birth" wire:model="date_of_birth">
                                    {!! $errors->first('date_of_birth', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="course">{{ __('Course') }}</label>
                                    <input type="number"
                                        class="form-control  {{ $errors->has('course') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Course') }}" name="course" id="course"
                                        wire:model="course">
                                    {!! $errors->first('course', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-5 col-lg-12">
                <div class="ec-cat-list card card-default mb-24px">
                    <div class="card-body">
                        <div class="ec-cat-form">
                            <div class="form-group">
                                <label for="gender_id">{{ __('Reference Gender') }}</label>
                                <div wire:ignore>
                                    <select id="gender_id"
                                        class=" form-select form-control {{ $errors->has('gender_id') ? ' is-invalid' : '' }}"
                                        wire:model="gender_id">
                                        <option value>{{ __('Choose') }}</option>
                                        @foreach ($genders as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('gender_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">

                                <label for="role-dropdown">{{ __('Role') }}</label>
                                <div wire:ignore>
                                    <select id="role-dropdown" class=" form-select form-control " multiple
                                        wire:model.defer="userroles">
                                        @foreach ($roles as $k => $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('userroles', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="userType_id">{{ __('User Type') }}</label>
                                <div wire:ignore>
                                    <select id="userType_id"
                                        class=" form-select form-control {{ $errors->has('userType_id') ? ' is-invalid' : '' }}"
                                        wire:model="userType_id">
                                        <option value>{{ __('Choose') }}</option>
                                        @foreach ($userTypes as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('userType_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                <label for="organization_id">{{ __('Organization') }}</label>
                                <div  >
                                    <select id="organization_id"
                                        class=" form-select form-control {{ $errors->has('organization_id') ? ' is-invalid' : '' }}"
                                        wire:model="organization_id">
                                        <option value>{{ __('Choose') }}</option>
                                        @foreach ($organizations as $k => $v)
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {!! $errors->first('organization_id', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <br>

                            @if ($organization_id > 0)
                                <div class="form-group">
                                    <label for="branch_id">{{ __('Branches') }}</label>
                                    <div  >
                                        <select id="branch_id"
                                            class=" form-select form-control {{ $errors->has('branch_id') ? ' is-invalid' : '' }}"
                                            wire:model="branch_id">
                                            <option value>{{ __('Choose') }}</option>
                                            @foreach ($branches as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {!! $errors->first('branch_id', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            @endif
                            <br>
                            @if ($organization_id > 0 && $branch_id > 0)
                                <div class="form-group">
                                    <label for="department_id">{{ __('Departments') }}</label>
                                    <div  >
                                        <select id="department_id"
                                            class=" form-select form-control {{ $errors->has('department_id') ? ' is-invalid' : '' }}"
                                            wire:model="department_id">
                                            <option value>{{ __('Choose') }}</option>
                                            @foreach ($departments as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {!! $errors->first('department_id', '<div class="invalid-feedback">:message</div>') !!}
                                </div>

                            @endif
                            <br>


                            <div class="form-group">
                                <div class="form-checkbox-box">
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" name="isActive" wire:model="isActive">
                                            {{ __('isActive') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label(__('User image')) }}
                                <br>
                                <input type="file" wire:model="user_image" accept="image/*" class='form-control'>

                                <div wire:loading wire:target="user_image">{{ __('Uploading') }}...</div>

                                @if ($user_image)
                                    <br>
                                    {{ __('Photo Preview') }}:
                                    <div class="align-items-left">
                                        <img src="{{ $user_image->temporaryUrl() }}" width="100">
                                    </div>
                                @elseif($user_old_image)
                                    <div class="align-items-left">
                                        <img src="/storage/{{ $user_old_image }}" width="100">
                                    </div>
                                @endif
                                @error('user_image')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-12 box-footer mt20">
                                    {{-- <button type="submit" class="btn btn-primary">{{ __('Save') }}</button> --}}
                                    <button  class="btn btn-primary">{{ __('Save') }}</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
@push('scripts')
    <script>
        $(document).ready(function() {

            $('#role-dropdown').select2({
                tags: true,
            });
            $('#role-dropdown').on('change', function(e) {
                let data = $(this).val();
                @this.set('userroles', data);
            });
        });
    </script>
@endpush
