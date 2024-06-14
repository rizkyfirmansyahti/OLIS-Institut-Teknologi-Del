<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://www.del.ac.id/" class="brand-link">
        <img src="{{ asset('images/logo.png') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">OLIS (IT Del)</span>
    </a>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('backend.dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item has-treeview">
                <a href="#"
                    class="nav-link {{ request()->is('books') || request()->is('compact-disks') || request()->is('articles') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Bahan Pustaka
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('backend.books.index') }}"
                            class="nav-link {{ 'books' == request()->path() ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.compact-disks.index') }}"
                            class="nav-link {{ 'compact-disks' == request()->path() ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>CD/DVD</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.articles.index') }}"
                            class="nav-link {{ 'articles' == request()->path() ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Artikel</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>
                        Peminjaman
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('backend.lendings.index', 'book') }}"
                            class="nav-link {{ 'lendings/book' == request()->path() ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Peminjaman Buku</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.lendings.index', 'cd') }}"
                            class="nav-link {{ 'lendings/cd' == request()->path() ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Peminjaman CD/DVD</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.reports.index') }}"
                            class="nav-link {{ 'reports' == request()->path() ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('backend.users.index') }}"
                    class="nav-link {{ 'users' == request()->path() ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>
                        Anggota
                    </p>
                </a>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-question-circle"></i>
                    <p>
                        Tentang perpus
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('backend.library-archives.index', 'rules') }}"
                            class="nav-link {{ 'library-archives/rules' == request()->path() ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Peraturan Perpustakaan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.library-archives.index', 'guidelines') }}"
                            class="nav-link {{ 'library-archives/guidelines' == request()->path() ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Panduan Pesan Pinjam</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.library-archives.index', 'achievements') }}"
                            class="nav-link {{ 'library-archives/achievements' == request()->path() ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Penghargaan</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('backend.site-links.index') }}"
                    class="nav-link {{ 'site-links' == request()->path() ? 'active' : '' }}">
                    <i class="nav-icon fas fa-link"></i>
                    <p>
                        Link Link Lainnya
                    </p>
                </a>

                {{-- <li class="nav-item">
                <a href="{{ route('backend.log-visitors.index') }}"
                    class="nav-link {{ 'log-visitors' == request()->path() ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Log Pengunjung
                    </p>
                </a>
            </li> --}}
        </ul>
    </nav>
</aside>
