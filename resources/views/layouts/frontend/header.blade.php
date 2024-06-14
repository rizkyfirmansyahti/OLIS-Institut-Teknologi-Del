<style>
    .iconClass {
        position: relative;
    }

    .iconClass span {
        position: absolute;
        top: -7px;
        right: 0px;
        display: block;
        font-size: 10px;
    }
</style>
<div class="d-flex justify-content-between p-3" style="position: fixed top: 0; width: 100%; z-index: 1000;">
    <div class="d-flex align-items-center">
        <!-- Bagian logo akun -->
        <img src="{{ asset('frontend/dist/img/olis.PNG') }}" class="logo">

        <!-- Bagian teks "INSTITUT TEKNOLOGI DEL" di sebelah logo -->
        <div class="d-flex align-items-center ml-3">
            <a href="https://www.del.ac.id/" target="_blank" style="text-decoration: none; color: black;">
                <h3 style="color: black; font-family: 'Poppins', sans-serif;">
                    INSTITUT TEKNOLOGI DEL
                </h3>
            </a>
        </div>
    </div>

    <!-- Ikon profil -->
    <div class="d-flex justify-content-between align-items-center">
        @auth
            <!-- notifikasi -->
            <div class="dropdown dropdown-menu-end" style="margin-right: 20px">
                <a class="dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                    id="dropdownMenuButton" aria-expanded="false" style="text-decoration: none; color: #333;">
                    <i class="far fa-bell"></i>
                    <span class="text-dark">0</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <div class="dropdown-header"><span style="font-weight: bold; color: #333">Pemberitahuan</span></div>
                    <div class="dropdown-divider"></div>
                    <div class="scroll" style="max-height: 300px; overflow-y: scroll; overflow-x: hidden;">
                        @foreach ($announcements as $announcement)
                            <a class="dropdown-item" href="{{ route('announcements.show', $announcement->slug) }}"
                                style="text-decoration: none; color: #333; margin-right: 100px">
                                <div class="notification-content">
                                    <div class="notification-text d-flex justify-content-between">
                                        <span>{{ $announcement->title }}</span>
                                        <span>{{ $announcement->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <!-- lihat semua notifikasi -->
                        <div class="dropdown-divider"></div>
                        <center>
                            <a class="dropdown-item text-center" href="{{ route('announcements.index') }}"
                                style="text-decoration: none; color: #333; margin-right: 100px">
                                <div class="notification-content">
                                    <div class="notification-text d-flex justify-content-between">
                                        <span>Lihat Semua</span>
                                    </div>
                                </div>
                            </a>
                        </center>
                    </div>
                </div>
            </div>

            <div class="dropdown">
                <a class="dropdown-toggle user-name" href="#" role="button" data-bs-toggle="dropdown"
                    id="navbarDropdown" aria-haspopup="true" aria-expanded="false"
                    style="text-decoration: none; color: black;">
                    <span class="me-2" style="font-size: 24px">{{ auth()->user()->name }}</span>
                    <span class="iconClass">
                        <i class="fas fa-user" style="font-size: 20px"></i>
                        <span class="badge rounded-pill bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                    <a class="dropdown-item" href="{{ route('lendings.index') }}">Riwayat Peminjaman</a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="logout()">Logout</a>
                </div>
            </div>
            {{-- Perbaiki Front End Nya --}}
        @else
            <a class="fw-bold text-decoration-none text-dark fs-4" href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt"></i>
                Login
            </a>
        @endauth
    </div>
</div>
