@extends('layouts.app')

@section('template_title')
    {{ __('Book Act') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Book Act') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Book Act') }}
                </p>
            </div>
            <div>
                <a href="{{ route('book-acts.create', app()->getLocale()) }}" class="btn btn-primary float-right">
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
                                        <th>{{ __('Where') }}</th>
                                        <th>{{ __('Arrived Year') }}</th>
                                        <th>{{ __('Summarka Raqam') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <form action="{{ route('book-acts.index', app()->getLocale()) }}" method="GET" 
                                        accept-charset="UTF-8" role="search">
    
                                    <tr>
                                        <th> </th>
                                        <th>
                                            @if ($wheres->count() > 0)
                                                <div class="form-group">
                                                    {!! Form::select('where_id', $wheres, $where_id, ['class' => 'border  p-2 bg-white form-select', 'placeholder' => __('Choose')]) !!}
                                                </div>
                                            @endif
                                        </th> 
                                        <th>
                                            <input type="text" class="form-control" name="arrived_year"
                                            placeholder="{{ __('Arrived Year') }}..."
                                            value="{{ $arrived_year }}">
                                        </th>
                                        <th>
                                            <input type="text" class="form-control" name="summarka"
                                            placeholder="{{ __('Summarka Raqam') }}..."
                                            value="{{ $summarka }}">
                                        </th>
                                     
                                        <th></th>
                                        <th >
                                            <button type="submit"
                                                class="btn btn-sm btn-primary float-left">{{ __('Search') }}</button>
                                            <a href="{{ route('book-acts.index', app()->getLocale()) }}"
                                                    class="btn btn-sm btn-info float-right">{{ __('Clear') }}</a>
                                            <br>
                                            <a href="{{ route('book-acts.export', [app()->getLocale(), 'where-id'=>$where_id, 'arrived-year'=>$arrived_year, 'summarka'=>$summarka]) }}" class="btn btn-sm btn-success float-right">
                                                {{ __('Export to Excel') }}
                                            </a>
                                        </th>
                                    </tr>
                                </form>
                                    @foreach ($bookActs as $bookAct)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $bookAct->wheres->title }}</td>
                                            <td>{{ $bookAct->arrived_year }}</td>
                                            <td>{{ $bookAct->summarka_raqam }}</td> 
                                            <td>{{ $bookAct->price }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary "
                                                    href="{{ route('book-acts.show', [app()->getLocale(), $bookAct->id]) }}">
                                                    {{ __('Show') }}</a>
                                                @if (Auth::user()->hasRole('SuperAdmin'))
                                                    <br>
                                                    <form
                                                        action="{{ route('book-acts.destroy', [app()->getLocale(), $bookAct->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        @csrf
                                                        <input name="type" type="hidden" value="DELETE">
                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger btn-flat show_confirm"
                                                            data-toggle="tooltip">{{ __('Delete from DataBase') }}</button>
                                                    </form>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($bookActs->count() > 0)
                            {!! $bookActs->appends(Request::all())->links('vendor.pagination.default') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
