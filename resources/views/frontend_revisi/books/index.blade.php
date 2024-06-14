@extends('layouts.frontend_revisi.master')
@section('title', 'List Buku')
@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm"
            style="background-image:url('{{ asset('frontend_revisi/images/header_2.jpg') }}');">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>BUKU</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Beranda</a></li>
                            <li class="breadcrumb-item">BUKU</li>
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
                    <div class="col-xl-8 col-lg-8">
                        {{-- BOOKS --}}
                        @foreach ($books as $book)
                            <div class="dz-blog style-1 bg-white m-b30 blog-half">
                                <div class="dz-media dz-img-effect zoom d-flex justify-content-center align-items-center">
                                    <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="w-50">
                                </div>
                                <div class="dz-info">
                                    <h4 class="dz-title">
                                        <a href="{{ route('books.show', $book->slug) }}">{{ $book->title }}</a>
                                    </h4>
                                    <div class="dz-meta meta-bottom">
                                        <ul class="border-0 pt-0">
                                            <li class="post-date"><i
                                                    class="fas fa-pencil-alt fa-fw m-r10"></i>{{ $book->author }}</li>
                                            <li class="post-author">ISBN :
                                                {{ $book->isbn }}</li>
                                            <li class="post-date"><i class="fas fa-star fa-fw m-r10"></i>
                                                {{ $book->rating }}</li>
                                        </ul>
                                    </div>
                                    {{-- <div class="dz-meta meta-bottom">
                                        <ul class="border-0 pt-0">
                                            <li class="post-date"><i
                                                    class="fas fa-pencil-alt fa-fw m-r10"></i>{{ $book->author }}</li>
                                            <li class="post-author"><i class="far fa-file-alt fa-fw m-r10"></i>158 Hal</li>
                                            <li class="post-author"><a href="javascript:void(0);"><i
                                                        class="fas fa-layer-group fa-fw"></i><span>{{ $book->publisher }}</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dz-meta meta-bottom">
                                        <ul class="border-0 pt-0">
                                            <li class="post-date"><i class="fas fa-note-sticky fa-fw m-r10"></i>
                                                {{ $book->subject }}</li>
                                            <li class="post-author">ISBN :
                                                {{ $book->isbn }}</li>
                                            <li class="post-author"><a href="javascript:void(0);"><span><i
                                                            class="fa-solid fa-circle-check"></i>
                                                        {{ $book->available == null ? 'Tidak Tersedia' : 'Tersedia' }}</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dz-meta meta-bottom">
                                        <ul class="border-0 pt-0">
                                            <li class="post-date"><i class="fas fa-star fa-fw m-r10"></i>
                                                {{ $book->rating }}</li>
                                            <li class="post-author"><i
                                                    class="fas fa-book fa-fw m-r10"></i>{{ $book->code }}</li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                        @endforeach

                        {{-- PAGINATION --}}
                        <nav aria-label="Blog Pagination">
                            <ul class="pagination text-center p-t20 style-1 m-b30">
                                {{ $books->links('components.pagination') }}
                                {{-- <li class="page-item"><a class="page-link prev" href="javascript:void(0);">
                                        {{ $books->links('components.pagination') }}
                                    </a>
                                </li> --}}
                            </ul>
                        </nav>
                    </div>


                    {{-- Page Ke Dua --}}
                    <div class="col-xl-4 col-lg-4">
                        <aside class="side-bar sticky-top mt-lg-0 mt-md-5">
                            <div class="widget">
                                <div class="search-bx">
                                    <form role="search" action="" method="get">
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="search"
                                                placeholder="Cari Buku" value="{{ request('search') }}">
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

                            <div class="widget recent-posts-entry">
                                <h4 class="widget-title">Rating Tertinggi</h4>
                                <div class="widget-post-bx">
                                    @foreach ($bestBooks as $books)
                                        <div class="widget-post clearfix">
                                            <div class="dz-media">
                                                <p
                                                    style="font-weight: 700; font-size: 50px; color:#6F410B; margin-left: 40px;">
                                                    {{ $loop->iteration }}
                                                </p>
                                            </div>
                                            <div class="dz-info">
                                                <h6 class="title">{{ $books->title }}</h6>
                                                <div class="dz-meta">
                                                    <ul>
                                                        <li class="post-date">{{ $books->author }}</li>
                                                        <li class="post-date">
                                                            @for ($i = 0; $i < $books->rating; $i++)
                                                                <i class="fas fa-star fa-sm"
                                                                    style="color: #FFD43B; margin-right: 2px;"></i>
                                                            @endfor {{ $books->rating }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </aside>
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
