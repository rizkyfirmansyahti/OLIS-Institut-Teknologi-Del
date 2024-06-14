@extends('layouts.backend.master')
@section('title', 'Tambah CD/DVD')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.compact-disks.index') }}">CD/DVD</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.compact-disks.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Tambah CD/DVD</h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="form-group">
                                <label for="code" class="col-sm-2 col-form-label @error('code') text-danger @enderror">
                                    Kode
                                </label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    id="code" name="code" value="{{ old('code') }}">
                                @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-2 col-form-label @error('title') text-danger @enderror">
                                    Judul
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title') }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="subject"
                                    class="col-sm-2 col-form-label @error('subject') text-danger @enderror">
                                    Subjek
                                </label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    id="subject" name="subject" value="{{ old('subject') }}">
                                @error('subject')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="author"
                                    class="col-sm-2 col-form-label @error('author') text-danger @enderror">
                                    Pengarang
                                </label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror"
                                    id="author" name="author" value="{{ old('author') }}">
                                @error('author')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description"
                                    class="col-sm-2 col-form-label @error('description') text-danger @enderror">
                                    Deskripsi
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="source"
                                    class="col-sm-2 col-form-label @error('source') text-danger @enderror">
                                    Sumber
                                </label>
                                <input type="text" class="form-control @error('source') is-invalid @enderror"
                                    id="source" name="source" value="{{ old('source') }}">
                                @error('source')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cover"
                                    class="col-sm-2 col-form-label @error('cover') text-danger @enderror">
                                    Cover
                                </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file"
                                            class="custom-file-input @error('cover') is-invalid @enderror" id="cover"
                                            name="cover">
                                        <label class="custom-file-label" for="cover">Choose file</label>
                                    </div>
                                </div>
                                @error('cover')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="major"
                                    class="col-sm-2 col-form-label @error('major') text-danger @enderror">
                                    Jurusan
                                </label>
                                <select class="form-control @error('major') is-invalid @enderror" id="major"
                                    name="major">
                                    <option value="">Pilih Jurusan</option>
                                    <option value="D3 Teknologi Komputer"
                                        @if (old('major') == 'D3 Teknologi Komputer') selected @endif>D3 Teknologi Komputer</option>
                                    <option value="D3 Teknologi Informasi"
                                        @if (old('major') == 'D3 Teknologi Informasi') selected @endif>D3 Teknologi Informasi</option>
                                    <option value="D4 Teknologi Rekayasa Perangkat Lunak"
                                        @if (old('major') == 'D4 Teknologi Rekayasa Perangkat Lunak') selected @endif>D4 Teknologi Rekayasa Perangkat
                                        Lunak</option>
                                    <option value="S1 Informatika" @if (old('major') == 'S1 Informatika') selected @endif>S1
                                        Informatika</option>
                                    <option value="S1 Sistem Informasi" @if (old('major') == 'S1 Sistem Informasi') selected @endif>
                                        S1 Sistem Informasi</option>
                                    <option value="S1 Teknik Elektro" @if (old('major') == 'S1 Teknik Elektro') selected @endif>S1
                                        Teknik Elektro</option>
                                    <option value="S1 Manajemen Rekayasa"
                                        @if (old('major') == 'S1 Manajemen Rekayasa') selected @endif>S1 Manajemen Rekayasa</option>
                                    <option value="S1 Teknik Metalurgi" @if (old('major') == 'S1 Teknik Metalurgi') selected @endif>
                                        S1 Teknik Metalurgi</option>
                                    <option value="S1 Teknik Bioproses" @if (old('major') == 'S1 Teknik Bioproses') selected @endif>
                                        S1 Teknik Bioproses</option>
                                    <option value="Umum/Lainnya" @if (old('major') == 'Umum/Lainnya') selected @endif>
                                        Umum/Lainnya</option>
                                </select>
                                @error('major')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cd_dvd"
                                    class="col-sm-2 col-form-label @error('cd_dvd') text-danger @enderror">
                                    CD/DVD
                                </label>
                                <select class="form-control @error('cd_dvd') is-invalid @enderror" id="cd_dvd"
                                    name="cd_dvd">
                                    <option value="">Pilih CD/DVD</option>
                                    <option value="CD" @if (old('cd_dvd') == 'CD') selected @endif>CD</option>
                                    <option value="DVD" @if (old('cd_dvd') == 'DVD') selected @endif>DVD</option>
                                </select>
                                @error('cd_dvd')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="year"
                                    class="col-sm-2 col-form-label @error('year') text-danger @enderror">
                                    Tahun
                                </label>
                                <input type="text" class="form-control @error('year') is-invalid @enderror"
                                    id="year" name="year" value="{{ old('year') }}">
                                @error('year')
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
            <!-- /.card -->
        </div>
    </div>
@endsection
@push('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // select2
            $('#category_id').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Kategori',
                allowClear: true
            });

            // bs-custom-file-input
            bsCustomFileInput.init();
        });
    </script>
@endpush
