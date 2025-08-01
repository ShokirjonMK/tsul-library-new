@if ($paginator->hasPages())

    <div class="row justify-content-between bottom-information">
        <div class="dataTables_info" id="responsive-data-table_info" role="status" aria-live="polite">
            @if (App::currentLocale() == 'uz')
               <b>Jami:</b> {{ $paginator->total() }} ta yozuv, {{ $paginator->currentPage() }}-sahifada
                {{ $paginator->perPage() }}
                ta yozuv koʻrsatilmoqda
            @else
                Showing {{ $paginator->perPage() }} to {{ $paginator->currentPage() }} of
                {{ $paginator->total() }}
                entries
        </div>
            @endif

        <div class="dataTables_paginate paging_simple_numbers" id="responsive-data-table_paginate">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="paginate_button page-item previous disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"
                        id="responsive-data-table_previous">
                        <a href="#" aria-controls="responsive-data-table" data-dt-idx="0" tabindex="0"
                            class="page-link">&lsaquo;</a>
                    </li>
                @else
                    <li class="paginate_button page-item previous ">

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
                                <li class="paginate_button page-item active" aria-current="page">
                                    <a href="#" aria-controls="responsive-data-table" data-dt-idx="1" tabindex="0"
                                        class="page-link">{{ $page }}</a>
                                </li>
                            @else
                                <li class="paginate_button page-item ">
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
                    <li>
                        {{-- <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                                    aria-label="@lang('pagination.next')">&rsaquo;</a> --}}
                        <a href="{{ $paginator->nextPageUrl() }}" aria-controls="responsive-data-table"
                            data-dt-idx="@lang('pagination.next')" tabindex="0" class="page-link">&rsaquo;</a>

                    </li>
                @else
                    <li class="paginate_button page-item next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        {{-- <span aria-hidden="true"></span> --}}
                        <a href="#" aria-controls="responsive-data-table" data-dt-idx="6" tabindex="0"
                            class="page-link">&rsaquo;</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
<div class="clear"></div>
@endif
