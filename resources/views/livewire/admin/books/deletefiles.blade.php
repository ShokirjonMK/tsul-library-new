<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <br>
    {{-- <form action="{{ route('books.destroy', [app()->getLocale(), $book->id]) }}" method="POST"> --}}
        @php
            $current_user = Auth::user()->profile;
        @endphp
        @if ($current_user != null && ($current_user->organization_id == $book->organization_id || $current_user->branch_id == $book->branch_id))
            <a href="javascript:void(0)" class="btn btn-danger btn-sm" wire:click="destroy({{ $book->id }})">{{ __('Delete') }}</a>

        @endif
    {{-- </form> --}}
    @if (Auth::user()->hasRole('SuperAdmin'))
        <br>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-flat " wire:click="destroyFromServer({{ $book->id }})">{{ __('Delete from DataBase') }}</a>

     @endif

</div>
