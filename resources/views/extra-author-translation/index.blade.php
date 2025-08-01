@extends('layouts.app')

@section('template_title')
    {{ __('Extra Author Translation') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Extra Author Translation') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Extra Author Translation') }}
            </p>
        </div>
        <div>
            <a href="{{ route('extra-author-translations.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
										<th>Extra Author Id</th>
										<th>Title</th>
										<th>Slug</th>
										<th>Content</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($extraAuthorTranslations as $extraAuthorTranslation)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $extraAuthorTranslation->locale }}</td>
											<td>{{ $extraAuthorTranslation->extra_author_id }}</td>
											<td>{{ $extraAuthorTranslation->title }}</td>
											<td>{{ $extraAuthorTranslation->slug }}</td>
											<td>{{ $extraAuthorTranslation->content }}</td>

                                        <td>
                                            <form action="{{ route('extra-author-translations.destroy',[app()->getLocale(), $extraAuthorTranslation->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('extra-author-translations.show', [app()->getLocale(), $extraAuthorTranslation->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('extra-author-translations.edit', [app()->getLocale(), $extraAuthorTranslation->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($extraAuthorTranslations->count() > 0)
                        {!! $extraAuthorTranslations->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
