@extends('layouts.backend.master')
@section('title', 'Riwayat Peminjaman')
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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="lending_datatable" class="table table-head-fixed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Peminjam</th>
                                    <th>Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
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
        var url = window.location.href;
        $(document).ready(function() {
            const table = $('#lending_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
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
                    }, {
                        data: 'return_date',
                        name: 'return_date'
                    }, {
                        data: 'status',
                        name: 'status'
                    }
                ],
                columnDefs: [{
                    targets: 0,
                    className: 'text-center',
                    width: '5%',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }]

            });

            $('#lending_datatable').on('click', '.btn-delete', function(e) {
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
        });
    </script>
@endpush
