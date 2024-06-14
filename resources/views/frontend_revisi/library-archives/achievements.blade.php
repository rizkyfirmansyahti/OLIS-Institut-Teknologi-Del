@extends('layouts.frontend_revisi.master')
@section('title', 'Penghargaan')
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
                            <li class="breadcrumb-item">PENGHARGAAN PERPUSTAKAAN</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- inner page banner End-->

        <!-- PENGHARGAAN PERPUSTAKAAN -->
        <section class="content-inner bg-white">
            <div class="container">
                <div class="row">
                    @forelse ($libraryArchives as $libraryArchive)
                        <div class="col-lg-4 col-md-6">
                            <div class="content-box style-1 m-b30">
                                <div class="dz-info">
                                    <h4 class="title">{{ $libraryArchive->title }}</h4>
                                    <p>{{ $libraryArchive->excerpt }}</p>
                                </div>
                                <div class="dz-bottom">
                                    <a href="{{ route('library-archives.achievements.show', $libraryArchive->slug) }}"
                                        class="btn-link btnhover3">Baca Selengkapnya<i
                                            class="fas fa-arrow-right m-l10"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="d-flex justify-content-center mt-4">
                            <h1>TIDAK ADA DATA</h1>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <!-- PENGHARGAAN PERPUSTAKAAN -->

    </div>
@endsection
