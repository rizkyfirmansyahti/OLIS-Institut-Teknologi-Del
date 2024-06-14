@extends('layouts.frontend_revisi.master')
@section('title', $libraryArchive->title)
@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm"
            style="background-image:url('{{ asset('frontend_revisi/images/header_2.jpg') }}');">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>PENGHARGAAN PERPUSTAKAAN</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('library-archives.achievements') }}"> PENGHARGAAN
                                    PERPUSTAKAAN</a></li>
                            <li class="breadcrumb-item">{{ $libraryArchive->title }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- inner page banner End-->

        <!-- PENGHARGAAN PERPUSTAKAAN -->
        <section class="content-inner-1 bg-light">
            <div class="container">
                <div class="row pricingtable-wraper">
                    <div class="col-lg-12 col-md-12">
                        <div class="pricingtable-wrapper style-1 m-b30">
                            <div class="pricingtable-inner">
                                <div class="pricingtable-title">
                                    <h3 class="title">{{ $libraryArchive->title }}</h3>
                                </div>
                                <p class="text">{!! $libraryArchive->body !!}</p>

                                <img id="file" src="{{ $libraryArchive->image }}" class="w-100 rounded"
                                    alt="{{ $libraryArchive->title }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- PENGHARGAAN PERPUSTAKAAN -->
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
