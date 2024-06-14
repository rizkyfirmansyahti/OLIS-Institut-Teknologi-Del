@extends('layouts.backend.master')
@section('title', 'Tambah Link Lainnya')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.site-links.index') }}">Link Lainnya</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.site-links.store') }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Tambah Link Lainnya</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 col-form-label @error('name') text-danger @enderror">
                                    Nama Link Lainnya
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="url" class="col-sm-2 col-form-label @error('url') text-danger @enderror">
                                    URL
                                </label>
                                <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                                    name="url" value="{{ old('url') }}">
                                @error('url')
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
