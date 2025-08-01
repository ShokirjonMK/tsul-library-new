@extends('layouts.app')

@section('template_title')
    {{ __('Resource Type') }} 
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Resource Type') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Resource Type') }}
            </p>
        </div>
        <div>
            <a href="{{ route('res-type.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    <th>{{ __('Code') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($resourceTypes as $resourceType)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                            <td>{!! $resourceType->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                            <td>{{ $resourceType->title }}</td>
                                            <td>{{ $resourceType->code }}</td>
                                        <td>
                                            <form action="{{ route('res-type.destroy',[app()->getLocale(), $resourceType->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('res-type.show', [app()->getLocale(), $resourceType->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('res-type.edit', [app()->getLocale(), $resourceType->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($resourceTypes->count() > 0)
                        {!! $resourceTypes->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
