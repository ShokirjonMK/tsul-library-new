@extends('layouts.app')

@section('template_title')
    {{ __('Roles') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Employee statistics') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Employee statistics') }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ec-vendor-list card card-default">
                    <div class="card-header">
                        <form action="{{ route('admin.employeestat', app()->getLocale()) }}" method="GET"
                            accept-charset="UTF-8" role="search" style="width: 100%;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group input-daterange">
                                        <input type="date" class="form-control" name="from"
                                            placeholder="{{ __('From') }}..." value="{{ $from }}">
                                        <div class="input-group-addon" style="margin: auto 11px;">{{ __('From') }}</div>
                                        <input type="date" class="form-control" name="to"
                                            placeholder="{{ __('To') }}..." value="{{ $to }}">
                                        <div class="input-group-addon" style="margin: auto 11px;">{{ __('To') }}</div>
                                    </div>

                                </div> 
                            </div>

                            <div class="card-footer">
                                <button type="submit"
                                    class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>

                                <a href="{{ route('admin.employeestat', app()->getLocale()) }}"
                                    class="btn btn-sm btn-info ">{{ __('Clear') }}</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>{{ __('Code') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>
                                            {{__('Statistics on inclusion of books in the database')}}
                                        </th>
                                        <th>
                                            {{__('Receiving and issuing books')}}
                                        </th>
                                        <th>
                                            {{__('Add users to the program')}}
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersEmps as $usersEmp)
                                        <tr>
                                            <td> <a href="{{ route('users.show', [app()->getLocale(),  $usersEmp->id ]) }}"> {{ $usersEmp->id }} </a> </td>
                                            <td>
                                                <a href="{{ route('users.show', [app()->getLocale(),  $usersEmp->id ]) }}">
                                                {{ $usersEmp->name }} <br>
                                                {{ $usersEmp->email }} <br>
                                                @php
                                                    if ($usersEmp->inventar_number) {
                                                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($usersEmp->inventar_number, $generator::TYPE_CODE_128)) . '">';
                                                    }
                                                @endphp
                                                <br>
                                                {{ $usersEmp->inventar_number }}
                                                </a>
                                            </td>
                                            <td>
                                                {{__('Bibliographic record')}}: <b>{!! \App\Models\Book::GetCountBookByUserByTwoMonth($usersEmp->id, $from, $to)!!}</b><br>
                                                {{__('Those attached to the branch')}}: <b>{!! \App\Models\BookInformation::GetCountBookInformationByUserByTwoMonth($usersEmp->id, $from, $to)!!}</b> <br>
                                                {{ __('In copy') }}: <b>{!! \App\Models\BookInventar::GetCountBookCopyByUserByTwoMonth($usersEmp->id, $from, $to)!!}</b>
                                            </td>
                                            <td>
                                                {{__('Issue of books')}}: <b>{!! \App\Models\Debtor::GetCountBookByUserByTwoMonth($usersEmp->id, $from, $to, \App\Models\Debtor::$GIVEN)!!}</b> <br>
                                                {{__('Number of books count')}}: <b>{!! \App\Models\Debtor::GetCountBookByUserByTwoMonth($usersEmp->id, $from, $to, \App\Models\Debtor::$TAKEN)!!}</b>
                                            </td>
                                            <td>
                                                 
                                               <b> {!! \App\Models\UserProfile::GetCountUsersByUserByTwoMonth($usersEmp->id, $from, $to) !!}</b>
                                            </td>
                                            <td>
                                                {{-- <a class="btn btn-sm btn-primary "
                                                        href="{{ route('employeestat.show', [app()->getLocale(), $debtor->reader_id, 'from' => $from, 'to'=>$to]) }}">
                                                        {{ __('Show') }}</a> --}}
                                            </td>
                                        </tr>
                                   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- @if ($statdebtor_by_readers->count() > 0)
                        {!! $statdebtor_by_readers->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
