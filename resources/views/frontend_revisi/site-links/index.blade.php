@extends('layouts.frontend_revisi.master')
@section('title', 'Link Link Lainnya')
@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm"
            style="background-image:url('{{ asset('frontend_revisi/images/header_2.jpg') }}');">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>LINK-LINK LAINNYA</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Beranda</a></li>
                            <li class="breadcrumb-item">LINK-LINK LAINNYA </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- inner page banner End-->

        <!-- Blog Large -->
        <section class="content-inner-1 bg-img-fix">
            <div class="container">
                <div class="row d-flex justify-content-start">
                    @foreach ($siteLinks as $siteLink)
                        <div class="col-6 col-md-6 col-lg-6 mb-2 d-flex justify-content-start">
                            <a href="{{ $siteLink->url }}" class="btn btn-primary w-100"
                                target="_blank">{{ $siteLink->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
@endsection
