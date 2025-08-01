@extends('layouts.app')

@section('template_title')
    {{ __('Resources Document') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Resources Document') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Resources Document') }}
            </p>
        </div>
        <div>
            <a href="{{ route('resources-documents.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
										<th>Resource Id</th>
										<th>Document Id</th>
										<th>Created By</th>
										<th>Updated By</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($resourcesDocuments as $resourcesDocument)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $resourcesDocument->resource_id }}</td>
											<td>{{ $resourcesDocument->document_id }}</td>
											<td>{{ $resourcesDocument->created_by }}</td>
											<td>{{ $resourcesDocument->updated_by }}</td>

                                        <td>
                                            <form action="{{ route('resources-documents.destroy',[app()->getLocale(), $resourcesDocument->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('resources-documents.show', [app()->getLocale(), $resourcesDocument->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('resources-documents.edit', [app()->getLocale(), $resourcesDocument->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($resourcesDocuments->count() > 0)
                        {!! $resourcesDocuments->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
