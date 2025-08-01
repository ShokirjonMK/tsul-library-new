@extends('layouts.app')

@section('template_title')
    {{ __('Basic') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Basic') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Basic') }}
            </p>
        </div>
        <div>
            <a href="{{ route('basics.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    <th>{{ __('Title') }}</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($basics as $basic)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{!! $basic->isActive == 1
                                            ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                            : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                        <td>{{ $basic->title }}</td>

                                        <td>
                                            <form action="{{ route('basics.destroy',[app()->getLocale(), $basic->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('basics.show', [app()->getLocale(), $basic->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('basics.edit', [app()->getLocale(), $basic->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($basics->count() > 0)
                        {!! $basics->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
