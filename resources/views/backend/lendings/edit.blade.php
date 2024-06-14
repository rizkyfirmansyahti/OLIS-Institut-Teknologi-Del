@extends('layouts.backend.master')
@section('title', 'Edit Peminjaman')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.lendings.index', $type) }}">Peminjaman</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form
                        action="{{ route('backend.lendings.update', ['type' => $type, 'lending' => encodeId($lending->id)]) }}"
                        method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h3 class="card-title">Edit Peminjaman</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($type == 'book')
                                <div class="form-group">
                                    <label for="book_id"
                                        class="col-sm-2 col-form-label @error('book_id') text-danger @enderror">
                                        Buku
                                    </label>
                                    <select class="form-control select2 @error('book_id') is-invalid @enderror"
                                        id="book_id" name="book_id">
                                        <option value="">Pilih Buku</option>
                                        @foreach ($books as $book)
                                            <option value="{{ $book->id }}"
                                                {{ old('book_id', $lending->book_id) == $book->id ? 'selected' : '' }}>
                                                {{ $book->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('book_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            @if ($type == 'cd')
                                <div class="form-group">
                                    <label for="cd_id"
                                        class="col-sm-2 col-form-label @error('compact_disk_id') text-danger @enderror">
                                        CD/DVD
                                    </label>
                                    <select class="form-control select2 @error('compact_disk_id') is-invalid @enderror"
                                        id="compact_disk_id" name="compact_disk_id">
                                        <option value="">Pilih CD</option>
                                        @foreach ($compactDisks as $cd)
                                            <option value="{{ $cd->id }}"
                                                {{ old('compact_disk_id', $lending->compact_disk_id) == $cd->id ? 'selected' : '' }}>
                                                {{ $cd->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('compact_disk_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="user_id"
                                    class="col-sm-2 col-form-label @error('user_id') text-danger @enderror">
                                    User
                                </label>
                                <select class="form-control select2 @error('user_id') is-invalid @enderror" id="user_id"
                                    name="user_id">
                                    <option value="">Pilih User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id', $lending->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="return_date"
                                    class="col-sm-2 col-form-label @error('return_date') text-danger @enderror">
                                    Tanggal Pengembalian
                                </label>
                                <input type="date" class="form-control @error('return_date') is-invalid @enderror"
                                    id="return_date" name="return_date"
                                    value="{{ old('return_date', $lending->return_date) }}">
                                @error('return_date')
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
            bsCustomFileInput.init();
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            $('#return_date').flatpickr({
                enableTime: false,
                dateFormat: 'Y-m-d',
            });
        });
    </script>
@endpush
