@extends('layouts.app')

@section('template_title')
    {{ __('Book Subject') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Book Subject') }}</h1>
            <p class="breadcrumbs"><span><a
                        href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Book Subject') }}
            </p>
        </div>
        <div>
            <a href="{{ route('book-subjects.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
									<th>{{ __('IsActive') }}</th> 
                                    <th>{{ __('Title') }}</th>
                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($bookSubjects as $bookSubject)
                                    <tr class="clickable-row" data-href="{{ route('book-subjects.show', [app()->getLocale(), $bookSubject->id]) }}">
 
                                        <td>{{ $bookSubject->id }}</td>
                                        
                                        <td>{!! $bookSubject->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                        <td>{{ $bookSubject->title }}</td>


                                        <td>
                                            <form action="{{ route('book-subjects.destroy',[app()->getLocale(), $bookSubject->id]) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('book-subjects.show', [app()->getLocale(), $bookSubject->id]) }}"> {{ __('Show') }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('book-subjects.edit', [app()->getLocale(), $bookSubject->id]) }}"> {{ __('Edit') }}</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                                            </form>
                                            @if (Auth::user()->hasRole('SuperAdmin'))
                                                <br>
                                                <form method="POST" action="{{ route('book-subjects.delete', [app()->getLocale(), 'id'=>$bookSubject->id]) }}">
                                                    @csrf
                                                    <input name="type" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm" data-toggle="tooltip" >{{ __('Delete from DataBase') }}</button>
                                                </form>                                                    
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach                                    
                            </tbody>
                        </table>
                    </div>
                    @if ($bookSubjects->count() > 0)
                        {!! $bookSubjects->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
