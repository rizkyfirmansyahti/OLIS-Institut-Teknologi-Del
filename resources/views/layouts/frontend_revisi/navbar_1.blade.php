@auth
    {{-- ATAS --}}
    <div class="header-info-bar">
        <div class="container clearfix">
            <!-- Website Logo -->
            <div class="logo-header logo-dark">
                <a href="https://www.del.ac.id/" class="d-flex"><img src="{{ asset('frontend_revisi/images/olis.png') }}"
                        alt="logo">
                    <h5>INSTITUT TEKNOLOGI DEL</h5>
                </a>
            </div>
            <!-- EXTRA NAV -->
            <div class="extra-nav">
                <div class="extra-cell">
                    <ul class="navbar-nav header-right">
                        <li class="nav-item">
                            <button type="button" class="nav-link box cart-btn">
                                <i class="fa-solid fa-bell text-dark"></i>
                                <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                            </button>
                            <ul class="dropdown-menu cart-list">
                                <li class="cart-item">
                                    <h6>Pemberitahuan</h6>
                                </li>
                                @foreach ($announcements as $announcement)
                                    <li class="cart-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <h6 class="dz-title">
                                                    <a href="{{ route('announcements.show', $announcement->slug) }}"
                                                        class="media-heading">{{ $announcement->title }}
                                                    </a>
                                                </h6>
                                                <span class="dz-price"
                                                    style="display: flex; justify-content: end; align-items: flex-end">{{ $announcement->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                <li class="cart-item">
                                    <div class="media">
                                        <a
                                            class="btn btn-primary w-100 btnhover btn-sm"href="{{ route('announcements.index') }}">Lihat
                                            Semuanya</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown profile-dropdown  ms-4">
                            <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ asset('frontend_revisi/images/profile3.jpg') }}" alt="/">
                                <div class="profile-info">
                                    <h6 class="title">{{ auth()->user()->name }}</h6>

                                </div>
                            </a>
                            <div class="dropdown-menu py-0 dropdown-menu-end">
                                <div class="dropdown-header">
                                    <h6 class="m-0">{{ auth()->user()->name }}</h6>
                                </div>
                                <div class="dropdown-body">
                                    <a href="{{ route('profile.index') }}"
                                        class="dropdown-item d-flex justify-content-between align-items-center ai-icon">
                                        <div>
                                            <i class="fas fa-user" style="color: #eaa451"></i>
                                            <span class="ms-2">Profile</span>
                                        </div>
                                    </a>
                                    <a href="{{ route('lendings.index') }}"
                                        class="dropdown-item d-flex justify-content-between align-items-center ai-icon">
                                        <div>
                                            <i class="fa-solid fa-clock-rotate-left" style="color: #eaa451"></i>
                                            <span class="ms-2">Riwayat Peminjaman</span>
                                        </div>
                                    </a>

                                </div>
                                <div class="dropdown-footer">
                                    <a class="btn btn-primary w-100 btnhover btn-sm"href="javascript:void(0)"
                                        onclick="logout()">Log Out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- BAWAH --}}
    <div class="sticky-header main-bar-wraper navbar-expand-lg">

        <div class="main-bar clearfix">

            <div class="container clearfix">
                <!-- Website Logo -->
                <div class="logo-header logo-dark ">
                    <a href="https://www.del.ac.id/"><img src="{{ asset('frontend_revisi/images/olis.png') }}"
                            alt="logo"></a>
                </div>
                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- Main Nav -->
                <div class="header-nav navbar-collapse collapse justify-content-center" id="navbarNavDropdown">
                    <div class="logo-header logo-dark">
                        <a href="https://www.del.ac.id/"><img src="{{ asset('frontend_revisi/images/olis.png') }}"
                                alt="" style="height: 50px;">
                        </a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li class="sub-menu-down d-lg-none d-block"><a
                                href="javascript:void(0);"><span>{{ auth()->user()->name }}</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('profile.index') }}">Profile</a></li>
                                <li><a href="{{ route('lendings.index') }}">Riwayat Peminjaman</a></li>
                            </ul>
                        </li>
                        <li><a href="/"><span>Beranda</span></a></li>
                        <li class="sub-menu-down"><a href="javascript:void(0);"><span>Tentang Perpus</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('library-archives.rules') }}">Peraturan Perpustakaan</a></li>
                                <li><a href="{{ route('library-archives.guidelines') }}">Panduan Pesan Pinjam</a></li>
                                <li><a href="{{ route('library-archives.achievements') }}">Penghargaan Perpustakaan</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu-down"><a href="javascript:void(0);"><span>Bahan Pustaka</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('books.index') }}">Buku</a></li>
                                <li><a href="{{ route('compact-disks.index') }}">CD/DVD</a></li>
                                <li><a href="{{ route('articles.index') }}">Artikel</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu-down"><a href="javascript:void(0);"><span>Pemberitahuan</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('notifications.books') }}">Buku Baru</a></li>
                                <li><a href="{{ route('notifications.compact-disks') }}">CD/DVD Baru</a></li>
                                <li><a href="{{ route('notifications.articles') }}">Artikel Baru</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('site-links.index') }}"><span>Link-Link Lainnya</span></a></li>
                        <li class="sub-menu-down d-lg-none d-block"><a
                                href="javascript:void(0);"><span>Notifikasi</span></a>
                            <ul class="sub-menu">
                                @foreach ($announcements as $announcement)
                                    <li><a
                                            href="{{ route('announcements.show', $announcement->slug) }}">{{ $announcement->title }}-{{ $announcement->created_at->format('d M Y') }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-center align-items-center mt-2 d-sm-none d-block">
                        <a href="javascript:void(0)" onclick="logout()" class="btn btn-primary btnhover btn-sm">
                            <i class="fa-solid fa-right-to-bracket" style="margin-right: 10px"></i>
                            Logout
                        </a>
                    </div>
                    <div class="dz-social-icon">
                        <ul>
                            <li><a class="fab fa-facebook-f" target="_blank"
                                    href="https://www.facebook.com/profile.php?id=100079065687693&mibextid=ZbWKwL"></a>
                            </li>
                            <li><a class="fab fa-youtube" target="_blank"
                                    href="https://www.youtube.com/@itdel_library"></a>
                            </li>
                            <li><a class="fas fa-envelope" target="_blank" href="mailto:library@del.ac.id"></a></li>
                            <li><a class="fab fa-instagram" target="_blank"
                                    href="https://www.instagram.com/itdel_library"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    {{-- BAWAH --}}
    <div class="sticky-header main-bar-wraper navbar-expand-lg">
        <div class="main-bar clearfix">
            <div class="container clearfix">
                <!-- Website Logo -->
                <div class="logo-header logo-dark">
                    <a href="https://www.del.ac.id/"><img src="{{ asset('frontend_revisi/images/olis.png') }}"
                            alt="logo" class="w-50">
                    </a>
                </div>

                <!-- Nav Toggle Button -->
                <button class="navbar-toggler collapsed navicon justify-content-end " type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <!-- EXTRA NAV -->
                <div class="extra-nav">
                    <div class="extra-cell">
                        <a href="{{ route('login') }}" class="btn btn-primary btnhover">
                            <i class="fa-solid fa-right-to-bracket" style="margin-right: 10px"></i>
                            Login</a>
                    </div>
                </div>

                <!-- Main Nav -->
                <div class="header-nav navbar-collapse collapse justify-content-start" id="navbarNavDropdown">
                    <div class="logo-header logo-dark">
                        <a href="https://www.del.ac.id/"><img src="{{ asset('frontend_revisi/images/olis.png') }}"
                                alt="" style="height: 50px;">
                        </a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a href="/"><span>Beranda</span></a></li>
                        <li class="sub-menu-down"><a href="javascript:void(0);"><span>Tentang Perpus</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('library-archives.rules') }}">Peraturan Perpustakaan</a></li>
                                <li><a href="{{ route('library-archives.guidelines') }}">Panduan Pesan Pinjam</a></li>
                                <li><a href="{{ route('library-archives.achievements') }}">Penghargaan Perpustakaan</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu-down"><a href="javascript:void(0);"><span>Bahan Pustaka</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('books.index') }}">Buku</a></li>
                                <li><a href="{{ route('compact-disks.index') }}">CD/DVD</a></li>
                                <li><a href="{{ route('articles.index') }}">Artikel</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu-down"><a href="javascript:void(0);"><span>Pemberitahuan</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('notifications.books') }}">Buku Baru</a></li>
                                <li><a href="{{ route('notifications.compact-disks') }}">CD/DVD Baru</a></li>
                                <li><a href="{{ route('notifications.articles') }}">Artikel Baru</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('site-links.index') }}"><span>Link-Link Lainnya</span></a></li>
                    </ul>
                    <div class="d-flex justify-content-center align-items-center mt-2 d-sm-none d-block">
                        <a href="{{ route('login') }}" class="btn btn-primary btnhover btn-sm">
                            <i class="fa-solid fa-right-to-bracket" style="margin-right: 10px"></i>
                            Login
                        </a>
                    </div>
                    <div class="dz-social-icon">
                        <ul>
                            <li><a class="fab fa-facebook-f" target="_blank"
                                    href="https://www.facebook.com/profile.php?id=100079065687693&mibextid=ZbWKwL"></a>
                            </li>
                            <li><a class="fab fa-youtube" target="_blank"
                                    href="https://www.youtube.com/@itdel_library"></a>
                            </li>
                            <li><a class="fas fa-envelope" target="_blank" href="mailto:library@del.ac.id"></a></li>
                            <li><a class="fab fa-instagram" target="_blank"
                                    href="https://www.instagram.com/itdel_library"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endauth
