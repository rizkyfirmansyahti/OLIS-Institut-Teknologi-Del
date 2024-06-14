@extends('layouts.frontend_revisi.master')
@section('title', 'List Artikel')
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
                            <li class="breadcrumb-item">Artikel</li>
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
                    {{-- Page Ke Dua --}}
                    <div class="col-xl-12 col-lg-12">
                        <aside class="side-bar sticky-top mt-lg-0 mt-md-5 mb-4">
                            <div class="widget">
                                <div class="search-bx">
                                    <form role="search" action="" method="get">
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="search"
                                                placeholder="Cari Artikel" value="{{ request('search') }}">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-search">
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                        <line x1="21" y1="21" x2="16.65" y2="16.65">
                                                        </line>
                                                    </svg></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </aside>
                    </div>

                    {{-- PAGE PERTAMA --}}
                    <div class="col-xl-12 col-lg-12">
                        {{-- BOOKS --}}
                        @foreach ($articles as $article)
                            <div class="dz-blog style-1 bg-white m-b30 blog-half">
                                <div class="dz-media dz-img-effect zoom">
                                    <img src="{{ $article->image }}" alt={{ $article->image }}>
                                </div>
                                <div class="dz-info">
                                    <h4 class="dz-title">
                                        <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                                    </h4>
                                    <p>{{ $article->excerpt }}</p>
                                    <div class="dz-meta meta-bottom">
                                        <ul class="border-0 pt-0">
                                            {{-- <li class="post-date"><i
                                                    class="fas fa-pencil-alt fa-fw m-r10"></i>{{ $article->author }}</li> --}}
                                            <li class="post-author"><i
                                                    class="fa-solid fa-calendar m-r10"></i>{{ $article->created_at->format('d M Y H:i') }}
                                                WIB
                                            </li>
                                            <li class="post-date"><i class="fas fa-eye fa-fw m-r10"></i>
                                                {{ $article->views }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- PAGINATION --}}
                        <nav aria-label="Blog Pagination">
                            <ul class="pagination text-center p-t20 style-1 m-b30">
                                {{ $articles->links('components.pagination') }}
                            </ul>
                        </nav>
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
        });
    </script>
@endpush
