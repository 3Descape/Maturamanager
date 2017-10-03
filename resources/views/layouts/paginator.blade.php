<ul class="pagination justify-content-center mt-4">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <div class="page-link">
                <span aria-hidden="true">&laquo;</span>
            </div>
        </li>
    @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">&laquo;</a>
        </li>
    @endif

    <!-- Pagination Elements -->
    @foreach ($elements as $element)
        <!-- Array Of Links -->
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active">
                        <a href="" class="page-link">{{ $page }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach

    <!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link">&raquo;</a>
        </li>
    @else
        <li class="page-item disabled">
            <div class="page-link">
                <span>&raquo;</span>
            </div>
        </li>
    @endif
</ul>
