@extends('layouts.app')

@section('template_title')
    {{ __('Group') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Groups') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Groups') }}
                </p>
            </div>
            <div>
                <a href="{{ route('groups.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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

                                        <th>{{ __('IsActive') }}</th>
                                        <th>{{ __('Organization') }}</th>
                                        <th>{{ __('Branch') }}</th>
                                        <th>{{ __('Faculty') }}</th>
                                        <th>{{ __('Chair') }}</th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('User count') }}</th> 


                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $group)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td> {!! $group->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                                            </td>
                                            <td>{!! $group->organization ? $group->organization->title : '' !!}</td>
                                            <td>{!! $group->branch ? $group->branch->title : '' !!}</td>
                                            <td>{!! $group->faculty ? $group->faculty->title : '' !!}</td>
                                            <td>{!! $group->chair ? $group->chair->title : '' !!}</td>
                                            <td>{{ $group->title }}</td>
                                            <td>{{ $group->profiles_count }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('groups.destroy', [app()->getLocale(), $group->id]) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('groups.show', [app()->getLocale(), $group->id]) }}">
                                                        {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('groups.edit', [app()->getLocale(), $group->id]) }}">
                                                        {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                                </form>
                                                @if (Auth::user()->hasRole('SuperAdmin'))
                                                <br>
                                                <form method="POST"
                                                    action="{{ route('groups.delete', [app()->getLocale(), 'id' => $group->id]) }}">
                                                    @csrf
                                                    <input name="type" type="hidden" value="DELETE">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger btn-flat show_confirm"
                                                        data-toggle="tooltip">{{ __('Delete from DataBase') }}</button>
                                                </form>
                                            @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($groups->count() > 0)
                            {!! $groups->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
