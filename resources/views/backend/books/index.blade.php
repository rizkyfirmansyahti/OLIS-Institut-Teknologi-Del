@extends('layouts.backend.master')
@section('title', 'Buku')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Buku</li>
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
                        {{-- <h3 class="card-title">Total Buku : {{ $totalBooks }} Judul, {{ $totalCopies }} Eksemplar</h3> --}}
                        <h1 class="card-title"><span class="badge badge-primary">Total Buku: {{ $totalBooks }} Judul</span>
                            <span class="badge badge-info">Total Eksemplar: {{ $totalCopies }}</span>
                        </h1>
                        <div class="card-tools">
                            <div class="d-sm-inline-block justify-content-between">
                                <a href="{{ route('backend.books.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Buku</a>
                                <!-- import button -->
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#importBook"><i class="fas fa-upload"></i> Import</button>
                                <!-- export button -->
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#exportBook"><i class="fas fa-download"></i> Export</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="book_datatable" class="table table-head-fixed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul Buku</th>
                                        <th>Bahasa</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
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
    @include('backend.books.import')
    @include('backend.books.export')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            const url = window.location.href;
            const table = $('#book_datatable').DataTable({
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
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'language',
                        name: 'language'
                    },
                    {
                        data: 'author',
                        name: 'author'
                    },
                    {
                        data: 'publisher',
                        name: 'publisher'
                    },
                    {
                        data: 'year',
                        name: 'year'
                    }, {
                        data: 'action',
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
                }, {
                    targets: 6,
                    className: 'text-center',
                    width: '15%',
                    render: function(data, type, row) {
                        return `
                            <div class="btn-group">
                                <a class="btn btn-info btn-sm" href="${url}/list/${row.slug}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        `;
                    },
                }],
                searching: true,
                order: [
                    [0, 'desc']
                ]
            });

            $('#book_datatable').on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                showConfirmationDialog('Are you sure?', 'You won\'t be able to revert this!', 'warning',
                    'Yes, delete it!', (result) => {
                        if (result.isConfirmed) {
                            handleAction(url, 'DELETE', 'Book has been deleted!',
                                'Failed to delete category!', {}, null, () => {
                                    table.ajax.reload();
                                });
                        }
                    });
            });
        });
    </script>
@endpush
