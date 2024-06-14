@extends('layouts.backend.master')
@section('title', 'Tambah User')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.users.index') }}">User</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.users.store') }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">Tambah User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_member"
                                            class="col-sm-2 col-form-label @error('id_member') text-danger @enderror">
                                            ID Anggota
                                        </label>
                                        <input type="text" class="form-control @error('id_member') is-invalid @enderror"
                                            id="id_member" name="id_member" value="{{ old('id_member') }}">
                                        @error('id_member')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role"
                                            class="col-sm-2 col-form-label @error('role') text-danger @enderror">
                                            Peran
                                        </label>
                                        <select class="form-control @error('role') is-invalid @enderror" id="role"
                                            name="role">
                                            <option value="">Pilih Peran</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    @if (old('role') == $role->name) selected @endif>{{ $role->name }}
                                            @endforeach
                                        </select>
                                        @error('role')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"
                                            class="col-sm-2 col-form-label @error('name') text-danger @enderror">
                                            Nama
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"
                                            class="col-sm-2 col-form-label @error('email') text-danger @enderror">
                                            Email
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password"
                                            class="col-sm-2 col-form-label @error('password') text-danger @enderror">
                                            Password
                                        </label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone"
                                            class="col-sm-2 col-form-label @error('phone') text-danger @enderror">
                                            Telepon
                                        </label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone') }}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address"
                                            class="col-sm-2 col-form-label @error('address') text-danger @enderror">
                                            Alamat
                                        </label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                            id="address" name="address" value="{{ old('address') }}">
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="major"
                                            class="col-sm-2 col-form-label @error('major') text-danger @enderror">
                                            Jurusan
                                        </label>
                                        <select class="form-control @error('major') is-invalid @enderror" id="major"
                                            name="major">
                                            <option value="">Pilih Jurusan</option>
                                            <option value="D3 Teknologi Komputer"
                                                @if (old('major') == 'D3 Teknologi Komputer') selected @endif>D3 Teknologi Komputer
                                            </option>
                                            <option value="D3 Teknologi Informasi"
                                                @if (old('major') == 'D3 Teknologi Informasi') selected @endif>D3 Teknologi Informasi
                                            </option>
                                            <option value="D4 Teknologi Rekayasa Perangkat Lunak"
                                                @if (old('major') == 'D4 Teknologi Rekayasa Perangkat Lunak') selected @endif>D4 Teknologi Rekayasa
                                                Perangkat
                                                Lunak</option>
                                            <option value="S1 Informatika"
                                                @if (old('major') == 'S1 Informatika') selected @endif>S1
                                                Informatika</option>
                                            <option value="S1 Sistem Informasi"
                                                @if (old('major') == 'S1 Sistem Informasi') selected @endif>
                                                S1 Sistem Informasi</option>
                                            <option value="S1 Teknik Elektro"
                                                @if (old('major') == 'S1 Teknik Elektro') selected @endif>S1
                                                Teknik Elektro</option>
                                            <option value="S1 Manajemen Rekayasa"
                                                @if (old('major') == 'S1 Manajemen Rekayasa') selected @endif>S1 Manajemen Rekayasa
                                            </option>
                                            <option value="S1 Teknik Metalurgi"
                                                @if (old('major') == 'S1 Teknik Metalurgi') selected @endif>
                                                S1 Teknik Metalurgi</option>
                                            <option value="S1 Teknik Bioproses"
                                                @if (old('major') == 'S1 Teknik Bioproses') selected @endif>
                                                S1 Teknik Bioproses</option>
                                            <option value="Umum/Lainnya"
                                                @if (old('major') == 'Umum/Lainnya') selected @endif>
                                                Umum/Lainnya</option>
                                        </select>
                                        @error('major')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position"
                                            class="col-sm-2 col-form-label @error('position') text-danger @enderror">
                                            Jabatan
                                        </label>
                                        <input type="text"
                                            class="form-control @error('position') is-invalid @enderror" id="position"
                                            name="position" value="{{ old('position') }}">
                                        @error('position')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status"
                                            class="col-sm-2 col-form-label @error('status') text-danger @enderror">
                                            Status
                                        </label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                            <option value="">Pilih Status</option>
                                            <option value="active" @if (old('status') == 'active') selected @endif>
                                                Aktif</option>
                                            <option value="inactive" @if (old('status') == 'inactive') selected @endif>
                                                Tidak Aktif</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
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
