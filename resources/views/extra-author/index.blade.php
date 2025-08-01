@extends('layouts.app')

@section('template_title')
    {{ __('Extra Author') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Extra Author') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Extra Author') }}
            </p>
        </div>
        <div>
            <a href="{{ route('extra-authors.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    <th>{{ __('Organization') }}</th>
                                    <th>{{ __('Branch') }}</th> 


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($extraAuthors as $extraAuthor)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{!! $extraAuthor->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                        <td>{{ $extraAuthor->title }}</td>

                                        <td>{!! $extraAuthor->organization_id ? $extraAuthor->organization->title : '' !!}</td>
                                        <td>{!! $extraAuthor->branch_id ? $extraAuthor->branch->title:''!!}</td>


                                        <td>
                                            <form action="{{ route('extra-authors.destroy',[app()->getLocale(), $extraAuthor->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('extra-authors.show', [app()->getLocale(), $extraAuthor->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('extra-authors.edit', [app()->getLocale(), $extraAuthor->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($extraAuthors->count() > 0)
                        {!! $extraAuthors->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
