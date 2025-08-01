@extends('layouts.app')

@section('template_title')
    {{ __('Scientific Publication Translation') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Scientific Publication Translation') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Scientific Publication Translation') }}
            </p>
        </div>
        <div>
            <a href="{{ route('scientific-publication-translations.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
										<th>Scientific Publication Id</th>
										<th>Title</th>
										<th>Slug</th>
										<th>Sub Title</th>
										<th>Country</th>
										<th>Inst Nome Address</th>
										<th>Authors</th>
										<th>Keywords</th>
										<th>Place Protection</th>
										<th>Content</th>
										<th>Description</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($scientificPublicationTranslations as $scientificPublicationTranslation)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $scientificPublicationTranslation->locale }}</td>
											<td>{{ $scientificPublicationTranslation->scientific_publication_id }}</td>
											<td>{{ $scientificPublicationTranslation->title }}</td>
											<td>{{ $scientificPublicationTranslation->slug }}</td>
											<td>{{ $scientificPublicationTranslation->sub_title }}</td>
											<td>{{ $scientificPublicationTranslation->country }}</td>
											<td>{{ $scientificPublicationTranslation->inst_nome_address }}</td>
											<td>{{ $scientificPublicationTranslation->authors }}</td>
											<td>{{ $scientificPublicationTranslation->keywords }}</td>
											<td>{{ $scientificPublicationTranslation->place_protection }}</td>
											<td>{{ $scientificPublicationTranslation->content }}</td>
											<td>{{ $scientificPublicationTranslation->description }}</td>

                                        <td>
                                            <form action="{{ route('scientific-publication-translations.destroy',[app()->getLocale(), $scientificPublicationTranslation->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('scientific-publication-translations.show', [app()->getLocale(), $scientificPublicationTranslation->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('scientific-publication-translations.edit', [app()->getLocale(), $scientificPublicationTranslation->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($scientificPublicationTranslations->count() > 0)
                        {!! $scientificPublicationTranslations->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
