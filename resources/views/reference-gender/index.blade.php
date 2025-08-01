@extends('layouts.app')

@section('template_title')
    {{ __('Reference Gender') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Reference Gender') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Reference Gender') }}
                </p>
            </div>
            <div>
                <a href="{{ route('reference-genders.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                        <th>{{ __('IsActive') }}</th>
                                        <th>{{ __('User count') }}</th>



                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($referenceGenders as $referenceGender)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $referenceGender->title }}</td>
                                            <td>{!! $referenceGender->isActive == 1
                                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $referenceGender->users_count }}</td>


                                            <td>
                                                <form
                                                    action="{{ route('reference-genders.destroy', [app()->getLocale(), $referenceGender->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('reference-genders.show', [app()->getLocale(), $referenceGender->id]) }}">
                                                        {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('reference-genders.edit', [app()->getLocale(), $referenceGender->id]) }}">
                                                        {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($referenceGenders->count() > 0)
                            {!! $referenceGenders->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
