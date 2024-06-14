<div class="header-navigation">
    <a class="text-white" href="/">Beranda</a>

    <!-- Menu "Tentang Perpus" dengan dropdown -->
    <div class="dropdown">
        <a class="dropdown-toggle text-white" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Tentang Perpus
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" style="color: #333" href="{{ route('library-archives.rules') }}">Peraturan
                Perpustakaan</a>
            <a class="dropdown-item" href="{{ route('library-archives.guidelines') }}">Panduan Pesan Pinjam</a>
            <a class="dropdown-item" href="{{ route('library-archives.achievements') }}">Penghargaan Perpustakaan</a>
        </div>
    </div>

    <div class="dropdown">
        <a class="dropdown-toggle text-white" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Bahan Pustaka
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('books.index') }}">Buku</a>
            <a class="dropdown-item" href="{{ route('compact-disks.index') }}">CD/DVD</a>
            <a class="dropdown-item" href="{{ route('articles.index') }}">Artikel</a>
        </div>
    </div>

    <div class="dropdown">
        <a class="dropdown-toggle text-white" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Pemberitahuan
        </a>
        <div class="dropdown-menu">
            <a href="{{ route('notifications.books') }}" class="dropdown-item"
                href="{{ route('notifications.books') }}">Buku Baru</a>
            <a class="dropdown-item" href="{{ route('notifications.compact-disks') }}">CD/DVD Baru</a>
            <a class="dropdown-item" href="{{ route('notifications.articles') }}">Artikel Baru</a>
        </div>
    </div>

    <a class="text-white" href="{{ route('site-links.index') }}">Link-Link
        Lainnya
    </a>
</div>
