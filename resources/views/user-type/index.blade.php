@extends('layouts.app')

@section('template_title')
    {{ __('User Type') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('User Type') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('User Type') }}
            </p>
        </div>
        <div>
            <a href="{{ route('user-types.create', app()->getLocale()) }}" class="btn btn-primary float-right">
                {{ __('Create') }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

									<th>{{ __('Title') }}</th>
                                    <th>{{ __('HEMIS Code') }}</th>

                                    <th>{{ __('IsActive') }}</th>
									<th>{{ __('User count') }}</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($userTypes as $userType)
                                    <tr>
                                        <td>{{ $userType->id }}</td>
                                        <td>{{ $userType->title }}</td>
                                        <td>{{ $userType->code }}</td>

                                        <td>{!! $userType->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                        <td>{{ $userType->users_count }}</td>

                                        <td>
                                            <form action="{{ route('user-types.destroy',[app()->getLocale(), $userType->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('user-types.show', [app()->getLocale(), $userType->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('user-types.edit', [app()->getLocale(), $userType->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    @if ($userTypes->count() > 0)
                        {!! $userTypes->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
