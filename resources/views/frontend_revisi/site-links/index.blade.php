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
                <div class="row">
                    @foreach ($siteLinks as $siteLink)
                        <div class="col  col-md-4 col-lg-2 mb-2">
                            <a href="{{ $siteLink->url }}" class="btn btn-primary" target="_blank">{{ $siteLink->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
