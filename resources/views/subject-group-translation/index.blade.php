@extends('layouts.app')

@section('template_title')
    {{ __('Subject Group Translation') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Subject Group Translation') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Subject Group Translation') }}
            </p>
        </div>
        <div>
            <a href="{{ route('subject-group-translations.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
										<th>Subject Group Id</th>
										<th>Title</th>
										<th>Slug</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($subjectGroupTranslations as $subjectGroupTranslation)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $subjectGroupTranslation->locale }}</td>
											<td>{{ $subjectGroupTranslation->subject_group_id }}</td>
											<td>{{ $subjectGroupTranslation->title }}</td>
											<td>{{ $subjectGroupTranslation->slug }}</td>

                                        <td>
                                            <form action="{{ route('subject-group-translations.destroy',[app()->getLocale(), $subjectGroupTranslation->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('subject-group-translations.show', [app()->getLocale(), $subjectGroupTranslation->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('subject-group-translations.edit', [app()->getLocale(), $subjectGroupTranslation->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($subjectGroupTranslations->count() > 0)
                        {!! $subjectGroupTranslations->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
