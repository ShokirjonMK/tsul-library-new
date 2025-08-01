@extends('layouts.app')

@section('template_title')
    {{ __('Social') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Social') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Social') }}
            </p>
        </div>
        <div>
            <a href="{{ route('socials.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    <th>{{ __('Link') }} | {{ __('Title') }}</th>
                                    <th>{{ __('Ismain') }}</th>
                                    <th>{{ __('Procedure') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($socials as $social)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{!! $social->isActive == 1
                                            ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                            : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>

                                        <td> <a href="{{ $social->link }}" target="__blank">{{ $social->title }}</a>    </td>
                                        <td>{!! $social->isMain == 1
                                            ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                            : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>

                                        <td>{{ $social->order }}</td>
                                        

                                        <td>
                                            <form action="{{ route('socials.destroy',[app()->getLocale(), $social->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('socials.show', [app()->getLocale(), $social->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('socials.edit', [app()->getLocale(), $social->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($socials->count() > 0)
                        {!! $socials->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
