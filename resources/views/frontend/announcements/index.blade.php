@extends('layouts.frontend.master')
@section('title', 'Pengumuman')
@section('content')
    <div class="container-fluid">
        <div class="title-container">
            <h2 style="color: #6F410B; text-align: center; padding-top: 1px;">Pengumuman</h2>
            <center>
                <hr style="border-color: #6F410B; margin-bottom: 30px; width: 20%;" />
            </center>
        </div>
    </div>
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Pengumuman</th>
                        <th>Isi Pengumuman</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($announcements as $announcement)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $announcement->title }}</td>
                            <td>{{ \Str::limit($announcement->content, 100) }}</td>
                            <td>
                                <a href="{{ route('announcements.show', $announcement->slug) }}"
                                    class="btn btn-primary btn-sm">Lihat</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($announcements->hasPages())
            <div class="d-flex justify-content-center">
                {{ $announcements->links('components.pagination') }}
            </div>
        @endif
    </div>
@endsection
