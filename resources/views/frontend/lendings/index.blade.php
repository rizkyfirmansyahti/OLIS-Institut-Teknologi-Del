@extends('layouts.frontend.master')
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
    <div class="container-fluid">
        <div class="title-container">
            <h2 style="color: #6F410B; text-align: center; padding-top: 1px;">Riwayat Peminjaman</h2>
            <center>
                <hr style="border-color: #6F410B; margin-bottom: 30px; width: 20%;" />
            </center>
        </div>
    </div>
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lendings as $lending)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lending->book->title }}</td>
                            <td>{{ $lending->book->author }}</td>
                            <td>{{ $lending->book->year }}</td>
                            <td>{{ $lending->lending_date }}</td>
                            <td>{{ $lending->return_date }}</td>
                            <td>{{ $lending->fine }}</td>
                            <td>
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
                            </td>
                            <td>
                                @if ($lending->status == 'returned')
                                    @if ($lending->book->hasReviewed(auth()->user()))
                                        @for ($i = 0; $i < $lending->book->rating; $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                    @else
                                        <a href="{{ route('books.review', $lending->book->slug) }}"
                                            class="btn btn-primary btn-rate">Beri Rating</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($lendings->hasPages())
            <div class="d-flex justify-content-center">
                {{ $lendings->links('components.pagination') }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    @include('frontend.lendings.rate')
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
                })
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
