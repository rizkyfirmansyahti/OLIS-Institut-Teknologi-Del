@extends('layouts.frontend_revisi.master')
@section('title', 'Riwayat Peminjaman')
@push('styles')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            top: -9999px;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
@endpush
@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm"
            style="background-image:url('{{ asset('frontend_revisi/images/header_2.jpg') }}');">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>RIWAYAT PEMINJAMAN</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Beranda</a></li>
                            <li class="breadcrumb-item">Riwayat Peminjaman</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- inner page banner End-->

        <!-- PENGUMUMAN -->
        <section class="content-inner-1 bg-img-fix">
            <div class="container">
                <div class="row">
                    {{-- CONTENT --}}
                    @forelse ($lendings as $lending)
                        <div class="col-xl-6 col-lg-6">
                            <div class="dz-blog style-1 bg-white m-b30">
                                <div class="dz-info">
                                    <h4 class="dz-title">
                                        {{ $lending->book->title }}
                                    </h4>
                                    <ul>
                                        <li><i class="fa-solid fa-circle fa-2xs"></i> Pengarang :
                                            {{ $lending->book->author }}</li>
                                        <li><i class="fa-solid fa-circle fa-2xs"></i> Tahun : {{ $lending->book->year }}
                                        </li>
                                        <li><i class="fa-solid fa-circle fa-2xs"></i> Tanggal Peminjaman :
                                            {{ $lending->lending_date }}</li>
                                        <li><i class="fa-solid fa-circle fa-2xs"></i> Tanggal Pengembalian :
                                            {{ $lending->return_date }}</li>
                                        <li><i class="fa-solid fa-circle fa-2xs"></i> Denda : {{ $lending->fine }}</li>
                                        <li><i class="fa-solid fa-circle fa-2xs"></i> Status :
                                            @if ($lending->status == 'pending')
                                                <span style="color: #FFC107;" class="fw-bold">Menunggu</span>
                                            @elseif ($lending->status == 'lent')
                                                <span style="color: #28A745;" class="fw-bold">Dipinjam</span>
                                            @elseif ($lending->status == 'returned')
                                                <span style="color: #007BFF;" class="fw-bold">Dikembalikan</span>
                                            @elseif ($lending->status == 'extended')
                                                <span style="color: #17A2B8;" class="fw-bold">Diperpanjang</span>
                                            @elseif ($lending->status == 'rejected')
                                                <span style="color: #DC3545;" class="fw-bold">Ditolak</span>
                                            @elseif($lending->status == 'overdue')
                                                <span style="color: #DC3545;" class="fw-bold">Terlambat</span>
                                            @endif
                                        </li>
                                    </ul>
                                    @if ($lending->status == 'returned')
                                        @if ($lending->book->hasReviewed(auth()->user()))
                                            <div class="dz-meta meta-bottom">
                                                <ul class="border-0 pt-0">
                                                    <li class="post-date d-flex justify-content-center align-items-center">
                                                        @for ($i = 0; $i < $lending->book->rating; $i++)
                                                            <i class="fas fa-star text-warning"></i>
                                                        @endfor
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <div class="dz-meta meta-bottom">
                                                <ul class="border-0 pt-0">
                                                    <li class="post-date d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('books.review', $lending->book->slug) }}"
                                                            class="btn btn-primary btn-rate">Beri Rating</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <nav aria-label="Blog Pagination">
                    <ul class="pagination text-center p-t20 style-1 m-b30">
                        {{ $lendings->links('components.pagination') }}
                    </ul>
                </nav>
            </div>
        </section>
    </div>
    <!-- Modal -->
    @include('frontend_revisi.lendings.rate')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-rate').on('click', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                $('#rateModal').on('show.bs.modal', function(e) {
                    const modal = $(this);
                    modal.find('form').attr('action', url);
                });
                $('#rateModal').modal('show');
            });

            $('#rateModal').on('hidden.bs.modal', function(e) {
                const modal = $(this);
                modal.find('form').attr('action', '');
            });

            // on submit
            $('#rateModal form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const url = form.attr('action');
                const method = form.attr('method');
                const data = form.serialize();

                // Hide modal before showing SweetAlert
                $('#rateModal').modal('hide');

                showConfirmationDialog('Are you sure?', 'You won\'t be able to revert this!', 'warning',
                    'Yes, rate it!', (result) => {
                        if (result.isConfirmed) {
                            handleAction(url, method, 'Book has been rated!', 'Failed to rate book!',
                                data,
                                null, () => {
                                    $('#rateModal').modal('hide');
                                    window.location.reload();
                                });
                        }
                    });
            });
        });
    </script>
@endpush
