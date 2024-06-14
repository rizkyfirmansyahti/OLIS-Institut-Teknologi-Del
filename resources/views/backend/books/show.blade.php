@extends('layouts.backend.master')
@section('title', 'Detail Buku')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('backend.books.index') }}">Buku</a></li>
        <li class="breadcrumb-item active">Detail Buku</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Buku</h3>
                        <div class="card-tools">
                            <a href="{{ route('backend.books.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="code">Kode Buku</label>
                            <input type="text" name="code" id="code" class="form-control"
                                value="{{ $book->code }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="title">Judul Buku</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $book->title }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="author">Pengarang</label>
                            <input type="text" name="author" id="author" class="form-control"
                                value="{{ $book->author }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="isbn">ISBN</label>
                            <input type="text" name="isbn" id="isbn" class="form-control"
                                value="{{ $book->isbn }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="cover">Cover</label>
                            <br>
                            <img alt="{{ $book->title }}" class="img-fluid" src="{{ $book->cover }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control" rows="5" readonly>{{ $book->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="publisher">Penerbit</label>
                            <input type="text" name="publisher" id="publisher" class="form-control"
                                value="{{ $book->publisher }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="language">Bahasa</label>
                            <input type="text" name="language" id="language" class="form-control"
                                value="{{ $book->language }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="edition">Edisi</label>
                            <input type="text" name="edition" id="edition" class="form-control"
                                value="{{ $book->edition }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subjek</label>
                            <input type="text" name="subject" id="subject" class="form-control"
                                value="{{ $book->subject }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="classification">Klasifikasi</label>
                            <input type="text" name="classification" id="classification" class="form-control"
                                value="{{ $book->classification }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="cp_or">CP/Or</label>
                            <input type="text" name="cp_or" id="cp_or" class="form-control"
                                value="{{ $book->cp_or }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <input type="text" name="year" id="year" class="form-control"
                                value="{{ $book->year }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            @if ($book->status == 1)
                                <input type="text" name="status" id="status" class="form-control"
                                    value="Tersedia" readonly>
                            @else
                                <input type="text" name="status" id="status" class="form-control"
                                    value="Tidak Tersedia" readonly>
                            @endif
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
@push('scripts')
    <script>
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
    </script>
@endpush
