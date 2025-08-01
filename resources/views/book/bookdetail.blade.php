<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <strong>{{ __('IsActive') }}:</strong>
            {!! $book->status == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
        </div>
        <div class="form-group">
            <strong>{{ __('Dc Title') }}:</strong>
            {{ $book->dc_title }}
        </div>
        <div class="form-group">
            <strong>{{ __('Location index') }}:</strong>
            {{ $book->location_index }}
        </div>
        <div class="form-group">
            <strong>{{ __("Author's mark") }}:</strong>
            {{ $book->authors_mark }}
        </div>
        <div class="form-group">
            <strong>{{ __('Dc Subjects') }}:</strong>
            @php

                if($book->dc_subjects!=null && $book->dc_subjects!="null"){
                    foreach (json_decode($book->dc_subjects) as $key => $value) {
                        echo ($key+1).') '.$value.', ';
                    }
                }
            @endphp
        </div>
        <div class="form-group">
            <strong>{{ __('Dc Authors') }}:</strong>
            @php
                if($book->dc_authors){
                    foreach (json_decode($book->dc_authors) as $key => $value) {
                        echo ($key+1).') '.$value.', ';
                    }
                }
            @endphp
        </div>
        <div class="form-group">
            <strong>{{ __('Dc UDK') }}:</strong>
            {{ $book->dc_UDK }}
        </div>
       
        <div class="form-group">
            <strong>{{ __('Dc BBK') }}:</strong>
            {{ $book->dc_BBK }}
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
            <strong>{{__('Betlar Soni')}}:</strong>
            {{ $book->betlar_soni }}
        </div>
        <div class="form-group">
            <strong>{{__('Price')}}:</strong>
            {{ $book->price }}
        </div>

        <div class="form-group">
            <strong>{{__('Published Year')}}:</strong>
            {{ $book->published_year }}
        </div>
        <div class="form-group">
            <strong>{{ __('Created At') }}:</strong>
            {{ $book->created_at  }}
        </div>
        <div class="form-group">
            <strong>{{ __('Updated At') }}:</strong>
            {{ $book->updated_at  }}
        </div>

    </div>
    <div class="col-md-6">

        <div class="form-group">
            <strong>{{ __('Book face image') }}:</strong>
            @if ($book->image_path)
                <img src="/storage/{{ $book->image_path}}" width="100px">
            @endif
        </div>
        <div class="form-group">
            <strong>{{__('Book file')}}:</strong> 
            @if ($book->full_text_path)
                <a href="/storage/{{$book->full_text_path}}" target="__blank">{{__('Download')}}</a>
            @endif
        </div>
        <div class="form-group">
            <strong>{{__('Dc Source')}}:</strong> 
            @if ($book->dc_source)
            <a href="{{$book->dc_source}}" target="__blank">{{__('Download')}}</a>
            @endif
        </div>
        <div class="form-group">
            <strong>{{__('File Format')}}:</strong>
            {{ $book->file_format }}
        </div>
        <div class="form-group">
            <strong>{{__('File Format Type')}}:</strong>
            {{ $book->file_format_type }}
        </div>
        <div class="form-group">
            <strong>{{__('File Size')}}:</strong>
            {{ $book->file_size }}
        </div>
        <div class="form-group">
            <strong>{{__('Books Type')}}:</strong>
            
            {!! $book->books_type_id ? $book->booksType->title : '' !!}
        </div>
        <div class="form-group">
            <strong>{{__('Book Language')}}:</strong>
            {!! $book->book_language_id ? $book->bookLanguage->title : '' !!}
        </div>
        <div class="form-group">
            <strong>{{__('Book Text')}}:</strong>
            {!! $book->book_text_id ? $book->bookText->title : '' !!}
        </div>
        <div class="form-group">
            <strong>{{__('Book Text Type')}}:</strong>
            {!! $book->book_text_type_id ? $book->bookTextType->title : '' !!}
        </div>
        <div class="form-group">
            <strong>{{__('Book Access Type')}}:</strong>
            {!! $book->book_access_type_id ? $book->bookAccessType->title : '' !!}
        </div>
        <div class="form-group">
            <strong>{{__('Book File Type')}}:</strong>
            {!! $book->book_file_type_id ? $book->bookFileType->title : '' !!}
        </div>
        <div class="form-group">
            <strong>{{__('Subjects')}}:</strong>
            {!! $book->subject_id ? $book->subject->title : '' !!}
        </div>
        <div class="form-group">
            <strong>{{__('Who')}}:</strong>
            {!! $book->who_id ? $book->whos->title : '' !!}
        </div>
        <div class="form-group">
            <strong>{{__('Where')}}:</strong>
            {!! $book->where_id ? $book->wheres->title : '' !!}
        </div>
        
        <div class="form-group">
            <strong>{{__('Circulation')}}:</strong>
            {{ $book->circulation }}
        </div>
        <div class="form-group">
            <strong>{{__('Printing plate')}}:</strong>
            {{ $book->printing_plate }}
        </div>

        <div class="form-group">
            <strong>{{ __('Created By') }}:</strong>
            {!! $book->created_by ? $book->createdBy->name : '' !!}
        </div>
        <div class="form-group">
            <strong>{{ __('Updated By') }}:</strong>
            {!! $book->updated_by ? $book->updatedBy->name : '' !!}
        </div>
    </div>
</div>