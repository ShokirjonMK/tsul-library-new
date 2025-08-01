@extends('layouts.app')

@section('template_title')
    {{ $subject->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Subjects') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/subjects') }}">{{ __('Subjects') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
            </p>
        </div>
        <div>
        <a href="{{ url(app()->getLocale() . '/admin/subjects') }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">

                        <div class="form-group">
                            <strong>{{ __('IsActive') }}:</strong>
                            {!! $subject->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('Title') }}:</strong>
                            {{ $subject->title }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('HEMIS Code') }}:</strong>
                            {{ $subject->code }}
                        </div>

                        <div class="form-group">
                            <strong>{{ __('Bibliographic record') }}:</strong>
                            {{ $subject->books_count }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Number of books') }}:</strong>
                            {!! \App\Models\Subject::GetCountBookByBookTypeId($subject->id) !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Books in Copy') }}:</strong>
                            {!! \App\Models\Subject::GetCountBookCopiesByBookTypeId($subject->id) !!}
                        </div>


                        <div class="form-group">
                            <strong>{{ __('Created By') }}:</strong>
                            {!! $subject->created_by ? $subject->createdBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated By') }}:</strong>
                            {!! $subject->updated_by ? $subject->updatedBy->name : '' !!}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Created At') }}:</strong>
                            {{ $subject->created_at  }}
                        </div>
                        <div class="form-group">
                            <strong>{{ __('Updated At') }}:</strong>
                            {{ $subject->updated_at  }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
