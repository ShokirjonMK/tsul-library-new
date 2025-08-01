<div>
    {{-- Do your work, then step back. --}}

    <div class="profile-content-right profile-right-spacing py-5">
        @if (count($errors))
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{$error}}</p>
            @endforeach
        @endif
        <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myProfileTab" role="tablist">
{{--            <li class="nav-item" role="presentation">--}}
{{--                <button class="nav-link " id="profile-tab" data-bs-toggle="tab"--}}
{{--                    data-bs-target="#profile" type="button" role="tab" aria-controls="profile"--}}
{{--                    aria-selected="true">{{ __('Profile') }}</button>--}}
{{--            </li>--}}
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="settings-tab" data-bs-toggle="tab"
                    data-bs-target="#settings" type="button" role="tab" aria-controls="settings"
                    aria-selected="false">{{ __('Settings') }}</button>
            </li>
        </ul>
        <div class="tab-content px-3 px-xl-5" id="myTabContent">
{{-- show active --}}
            <div class="tab-pane fade " id="profile" role="tabpanel"
                aria-labelledby="profile-tab">
                <div class="tab-widget mt-5">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="media widget-media p-3 bg-white border">
                                <div class="icon rounded-circle mr-3 bg-primary">
                                    <i class="mdi mdi-account-outline text-white "></i>
                                </div>

                                <div class="media-body align-self-center">
                                    <h4 class="text-primary mb-2">546</h4>
                                    <p>Bought</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="media widget-media p-3 bg-white border">
                                <div class="icon rounded-circle bg-warning mr-3">
                                    <i class="mdi mdi-cart-outline text-white "></i>
                                </div>

                                <div class="media-body align-self-center">
                                    <h4 class="text-primary mb-2">1953</h4>
                                    <p>Wish List</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="media widget-media p-3 bg-white border">
                                <div class="icon rounded-circle mr-3 bg-success">
                                    <i class="mdi mdi-ticket-percent text-white "></i>
                                </div>

                                <div class="media-body align-self-center">
                                    <h4 class="text-primary mb-2">02</h4>
                                    <p>Voucher</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                <div class="tab-pane-content mt-5">
                    <form method="POST" role="form" enctype="multipart/form-data" wire:submit.prevent="update">
                        <div class="form-group row mb-6">
                            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">{{__('User image')}}</label>
                            <div class="col-sm-8 col-lg-10">
                                <div class="custom-file mb-1">
                                    <input type="file" wire:model="user_image" accept="image/*" class="custom-file-input" id="coverImage" required>
                                    <label class="custom-file-label" for="coverImage">{{ __('Choose file') }}...</label>
                                    <div wire:loading wire:target="user_image">{{ __('Uploading') }}...</div>

                                    @if ($user_image)

                                        {{ __('Photo Preview') }}:
                                        <div class="align-items-left">
                                            <img src="{{ $user_image->temporaryUrl() }}" width="100">
                                        </div>
                                    @elseif($user_old_image)
                                        <div class="align-items-left">
                                            <img src="/storage/{{ $user_old_image }}" width="100">
                                        </div>
                                    @endif
                                    @error('user_image') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
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
                            <label for="branch_id">{{ __('Branches') }}</label>
                            <div wire:ignore>
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
                        <div class="form-group">
                            <label for="department_id">{{ __('Departments') }}</label>
                            <div wire:ignore>
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


                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name">{{ __('FIO') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('FIO') }}" name="name"
                                        id="name" wire:model="name">
                                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input type="email"
                                        class="form-control  {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Email') }}" name="email"
                                        id="email" wire:model="email">
                                    {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                        </div>


                        <div class="row mb-2">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone_number">{{ __('Phone Number') }}</label>
                                    <input type="text"
                                        class="form-control  {{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Phone Number') }}" name="phone_number" id="phone_number"
                                        wire:model="phone_number">
                                    {!! $errors->first('phone_number', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="date_of_birth">{{ __('Date Of Birth') }}</label>
                                    <input type="date"
                                        class="form-control  {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Date Of Birth') }}" name="date_of_birth" id="date_of_birth"
                                        wire:model="date_of_birth">
                                    {!! $errors->first('date_of_birth', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="course">{{ __('Course') }}</label>
                            <input type="number"
                                class="form-control  {{ $errors->has('course') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Course') }}" name="course" id="course"
                                wire:model="course">
                            {!! $errors->first('course', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group mb-4">
                            <label for="old_password">{{ __('Old Password') }}</label>
                            <input type="password"
                                class="form-control  {{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Old Password') }}" name="old_password"
                                id="old_password" wire:model="old_password">
                            {!! $errors->first('old_password', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">{{ __('New Password') }}</label>
                            <input type="password"
                                class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Password') }}" name="password"
                                id="password" wire:model="password">
                            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation">{{ __('Confirm New Password') }}</label>
                            <input type="password"
                                class="form-control  {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Confirm New Password') }}" name="password_confirmation"
                                id="password_confirmation" wire:model="password_confirmation">
                            {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
                        </div>


                        <div class="d-flex justify-content-end mt-5">
                            <button wire:click="update()" class="btn btn-primary mb-2 btn-pill">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
