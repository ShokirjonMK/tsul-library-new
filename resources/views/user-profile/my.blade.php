@extends('layouts.app')

@section('template_title')
    {{ __('My Profile') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('My Profile') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('My Profile') }}
                </p>
            </div>
        </div>

        <div class="card bg-white profile-content">
            <div class="row">
                <div class="col-lg-4 col-xl-3">
                    <div class="profile-content-left profile-left-spacing">
                        <div class="text-center widget-profile px-0 border-0">
                            <div class="card-img mx-auto rounded-circle">
                                @if (Auth::user()->profile != null && Auth::user()->profile->image)
                                    <img src="/storage/{{ Auth::user()->profile->image }}" class="img-image"
                                        alt="{{ Auth::user()->name }}" width="40" />
                                @else
                                    <img src="/assets/img/user/user.png" class="user-image" alt="{{ $user->name }}" />
                                @endif
                            </div>
                            <div class="card-body">
                                <h4 class="py-2 text-dark">{{ $user->name }}</h4>
                                <p>{{ $user->email }}</p>
                                <div class="form-group">
                                    <strong>{{ __('Inventar Number') }}:</strong>
                                    <div>
                                        @php
                                            if ($user->inventar_number) {
                                                $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                            }
                                        @endphp
                                        <br>
                                        {{ $user->inventar_number }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="d-flex justify-content-between ">
                        <div class="text-center pb-4">
                            <h6 class="text-dark pb-2">546</h6>
                            <p>Bought</p>
                        </div>

                        <div class="text-center pb-4">
                            <h6 class="text-dark pb-2">32</h6>
                            <p>Wish List</p>
                        </div>

                        <div class="text-center pb-4">
                            <h6 class="text-dark pb-2">1150</h6>
                            <p>Following</p>
                        </div>
                    </div> --}}

                        <hr class="w-100">

                        <div class="contact-info pt-4">
                            <h5 class="text-dark">{{ __('Contact Information') }}</h5>
                            <p class="text-dark font-weight-medium pt-24px mb-2">{{ __('Email') }}</p>
                            <p>{{ $user->email }}</p>
                            @if ($userProfile != null)
                                <p class="text-dark font-weight-medium pt-24px mb-2">{{ __('Phone Number') }}</p>
                                <p>{{ $userProfile->phone_number }}</p>
                                <p class="text-dark font-weight-medium pt-24px mb-2">{{ __('Date Of Birth') }}</p>
                                <p>{{ $userProfile->date_of_birth }}</p>
                                <div class="form-group">
                                    <strong>{{ __('Course') }}:</strong>
                                    {{ $userProfile->kursi }}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Reference Gender') }}:</strong>
                                    {!! $userProfile->referenceGender ? $userProfile->referenceGender->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('User Type') }}:</strong>
                                    {!! $userProfile->userType ? $userProfile->userType->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Branch') }}:</strong>
                                    {!! $userProfile->branch ? $userProfile->branch->title : '' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Department') }}:</strong>
                                    {!! $userProfile->department ? $userProfile->department->title : '' !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-xl-9">
                    <livewire:admin.users.my-profile :user_id="$user->id" />
                </div>

            </div>
        </div>


    </div>
@endsection
