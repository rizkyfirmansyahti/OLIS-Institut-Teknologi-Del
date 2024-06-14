@extends('layouts.backend.master')
@section('title', 'Tambah Buku')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.books.index') }}">Buku</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.books.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Tambah Buku</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
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
                                <label for="isbn" class="col-sm-2 col-form-label @error('isbn') text-danger @enderror">
                                    ISBN
                                </label>
                                <input type="text" class="form-control @error('isbn') is-invalid @enderror"
                                    id="isbn" name="isbn" value="{{ old('isbn') }}">
                                @error('isbn')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cover" class="col-sm-2 col-form-label @error('cover') text-danger @enderror">
                                    Cover
                                </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('cover') is-invalid @enderror"
                                            id="cover" name="cover" accept="image/*">
                                        <label class="custom-file-label" for="cover">Choose file</label>
                                    </div>
                                </div>
                                @error('cover')
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
                                <label for="publisher"
                                    class="col-sm-2 col-form-label @error('publisher') text-danger @enderror">
                                    Penerbit
                                </label>
                                <input type="text" class="form-control @error('publisher') is-invalid @enderror"
                                    id="publisher" name="publisher" value="{{ old('publisher') }}">
                                @error('publisher')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="language"
                                    class="col-sm-2 col-form-label @error('language') text-danger @enderror">
                                    Bahasa
                                </label>
                                <select name="language" id="language"
                                    class="form-control @error('language') is-invalid @enderror">
                                    <option value="">Pilih Bahasa</option>
                                    <option value="Indonesia" @if (old('language') == 'Indonesia') selected @endif>
                                        Indonesia
                                    </option>
                                    <option value="Inggris" @if (old('language') == 'Inggris') selected @endif>
                                        Inggris
                                    </option>
                                </select>
                                @error('language')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="location"
                                    class="col-sm-2 col-form-label @error('location') text-danger @enderror">
                                    Lokasi
                                </label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                    id="location" name="location" value="{{ old('location') }}">
                            </div>

                            <div class="form-group">
                                <label for="edition"
                                    class="col-sm-2 col-form-label @error('edition') text-danger @enderror">
                                    Edisi
                                </label>
                                <input type="text" class="form-control @error('edition') is-invalid @enderror"
                                    id="edition" name="edition" value="{{ old('edition') }}">
                                @error('edition')
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
                                <label for="classification"
                                    class="col-sm-2 col-form-label @error('classification') text-danger @enderror">
                                    Klasifikasi
                                </label>
                                <input type="text" class="form-control @error('classification') is-invalid @enderror"
                                    id="classification" name="classification" value="{{ old('classification') }}">
                                @error('classification')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cp_or"
                                    class="col-sm-2 col-form-label @error('cp_or') text-danger @enderror">
                                    CP/OR
                                </label>
                                <select name="cp_or" id="cp_or"
                                    class="form-control @error('cp_or') is-invalid @enderror">
                                    <option value="">Pilih CP/OR</option>
                                    <option value="CP" @if (old('cp_or') == 'CP') selected @endif>CP</option>
                                    <option value="OR" @if (old('cp_or') == 'OR') selected @endif>OR</option>
                                </select>
                                @error('cp_or')
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

                            <div class="form-group">
                                <label for="quantity"
                                    class="col-sm-2 col-form-label @error('quantity') text-danger @enderror">
                                    Jumlah
                                </label>
                                <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                    id="quantity" name="quantity" value="{{ old('quantity') }}">
                                @error('quantity')
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
                placeholder: 'Pilih Jenis Buku',
                allowClear: true
            });

            // bs-custom-file-input
            bsCustomFileInput.init();
        });
    </script>
@endpush
