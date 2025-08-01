@extends('layouts.app')

@section('template_title')
    {{ __('Bibliographicrecord') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Bibliographicrecord') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Bibliographicrecord') }}
            </p>
        </div>
        <div>
            <a href="{{ route('bibliographicrecords.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
										<th>Record</th>
										<th>Workpage</th>
										<th>Countof</th>
										<th>Purrentid</th>
										<th>Filename</th>
										<th>Filesiize</th>
										<th>Creator</th>
										<th>Status</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($bibliographicrecords as $bibliographicrecord)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $bibliographicrecord->record }}</td>
											<td>{{ $bibliographicrecord->workPage }}</td>
											<td>{{ $bibliographicrecord->countOf }}</td>
											<td>{{ $bibliographicrecord->purrentID }}</td>
											<td>{{ $bibliographicrecord->fileName }}</td>
											<td>{{ $bibliographicrecord->fileSiize }}</td>
											<td>{{ $bibliographicrecord->creator }}</td>
											<td>{{ $bibliographicrecord->status }}</td>

                                        <td>
                                            <form action="{{ route('bibliographicrecords.destroy',[app()->getLocale(), $bibliographicrecord->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('bibliographicrecords.show', [app()->getLocale(), $bibliographicrecord->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('bibliographicrecords.edit', [app()->getLocale(), $bibliographicrecord->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($bibliographicrecords->count() > 0)
                        {!! $bibliographicrecords->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
