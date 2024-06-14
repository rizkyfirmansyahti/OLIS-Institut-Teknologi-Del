@extends('layouts.frontend_revisi.master')
@section('title', $book->title)

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
                            <li class="breadcrumb-item"><a href="{{ route('books.index') }}">BUKU</a></li>
                            <li class="breadcrumb-item"> {{ $book->title }}</li>
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
                        <div class="dz-box">
                            <div class="dz-media d-flex justify-content-center align-items-center">
                                <img src="{{ $book->cover }}" alt="{{ $book->title }}" style="height: 200px; width: 200px"
                                    onerror="this.onerror=null; this.src='https://lancangkuning.com/image/NoImage.png';">
                            </div>
                            <div class="dz-content">
                                <div class="dz-header">
                                    <h3 class="title">{{ $book->title }}</h3>
                                </div>
                                <div class="dz-body">
                                    <div class="book-detail">
                                        <ul class="book-info">
                                            <li>
                                                <div class="writer-info">
                                                    <img src="{{ asset('frontend_revisi/images/profile2.jpg') }}"
                                                        alt="book">
                                                    <div>
                                                        <span>Pengarang </span>{{ $book->author }}
                                                    </div>
                                                </div>
                                            </li>
                                            <li><span>Penerbit</span>{{ $book->publisher }}</li>
                                            <li><span>Tahun</span>{{ $book->year }}</li>
                                        </ul>
                                    </div>
                                </div>
                                @auth
                                    <div class="book-footer">
                                        <div class="product-num">
                                            <a data-bs-toggle="collapse" href="#collapseExample" role="button"
                                                aria-expanded="false" aria-controls="collapseExample"
                                                class="btn btn-primary btnhover btnhover2"><span>Pinjam
                                                    Buku</span></a>
                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body">
                                                    <table class="table border book-overview">
                                                        <tr>
                                                            <th> <label for="return_date" class="form-label">Tanggal
                                                                    Pengembalian</label></th>
                                                            <td colspan="2"> <input type="text" class="form-control"
                                                                    id="return_date" placeholder="Pilih Tanggal"
                                                                    name="return_date"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <div class="d-flex justify-content-end">
                                                                    @if (auth()->check())
                                                                        @if ($book->status == 1)
                                                                            <button type="button" class="btn btn-success"
                                                                                onclick="lendBook('{{ encodeId($book->id) }}')">Pinjam</button>
                                                                        @else
                                                                            <span class="text-danger">Buku tidak tersedia</span>
                                                                        @endif
                                                                    @else
                                                                        <span class="text-danger">Anda harus login terlebih
                                                                            dahulu</span>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>



                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="product-description tabs-site-button">
                            <ul class="nav nav-tabs">
                                <li><a data-bs-toggle="tab" href="#graphic-design-1" class="active">Details
                                        Books</a></li>
                                <li><a data-bs-toggle="tab" href="#list_copies">List Copies</a></li>
                            </ul>

                            <div class="tab-content">
                                {{-- Details Books --}}
                                <div id="graphic-design-1" class="tab-pane show active">
                                    <table class="table border book-overview">
                                        <tr>
                                            <th>ID Buku</th>
                                            <td>{{ encodeId($book->id) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Judul Buku</th>
                                            <td>{{ $book->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bahasa Buku</th>
                                            <td>{{ $book->language }}</td>
                                        </tr>
                                        <tr>
                                            <th>Subjek</th>
                                            <td>{{ $book->subject }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pengarang</th>
                                            <td>{{ $book->author }}</td>
                                        </tr>
                                        <tr>
                                            <th>Penerbit</th>
                                            <td>{{ $book->publisher }}</td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td>{{ $book->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($book->status == 1)
                                                    <span class="badge bg-success">Tersedia</span>
                                                @else
                                                    <span class="badge bg-danger">Tidak Tersedia</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Edisi</th>
                                            <td>{{ $book->edition }}</td>
                                        </tr>
                                        <tr>
                                            <th>ISBN</th>
                                            <td>{{ $book->isbn }}</td>
                                        </tr>
                                        <tr>
                                            <th>Klasifikasi</th>
                                            <td>{{ $book->classification }}</td>
                                        </tr>
                                        <tr>
                                            <th>Lokasi</th>
                                            <td>{{ $book->location }}</td>
                                        </tr>
                                        <tr>
                                            <th>Copy/Original</th>
                                            <td>
                                                @if ($book->cp_or == 'cp')
                                                    Copy
                                                @else
                                                    Original
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tahun</th>
                                            <td>{{ $book->year }}</td>
                                        </tr>
                                    </table>
                                </div>
                                {{-- List Copies --}}
                                <div id="list_copies" class="tab-pane">
                                    <table id="book_datatable" class="table border book-overview">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Buku</th>
                                                <th>Judul Buku</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($book_copies as $book)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $book->code }}</td>
                                                    <td>{{ $book->title }}</td>
                                                    <td>
                                                        @if ($book->status == 1)
                                                            <p class="badge bg-success">Tersedia</p>
                                                        @else
                                                            <p class="badge bg-danger">Tidak Tersedia</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{-- Pinjam Buku --}}
                                <div id="pinjam_buku" class="tab-pane">
                                    <table class="table border book-overview">
                                        <tr>
                                            <th> <label for="return_date" class="form-label">Tanggal Pengembalian</label>
                                            </th>
                                            <td> <input type="text" class="form-control" id="return_date"
                                                    placeholder="Pilih Tanggal" name="return_date"></td>
                                        </tr>
                                        <tr>
                                            <th>
                                            </th>
                                            <td>
                                                @if (auth()->check())
                                                    @if ($book->status == 1)
                                                        <button type="button" class="btn btn-success"
                                                            onclick="lendBook('{{ encodeId($book->id) }}')">Pinjam</button>
                                                    @else
                                                        <span class="text-danger">Buku tidak tersedia</span>
                                                    @endif
                                                @else
                                                    <span class="text-danger">Anda harus login terlebih dahulu</span>
                                                @endif
                                            </td>
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
