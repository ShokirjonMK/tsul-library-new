@extends('layouts.app')

@section('template_title')
    {{ __('Author') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Author') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Author') }}
            </p>
        </div>
        <div>
            <a href="{{ route('authors.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
                                    <th>{{ __('FIO') }}</th>
									<th>{{ __('IsActive') }}</th> 
										<th>{{__('Author photo')}}</th> 


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($authors as $author)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
                                        <td>{{ $author->title }}</td>
                                        <td>{!! $author->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>

										<td>
                                            @if ($author->image_path)
                                                <img src="{{ asset('/storage/authors/photo/' . $author->image_path) }}" width="100px">
                                            @endif    
                                        </td> 

                                        <td>
                                            <form action="{{ route('authors.destroy',[app()->getLocale(), $author->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('authors.show', [app()->getLocale(), $author->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('authors.edit', [app()->getLocale(), $author->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($authors->count() > 0)
                        {!! $authors->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
