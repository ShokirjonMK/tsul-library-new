@extends('layouts.app')

@section('template_title')
    {{ __('Resource') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Resource') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Resource') }}
            </p>
        </div>
        <div>
            <a href="{{ route('resources.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                    
										<th>Title</th>
										<th>Authors</th>
										<th>Type Id</th>
										<th>Publisher Id</th>
										<th>Published Year</th>
										<th>Published City</th>
										<th>Copies</th>
										<th>Price</th>
										<th>Status</th>
										<th>{{__('Consignment Note')}}</th>
										<th>{{__('Act Number')}}</th>
										<th>Ksu</th>
										<th>Who Id</th>
										<th>Basic Id</th>
										<th>Organization Id</th>
										<th>Branch Id</th>
										<th>Deportmetn Id</th>
										<th>Comment</th>
										<th>Extra1</th>
										<th>Extra2</th>
										<th>Extra3</th>
										<th>Extra4</th>
										<th>Created By</th>
										<th>Updated By</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($resources as $resource)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $resource->title }}</td>
											<td>{{ $resource->authors }}</td>
											<td>{{ $resource->type_id }}</td>
											<td>{{ $resource->publisher_id }}</td>
											<td>{{ $resource->published_year }}</td>
											<td>{{ $resource->published_city }}</td>
											<td>{{ $resource->copies }}</td>
											<td>{{ $resource->price }}</td>
											<td>{{ $resource->status }}</td>
											<td>{{ $resource->consignment_note }}</td>
											<td>{{ $resource->act_number }}</td>
											<td>{{ $resource->ksu }}</td>
											<td>{{ $resource->who_id }}</td>
											<td>{{ $resource->basic_id }}</td>
											<td>{{ $resource->organization_id }}</td>
											<td>{{ $resource->branch_id }}</td>
											<td>{{ $resource->deportmetn_id }}</td>
											<td>{{ $resource->comment }}</td>
											<td>{{ $resource->extra1 }}</td>
											<td>{{ $resource->extra2 }}</td>
											<td>{{ $resource->extra3 }}</td>
											<td>{{ $resource->extra4 }}</td>
											<td>{{ $resource->created_by }}</td>
											<td>{{ $resource->updated_by }}</td>

                                        <td>
                                            <form action="{{ route('resources.destroy',[app()->getLocale(), $resource->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('resources.show', [app()->getLocale(), $resource->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('resources.edit', [app()->getLocale(), $resource->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($resources->count() > 0)
                        {!! $resources->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
