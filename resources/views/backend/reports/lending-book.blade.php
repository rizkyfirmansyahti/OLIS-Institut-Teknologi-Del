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
                    <!-- /.card-header -->
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-title">Log Peminjaman Buku {{ $start_month }} {{ $start_year }} -
                                {{ $end_month }} {{ $end_year }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <table id="datatable" class="table table-head-fixed">
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
                                <tbody>
                                    @foreach ($lendings as $lending)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $lending->member->name }}</td>
                                            <td>{{ $lending->book->title }}</td>
                                            </td>
                                            <td>{{ $lending->lending_date }}</td>
                                            <td>{{ $lending->return_date }}</td>
                                            <td>
                                                @if ($lending->status == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($lending->status == 'lent')
                                                    <span class="badge badge-success">Dipinjam</span>
                                                @elseif($lending->status == 'returned')
                                                    <span class="badge badge-info">Dikembalikan</span>
                                                @elseif($lending->status == 'canceled')
                                                    <span class="badge badge-danger">Dibatalkan</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
            $('#datatable').DataTable();
        });
    </script>
@endpush
