@extends('layouts.app')

@section('template_title')
    {{ __('Permissions') }}
@endsection

@section('content')

<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Permissions') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Permissions') }}
            </p>
        </div>
        <div>
            <a href="{{ route('permissions.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $key => $permission)
                                    <tr>
                                        
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>

                                        <td>
                                            <form action="{{ route('permissions.destroy',[app()->getLocale(), $permission->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('permissions.show', [app()->getLocale(), $permission->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('permissions.edit', [app()->getLocale(), $permission->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($data->count() > 0)
                        {!! $data->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div> 
            </div>
        </div>
    </div>
</div> 
@endsection