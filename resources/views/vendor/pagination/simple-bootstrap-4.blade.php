@if ($paginator->hasPages())
    <ul class="pagination list-reset block flex items-center" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled border border-primary-light text-primary-light rounded px-2 py-1 mr-2 " aria-disabled="true">
                <span class="page-link">@lang('pagination.previous')</span>
            </li>
        @else
            <li class="page-item border border-primary rounded px-2 py-1 mr-2">
                <a class="page-link text-primary-dark" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
            </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item border border-primary rounded px-2 py-1 mr-2">
                <a class="page-link text-primary-dark" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
            </li>
        @else
            <li class="page-item disabled border border-primary-light text-primary-light rounded px-2 py-1 mr-2" aria-disabled="true">
                <span class="page-link">@lang('pagination.next')</span>
            </li>
        @endif
    </ul>
@endif
