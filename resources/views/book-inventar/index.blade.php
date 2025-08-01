@extends('layouts.app')

@section('template_title')
    {{ __('Book Inventar') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Book Inventar') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Book Inventar') }}
            </p>
        </div>
        <div>
            <a href="{{ route('book-inventars.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
										<th>Isactive</th>
										<th>Comment</th>
										<th>Inventar Number</th>
										<th>Book Id</th>
										<th>Book Information Id</th>
										<th>Branch Id</th>
										<th>Deportmetn Id</th>
										<th>Created By</th>
										<th>Updated By</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($bookInventars as $bookInventar)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $bookInventar->isActive }}</td>
											<td>{{ $bookInventar->comment }}</td>
											<td>{{ $bookInventar->inventar_number }}</td>
											<td>{{ $bookInventar->book_id }}</td>
											<td>{{ $bookInventar->book_information_id }}</td>
											<td>{{ $bookInventar->branch_id }}</td>
											<td>{{ $bookInventar->deportmetn_id }}</td>
											<td>{{ $bookInventar->created_by }}</td>
											<td>{{ $bookInventar->updated_by }}</td>

                                        <td>
                                            <form action="{{ route('book-inventars.destroy',[app()->getLocale(), $bookInventar->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('book-inventars.show', [app()->getLocale(), $bookInventar->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('book-inventars.edit', [app()->getLocale(), $bookInventar->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($bookInventars->count() > 0)
                        {!! $bookInventars->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
