@extends('layouts.app')

@section('template_title')
    {{ __('Education Type Translation') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Education Type Translation') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Education Type Translation') }}
            </p>
        </div>
        <div>
            <a href="{{ route('education-type-translations.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
										<th>Education Type Id</th>
										<th>Title</th>
										<th>Slug</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($educationTypeTranslations as $educationTypeTranslation)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $educationTypeTranslation->locale }}</td>
											<td>{{ $educationTypeTranslation->education_type_id }}</td>
											<td>{{ $educationTypeTranslation->title }}</td>
											<td>{{ $educationTypeTranslation->slug }}</td>

                                        <td>
                                            <form action="{{ route('education-type-translations.destroy',[app()->getLocale(), $educationTypeTranslation->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('education-type-translations.show', [app()->getLocale(), $educationTypeTranslation->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('education-type-translations.edit', [app()->getLocale(), $educationTypeTranslation->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($educationTypeTranslations->count() > 0)
                        {!! $educationTypeTranslations->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
