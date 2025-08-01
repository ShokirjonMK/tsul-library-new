<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div class="col-12">
            <div class="ec-vendor-list card card-default">
                <div class="card-header">
                    <div class="container">

                        <div class="row">
                            <h4>{{__('Bibliographic records entered  by user')}}</h4>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>{{ __('From') }}</label>
                                <input type="date" class="form-control" wire:model="fromDate">
                            </div>

                            <div class="col-md-4">
                                <label>{{ __('To') }}</label>
                                <input type="date" class="form-control" wire:model="toDate">
                            </div>

                            <div class="col-md-4 d-flex align-items-end">
                                <button class="btn btn-primary" wire:click="$refresh">{{ __('Search') }}</button>
                                <button class="btn btn-secondary ml-2"
                                        wire:click="resetFilters">{{ __('Clear') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                            <tr>
                                <th>No</th>
                                <th>{{ __('IsActive') }}</th>
                                <th>{{ __('ISBN') }}</th>
                                <th>{{ __('Dc Title') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Dc Authors') }}</th>
                                <th>{{ __('Books Type') }}</th>
                                <th>{{ __('Book Language') }}</th>

                                <th>{{ __('Copies') }}</th>
                                <th>{{ __('Book face image') }}</th>
                                <th>{{ __('Book file') }}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{!! $book->status == 1
                                                ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>'
                                                : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}</td>
                                    <td>{{ $book->ISBN }}</td>
                                    <td>{{ $book->dc_title }}</td>
                                    <td>{{ $book->created_at }}</td>
                                    <td>
                                        @php
                                            if ($book->dc_authors) {
                                                foreach (json_decode($book->dc_authors) as $key => $value) {
                                                    echo $key + 1 . ') ' . $value . '<br>';
                                                }
                                            }
                                        @endphp
                                    </td>
                                    <td>{!! $book->BooksType ? $book->BooksType->title : '' !!}</td>
                                    <td>{!! $book->BookLanguage ? $book->BookLanguage->title : '' !!}</td>
                                    <td>{!! $book->bookInventar ? $book->bookInventar->count() : '' !!}</td>


                                    <td>

                                        @if ($book->image_path)
                                            <img src="/storage/{{ $book->image_path }}" width="100px">
                                        @endif
                                    </td>
                                    <td>
                                        @if ($book->full_text_path)
                                            <a href="/storage/{{ $book->full_text_path }}"
                                               target="__blank">{{ __('Download') }}</a>
                                        @endif
                                    </td>

                                    <td>

                                        <a class="btn btn-sm btn-primary "
                                           href="{{ route('books.show', [app()->getLocale(), $book->id]) }}">
                                            {{ __('Show') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($books->count() > 0)
                        {!! $books->appends(Request::all())->links('vendor.pagination.default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
