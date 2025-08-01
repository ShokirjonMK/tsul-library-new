@extends('layouts.app')

@section('template_title')
    {{ $book->name ?? __('Show') }}
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Books') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/books') }}">{{ __('Books') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span> {{ $book->title ?? __('Show') }}
            </p>
        </div>
        <div>
            <a class="btn btn-success" href="{{ route('books.edit', [app()->getLocale(), $book->id]) }}"> {{ __('Edit') }}</a> |
            @if ($previous_page)
                <a href="{{ $previous_page }}"  class="btn btn-primary" >{{ __('Back') }}</a>
            @else
                <a href="{{ url(session()->previousUrl()) }}"  class="btn btn-primary" >{{ __('Back') }}</a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="ec-cat-list card card-default">
                <div class="card">
                    <div class="card-body">
                        @include('book.bookdetail', ['book'=>$book])
                        <hr>
                        <livewire:admin.books.add-extra-authors :book_id="$book->id" />
                        <hr>
                        <livewire:admin.books.add-get-book-acts :book_id="$book->id" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
