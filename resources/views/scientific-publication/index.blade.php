@extends('layouts.app')

@section('template_title')
    {{ __('Scientific Publication') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Scientific Publication') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Scientific Publication') }}
            </p>
        </div>
        <div>
            <a href="{{ route('scientific-publications.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
										<th>Steps</th>
										<th>Copies</th>
										<th>Key</th>
										<th>Code</th>
										<th>Publication Year</th>
										<th>Page Number</th>
										<th>Permission</th>
										<th>Barcode Key</th>
										<th>Barcode</th>
										<th>Inventar Number</th>
										<th>Isactive</th>
										<th>Image Path</th>
										<th>File Path</th>
										<th>Journal Id</th>
										<th>Magazine Issue Id</th>
										<th>Res Lang Id</th>
										<th>Res Type Id</th>
										<th>Res Field Id</th>
										<th>Created By</th>
										<th>Updated By</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($scientificPublications as $scientificPublication)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $scientificPublication->steps }}</td>
											<td>{{ $scientificPublication->copies }}</td>
											<td>{{ $scientificPublication->key }}</td>
											<td>{{ $scientificPublication->code }}</td>
											<td>{{ $scientificPublication->publication_year }}</td>
											<td>{{ $scientificPublication->page_number }}</td>
											<td>{{ $scientificPublication->permission }}</td>
											<td>{{ $scientificPublication->barcode_key }}</td>
											<td>{{ $scientificPublication->barcode }}</td>
											<td>{{ $scientificPublication->inventar_number }}</td>
											<td>{{ $scientificPublication->isActive }}</td>
											<td>{{ $scientificPublication->image_path }}</td>
											<td>{{ $scientificPublication->file_path }}</td>
											<td>{{ $scientificPublication->journal_id }}</td>
											<td>{{ $scientificPublication->magazine_issue_id }}</td>
											<td>{{ $scientificPublication->res_lang_id }}</td>
											<td>{{ $scientificPublication->res_type_id }}</td>
											<td>{{ $scientificPublication->res_field_id }}</td>
											<td>{{ $scientificPublication->created_by }}</td>
											<td>{{ $scientificPublication->updated_by }}</td>

                                        <td>
                                            <form action="{{ route('scientific-publications.destroy',[app()->getLocale(), $scientificPublication->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('scientific-publications.show', [app()->getLocale(), $scientificPublication->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('scientific-publications.edit', [app()->getLocale(), $scientificPublication->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($scientificPublications->count() > 0)
                        {!! $scientificPublications->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
