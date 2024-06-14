@extends('layouts.backend.master')
@section('title', 'Tambah Arsip Perpustakaan')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.library-archives.index', $type) }}">Arsip Perpustakaan</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            @if ($type == 'achievements')
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('backend.library-archives.store', $type) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Tambah Arsip Perpustakaan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title"
                                        class="col-sm-2 col-form-label @error('title') text-danger @enderror">
                                        Judul Arsip
                                    </label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title') }}">
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="body"
                                        class="col-sm-2 col-form-label @error('body') text-danger @enderror">
                                        Konten Arsip
                                    </label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body">{!! old('body') !!}</textarea>
                                    @error('body')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image"
                                        class="col-sm-2 col-form-label @error('image') text-danger @enderror">
                                        Gambar
                                    </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file"
                                                class="custom-file-input @error('image') is-invalid @enderror"
                                                id="image" name="image" accept="image/*">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            @else
                <div class="col-12">
                    <div class="card">
                        <form action="{{ route('backend.library-archives.store', $type) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">Tambah Arsip Perpustakaan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title"
                                                class="col-form-label @error('title') text-danger @enderror">
                                                Judul Arsip
                                            </label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                id="title" name="title" value="{{ old('title') }}">
                                            @error('title')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description"
                                                class="col-sm-2 col-form-label @error('description') text-danger @enderror">
                                                File
                                            </label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file"
                                                        class="custom-file-input @error('file') is-invalid @enderror"
                                                        id="file" name="file" accept="application/pdf">
                                                    <label class="custom-file-label" for="file">Choose file</label>
                                                </div>
                                            </div>
                                            @error('file')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            @endif
        </div>
    </div>
@endsection
@if ($type == 'achievements')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
    @endpush
@endif
@push('scripts')
    @if ($type == 'achievements')
        <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
    @endif
    <script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            @if ($type == 'achievements')
                $('#body').summernote({
                    height: 300,
                });
            @endif
            bsCustomFileInput.init();
        });
    </script>
@endpush
