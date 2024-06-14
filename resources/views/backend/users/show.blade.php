@extends('layouts.backend.master')
@section('title', 'Detail Anggota')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('backend.users.index') }}">Anggota</a></li>
        <li class="breadcrumb-item active">Detail Anggota</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Anggota</h3>
                        <div class="card-tools">
                            <a href="{{ route('backend.users.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="id_member">ID Anggota</label>
                            <input type="text" name="id_member" id="id_member" class="form-control"
                                value="{{ $user->id_member }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $user->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control"
                                value="{{ $user->email }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="phone">Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ $user->phone }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" class="form-control" rows="5" readonly>{{ $user->address }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="major">Jurusan</label>
                            <input type="text" name="major" id="major" class="form-control"
                                value="{{ $user->major }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="position">Posisi</label>
                            <input type="text" name="position" id="position" class="form-control"
                                value="{{ $user->position }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="lending_limit">Batas Pinjam</label>
                            <input type="text" name="lending_limit" id="lending_limit" class="form-control"
                                value="{{ $user->lending_limit }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="fine">Denda</label>
                            <input type="text" name="fine" id="fine" class="form-control"
                                value="{{ $user->fine }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="lending_count">Jumlah Pinjam</label>
                            <input type="text" name="lending_count" id="lending_count" class="form-control"
                                value="{{ $user->lending_count }}" readonly>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    @endsection
