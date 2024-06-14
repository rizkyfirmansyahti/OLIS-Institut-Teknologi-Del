@extends('layouts.backend.master')
@section('title', 'Detail CD/DVD')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('backend.compact-disks.index') }}">CD/DVD</a></li>
        <li class="breadcrumb-item active">Detail CD/DVD</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail CD/DVD</h3>
                        <div class="card-tools">
                            <a href="{{ route('backend.compact-disks.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="code">Kode CD/DVD</label>
                            <input type="text" name="code" id="code" class="form-control"
                                value="{{ $compactDisk->code }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="title">Judul CD/DVD</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $compactDisk->title }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subjek</label>
                            <input type="text" name="subject" id="subject" class="form-control"
                                value="{{ $compactDisk->subject }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="author">Pengarang</label>
                            <input type="text" name="author" id="author" class="form-control"
                                value="{{ $compactDisk->author }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control" rows="5" readonly>{{ $compactDisk->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="source">Sumber</label>
                            <input type="text" name="source" id="source" class="form-control"
                                value="{{ $compactDisk->source }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="cover">Cover</label>
                            <br>
                            <img src="{{ $compactDisk->cover }}" alt="{{ $compactDisk->title }}" id="file"
                                class="img-fluid">
                        </div>

                        <div class="form-group">
                            <label for="major">Jurusan</label>
                            <input type="text" name="major" id="major" class="form-control"
                                value="{{ $compactDisk->major }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <input type="text" name="category" id="category" class="form-control"
                                value="{{ $compactDisk->category }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <input type="text" name="year" id="year" class="form-control"
                                value="{{ $compactDisk->year }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            @if ($compactDisk->status == 1)
                                <input type="text" name="status" id="status" class="form-control" value="Tersedia"
                                    readonly>
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
