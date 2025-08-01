@extends('layouts.app')

@section('template_title')
    {{ __('Roles') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Statdebtors') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Statdebtors') }}
                </p>
            </div>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    <strong>{{ __('IsActive') }}:</strong>
                                    {!! $user->status == 1
                                        ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                        : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Reader') }}:</strong>
                                    {{ $user->name }}
                                </div>

                                <div class="form-group">
                                    <strong>{{ __('Email') }}:</strong>
                                    {{ $user->email }}
                                </div>

                                <div class="form-group">
                                    <strong>{{ __('Roles') }}:</strong>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $val)
                                            <label class="badge badge-purple">{{ $val }}</label>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <strong>{{ __('Inventar Number') }}:</strong>
                                    <div>
                                        @if(($user->inventar_number))

                                            @if (env('USER_BAR_CODE_TYPE')=='QRCODE')
                                                {!! QrCode::size(100)->generate($user->inventar_number); !!}
                                            @else
                                                @php
                                                    $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                    echo $generator->getBarcode($user->inventar_number, $generator::TYPE_CODE_128, 2.30);

                                                @endphp
                                            @endif
                                        @endif
                                        <br>
                                        {{ $user->inventar_number }}
                                    </div>
                                </div>
                                @if ($user->profile != null)
                                    <div class="form-group">
                                        <strong>{{ __('User image') }}:</strong>
                                        <div>
                                            @if ($user->profile->image)
                                                <div class="align-items-left">
                                                    <img src="/storage/{{ $user->profile->image }}" width="100">
                                                </div>
                                            @else
                                                {{ __('No image') }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Phone Number') }}:</strong>
                                        {{ $user->profile->phone_number }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">

                                @if ($user->profile != null)
                                    <div class="form-group">
                                        <strong>{{ __('Date Of Birth') }}:</strong>
                                        {{ $user->profile->date_of_birth }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('PIN') }}:</strong>
                                        {{ $user->profile->pnf_code }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Passport series and number') }}:</strong>
                                        {{ $user->profile->passport_seria_number }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Course') }}:</strong>
                                        {{ $user->profile->kursi }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Reference Gender') }}:</strong>
                                        {!! $user->profile->referenceGender ? $user->profile->referenceGender->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('User Type') }}:</strong>
                                        {!! $user->profile->userType ? $user->profile->userType->title : '' !!}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{ __('Faculty') }}:</strong>
                                        {!! $user->profile->faculty_id ? $user->profile->faculty->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Chair') }}:</strong>
                                        {!! $user->profile->chair_id ? $user->profile->chair->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Group') }}:</strong>
                                        {!! $user->profile->group_id ? $user->profile->group->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Address') }}:</strong>
                                        {!! $user->profile->address !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>{{ __('Book') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Taken Time') }}</th>
                                        <th>{{ __('Return Time') }}</th>
                                        <th>{{ __('Returned Time') }}</th>
                                        <th>{{ __('How Many Days') }}</th>
                                        <th>{{ __('Given By') }}</th>
                                        <th>{{ __('Taken By') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($statdebtor_by_readers as $debtor)
                                        <tr>
                                            <td>{{ $debtor->id }}</td>
                                            <td>
                                                {!!\App\Models\Book::GetBibliographicById($debtor->book_id )!!}
                                                <br>
                                                @if ($debtor->bookInventar!=null)
                                                    <div class="text-center">
                                                        @if (env('BAR_CODE_TYPE')=='QRCODE')
                                                            {!! QrCode::size(100)->generate($debtor->bookInventar->bar_code); !!}
                                                        @else
                                                            @php
                                                                $generator = new Picqer\Barcode\BarcodeGeneratorSVG();
                                                                echo $generator->getBarcode($debtor->bookInventar->bar_code, $generator::TYPE_CODE_128, 2.30);
                                                            @endphp
                                                        @endif
                                                        <br>
                                                        {{ $debtor->bookInventar->bar_code }}

                                                    </div>
                                                @endif
                                            </td>
                                            <td>{!! \App\Models\Debtor::GetStatus($debtor->status) !!}</td>

                                            <td>{{ $debtor->taken_time }}</td>
                                            <td>{{ $debtor->return_time }}</td>
                                            <td>{{ $debtor->returned_time }}</td>
                                            <td>{{ $debtor->how_many_days }}</td>
                                            <td>{!! $debtor->created_by ? $debtor->createdBy->name : '' !!}</td>
                                            <td>{!! $debtor->updated_by ? $debtor->updatedBy->name : '' !!}</td>



                                            <td>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($statdebtor_by_readers->count() > 0)
                            {{-- {{ $statdebtor_by_readers->links() }} --}}


                        {!! $statdebtor_by_readers->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
