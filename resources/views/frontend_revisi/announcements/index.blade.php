@extends('layouts.frontend_revisi.master')
@section('title', 'List Pengumuman')
@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm"
            style="background-image:url('{{ asset('frontend_revisi/images/header_2.jpg') }}');">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>PENGUMUMAN</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Beranda</a></li>
                            <li class="breadcrumb-item">PENGUMUMAN</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- inner page banner End-->

        <!-- Blog Large -->
        <section class="content-inner-1 bg-img-fix">
            <div class="container">
                <div class="row">


                    {{-- PAGE PERTAMA --}}
                    <div class="col-xl-12 col-lg-12">
                        {{-- PENGUMUMAN --}}
                        @foreach ($announcements as $announcement)
                            <div class="dz-blog style-1 bg-white m-b30 blog-half">
                                <div class="dz-info">
                                    <h4 class="dz-title">
                                        <a
                                            href="{{ route('announcements.show', $announcement->slug) }}">{{ $announcement->title }}</a>
                                    </h4>
                                    <p>{{ \Str::limit($announcement->content, 100) }}</p>

                                </div>
                            </div>
                        @endforeach

                        {{-- PAGINATION --}}
                        <nav aria-label="Blog Pagination">
                            <ul class="pagination text-center p-t20 style-1 m-b30">
                                {{ $announcements->links('components.pagination') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
