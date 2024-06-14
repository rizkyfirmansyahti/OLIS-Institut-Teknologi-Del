@extends('layouts.frontend.master')
@section('title', 'Home')
@section('content')
    <div class="title-container">
        <h1 style="font-size: 20px; font-weight: 700; line-height: 36px;">Layanan
            Perpustakaan IT DEL</h1>
        <div style="position: relative;">
            <hr
                style="height: 4px;
            border-top-width: 1px;
            border-color: 3px solid #6F410B;
            margin: 20px auto;
            border-radius: 20px;
            width: 17%;">
        </div>
    </div>

    <div class="container-fluid py-5 px-5" style="background-color: #e7e7e7;">
        <div class="row">
            <div class="col-md-3 mb-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="m-3 align-self-center">
                                <img src="{{ asset('frontend/dist/img/melihatbahanpustaka.PNG') }}" alt="Deskripsi Gambar"
                                    class="img-fluid" style="width: 250px" height="250px" />
                            </div>
                            <div>
                                <h4>
                                    Melihat
                                    Bahan Pustaka</h4>
                                <p style="font-size: 10px; font-weight: 400; margin: 0;">
                                    Terdapat
                                    beberapa bahan pustaka
                                    yang dapat dilihat melalui sistem
                                    informasi OLIS, diantaranya :</p>
                                <ul style="font-size: 10px; font-weight: 400; margin: 0;">
                                    <li>Buku</li>
                                    <li>CD/DVD</li>
                                    <li>Artikel</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="m-3 align-self-center">
                                <img src="{{ asset('frontend/dist/img/meminjambuku.PNG') }}" alt="Deskripsi Gambar"
                                    class="img-fluid" style="width: 250px" height="250px" />
                            </div>
                            <div>
                                <h4> Layanan Peminjaman Buku
                                </h4>
                                {{-- <p class="h-2">
                                    Melihat
                                    Bahan Pustaka</p> --}}
                                <p style="font-size: 10px; font-weight: 400; margin: 0;">
                                    Terdapat
                                    beberapa bahan pustaka
                                    yang dapat dilihat melalui sistem
                                    informasi OLIS, diantaranya :</p>
                                <ul style="font-size: 10px; font-weight: 400; margin: 0;">
                                    <li>Buku</li>
                                    <li>CD/DVD</li>
                                    <li>Artikel</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="m-3 align-self-center">
                                <img src="{{ asset('frontend/dist/img/cetakdokumen.PNG') }}" alt="Deskripsi Gambar"
                                    class="img-fluid" style="width: 250px" height="250px" />
                            </div>
                            <div>
                                <h4>Layanan
                                    Cetak Dokuman</h4>
                                {{-- <p class="h-2">
                                    Melihat
                                    Bahan Pustaka</p> --}}
                                <p style="font-size: 10px; font-weight: 400; margin: 0;">
                                    Terdapat
                                    layanan cetak dokumen
                                    di perpustakaan IT DEL, diantaranya untuk mencetak
                                    dokumen seperti:</p>
                                <ul style="font-size: 10px; font-weight: 400; margin: 0;">
                                    <li>Surat Izin Bermalam</li>
                                    <li>Surat Izin Keluar</li>
                                    <li>Dokumen PA/TA/KP</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="m-3 align-self-center">
                                <img src="{{ asset('frontend/dist/img/ruangdiskusi.PNG') }}" alt="Deskripsi Gambar"
                                    class="img-fluid" style="width: 250px" height="250px" />
                            </div>
                            <div>
                                <h4>Memiliki
                                    Ruang Diskusi</h4>
                                {{-- <p class="h-2">
                                    Melihat
                                    Bahan Pustaka</p> --}}
                                <p style="font-size: 10px; font-weight: 400; margin: 0;">
                                    Terdapat
                                    beberapa ruang diskusi yang nyaman dan
                                    memiliki fasilitas yang baik, diantaranya seperti:</p>
                                <ul style="font-size: 10px; font-weight: 400; margin: 0;">
                                    <li>AC</li>
                                    <li>Komputer</li>
                                    <li>Papan Tulis</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="title-container">
        <h1 style="font-size: 20px; font-weight: 700; line-height: 36px;">Buku
            Dengan
            Rating Tertinggi</h1>
        <div style="position: relative;">
            <hr
                style="height: 4px;
            border-top-width: 1px;
            border-color: 3px solid #6F410B;
            margin: 20px auto;
            border-radius: 20px;
            width: 17%;">
        </div>
    </div>

    <div class="container-fluid py-5 px-5" style="background-color: #e7e7e7;">
        <div class="row">
            @foreach ($bestBooks as $book)
                <div class="col-md-3 mb-3 d-flex align-items-stretch">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="d-flex justify-content-between">
                                    <div class="m-3 align-self-center">
                                        <img src="{{ $book->cover }}" alt="Deskripsi Gambar" class="img-fluid"
                                            style="width: 250px" height="250px"
                                            onerror="https://lancangkuning.com/image/NoImage.png" />
                                    </div>
                                    <div>
                                        <table>
                                            <tr>
                                                <td
                                                    style="text-align: center; align-items: center; justify-content: center;">
                                                    <i class="fas fa-pencil-alt fa-sm" style="color: #000000;"></i>
                                                </td>
                                                <td style="width: 300px;">
                                                    <p
                                                        style="font-size: 17px; font-weight: 400; margin-top: 14px; margin-left: 10px;">
                                                        {{ $book->title }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                        <table>
                                            <tr>
                                                <td
                                                    style="text-align: center; align-items: center; justify-content: center;">
                                                    <i class="far fa-file-alt fa-sm" style="color: #000000;"></i>
                                                </td>
                                                <td style="width: 300px;">
                                                    <p
                                                        style="font-size: 17px; font-weight: 400; margin-top: 14px; margin-left: 10px;">
                                                        {{ $book->author }}
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="subtitle">
                                <div class="text-book">
                                    <i class="fas fa-fire fa-lg" style="color: #ff9d33; margin-right: 10px;"></i>
                                    <p
                                        style="font-family: 'Roboto', sans-serif; font-size: 18px; font-weight: 400; margin-bottom: 5px;">
                                        {{ $book->subject }}
                                    </p>
                                </div>
                                <p
                                    style="font-family: 'Roboto', sans-serif; font-size: 18px; font-weight: 400; color: darkgrey; margin: 0;">
                                    {{ $book->description }}
                                </p>
                                <div class="text-book">
                                    <i class="fas fa-star fa-lg" style="color: #FFD43B; margin-right: 5px;"></i>
                                    <p style="font-size: 18px; font-weight: 400; color: darkgrey; margin-top: 16px;">
                                        {{ $book->rating }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
