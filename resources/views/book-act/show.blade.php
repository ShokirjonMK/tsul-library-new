@extends('layouts.app')

@section('template_title')
    {{ $bookAct->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Book Act') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/book-acts') }}">{{ __('Book Act') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/book-acts') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>{{ __('Where') }}:</strong>
                            {{ $bookAct->wheres->title }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Price') }}:</strong>
                            {{ $bookAct->price }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Summarka Raqam') }}:</strong>
                            {{ $bookAct->summarka_raqam }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Arrived Year') }}:</strong>
                            {{ $bookAct->arrived_year }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Organization') }}:</strong>
                            {!! $bookAct->organization_id ? $bookAct->organization->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Branch') }}:</strong>
                            {!! $bookAct->branch_id ? $bookAct->branch->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Department') }}:</strong>
                            {!! $bookAct->department_id ? $bookAct->department->title : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Bibliographic record') }}:</strong>
                            <br>
                            {!!\App\Models\Book::GetBibliographicById($bookAct->book_id)!!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $bookAct->created_by ? $bookAct->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $bookAct->updated_by ? $bookAct->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $bookAct->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $bookAct->updated_at  }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
