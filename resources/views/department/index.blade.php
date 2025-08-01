@extends('layouts.app')

@section('template_title')
    {{ __('Department') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Department') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Department') }}
            </p>
        </div>
        <div>
            <a href="{{ route('departments.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    <th>{{ __('Organization') }}</th> 
                                    <th>{{ __('Branch') }}</th> 
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Number of books') }}</th>
                                    <th>{{ __('Books in Copy') }}</th>
                                    <th>{{ __('IsActive') }}</th> 
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{!! $department->organization ? $department->organization->title:''!!}</td>
                                        <td>{!! $department->branch ? $department->branch->title:''!!}</td>
                                        
                                        <td>{{ $department->title }}</td>
                                        <td>
                                            {{ $department->book->count() }}
                                        </td>
                                        <td>
                                            {{ $department->bookInventar->count() }}
                                        </td>
                                        <td>{!! $department->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                        
                                        <td>
                                            <form action="{{ route('departments.destroy',[app()->getLocale(), $department->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('departments.show', [app()->getLocale(), $department->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('departments.edit', [app()->getLocale(), $department->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                            @if (Auth::user()->hasRole('SuperAdmin'))
                                                <br>
                                                <form method="POST"
                                                    action="{{ route('departments.delete', [app()->getLocale(), 'id' => $department->id]) }}">
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
                    @if ($departments->count() > 0)
                        {!! $departments->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
