@extends('layouts.app')

@section('template_title')
    {{ __('Update') }}
@endsection

@section('content')
<div class="content">

    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1>{{ __('Books') }}</h1>
            <p class="breadcrumbs">
                <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i><a href="{{ url(app()->getLocale() . '/admin/books') }}">{{ __('Books') }}</a></span>
                <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Update') }}
            </p>
        </div>
        <div>
            <a class="btn btn-warning " href="{{ route('books.show', [app()->getLocale(), $book->id]) }}"> {{ __('Show') }}</a> |

            <a href="{{ url()->previous() }}"  class="btn btn-primary" >{{ __('Back') }}</a>
        </div>
    </div>
    {{-- <livewire:admin.books.update :book_id="$book->id" /> --}}
    @includeif('partials.errors')
    <form method="POST" action="{{ route('books.update', [app()->getLocale(), $book->id]) }}"  role="form" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @csrf
         @include('book.form')

    </form>  

</div>

@endsection
