@extends('layouts.app')

@section('template_title')
    {{ __('Book Information') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Book Information') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Book Information') }}
            </p>
        </div>
        <div>
            <a href="{{ route('book-informations.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
										<th>Summarka Raqam</th>
										<th>Arrived Year</th>
										<th>Kutubxonada Bor</th>
										<th>Elektronni Bor</th>
										<th>Branch Id</th>
										<th>Deportmetn Id</th>
										<th>Book Id</th>
										<th>Created By</th>
										<th>Updated By</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($bookInformations as $bookInformation)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $bookInformation->isActive }}</td>
											<td>{{ $bookInformation->summarka_raqam }}</td>
											<td>{{ $bookInformation->arrived_year }}</td>
											<td>{{ $bookInformation->kutubxonada_bor }}</td>
											<td>{{ $bookInformation->elektronni_bor }}</td>
											<td>{{ $bookInformation->branch_id }}</td>
											<td>{{ $bookInformation->deportmetn_id }}</td>
											<td>{{ $bookInformation->book_id }}</td>
											<td>{{ $bookInformation->created_by }}</td>
											<td>{{ $bookInformation->updated_by }}</td>

                                        <td>
                                            <form action="{{ route('book-informations.destroy',[app()->getLocale(), $bookInformation->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('book-informations.show', [app()->getLocale(), $bookInformation->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('book-informations.edit', [app()->getLocale(), $bookInformation->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($bookInformations->count() > 0)
                        {!! $bookInformations->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
