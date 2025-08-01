@if ($paginator->hasPages())
@if (App::currentLocale() == 'uz')
                {{ $paginator->total() }} ta yozuvdan {{ $paginator->perPage() }} tadan
                {{ $paginator->currentPage() }} - sahifasi koʻrsatilmoqda
            @else
                Showing {{ $paginator->perPage() }} to {{ $paginator->currentPage() }} of
                {{ $paginator->total() }}
                entries

            @endif
<nav aria-label="Page navigation example">
    <ul
        class="pagination pagination__custom justify-content-md-center flex-nowrap flex-md-wrap overflow-auto overflow-md-visble">


        @if ($paginator->onFirstPage())
            <li class="flex-shrink-0 flex-md-shrink-1 page-item page-item previous disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"
                id="responsive-data-table_previous">
                <a href="#" aria-controls="responsive-data-table" data-dt-idx="0" tabindex="0"
                    class="page-link">&lsaquo;</a>
            </li>
        @else
            <li class="flex-shrink-0 flex-md-shrink-1 page-item page-item previous ">

                <a href="{{ $paginator->previousPageUrl() }}" data-dt-idx="0" tabindex="0" class="page-link"
                    aria-controls="responsive-data-table" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>

            </li>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)

                {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)

                    @if ($page == $paginator->currentPage())
                        <li class="flex-shrink-0 flex-md-shrink-1 page-item page-item active" aria-current="page">
                            <a href="#" aria-controls="responsive-data-table" data-dt-idx="1" tabindex="0"
                                class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="flex-shrink-0 flex-md-shrink-1 page-item page-item ">
                            <a href="{{ $url }}" aria-controls="responsive-data-table"
                                data-dt-idx="{{ $page }}" tabindex="0"
                                class="page-link">{{ $page }}</a>


                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="flex-shrink-0 flex-md-shrink-1 page-item">
                {{-- <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                        aria-label="@lang('pagination.next')">&rsaquo;</a> --}}
                <a href="{{ $paginator->nextPageUrl() }}" aria-controls="responsive-data-table"
                    data-dt-idx="@lang('pagination.next')" tabindex="0" class="page-link">&rsaquo;</a>

            </li>
        @else
            <li class="flex-shrink-0 flex-md-shrink-1 page-item page-item next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                {{-- <span aria-hidden="true"></span> --}}
                <a href="#" aria-controls="responsive-data-table" data-dt-idx="6" tabindex="0"
                    class="page-link">&rsaquo;</a>
            </li>
        @endif

    </ul>
</nav>
@endif
