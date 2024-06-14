@extends('layouts.frontend_revisi.master')
@section('title', $compactDisk->title)
@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm"
            style="background-image:url('{{ asset('frontend_revisi/images/header_2.jpg') }}');">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>CD/DVD</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('compact-disks.index') }}">CD/DVD</a></li>
                            <li class="breadcrumb-item">{{ $compactDisk->title }}</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- inner page banner End-->

        <section class="content-inner-1">
            <div class="container">
                <div class="row book-grid-row style-4 m-b60">
                    <div class="col">
                        <div class="">
                            <div class="dz-content">
                                <div class="dz-header">
                                    <h3 class="title">{{ $compactDisk->title }}</h3>
                                </div>
                            </div>
                            <div class="dz-media d-flex justify-content-center align-items-center">
                                <img style="height: 300px; width: 300px;" src="{{ $compactDisk->cover }}"
                                    alt={{ $compactDisk->title }}>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="product-description tabs-site-button">
                            <ul class="nav nav-tabs">
                                <li><a data-bs-toggle="tab" href="#graphic-design-1" class="active">Details CD/DVD</a></li>

                            </ul>
                            <div class="tab-content">
                                <div id="graphic-design-1" class="tab-pane show active">
                                    <table class="table border book-overview">
                                        <tr>
                                            <th>Kode</th>
                                            <td>{{ $compactDisk->code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Judul</th>
                                            <td>{{ $compactDisk->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Subjek</th>
                                            <td>{{ $compactDisk->subject }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pengarang</th>
                                            <td>{{ $compactDisk->author }}</td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td>{{ $compactDisk->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jurusan</th>
                                            <td>{{ $compactDisk->major }}</td>
                                        </tr>
                                        <tr>
                                            <th>CD/DVD</th>
                                            <td>{{ $compactDisk->cd_dvd }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun</th>
                                            <td>{{ $compactDisk->year }}</td>
                                        </tr>
                                        <tr>
                                            <th>Penerbit</th>
                                            <td>{{ $compactDisk->publisher }}</td>
                                        </tr>
                                        <tr>
                                            <th>Sumber</th>
                                            <td>{{ $compactDisk->source }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            let maxDate = new Date();
            @role('student')
                // if student then set max date to 7 days from now
                maxDate.setDate(maxDate.getDate() + 7);
            @else
                // set max date to 14 days from now
                maxDate.setDate(maxDate.getDate() + 14);
            @endrole

            $('#return_date').flatpickr({
                enableTime: false,
                dateFormat: 'Y-m-d',
                minDate: 'today',
                maxDate: maxDate
            });
        });

        function lendBook(id) {
            showConfirmationDialog('Pinjam Buku', 'Apakah Anda yakin ingin meminjam buku ini?', 'warning', 'Ya, pinjam',
                function(result) {
                    if (result.isConfirmed) {
                        handleAction('{{ route('lendings.store') }}', 'POST',
                            'Buku berhasil dipinjam', 'Gagal meminjam buku', {
                                book_id: id,
                                return_date: $('#return_date').val()
                            }, null, () => {
                                window.location.reload();
                            });
                    }
                });
        }
    </script>
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
