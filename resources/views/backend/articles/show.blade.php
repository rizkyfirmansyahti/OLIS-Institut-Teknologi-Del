@extends('layouts.backend.master')
@section('title', 'Detail Artikel')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('backend.articles.index') }}">Artikel</a></li>
        <li class="breadcrumb-item active">Detail Artikel</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Artikel</h3>
                        <div class="card-tools">
                            <a href="{{ route('backend.articles.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Judul Artikel</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ $article->title }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="content">Isi Artikel</label>
                            <textarea name="content" id="content" class="form-control" rows="5" readonly>{!! $article->body !!}</textarea>
                        </div>

                        @if ($article->image)
                            <div class="form-group">
                                <label for="image">Image</label>
                                <br>
                                <img alt="{{ $article->title }}" class="img-fluid" id="file">
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="created_at">Dibuat pada</label>
                            <input type="text" name="created_at" id="created_at" class="form-control"
                                value="{{ $article->created_at->format('d F Y H:i:s') }}" readonly>
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
        let fileUrl = '{{ $article->image }}';
        if (fileUrl.includes('drive.google.com')) {
            $(document).ready(function() {
                var file = document.getElementById('file');
                var fileId = fileUrl.split('=')[1];
                fileId = fileId.split('&')[0];
                file.src = `https://drive.google.com/thumbnail?id=${fileId}`;
            });
        } else {
            $(document).ready(function() {
                var file = document.getElementById('file');
                file.src = fileUrl;
            });
        }
    </script>
@endpush
