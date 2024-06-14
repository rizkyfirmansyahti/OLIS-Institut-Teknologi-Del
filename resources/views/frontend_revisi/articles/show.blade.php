@extends('layouts.frontend_revisi.master')
@section('title', $article->title)
@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm"
            style="background-image:url('{{ asset('frontend_revisi/images/header_2.jpg') }}');">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>ARTIKEL</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Artikel</a></li>
                            <li class="breadcrumb-item">{{ $article->title }}</li>
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
                            <div class="dz-media rounded-md">
                                <img id="file" src="{{ $article->image }}" alt="{{ $article->title }}">
                            </div>
                            <div class="dz-info">
                                <h4 class="dz-title">{{ $article->title }}</h4>
                                <div class="dz-post-text">
                                    <p> {!! $article->body !!}</p>

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

            // on enter key
            $(document).on('keyup', function(e) {
                console.log(e.key);
            });
        });
    </script>
@endpush
