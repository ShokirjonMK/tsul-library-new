@extends('layouts.app')

@section('template_title')
    {{ $magazineIssue->name ?? __('Show') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Magazine Issue') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/magazine-issues') }}">{{ __('Magazine Issue') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ $booksType->title ?? __('Show') }}
                </p>
            </div>
            <div>
                <a href="{{ url()->previous() }}"
                    class="btn btn-primary">{{ __('Back') }}</a>
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
                                        <strong>{{ __('Journal') }}:</strong>
                                        {!! $magazineIssue->journal ? $magazineIssue->journal->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Title') }}:</strong>
                                        {{ $magazineIssue->title }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('IsActive') }}:</strong>
                                        {!! $magazineIssue->isActive == 1
                                            ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                            : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Published Year') }}:</strong>
                                        {{ $magazineIssue->published_year }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('fourth_number') }}:</strong>
                                        {{ $magazineIssue->fourth_number }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Betlar Soni') }}:</strong>
                                        {{ $magazineIssue->betlar_soni }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Created By') }}:</strong>
                                        {!! $magazineIssue->created_by ? $magazineIssue->createdBy->name : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Updated By') }}:</strong>
                                        {!! $magazineIssue->updated_by ? $magazineIssue->updatedBy->name : '' !!}
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group">
                                        <strong>{{ __('Image') }}:</strong>
                                        @if ($magazineIssue->image_path)
                                            <img src="{{ asset('/storage/magazineIssues/photo/' . $magazineIssue->image_path) }}"
                                                width="100px">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <strong>{{ __('Full Text Path') }}:</strong>
                                        @if ($magazineIssue->full_text_path)
                                            <a href="{{ asset('/storage/magazineIssues/full-text/' . $magazineIssue->full_text_path) }}"
                                                target="__blank">{{ __('Download') }}</a>
                                        @endif
                                    </div>

                                    
                                    <div class="form-group">
                                        <strong>{{ __('Price') }}:</strong>
                                        {{ $magazineIssue->price }}
                                    </div>


                                  
                                    <div class="form-group">
                                        <strong>{{ __('Created At') }}:</strong>
                                        {{ $magazineIssue->created_at }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Updated At') }}:</strong>
                                        {{ $magazineIssue->updated_at }}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <livewire:admin.journal.get-articles-by-magazine :magazine_id="$magazineIssue->id"  />
          

    </div>
@endsection
