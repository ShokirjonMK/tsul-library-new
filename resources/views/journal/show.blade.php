@extends('layouts.app')

@section('template_title')
    {{ $journal->name ?? __('Show') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Journal') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/journals') }}">{{ __('Journal') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
                </p>
            </div>
            <div>
                <a href="{{ url(app()->getLocale() . '/admin/journals') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>

        <div class="row">

            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-xl-6 col-lg-6">

                                    <div class="form-group">
                                        <strong>{{ __('IsActive') }}:</strong>
                                        {!! $journal->isActive == 1
                                            ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                            : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Organization') }}:</strong>
                                        {!! $journal->organization_id ? $journal->organization->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Title') }}:</strong>
                                        {{ $journal->title }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('ISSN') }}:</strong>
                                        {{ $journal->ISSN }}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{ __('Phone Number') }}:</strong>
                                        {{ $journal->phone_number }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Subjects') }}:</strong>
                                        @php
                                            if ($journal->subjects != 'null') {
                                                foreach (json_decode($journal->subjects) as $key => $value) {
                                                    echo \App\Models\BookSubject::GetById($value) ? \App\Models\BookSubject::GetById($value)->title . ', ' : '';
                                                }
                                            }
                                        @endphp
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Fax') }}:</strong>
                                        {{ $journal->fax }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Email') }}:</strong>
                                        {{ $journal->email }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Website') }}:</strong>
                                        {{ $journal->website }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('editor_in_chiefs') }}:</strong>
                                        {{ $journal->editor_in_chiefs }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('editorial_members') }}:</strong>
                                        @php
                                            if ($journal->editorial_members) {
                                                foreach (json_decode($journal->editorial_members) as $key => $value) {
                                                    echo \App\Models\Author::GetById($value) ? \App\Models\Author::GetById($value)->title . ', ' : '';
                                                }
                                            }
                                        @endphp
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">

                                    <div class="form-group">
                                        <strong>{{ __('Image') }}:</strong>
                                        @if ($journal->image_path)
                                            <img src="{{ asset('/storage/journals/photo/' . $journal->image_path) }}"
                                                width="100px">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Books Type') }}:</strong>
                                        {!! $journal->booksType ? $journal->booksType->title : '' !!}

                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Book Text') }}:</strong>
                                        {!! $journal->bookText ? $journal->bookText->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Book Text Type') }}:</strong>
                                        {!! $journal->bookTextType ? $journal->bookTextType->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Book Access Type') }}:</strong>
                                        {!! $journal->bookAccessType ? $journal->bookAccessType->title : '' !!}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{ __('Created By') }}:</strong>
                                        {!! $journal->created_by ? $journal->createdBy->name : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Updated By') }}:</strong>
                                        {!! $journal->updated_by ? $journal->updatedBy->name : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Created At') }}:</strong>
                                        {{ $journal->created_at }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Updated At') }}:</strong>
                                        {{ $journal->updated_at }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <livewire:admin.journal.get-magazines-by-journal :journal_id="$journal->id"  />
          

    </div>
@endsection
