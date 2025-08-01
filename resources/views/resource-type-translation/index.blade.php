@extends('layouts.app')

@section('template_title')
    {{ __('Resource Type Translation') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Resource Type Translation') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Resource Type Translation') }}
            </p>
        </div>
        <div>
            <a href="{{ route('resource-type-translations.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
										<th>Locale</th>
										<th>Resource Type Id</th>
										<th>Title</th>
										<th>Slug</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($resourceTypeTranslations as $resourceTypeTranslation)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $resourceTypeTranslation->locale }}</td>
											<td>{{ $resourceTypeTranslation->resource_type_id }}</td>
											<td>{{ $resourceTypeTranslation->title }}</td>
											<td>{{ $resourceTypeTranslation->slug }}</td>

                                        <td>
                                            <form action="{{ route('resource-type-translations.destroy',[app()->getLocale(), $resourceTypeTranslation->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('resource-type-translations.show', [app()->getLocale(), $resourceTypeTranslation->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('resource-type-translations.edit', [app()->getLocale(), $resourceTypeTranslation->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($resourceTypeTranslations->count() > 0)
                        {!! $resourceTypeTranslations->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
