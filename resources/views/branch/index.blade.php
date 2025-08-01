@extends('layouts.app')

@section('template_title')
    {{ __('Branch') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Branch') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Branch') }}
            </p>
        </div>
        <div>
            <a href="{{ route('branches.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('IsActive') }}</th> 
                                    <th>{{ __('Number of books') }}</th>
                                    <th>{{ __('Books in Copy') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <form action="{{ route('branches.index', app()->getLocale()) }}" method="GET" 
                                    accept-charset="UTF-8" role="search">

                                <tr>
                                    <td></td>
                                    <td>
                                        
                                        @if ($organizations->count() > 0)
                                            <div class="form-group">
                                                 {!! Form::select('organization_id', $organizations, $organization_id, ['class' => 'border  p-2 bg-white form-select', 'placeholder' => __('Choose')]) !!}
                                            </div>
                                        @endif
                                    </td>
                                    <td><input type="text" class="form-control" name="keyword"
                                        placeholder="{{ __('Title') }}..."
                                        value="{{ $keyword }}"></td>
                                    <td>   <select class="form-select" id="status" name="status">
                                        <option value='0' {{ $status ? '' : 'selected' }}>
                                            {{ __('Passive') }}</option>
                                        <option value='1' {{ $status ? 'selected' : '' }}>
                                            {{ __('Active') }}</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror</td> 
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('branches.index', app()->getLocale()) }}"
                                            class="btn btn-sm btn-info">{{ __('Clear') }}</a>
                                        <button type="submit"
                                            class="btn btn-sm btn-primary float-right">{{ __('Search') }}</button>
                                    </td>
                                </tr>
                            </form>

                            @foreach ($branches as $branch)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{!! $branch->organization_id ? $branch->organization->title : '' !!}</td>

                                        <td>{{ $branch->title }}</td>
                                        <td>{!! $branch->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>

                                        <td>
                                            {{ $branch->book->count() }}
                                        </td>
                                        <td>
                                            {{ $branch->bookInventar->count() }}
                                        </td>
                                        <td>
                                            <form action="{{ route('branches.destroy',[app()->getLocale(), $branch->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('branches.show', [app()->getLocale(), $branch->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('branches.edit', [app()->getLocale(), $branch->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                            @if (Auth::user()->hasRole('SuperAdmin'))
                                                <br>
                                                <form method="POST"
                                                    action="{{ route('branches.delete', [app()->getLocale(), 'id' => $branch->id]) }}">
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
                    @if ($branches->count() > 0)
                        {!! $branches->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
