@extends('layouts.app')

@section('template_title')
        {{ __('Create') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Books') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/books') }}">{{ __('Books') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Create') }}
            </p>
        </div>
        <div>

            <a href="{{ url()->previous() }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div> 
    {{-- <livewire:admin.books.create :import_book='$import' /> --}}
    <form method="POST" action="{{ route('books.store', app()->getLocale()) }}"  role="form" enctype="multipart/form-data">
        @csrf
        @if ($import != null)
            <input type="hidden" value="{{$import->id}}" name="import_id">            
        @endif
        
        @include('book.form')
    
    </form> 

</div>            
@endsection
