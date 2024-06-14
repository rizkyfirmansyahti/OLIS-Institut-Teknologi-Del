@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <!-- Link ke halaman sebelumnya -->
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                        rel="prev">&laquo;</a></li>
            @endif

            <!-- Link ke halaman pertama -->
            @if ($paginator->currentPage() > 1)
                <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
                @if ($paginator->currentPage() > 3)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endif

            <!-- Link ke halaman 2, 3, dan 4 (tergantung halaman yang aktif) -->
            @foreach (range(max(1, $paginator->currentPage() - 1), min($paginator->lastPage(), $paginator->currentPage() + 1)) as $page)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link"
                            href="{{ $paginator->url($page) }}">{{ $page }}</a></li>
                @endif
            @endforeach

            <!-- Link ke halaman terakhir -->
            @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                <li class="page-item"><a class="page-link"
                        href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
            @endif

            <!-- Link ke halaman berikutnya -->
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        &raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link"> &raquo;</span></li>
            @endif
        </ul>
    </nav>
@endif
