@extends('layouts.frontend.master')
@section('title', 'Penghargaan')
@section('content')
    <div class="container-fluid">
        <div class="title-container">
            <h2 style="color: #6F410B; text-align: center; padding-top: 1px;">Penghargaan</h2>
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
                        <th>Judul Penghargaan</th>
                        <th>Isi Penghargaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($libraryArchives as $libraryArchive)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $libraryArchive->title }}</td>
                            <td>{{ $libraryArchive->excerpt }}</td>
                            <td>
                                <a href="{{ route('library-archives.achievements.show', $libraryArchive->slug) }}"
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
        @if ($libraryArchives->hasPages())
            <div class="d-flex justify-content-center">
                {{ $announcements->links('components.pagination') }}
            </div>
        @endif
    </div>
@endsection
