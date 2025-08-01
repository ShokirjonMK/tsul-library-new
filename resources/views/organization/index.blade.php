@extends('layouts.app')

@section('template_title')
    {{ __('Organization') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Organization') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Organization') }}
            </p>
        </div>
        <div>
            <a href="{{ route('organizations.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    <th>{{ __('Number of books') }}</th>
                                    <th>{{ __('Books in Copy') }}</th>
                                    <th>{{ __('Image') }}</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($organizations as $organization)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
                                        <td>
                                            {{ $organization->title }}
                                        </td>
                                        
                                        <td>{!! $organization->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                        <td>
                                            {{ $organization->book->count() }}
                                        </td>
                                        <td>
                                            {{ $organization->bookInventar->count() }}
                                        </td>
 										<td>
                                            @if ($organization->image_path)
                                                <img src="{{ asset('/storage/organizations/photo/' . $organization->image_path) }}" width="100px">
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('organizations.destroy',[app()->getLocale(), $organization->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('organizations.show', [app()->getLocale(), $organization->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('organizations.edit', [app()->getLocale(), $organization->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                            @if (Auth::user()->hasRole('SuperAdmin'))
                                                <br>
                                                <form method="POST"
                                                    action="{{ route('organizations.delete', [app()->getLocale(), 'id' => $organization->id]) }}">
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
                    @if ($organizations->count() > 0)
                        {!! $organizations->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
