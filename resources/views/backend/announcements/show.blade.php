@extends('layouts.backend.master')
@section('title', 'Detail Pengumuman')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('backend.announcements.index') }}">Pengumuman</a></li>
        <li class="breadcrumb-item active">Detail Pengumuman</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Pengumuman</h3>
                        <div class="card-tools">
                            <a href="{{ route('backend.announcements.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Judul Pengumuman</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $announcement->title }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="content">Isi Pengumuman</label>
                            <textarea name="content" id="content" class="form-control" rows="5" readonly>{{ $announcement->content }}</textarea>
                        </div>

                        @if ($announcement->image)
                            <div class="form-group">
                                <label for="image">Image</label>
                                <br>
                                <img alt="{{ $announcement->title }}" class="img-fluid" src="{{ $announcement->image }}">
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="created_at">Dibuat pada</label>
                            <input type="text" name="created_at" id="created_at" class="form-control"
                                value="{{ $announcement->created_at->format('d F Y H:i:s') }}" readonly>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
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
