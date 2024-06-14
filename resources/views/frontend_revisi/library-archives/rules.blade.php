@extends('layouts.frontend_revisi.master')
@section('title', 'Peraturan Perpustakaan')
@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm"
            style="background-image:url('{{ asset('frontend_revisi/images/header_2.jpg') }}');">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>PERATURAN PERPUSTAKAAN</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Beranda</a></li>
                            <li class="breadcrumb-item">Peraturan Perpustakaan</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- inner page banner  -->


        <!-- PERATURAN PERPUSTAKAAN -->
        <section class="content-inner-1 bg-light">
            <div class="container">
                <div class="row pricingtable-wraper">
                    <div class="col-lg-12 col-md-12">
                        <div class="pricingtable-wrapper style-1 m-b30">
                            <div class="pricingtable-inner">
                                <embed type="application/pdf" width="100%" height="600px" id="file">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- PERATURAN PERPUSTAKAAN -->

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var file = document.getElementById('file');
            var fileUrl = '{{ $libraryArchive->file }}';
            file.src = 'https://drive.google.com/viewerng/viewer?embedded=true&url=' + fileUrl;
        });
    </script>
@endpush
