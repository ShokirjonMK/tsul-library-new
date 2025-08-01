<div class="row">
    <input type="hidden" name="previous_page" value="{{ URL::previous() }}">

    <div class="col-xl-7 col-lg-12">
        <div class="ec-cat-list card card-default">
            <div class="card-body">
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <div class="form-group">
                            {{ Form::label(__('Dc Title')) }}
                            {{ Form::text('dc_title', $book->dc_title, ['class' => 'form-control' . ($errors->has('dc_title') ? ' is-invalid' : ''), 'placeholder' => __('Dc Title')]) }}
                            {!! $errors->first('dc_title', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            {{ Form::label(__('Location index')) }}
                            {{ Form::text('location_index', $book->location_index, ['class' => 'form-control' . ($errors->has('location_index') ? ' is-invalid' : ''), 'placeholder' => __('Location index')]) }}
                            {!! $errors->first('location_index', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            {{ Form::label(__("Author's mark")) }}
                            {{ Form::text('authors_mark', $book->authors_mark, ['class' => 'form-control' . ($errors->has("Author's mark") ? ' is-invalid' : ''), 'placeholder' => __('Dc Title')]) }}
                            {!! $errors->first("authors_mark", '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            {{ Form::label(__('Dc Published City')) }}
                            {{ Form::text('dc_published_city', $book->dc_published_city, ['class' => 'form-control' . ($errors->has('dc_published_city') ? ' is-invalid' : ''), 'placeholder' => __('Dc Published City')]) }}
                            {!! $errors->first('dc_published_city', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc Publisher')) }}
                            {{ Form::text('dc_publisher', $book->dc_publisher, ['class' => 'form-control' . ($errors->has('dc_publisher') ? ' is-invalid' : ''), 'placeholder' => __('Dc Publisher')]) }}
                            {!! $errors->first('dc_publisher', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc Authors')) }}
                            @if ($import != null)
                                {{ Form::text('dc_authors', \App\Models\Author::GetStringNameByJsonName($import->authors), ['class' => 'form-control' . ($errors->has('dc_authors') ? ' is-invalid' : ''), 'data-role' => 'tagsinput']) }}
                            @else
                                {{ Form::text('dc_authors', $book->dc_authors, ['class' => 'form-control' . ($errors->has('dc_authors') ? ' is-invalid' : ''), 'data-role' => 'tagsinput']) }}
                            @endif
                            {!! $errors->first('dc_authors', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc UDK')) }}
                            {{ Form::text('dc_UDK', $book->dc_UDK, ['class' => 'form-control' . ($errors->has('dc_UDK') ? ' is-invalid' : ''), 'placeholder' => __('Dc UDK')]) }}
                            {!! $errors->first('dc_UDK', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc BBK')) }}
                            {{ Form::text('dc_BBK', $book->dc_BBK, ['class' => 'form-control' . ($errors->has('dc_BBK') ? ' is-invalid' : ''), 'placeholder' => __('Dc BBK')]) }}
                            {!! $errors->first('dc_BBK', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group">
                            {{ Form::label(__('ISBN')) }}
                            {{ Form::text('ISBN', $book->ISBN, ['class' => 'form-control' . ($errors->has('ISBN') ? ' is-invalid' : ''), 'placeholder' => __('ISBN')]) }}
                            {!! $errors->first('ISBN', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc Description')) }}
                            {{ Form::textarea('dc_description', $book->dc_description, ['class' => 'form-control' . ($errors->has('dc_description') ? ' is-invalid' : ''), 'placeholder' => __('Dc Description'), 'rows' => '3']) }}
                            {!! $errors->first('dc_description', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc Source')) }}
                            {{ Form::text('dc_source', $book->dc_source, ['class' => 'form-control' . ($errors->has('dc_source') ? ' is-invalid' : ''), 'placeholder' => __('Dc Source')]) }}
                            {!! $errors->first('dc_source', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Dc Date')) }}
                            {{ Form::number('dc_date', $book->dc_date, ['class' => 'form-control' . ($errors->has('dc_date') ? ' is-invalid' : ''), 'placeholder' => __('Dc Date')]) }}
                            {!! $errors->first('dc_date', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Betlar Soni')) }}
                            {{ Form::text('betlar_soni', $book->betlar_soni, ['class' => 'form-control' . ($errors->has('betlar_soni') ? ' is-invalid' : ''), 'placeholder' => __('Betlar Soni')]) }}
                            {!! $errors->first('betlar_soni', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Price')) }}
                            {{ Form::text('price', $book->price, ['class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => __('Price')]) }}
                            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Circulation')) }}
                            {{ Form::number('circulation', $book->circulation, ['class' => 'form-control' . ($errors->has('circulation') ? ' is-invalid' : ''), 'placeholder' => __('Circulation')]) }}
                            {!! $errors->first('circulation', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label(__('Printing plate')) }}
                            {{ Form::text('printing_plate', $book->printing_plate, ['class' => 'form-control' . ($errors->has('printing_plate') ? ' is-invalid' : ''), 'placeholder' => __('Printing plate')]) }}
                            {!! $errors->first('printing_plate', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-5 col-lg-12">
        <div class="ec-cat-list card card-default mb-24px">
            <div class="card-body">
                <div class="ec-cat-form">
                    @php
                        $status = 1;
                        if ($book->count() > 0 && isset($book->status)) {
                            $status = $book->status;
                        }
                    @endphp

                    <div class="form-group">

                        <label for="status" class="form-label">{{ __('IsActive') }}</label>
                        <select class="form-select" id="status" name="status">
                            <option value='0' {{ $status ? '' : 'selected' }}>{{ __('Passive') }}</option>
                            <option value='1' {{ $status ? 'selected' : '' }}>{{ __('Active') }}</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label(__('Dc Subjects', ['class' => 'form-label', 'for' => 'dc_subjects'])) }}
                        {!! Form::select('dc_subjects', $bookSubjects, $book->dc_subjects, [
                            'placeholder' => __('Please select'),
                            'class' => 'js-example-basic-single form-select ' . ($errors->has('dc_subjects') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('dc_subjects', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label(__('Books Type', ['class' => 'form-label', 'for' => 'books_type_id'])) }}
                        {!! Form::select('books_type_id', $bookTypes, $book->books_type_id, [
                            'class' => 'js-example-basic-single form-select ' . ($errors->has('books_type_id') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('books_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Language')) }}
                        {!! Form::select('book_language_id', $bookLanguages, $book->book_language_id, [
                            'class' => 'js-example-basic-single form-select ' . ($errors->has('book_language_id') ? ' is-invalid' : ''),
                        ]) !!}

                        {!! $errors->first('book_language_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Text')) }}
                        {!! Form::select('book_text_id', $bookTexts, $book->book_text_id, [
                            'class' => 'js-example-basic-single form-select ' . ($errors->has('book_text_id') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('book_text_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Text Type')) }}
                        {!! Form::select('book_text_type_id', $bookTextTypes, $book->book_text_type_id, [
                            'class' => 'js-example-basic-single form-select ' . ($errors->has('book_text_type_id') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('book_text_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book Access Type')) }}
                        {!! Form::select('book_access_type_id', $bookAccessTypes, $book->book_access_type_id, [
                            'class' => 'js-example-basic-single form-select ' . ($errors->has('book_access_type_id') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('book_access_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label(__('Book File Type')) }}
                        {!! Form::select('book_file_type_id', $bookFileTypes, $book->book_file_type_id, [
                            'class' => 'js-example-basic-single form-select ' . ($errors->has('book_file_type_id') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('book_file_type_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="form-group">
                        <label for="subject_id">{{ __('Subjects') }}</label>
                        {!! Form::select('subject_id', $subjects, $book->subject_id, [
                            'placeholder' => __('Please select'),
                            'class' => 'js-example-basic-single form-select ' . ($errors->has('subject_id') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('subject_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        <label for="who_id">{{ __('Who') }}</label>
                        {!! Form::select('who_id', $whos, $book->who_id, [
                            'class' => 'js-example-basic-single form-select ' . ($errors->has('who_id') ? ' is-invalid' : ''),
                        ]) !!}
                        {!! $errors->first('who_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>


                    <div class="form-group">
                        {{ Form::label(__('Book face image')) }}
                        <input type="file" name="file" class='form-control' accept="image/*" />
                        @if ($book->image_path)
                            <img src="{{ asset('/storage/' . $book->image_path) }}" width="100px">
                        @endif
                        {!! $errors->first('file', '<div class="invalid-feedback">:message</div>') !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label(__('Book file')) }}

                        @if ($book != null && $book->full_text_path && $book->id)
                            <input type="file" name="full_text" class='form-control'
                                value="{{ $book->full_text_path }}" />
                            <a href="/storage/{{ $book->full_text_path }}" target="__blank">{{ __('Download') }}</a>

                            <livewire:admin.books.deletefiles :book='$book' />

                        @else
                            <input type="file" name="full_text" class='form-control' />
                        @endif
                        {!! $errors->first('full_text_path', '<div class="invalid-feedback">:message</div>') !!}
                    </div>


                    <div class="row">
                        <div class="col-12 box-footer mt20">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(".bootstrap-tagsinput").addClass('form-control');

            $('#author-dropdown').select2({
                tags: true,
            });

            $('#subject-dropdown').select2({
                tags: true,
            });

        });
    </script>
@endpush
