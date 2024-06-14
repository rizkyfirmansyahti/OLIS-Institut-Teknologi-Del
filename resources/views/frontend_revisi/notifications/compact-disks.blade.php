@extends('layouts.frontend_revisi.master')
@section('title', 'List CD/DVD')
@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm"
            style="background-image:url('{{ asset('frontend_revisi/images/header_2.jpg') }}');">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>CD/DVD Baru</h1>
                    <h5 class="text-white">{{ $lastUpdated->updated_at->format('d F Y') }}</h5>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Beranda</a></li>
                            <li class="breadcrumb-item">CD/DVD Baru</li>
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

                    {{-- Search --}}
                    <div class="col-xl-4 col-lg-4">
                        <aside class="side-bar sticky-top mt-lg-0 mt-md-5 mb-4">
                            <select class="form-select border rounded" placeholder="Filter CD/DVD Baru">
                                <option selected>Filter CD/DVD Baru</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </aside>
                    </div>
                    <div class="col-xl-8 col-lg-8">
                        <aside class="side-bar sticky-top mt-lg-0 mt-md-5 mb-4">
                            <div class="widget">
                                <div class="search-bx">
                                    <form role="search" action="" method="get">
                                        <div class="input-group">
                                            <input class="form-control" type="text" name="search"
                                                placeholder="Cari CD/DVD" value="{{ request('search') }}">
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

                    {{-- Content --}}
                    @foreach ($compactDisks as $cd)
                        <div class="col-xl-6 col-lg-6">
                            <div class="dz-blog style-1 bg-white m-b30">
                                <div class="dz-media dz-img-effect zoom d-flex justify-content-center align-items-center">
                                    <img src="{{ $cd->cover }}" alt="{{ $cd->title }}" class="w-50">
                                </div>
                                <div class="dz-info">
                                    <h4 class="dz-title">
                                        <a
                                            href="{{ route('compact-disks.show', encodeId($cd->id)) }}">{{ $cd->title }}</a>
                                    </h4>
                                    <div class="dz-meta meta-bottom">
                                        <ul class="border-0 pt-0">
                                            <li class="post-date"><i class="fas fa-calendar-alt"></i>{{ $cd->year }}
                                            </li>
                                            <li class="post-author"><i class="fas fa-user"></i>{{ $cd->author }}</li>
                                            <li class="post-date"><i class="fas fa-compact-disc"></i>{{ $cd->cd_dvd }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- PAGINATION --}}
                <nav aria-label="Blog Pagination">
                    <ul class="pagination text-center p-t20 style-1 m-b30">
                        {{ $compactDisks->links('components.pagination') }}
                    </ul>
                </nav>
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
