@extends('layouts.app')

@section('template_title')
    {{ __('Contact Translation') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Contact Translation') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Contact Translation') }}
            </p>
        </div>
        <div>
            <a href="{{ route('contact-translations.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
										<th>Contact Id</th>
										<th>Title</th>
										<th>Slug</th>
										<th>Site Name</th>
										<th>Site Name2</th>
										<th>Footer Menu</th>
										<th>Footer Info</th>
										<th>Contacts Info</th>
										<th>Home Description</th>
										<th>Footer Description</th>
										<th>Address Locality</th>
										<th>Street Address</th>
										<th>Street Address2</th>
										<th>Description</th>
										<th>Body</th>
										<th>Extra1</th>
										<th>Extra2</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($contactTranslations as $contactTranslation)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $contactTranslation->locale }}</td>
											<td>{{ $contactTranslation->contact_id }}</td>
											<td>{{ $contactTranslation->title }}</td>
											<td>{{ $contactTranslation->slug }}</td>
											<td>{{ $contactTranslation->site_name }}</td>
											<td>{{ $contactTranslation->site_name2 }}</td>
											<td>{{ $contactTranslation->footer_menu }}</td>
											<td>{{ $contactTranslation->footer_info }}</td>
											<td>{{ $contactTranslation->contacts_info }}</td>
											<td>{{ $contactTranslation->home_description }}</td>
											<td>{{ $contactTranslation->footer_description }}</td>
											<td>{{ $contactTranslation->address_locality }}</td>
											<td>{{ $contactTranslation->street_address }}</td>
											<td>{{ $contactTranslation->street_address2 }}</td>
											<td>{{ $contactTranslation->description }}</td>
											<td>{{ $contactTranslation->body }}</td>
											<td>{{ $contactTranslation->extra1 }}</td>
											<td>{{ $contactTranslation->extra2 }}</td>

                                        <td>
                                            <form action="{{ route('contact-translations.destroy',[app()->getLocale(), $contactTranslation->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('contact-translations.show', [app()->getLocale(), $contactTranslation->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('contact-translations.edit', [app()->getLocale(), $contactTranslation->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($contactTranslations->count() > 0)
                        {!! $contactTranslations->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
