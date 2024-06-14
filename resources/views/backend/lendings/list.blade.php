@extends('layouts.backend.master')
@section('title', 'Peminjaman')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Peminjaman</li>
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
                        <div class="card-title">
                            @if ($type == 'book')
                                @if ($status == 'pending')
                                    Pemesanan Buku
                                @elseif($status == 'lent')
                                    Peminjaman Buku
                                @else
                                    Riwayat Peminjaman Buku
                                @endif
                            @else
                                @if ($status == 'pending')
                                    Pemesanan CD/DVD
                                @elseif($status == 'lent')
                                    Peminjaman CD/DVD
                                @else
                                    Riwayat Peminjaman CD/DVD
                                @endif
                            @endif
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="mb-3">
                            <table id="datatable" class="table table-head-fixed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Peminjam</th>
                                        <th>{{ $type == 'book' ? 'Buku' : 'CD/DVD' }}</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        @if (($status == 'pending' && $type == 'book') || ($status == 'lent' && $type == 'cd-dvd'))
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
            const url = '{{ route('backend.lendings.index', ['type' => $type]) }}';
            const type = '{{ $type }}';
            const status = '{{ $status }}';
            const table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('backend.lendings.data', ['type' => $type, 'status' => $status]) }}',
                    data: {
                        type: type,
                        status: status
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        defaultContent: '',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'item',
                        name: 'item'
                    },
                    {
                        data: 'lending_date',
                        name: 'lending_date'
                    },
                    {
                        data: 'return_date',
                        name: 'return_date'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    @if ($status == 'pending' && $type == 'book')
                        {
                            data: 'action',
                            name: 'action'
                        }
                    @endif
                ],
                columnDefs: [{
                        targets: 0,
                        className: 'text-center',
                        width: '5%',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        targets: 5,
                        className: 'text-center',
                        width: '10%',
                        render: function(data, type, row) {
                            var status = '';
                            if (row.status === 'pending') {
                                status = '<span class="badge badge-warning">Pending</span>';
                            } else if (row.status === 'approved') {
                                status = '<span class="badge badge-success">Approved</span>';
                            } else if (row.status === 'rejected') {
                                status = '<span class="badge badge-danger">Rejected</span>';
                            } else if (row.status === 'lent') {
                                status = '<span class="badge badge-primary">Lent</span>';
                            } else if (row.status === 'returned') {
                                status = '<span class="badge badge-info">Returned</span>';
                            }
                            return status;
                        }
                    },
                    @if ($status == 'pending' && $type == 'book')
                        {
                            targets: 6,
                            className: 'text-center',
                            width: '15%',
                            render: function(data, type, row) {
                                var button = '';
                                // dropdown menu
                                if (row.status === 'pending') {
                                    button += `
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Tindakan
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btn-approve" href="${url}/${row.id}/approve">Setujui</a>
                                    <a class="dropdown-item btn-reject" href="${url}/${row.id}/reject">Tolak</a>
                                    <a class="dropdown-item" href="${url}/${row.id}/edit">Edit</a>
                                </div>
                            </div>
                        `;
                                }
                                return button;
                            }
                        }
                    @endif
                ],
                searching: true,
                order: [
                    [0, 'desc']
                ]
            });

            @if ($status == 'pending' && $type == 'book')

                table.on('click', '.btn-delete', function(e) {
                    e.preventDefault();
                    const url = $(this).attr('href');
                    showConfirmationDialog('Are you sure?', 'You won\'t be able to revert this!', 'warning',
                        'Yes, delete it!', (result) => {
                            if (result.isConfirmed) {
                                handleAction(url, 'DELETE', 'Lending has been deleted!',
                                    'Failed to delete lending!', {}, null, () => {
                                        table.ajax.reload();
                                    });
                            }
                        });
                });

                table.on('click', '.btn-approve', function(e) {
                    e.preventDefault();
                    const url = $(this).attr('href');
                    showConfirmationDialog('Are you sure?', 'You won\'t be able to revert this!',
                        'warning',
                        'Yes, approve it!', (result) => {
                            if (result.isConfirmed) {
                                handleAction(url, 'PUT', 'Lending has been approved!',
                                    'Failed to approve lending!', {}, null, () => {
                                        table.ajax.reload();
                                    });
                            }
                        });
                });

                table.on('click', '.btn-reject', function(e) {
                    e.preventDefault();
                    const url = $(this).attr('href');
                    showConfirmationDialog('Are you sure?', 'You won\'t be able to revert this!', 'warning',
                        'Yes, reject it!', (result) => {
                            if (result.isConfirmed) {
                                handleAction(url, 'PUT', 'Lending has been rejected!',
                                    'Failed to reject lending!', {}, null, () => {
                                        table.ajax.reload();
                                    });
                            }
                        });
                });
            @else

                // on row click
                table.on('click', 'tr', function() {
                    console.log('row clicked');
                    const data = table.row(this).data();
                    const url =
                        '{{ route('backend.lendings.show', ['type' => $type, 'lending' => ':id']) }}'
                        .replace(
                            ':id', data.id);
                    openModal(url, '#modalListResult');
                });
            @endif
        });
    </script>
@endpush
