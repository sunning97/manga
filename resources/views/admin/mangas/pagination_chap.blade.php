@if ($paginator->hasPages())
    <ul class="pagination pagination-split">
        @if ($paginator->onFirstPage())
        @else
            <li> <a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a> </li>
        @endif

        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"> <a href="#" class="text-light">{{ $page }}</a></li>
                    @elseif (($page == $paginator->currentPage() - 1 || $page == $paginator->currentPage() - 2))
                        <li> <a href="{{ $url }}">{{ $page }}</a> </li>
                    @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                        <li> <a href="{{ $url }}">{{ $page }}</a> </li>
                    @elseif ($page == $paginator->lastPage() - 1)
                        <li class="disabled"><span><b>...</b></span></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li> <a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a> </li>
        @else
        @endif
    </ul>
@endif