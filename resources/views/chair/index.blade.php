@extends('layouts.app')

@section('template_title')
    {{ __('Chairs') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Chairs') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Chairs') }}
            </p>
        </div>
        <div>
            <a href="{{ route('chairs.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    <th>{{ __('Faculties') }}</th> 

                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('User count') }}</th> 

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($chairs as $chair)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{!! $chair->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>

                                        <td>{!! $chair->organization_id ? $chair->organization->title : '' !!}</td>
                                        <td>{!! $chair->branch_id ? $chair->branch->title:''!!}</td>
                                        <td>{!! $chair->faculty_id ? $chair->faculty->title:''!!}</td>

                                        <td>{{ $chair->title }}</td>
                                        <td>{{ $chair->profiles_count }}</td>

                                        <td>
                                            <form action="{{ route('chairs.destroy',[app()->getLocale(), $chair->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('chairs.show', [app()->getLocale(), $chair->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('chairs.edit', [app()->getLocale(), $chair->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                            @if (Auth::user()->hasRole('SuperAdmin'))
                                                <br>
                                                <form method="POST"
                                                    action="{{ route('chairs.delete', [app()->getLocale(), 'id' => $chair->id]) }}">
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
                    @if ($chairs->count() > 0)
                        {!! $chairs->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
