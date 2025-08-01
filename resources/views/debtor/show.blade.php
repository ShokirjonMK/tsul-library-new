@extends('layouts.app')

@section('template_title')
    {{ $debtor->name ?? __('Show') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Debtor') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/debtors') }}">{{ __('Debtor') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
                </p>
            </div>
            <div>
                <a href="{{ url(app()->getLocale() . '/admin/debtors') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
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
                                        @foreach ($debtors as $debtor)
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
                                                                    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                                    echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($debtor->bookInventar->bar_code, $generator::TYPE_CODE_128)) . '">';
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
                            @if ($debtors->count() > 0)
                                {!! $debtors->appends(Request::all())->links('vendor.pagination.default') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
