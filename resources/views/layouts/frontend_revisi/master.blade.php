<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="" />
    <meta name="author" content="DexignZone" />
    <meta name="robots" content="" />
    <meta name="description" content="Bookland-Book Store Ecommerce Website" />
    <meta property="og:title" content="Bookland-Book Store Ecommerce Website" />
    <meta property="og:description" content="Bookland-Book Store Ecommerce Website" />
    <meta property="og:image" content="../../makaanlelo.com/tf_products_007/bookland/xhtml/social-image.html" />
    <meta name="format-detection" content="telephone=no">

    <!-- FAVICONS ICON -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend_revisi/images/olis.png') }}" />

    <!-- PAGE TITLE HERE -->
    <title>@yield('title')</title>

    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- STYLESHEETS -->
    {{-- Boostrap Select --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend_revisi/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    {{-- FontAwesome --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_revisi/icons/fontawesome/css/all.min.css') }}">
    {{-- Swiper --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_revisi/vendor/swiper/swiper-bundle.min.css') }}">
    {{-- Animate --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_revisi/vendor/animate/animate.css') }}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_revisi/css/style.css') }}">
    {{-- Datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">



    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Righteous&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/notification.css') }}">



    <!-- GOOGLE FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&amp;family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="page-wraper">
        <!-- LOADER -->
        <div id="loading-area" class="preloader-wrapper-1">
            <div class="preloader-inner">
                <div class="preloader-shade"></div>
                <div class="preloader-wrap"></div>
                <div class="preloader-wrap wrap2"></div>
                <div class="preloader-wrap wrap3"></div>
                <div class="preloader-wrap wrap4"></div>
                <div class="preloader-wrap wrap5"></div>
            </div>
        </div>

        <!-- Header -->
        <header class="site-header mo-left header style-1">
            <!-- Main Navbar 1-->
            @include('layouts.frontend_revisi.navbar_1')
            <!-- Main Header End -->

            <!-- Main Navbar 2-->
            {{-- @include('layouts.frontend_revisi.navbar_2') --}}
            <!-- Main Header End -->
        </header>
        <!-- Header End -->

        @yield('content')

        <!-- Footer -->
        @include('layouts.frontend_revisi.footer')
        <!-- Footer End -->

        <button class="scroltop" type="button"><i class="fas fa-arrow-up"></i></button>
    </div>
    <!-- JAVASCRIPT FILES ========================================= -->
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('frontend_revisi/js/jquery.min.js') }}"></script><!-- JQUERY MIN JS -->
    <script src="{{ asset('frontend_revisi/vendor/wow/wow.min.js') }}"></script><!-- WOW JS -->
    <script src="{{ asset('frontend_revisi/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script><!-- BOOTSTRAP MIN JS -->
    <script src="{{ asset('frontend_revisi/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script><!-- BOOTSTRAP SELECT MIN JS -->
    <script src="{{ asset('frontend_revisi/vendor/counter/waypoints-min.js') }}"></script><!-- WAYPOINTS JS -->
    <script src="{{ asset('frontend_revisi/vendor/counter/counterup.min.js') }}"></script><!-- COUNTERUP JS -->
    <script src="{{ asset('frontend_revisi/vendor/swiper/swiper-bundle.min.js') }}"></script><!-- SWIPER JS -->
    <script src="{{ asset('frontend_revisi/js/dz.carousel.js') }}"></script><!-- DZ CAROUSEL JS -->
    <script src="{{ asset('frontend_revisi/js/dz.ajax.js') }}"></script><!-- AJAX -->
    <script src="{{ asset('frontend_revisi/js/custom.js') }}"></script><!-- CUSTOM JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('backend/js/method.js') }}"></script>
    {{-- Logout --}}
    <script>
        function logout() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari aplikasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, keluar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "{{ route('logout') }}"
                }
            })
        }
    </script>
    @stack('scripts')
</body>

</html>
