@extends('layouts.frontend_revisi.master')
@section('title', 'Home')
@section('content')
    <div class="page-content bg-white">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ 'frontend_revisi/images/header_2.jpg' }}" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>
        <!-- LAYANAN PERPUSTAKAAN IT DEL-->
        <section class="content-inner-2">
            <div class="container">
                <div class="section-head book-align">
                    <h2 class="title mb-0">Layanan Perpustakaan IT DEL</h2>
                    <div class="pagination-align style-1">
                        <div class="book-button-prev swiper-button-prev"><i class="fa-solid fa-angle-left"></i>
                        </div>
                        <div class="book-button-next swiper-button-next"><i class="fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-container book-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="dz-media">
                                    <img src="{{ asset('frontend/dist/img/melihatbahanpustaka.PNG') }}" alt="/">
                                </div>
                                <div class="dz-info">
                                    <h4 class="dz-title">Melihat Pustaka</h4>
                                    <p>Terdapat
                                        beberapa bahan pustaka
                                        yang dapat dilihat melalui sistem
                                        informasi OLIS, diantaranya :</p>
                                    <div class="dz-meta">
                                        <ul class="dz-tags">
                                            <li><a class="disabed">BUKU</a></li>
                                            <li><a class="disabed">CD/DVD</a></li>
                                            <li><a class="disabed">ARTIKEL</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="dz-media">
                                    <img src="{{ asset('frontend/dist/img/meminjambuku.PNG') }}" alt="/">
                                </div>
                                <div class="dz-info">
                                    <h4 class="dz-title">Layanan Peminjaman Buku</h4>
                                    <p>Terdapat
                                        beberapa bahan pustaka
                                        yang dapat dilihat melalui sistem
                                        informasi OLIS, diantaranya :</p>
                                    <div class="dz-meta">
                                        <ul class="dz-tags">
                                            <li><a class="disabed">BUKU</a></li>
                                            <li><a class="disabed">CD/DVD</a></li>
                                            <li><a class="disabed">ARTIKEL</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="dz-media">
                                    <img src="{{ asset('frontend/dist/img/cetakdokumen.PNG') }}" alt="/">
                                </div>
                                <div class="dz-info">
                                    <h4 class="dz-title">Layanan Cetak Dokumen</h4>
                                    <p> Terdapat
                                        layanan cetak dokumen
                                        di perpustakaan IT DEL, diantaranya untuk mencetak
                                        dokumen seperti:</p>
                                    <div class="dz-meta">
                                        <ul class="dz-tags">
                                            <li><a class="disabed">SURAT IZIN BERMALAM</a></li>
                                            <li><a class="disabed">SURAT IZIN KELUAR</a></li>
                                            <li><a class="disabed">DOKUMEN PA/TA/KP</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="dz-media">
                                    <img src="{{ asset('frontend/dist/img/ruangdiskusi.PNG') }}" alt="/">
                                </div>
                                <div class="dz-info">
                                    <h4 class="dz-title">Memiiki Ruang Diskusi</h4>
                                    <p> Terdapat
                                        beberapa ruang diskusi yang nyaman dan
                                        memiliki fasilitas yang baik, diantaranya seperti:</p>
                                    <div class="dz-meta">
                                        <ul class="dz-tags">
                                            <li><a class="disabed">AC</a></li>
                                            <li><a class="disabed">KOMPUTER</a></li>
                                            <li><a class="disabed">PAPAN TULIS</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- LAYANAN PERPUSTAKAAN IT DEL -->

        <!-- BUKU DENGAN RATING TERTINGGI -->
        <section class="content-inner-2">
            <div class="container">
                <div class="section-head book-align">
                    <h2 class="title mb-0">Buku Dengan Rating Tertinggi</h2>
                    <div class="pagination-align style-1">
                        <div class="book-button-prev swiper-button-prev"><i class="fa-solid fa-angle-left"></i>
                        </div>
                        <div class="book-button-next swiper-button-next"><i class="fa-solid fa-angle-right"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-container book-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($bestBooks as $book)
                            <div class="swiper-slide">
                                <div class="dz-card style-2 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="dz-media d-flex justify-content-center align-items-center">
                                        <img src="{{ $book->cover }}" alt="/" class="w-50 ">
                                    </div>
                                    <div class="dz-info">
                                        <h4 class="dz-title">{{ $book->title }}</h4>
                                        <p>
                                            {{ $book->description }}
                                        </p>
                                        <div class="dz-meta">
                                            <ul class="dz-tags">
                                                <li>
                                                    <i class="fas fa-fire fa-lg"
                                                        style="color: #ff9d33; margin-right: 10px;"></i>{{ $book->subject }}
                                                </li>
                                                <li><i class="fas fa-star fa-lg"
                                                        style="color: #ff9d33; margin-right: 10px;"></i>{{ $book->rating }}
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- BUKU DENGAN RATING TERTINGGI -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            let images = document.querySelectorAll('img');
            images.forEach((img) => {
                let fileUrl = img.src;
                if (fileUrl.includes('drive.google.com')) {
                    var fileId = fileUrl.split('=')[1];
                    fileId = fileId.split('&')[0];
                    img.src = `https://drive.google.com/thumbnail?id=${fileId}`;
                }
            });
        });
    </script>
@endpush
