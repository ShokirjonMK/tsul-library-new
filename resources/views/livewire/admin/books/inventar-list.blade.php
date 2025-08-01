<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="float-right">
                    <form method="get">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="{{ __('Keyword') }}..."
                                   wire:model="search" class="form-control">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-primary">{{ __('Search') }}</button>
                            </span>
                        </div>
                    </form>
                    <div wire:loading>{{ __('Searching') }}...</div>
                    <div wire:loading.remove></div>
                    <span id="card_title">
                    </span>
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
                        <th>{{ __('Bibliographic record') }}</th>
                        <th>{{ __('Copies') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>

                            <td>

                                {!! $book->status == 1 ? '<span class="badge badge-success"><i class="mdi mdi-check-circle"></i></span>' : '<span class="badge badge-danger"><i class="mdi mdi-close-circle "></i></span>' !!}
                            </td>
                            <td>
                                {!! \App\Models\Book::GetBibliographicById($book->id) !!}
                            </td>
                            <td>{!! $book->bookInventar ? $book->bookInventar->count() : '' !!}</td>
                            <td>
                                <a class="btn btn-sm btn-success"
                                   href="{{ route('books.rfidgive', [app()->getLocale(), $rfid_tag, $book->id]) }}">
                                    {{ __('Give RFID') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($books->count() > 0)
                {!! $books->appends(Request::all())->links() !!}
            @endif
        </div>

    </div>
</div>
