@extends('layouts.backend.master')
@section('title', 'Dashboard')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="text-bold">{{ date('l, Y-m-d H:i:s') }}</h2>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-bold text-center">Pengunjung Hari Ini</h4>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <span class="text-bold"
                                        style="font-size: 50px; color: #20A9C7">{{ $visitorToday }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-bold text-center">Total Peminjaman</h4>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <span class="text-bold"
                                        style="font-size: 50px; color: #20A9C7">{{ $totalLending }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-bold text-center">Pemesanan</h4>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <span class="text-bold"
                                        style="font-size: 50px; color: #20A9C7">{{ $totalLendingByUser }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-bold text-center">Peminjaman</h4>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <span class="text-bold"
                                        style="font-size: 50px; color: #20A9C7">{{ $totalLendingByAdmin }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <!-- pengumuman -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-bold">Pengumuman</h4>
                    </div>
                    <div class="card-body">
                        <center>
                            <a href="{{ route('backend.announcements.create') }}"
                                class="btn btn-primary text-center d-inline-flex align-items-center justify-content-center">
                                <i class="fas fa-plus mr-2"></i>
                                <h5 class="mb-0">Tambah Pengumuman</h5>
                            </a>
                        </center>
                        <div class="mt-3">
                            @foreach ($announcements as $announcement)
                                <div class="row">
                                    <div class="col-9">
                                        <span class="text-bold">{{ $announcement->title }}</span>
                                    </div>
                                    <div class="col-3">
                                        <span class="text-muted">{{ $announcement->created_at->format('d M Y') }}</span>
                                        <a href="{{ route('backend.announcements.edit', encodeId($announcement->id)) }}"
                                            class="text-primary"><u>Edit</u></a> |
                                        <a href="javascript:void(0)"
                                            onclick="handleDelete('{{ route('backend.announcements.destroy', encodeId($announcement->id)) }}', 'Pengumuman berhasil dihapus', 'Gagal menghapus pengumuman', {}, null, () => { window.location.reload() })"
                                            class="text-danger"><u>Hapus</u></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('backend.announcements.index') }}" class="btn btn-primary">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
