@extends('layouts.app')

@section('template_title')
    {{ __('Gen Type Translation') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Gen Type Translation') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Gen Type Translation') }}
            </p>
        </div>
        <div>
            <a href="{{ route('gen-type-translations.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
										<th>Gen Type Id</th>
										<th>Title</th>
										<th>Slug</th>
										<th>Content</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($genTypeTranslations as $genTypeTranslation)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $genTypeTranslation->locale }}</td>
											<td>{{ $genTypeTranslation->gen_type_id }}</td>
											<td>{{ $genTypeTranslation->title }}</td>
											<td>{{ $genTypeTranslation->slug }}</td>
											<td>{{ $genTypeTranslation->content }}</td>

                                        <td>
                                            <form action="{{ route('gen-type-translations.destroy',[app()->getLocale(), $genTypeTranslation->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('gen-type-translations.show', [app()->getLocale(), $genTypeTranslation->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('gen-type-translations.edit', [app()->getLocale(), $genTypeTranslation->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($genTypeTranslations->count() > 0)
                        {!! $genTypeTranslations->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
