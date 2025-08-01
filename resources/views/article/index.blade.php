@extends('layouts.app')

@section('template_title')
    {{ __('Articles') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Articles') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Articles') }}
            </p>
        </div>
        <div>
            <a href="{{ route('articles.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
										<th>Udk</th>
										<th>File Path</th>
										<th>Journal Id</th>
										<th>Magazine Issue Id</th>
										<th>Sort Id</th>
										<th>Created By</th>
										<th>Updated By</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($articles as $article)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        
											<td>{{ $article->steps }}</td>
											<td>{{ $article->udk }}</td>
											<td>{{ $article->file_path }}</td>
											<td>{{ $article->journal_id }}</td>
											<td>{{ $article->magazine_issue_id }}</td>
											<td>{{ $article->sort_id }}</td>
											<td>{{ $article->created_by }}</td>
											<td>{{ $article->updated_by }}</td>

                                        <td>
                                            <form action="{{ route('articles.destroy',[app()->getLocale(), $article->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('articles.show', [app()->getLocale(), $article->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('articles.edit', [app()->getLocale(), $article->id]) }}"> {{ __('Edit') }}</a>
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
                    @if ($articles->count() > 0)
                        {!! $articles->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
