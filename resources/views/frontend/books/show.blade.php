@extends('layouts.frontend.master')
@section('title', $book->title)
@section('content')
    <div class="title-container">
        <h2 style="font-size: 20px; font-weight: 700; line-height: 36px; margin-left: 41px; margin-bottom: 3px;">
            {{ $book->title }}</h2>
        <p style="font-size: 20px; font-weight: 500; line-height: 30px; margin-left: 41px; color: #494646; margin-top: 0;">
            {{ $book->author }}</p>
        <hr style="border-color: black; width: 95%; margin: 0 auto;">
    </div>
    </div>
    <div class="container-fluid py-5" style="background-color: #E7E7E7;">
        <div class="row">
            <div class="col-4" style="display: flex; flex-direction: column; align-items: center;">
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <img style="height: 362px; width: 259px" src="{{ $book->cover }}" alt={{ $book->title }}
                        onerror="this.onerror=null; this.src='https://lancangkuning.com/image/NoImage.png'">
                </div>
                @auth
                    <div style="display: flex; flex-direction: column; align-items: center; margin-top: auto;">
                        <button class="btn" style="width: 200px; background-color: #00FF38; font-weight: 600;" type="button"
                            data-bs-toggle="modal" data-bs-target="#myModal">Pinjam</button>
                    </div>
                @endauth
            </div>

            <div class="col-4">
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">ID</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ encodeId($book->id) }}</p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Judul</p>
                    <p style="font-weight: 400; margin-top: 0;">{{ $book->title }}
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Bahasa</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $book->language }}</p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Subjek</p>
                    <p style="font-weight: 400; margin-top: 0;">{{ $book->subject }}
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Pengarang</p>
                    <p style="font-weight: 400; margin-top: 0;">{{ $book->author }}
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Penerbit</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $book->publisher }}</p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Deskipsi</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $book->description }}</p>
                </div>
            </div>
            <div class="col-4">
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Status</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        @if ($book->status == 1)
                            <span class="badge bg-success">Tersedia</span>
                        @else
                            <span class="badge bg-danger">Tidak Tersedia</span>
                        @endif
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Edisi</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $book->edition }}</p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">ISBN</p>
                    <p style="font-weight: 400; margin-top: 0;">{{ $book->isbn }}
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Klasifikasi</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $book->classification }}</p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Lokasi</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $book->location }}
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Copy/Original
                    </p>
                    <p style="font-weight: 400; margin-top: 0;">
                        @if ($book->cp_or == 'cp')
                            Copy
                        @else
                            Original
                        @endif
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Tahun</p>
                    <p style="font-weight: 400; margin-top: 0;">{{ $book->year }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #C9AC98">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Pinjam Buku</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="return_date" class="form-label">Tanggal Pengembalian Buku</label>
                        <input type="text" class="form-control" id="return_date" placeholder="Pilih Tanggal"
                            name="return_date" style="background-color: #C9AC98">
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
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
                </div>

            </div>
        </div>
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
