@extends('layouts.backend.master')
@section('title', 'Log Visitors')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Log Visitors</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-center" id="visitorToday">Log Pengunjung {{ $start_month }}
                            {{ $start_year }} - {{ $end_month }} {{ $end_year }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="visitor_datatable" class="table table-head-fixed">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Member</th>
                                    <th>Nama</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Jam Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visitors as $visitor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $visitor->id_member }}</td>
                                        <td>{{ $visitor->name }}</td>
                                        <td>{{ $visitor->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $visitor->created_at->format('H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#visitor_datatable').DataTable();
        });
    </script>
@endpush
