@extends('layouts.app')

@section('template_title')
    {{ __('Order books') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper d-flex align-items-center justify-content-between">
            <div>
                <h1>{{ __('Order books') }}</h1>
                <p class="breadcrumbs"><span><a
                            href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span>{{ __('Order books') }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">

                    <div class="card-header">
                        <div class="accordion" id="accordionExample" style="width: 100%;">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        {{ __('Advanced search') }}
                                    </button>
                                </h2>
                                <div id="collapseOne"
                                    class="accordion-collapse collapse  @if ($show_accardion) show @endif"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="{{ route('admin.readerbook', app()->getLocale()) }}" method="GET"
                                            accept-charset="UTF-8" role="search">
                                            <div class="row">

                                                <div class="col-md-3">
                                                    @if ($bookTypes->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_types', __('Books Type')) !!} :
                                                            {!! Form::select('book_type_id', $bookTypes, $book_bookType_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    @if ($bookLanguages->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_languages', __('Book Language')) !!} :
                                                            {!! Form::select('book_language_id', $bookLanguages, $book_bookLanguage_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    @if ($bookTexts->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_texts', __('Book Text')) !!} :
                                                            {!! Form::select('book_text_id', $bookTexts, $book_bookText_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-3">
                                                    @if ($bookTextTypes->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_text_type_id', __('Book Text Type')) !!} :
                                                            {!! Form::select('book_text_type_id', $bookTextTypes, $book_bookTextType_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    @if ($bookFileTypes->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_file_type_id', __('Book File Type')) !!} :
                                                            {!! Form::select('book_file_type_id', $bookFileTypes, $book_file_type_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    @if ($bookSubjects->count() > 0)
                                                        <div class="form-group">
                                                            {!! Form::label('book_subject_id', __('Dc Subjects')) !!} :
                                                            {!! Form::select('book_subject_id', $bookSubjects, $book_subject_id, ['class' => 'border  p-2 bg-white', 'placeholder' => __('Choose')]) !!}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" name="keyword"
                                                        placeholder="{{ __('Keyword') }}..." value="{{ $keyword }}">
                                                </div>

                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Search') }}</button>

                                                <a href="{{ route('admin.readerbook', app()->getLocale()) }}" class="btn btn-sm btn-info  float-right">{{ __('Clear') }}</a>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <br>
                                {!! __('Number of bibliographic records is :attribute', ['attribute' => $books->total()]) !!}
                                {{-- , | {!!__("Number of books is :attribute",['attribute' => $books->total() ])!!} --}}
                            </div>
                        </div>
                    </div>

                     
                    <div class="card-body">
                        <div class="row">
                            @if ($books != null && $books->count() > 0)
                                @foreach ($books as $book)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="card-wrapper">
                                            <div class="card-container">
                                                <div class="card-top">
                                                    <a href="{{ route('admin.readershowbook', [app()->getLocale(), $book->id]) }}">
                                                    @if ($book->image_path)
                                                        <img src="/storage/{{ $book->image_path }}" class="card-image">
                                                    @else
                                                        <img src="/book_no_photo.jpg" class="card-image">
                                                    @endif
                                                </a>
                                                </div>
                                                <div class="card-bottom">
                                                    <h3><a href="{{ route('admin.readershowbook', [app()->getLocale(), $book->id]) }}">{{ $book->dc_title }}</a></h3>
                                                    <p> @php
                                                        if ($book->dc_authors) {
                                                            foreach (json_decode($book->dc_authors) as $key => $value) {
                                                                echo $value;
                                                            }
                                                        }
                                                    @endphp</p>
                                                </div>
                                                <div class="card-action">
                                                    <div class="card-preview">
                                                        <a href="{{ route('admin.readershowbook', [app()->getLocale(), $book->id]) }}"><i class="mdi mdi-eye-outline"></i></a>
                                                    </div>
                                                    <div class="card-remove">
                                                        <a href="{{ route('addtocart', [app()->getLocale(), $book->id, 'type'=>'book']) }}">
                                                            <i class="mdi mdi-cart"></i>
                                                        </a>    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <div class="row">
                            @if ($books->count() > 0)
                                {!! $books->appends(Request::all())->links('vendor.pagination.default') !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
