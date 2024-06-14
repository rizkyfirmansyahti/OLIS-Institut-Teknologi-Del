@extends('layouts.backend.master')
@if ($type == 'rules')
    @section('title', 'Peraturan Perpustakaan')
@elseif($type == 'guidelines')
    @section('title', 'Panduan Pesan Pinjam')
@elseif($type == 'achievements')
    @section('title', 'Penghargaan')
@endif
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">
            @if ($type == 'rules')
                Peraturan Perpustakaan
            @elseif($type == 'guidelines')
                Panduan Pesan Pinjam
            @elseif($type == 'achievements')
                Penghargaan
            @endif
        </li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <x-alert />
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ route('backend.library-archives.create', $type) }}" class="btn btn-primary">Tambah
                                @if ($type == 'rules')
                                    Peraturan
                                @elseif($type == 'guidelines')
                                    Panduan
                                @elseif($type == 'achievements')
                                    Penghargaan
                                @endif
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="archive_datatable" class="table table-head-fixed">
                                <thead>
                                    <tr>
                                        @if ($type == 'rules' || $type == 'guidelines')
                                            <th>#</th>
                                            <th>No. Dokumen</th>
                                            <th>Judul</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        @else
                                            <th>#</th>
                                            <th>Judul</th>
                                            <th>Isi</th>
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            const url = window.location.href;
            const table = $('#archive_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [{
                        data: 'DT_RowIndex',
                        defaultContent: '',
                        orderable: false,
                        searchable: false
                    },
                    @if ($type == 'rules' || $type == 'guidelines')
                        {
                            data: 'number',
                            name: 'number'
                        }, {
                            data: 'title',
                            name: 'title'
                        }, {
                            data: 'active',
                            name: 'active',
                            render: function(data) {
                                return data ? '<span class="badge badge-success">Aktif</span>' :
                                    '<span class="badge badge-danger">Tidak Aktif</span>';
                            }
                        },
                    @else
                        {
                            data: 'title',
                            name: 'title'
                        }, {
                            data: 'excerpt',
                            name: 'excerpt'
                        },
                    @endif {
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                        targets: 0,
                        className: 'text-center',
                        width: '5%',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    @if ($type == 'rules' || $type == 'guidelines')
                        {
                            targets: 4,
                            className: 'text-center',
                            width: '15%',
                            render: function(data, type, row) {
                                console.log(!row.active == 1);
                                var button = '<div class="btn-group">';
                                if (row.active == 0) {
                                    button += `
                                <a class="btn btn-success btn-sm btn-activate" href="${url}/${row.id}/activate">
                                    Gunakan
                                </a>
                            `;
                                }
                                button += `
                            <a class="btn btn-info btn-sm" href="${url}/${row.id}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a class="btn btn-danger btn-sm btn-delete" href="${url}/${row.id}">
                                <i class="fas fa-trash"></i>
                            </a>
                        `;
                                button += '</div>';
                                return button;
                            }
                        }
                    @else
                        {
                            targets: 3,
                            className: 'text-center',
                            orderable: false,
                            render: function(data, type, row) {
                                return `
                            <div class="btn-group">
                                <a class="btn btn-info btn-sm" href="${url}/${row.id}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-warning btn-sm" href="${url}/${row.id}/edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm btn-delete" href="${url}/${row.id}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        `;
                            },
                            width: '15%'
                        }
                    @endif
                ]
            });

            $('#archive_datatable').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                showConfirmationDialog('Are you sure?', 'You won\'t be able to revert this!', 'warning',
                    'Yes, delete it!', (result) => {
                        if (result.isConfirmed) {
                            handleAction(url, 'DELETE', 'Arsip Perpustakaan has been deleted!',
                                'Failed to delete Arsip Perpustakaan!', {}, null, () => {
                                    table.ajax.reload();
                                });
                        }
                    });
            });

            $('#archive_datatable').on('click', '.btn-activate', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                showConfirmationDialog('Are you sure?', 'You won\'t be able to revert this!', 'warning',
                    'Yes, activate it!', (result) => {
                        if (result.isConfirmed) {
                            handleAction(url, 'PUT', 'Arsip Perpustakaan has been activated!',
                                'Failed to activate Arsip Perpustakaan!', {}, null, () => {
                                    table.ajax.reload();
                                });
                        }
                    });
            });
        });
    </script>
@endpush
