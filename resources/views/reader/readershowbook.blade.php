@extends('layouts.app')

@section('template_title')
    {{ $book->name ?? __('Show') }}
@endsection

@section('content')
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <div>
                <h1>{{ __('Order books') }}</h1>
                <p class="breadcrumbs">
                    <span><a href="{{ route('admin.home', app()->getLocale()) }}">{{ __('Home') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i><a
                            href="{{ url(app()->getLocale() . '/admin/breader') }}">{{ __('Order books') }}</a></span>
                    <span><i class="mdi mdi-chevron-right"></i></span> {{ $book->title ?? __('Show') }}
                </p>
            </div>
            <div>

                <a href="{{ url(app()->getLocale() . '/admin/breader') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="ec-cat-list card card-default">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <strong>{{ __('Dc Title') }}:</strong>
                                        {{ $book->dc_title }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __("Author's mark") }}:</strong>
                                        {{ $book->authors_mark }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Dc Subjects') }}:</strong>
                                        @php
                                            if ($book->dc_subjects != "null" && $book->dc_subjects != null){

                                                foreach (json_decode($book->dc_subjects) as $key => $value) {
                                                    echo $key + 1 . ') ' . $value . ', ';
                                                }
                                            }
                                        @endphp
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Dc Authors') }}:</strong>
                                        @php
                                            if ($book->dc_authors) {
                                                foreach (json_decode($book->dc_authors) as $key => $value) {
                                                    echo $key + 1 . ') ' . $value . ', ';
                                                }
                                            }
                                        @endphp
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Dc UDK') }}:</strong>
                                        {{ $book->dc_UDK }}
                                    </div>


                                    <div class="form-group">
                                        <strong>{{ __('Dc Publisher') }}:</strong>
                                        {{ $book->dc_publisher }}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{ __('Dc Published City') }}:</strong>
                                        {{ $book->dc_published_city }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('ISBN') }}:</strong>
                                        {{ $book->ISBN }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Dc Description') }}:</strong>
                                        {{ $book->dc_description }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Dc Date') }}:</strong>
                                        {{ $book->dc_date }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Betlar Soni') }}:</strong>
                                        {{ $book->betlar_soni }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Price') }}:</strong>
                                        {{ $book->price }}
                                    </div>

                                    <div class="form-group">
                                        <strong>{{ __('Published Year') }}:</strong>
                                        {{ $book->published_year }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{ __('Book face image') }}:</strong>
                                        @if ($book->image_path)
                                            <img src="/storage/{{ $book->image_path }}" width="100px">
                                        @else
                                            <img src="/book_no_photo.jpg" width="100px">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Book file') }}:</strong>
                                        @if ($book->full_text_path)
                                            @if ($book->file_format=='pdf')
                                                <a href="{{ url(app()->getLocale() . '/books/' . $book->id) }}/pdf"
                                                   target="__blank">{{ __('Download') }}</a>
                                            @else
                                                <a href="/storage/{{ $book->full_text_path }}"
                                                   target="__blank">{{ __('Download') }}</a>
                                            @endif
                                            {{--
                                                                                        <a href="/storage/{{ $book->full_text_path }}"
                                                                                            target="__blank">{{ __('Download') }}</a> --}}
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Dc Source') }}:</strong>
                                        @if ($book->dc_source)
                                            <a href="{{ $book->dc_source }}" target="__blank">{{ __('Download') }}</a>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('File Format') }}:</strong>
                                        {{ $book->file_format }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('File Format Type') }}:</strong>
                                        {{ $book->file_format_type }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('File Size') }}:</strong>
                                        {{ $book->file_size }}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Books Type') }}:</strong>

                                        {!! $book->books_type_id ? $book->booksType->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Book Language') }}:</strong>
                                        {!! $book->book_language_id ? $book->bookLanguage->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Book Text') }}:</strong>
                                        {!! $book->book_text_id ? $book->bookText->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Book Text Type') }}:</strong>
                                        {!! $book->book_text_type_id ? $book->bookTextType->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Book Access Type') }}:</strong>
                                        {!! $book->book_access_type_id ? $book->bookAccessType->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Book File Type') }}:</strong>
                                        {!! $book->book_file_type_id ? $book->bookFileType->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Subjects') }}:</strong>
                                        {!! $book->subject_id ? $book->subject->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Who') }}:</strong>
                                        {!! $book->who_id ? $book->whos->title : '' !!}
                                    </div>
                                    <div class="form-group">
                                        <strong>{{ __('Where') }}:</strong>
                                        {!! $book->where_id ? $book->wheres->title : '' !!}
                                    </div>

                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-lg-12">

                                @if ($book_informations->count() > 0)
                                    <div class="table-responsive">

                                        <table class="table table-striped table-hover">
                                            <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>{{ __('IsActive') }}</th>
                                                <th>{{ __('Organization') }}</th>
                                                <th>{{ __('Branches') }}</th>
                                                <th>{{ __('Departments') }}</th>

                                                <th>{{ __('Arrived Year') }}</th>
                                                <th>{{ __('Copy count') }}</th>
                                                <th>{{ __('Number of copies of books available') }}</th>

                                                <th>{{ __('Is it in the library?') }}</th>
                                                <th>{{ __('Is it in electronic format?') }}</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $total = 0;
                                                $available = 0;
                                            @endphp
                                            @foreach ($book_informations as $k => $item)
                                                <tr>
                                                    <td>
                                                        {{ $k + 1 }}
                                                    </td>
                                                    <td>

                                                        {!! $item->isActive == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}

                                                    </td>
                                                    <td>{!! $item->organization ? $item->organization->title : '' !!}</td>
                                                    <td>{!! $item->branch ? $item->branch->title : '' !!}</td>
                                                    <td>{!! $item->department ? $item->department->title : '' !!}</td>

                                                    <td>{{ $item->arrived_year }}</td>
                                                    @php
                                                        $total += $item->bookInventar->count();
                                                        $available +=  \App\Models\BookInventar::GetAvailablesByBookId($item->book_id);
                                                    @endphp
                                                    <td>{{ $item->bookInventar->count() }}</td>
                                                    <td>{{ \App\Models\BookInventar::GetAvailablesByBookId($item->book_id) }}</td>

                                                    <td>{!! $item->kutubxonada_bor == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                                    <td>{!! $item->elektronni_bor == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                                    <td>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="6">{{ __('Total') }}:</td>
                                                <td>
                                                    {{ $total }}
                                                </td>
                                                <td>{{$available}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    @if($available>0)
                                                        <p class="btn-holder"><a
                                                                href="{{ route('addtocart', [app()->getLocale(), $book->id, 'type'=>'book']) }}"
                                                                class="btn btn-success btn-block text-center"
                                                                role="button">{{ __('Add to cart') }}</a></p>
                                                    @endif

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                @else
                                    {{-- <h1>nusxalar yo'q</h1> --}}
                                @endif
                                <hr>
                            </div>
                            <hr>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
