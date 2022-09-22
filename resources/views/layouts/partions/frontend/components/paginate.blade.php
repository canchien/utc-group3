@if ($paginator->hasPages())
<nav aria-label="Page navigation example" class="pagination_area">
<ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        @else
            <li class="page-item next">
                <a class="page-link" rel="prev" href="{{ $paginator->previousPageUrl() }}" aria-label="@lang('pagination.previous')"><i class="fa fa-angle-left"
                                            aria-hidden="true"></i>
                </a>
            </li>
            
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true">
                    <div class="spinner">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())

        <li class="page-item next"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right"
                aria-label="@lang('pagination.next')"></i></a></li>
        
        @endif
</ul>    
    </nav>
@endif
