@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
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

                     @if($page == 1 || $page == 2)
                        @if($page == $paginator->currentPage())
                            @if($page==2)
                                <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                                <li><a href="{{ $paginator->nextPageUrl() }}">{{ $page+1 }}</a></li>
                            @else
                                <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                            @endif
                            
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @elseif($page == $paginator->lastPage() || $page == $paginator->lastPage() - 1)
                        
                        @if($page == $paginator->currentPage())
                            @if($page == $paginator->lastPage() - 1)
                                <li><a href="{{ $paginator->previousPageUrl() }}">{{ $page-1 }}</a></li>
                                <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                            @else
                                <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                            @endif
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @elseif($page == $paginator->currentPage())
                        @if($page > 4 && $page < $paginator->lastPage() - 3)
                            <li class="disabled" aria-disabled="true"><span>...</span></li>
                            <li><a href="{{ $paginator->previousPageUrl() }}">{{ $page-1 }}</a></li>
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                            <li><a href="{{ $paginator->nextPageUrl() }}">{{ $page+1 }}</a></li>
                            <li class="disabled" aria-disabled="true"><span>...</span></li>
                        @elseì($page <= 4)
                            <li><a href="{{ $paginator->previousPageUrl() }}">{{ $page-1 }}</a></li>
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                            <li><a href="{{ $paginator->nextPageUrl() }}">{{ $page+1 }}</a></li>
                        @endif
                    @endif

                    <!-- @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                    @else

                        

                        @if($page < $paginator->currentPage() && $page > $paginator->currentPage() - 2 && $page > 2)
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                            
                        @if($page > $paginator->currentPage() && $page < $paginator->currentPage() +2 && $page < $paginator->lastPage() - 1)
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif

                        @if($page == $paginator->lastPage() || $page == $paginator->lastPage() - 1)
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif

                    @endif -->
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
