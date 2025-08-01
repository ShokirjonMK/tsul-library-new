@extends('layouts.app')

@section('template_title')
    {{ __('Extra Author Book') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Extra Author Book') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Extra Author Book') }}
            </p>
        </div>
        <div>
            <a href="{{ route('extra-author-books.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
										<th>Extra Author Id</th>
										<th>Book Id</th>
										<th>Name</th>
										<th>Slug</th>
										<th>Extra1</th>
										<th>Extra2</th>
										<th>Extra3</th>
										<th>Created By</th>
										<th>Updated By</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($extraAuthorBooks as $extraAuthorBook)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $extraAuthorBook->extra_author_id }}</td>
											<td>{{ $extraAuthorBook->book_id }}</td>
											<td>{{ $extraAuthorBook->name }}</td>
											<td>{{ $extraAuthorBook->slug }}</td>
											<td>{{ $extraAuthorBook->extra1 }}</td>
											<td>{{ $extraAuthorBook->extra2 }}</td>
											<td>{{ $extraAuthorBook->extra3 }}</td>
											<td>{{ $extraAuthorBook->created_by }}</td>
											<td>{{ $extraAuthorBook->updated_by }}</td>

                                        <td>
                                            <form action="{{ route('extra-author-books.destroy',[app()->getLocale(), $extraAuthorBook->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('extra-author-books.show', [app()->getLocale(), $extraAuthorBook->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('extra-author-books.edit', [app()->getLocale(), $extraAuthorBook->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($extraAuthorBooks->count() > 0)
                        {!! $extraAuthorBooks->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
