@extends('layouts.frontend_revisi.master')
@section('title', $announcement->title)
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
                            <li class="breadcrumb-item"><a href="{{ route('announcements.index') }}">PENGUMUMAN</a></li>
                            <li class="breadcrumb-item">{{ $announcement->title }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- inner page banner End-->
        <section class="content-inner-1 bg-img-fix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <!-- blog start -->
                        <div class="dz-blog blog-single style-1">
                            <div class="dz-info">
                                <h4 class="dz-title">{{ $announcement->title }}</h4>
                                <div class="dz-post-text">
                                    <p> {!! $announcement->content !!}</p>

                                </div>
                            </div>
                        </div>
                        <!-- blog END -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
