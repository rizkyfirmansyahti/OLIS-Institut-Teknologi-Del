@extends('layouts.backend.master')
@section('title', 'Laporan')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Laporan</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h3 class="card-title font-weight-bold">Laporan Pemesanan Buku</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form action="{{ route('backend.reports.export-lending-book', 'lent') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="start_month" class="col-sm-3 col-form-label">Pilih Bulan Awal</label>
                                <div class="col-sm-9">
                                    <input type="text" name="start_date" id="start_month"
                                        class="form-control start_month">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="end_month" class="col-sm-3 col-form-label">Pilih Bulan Akhir</label>
                                <div class="col-sm-9">
                                    <input type="text" name="end_month" id="end_month" class="form-control end_month">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-secondary">Cetak Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h3 class="card-title font-weight-bold">Laporan Peminjaman Buku</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form action="{{ route('backend.reports.export-lending-book', 'returned') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="start_month" class="col-sm-3 col-form-label">Pilih Bulan Awal</label>
                                <div class="col-sm-9">
                                    <input type="text" name="start_month" id="start_month"
                                        class="form-control start_month">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="end_month" class="col-sm-3 col-form-label">Pilih Bulan Akhir</label>
                                <div class="col-sm-9">
                                    <input type="text" name="end_month" id="end_month" class="form-control end_month">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h3 class="card-title font-weight-bold">Laporan Denda Peminjaman Buku</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form action="{{ route('backend.reports.export-lending-book', 'fine') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="start_month" class="col-sm-3 col-form-label">Pilih Bulan Awal</label>
                                <div class="col-sm-9">
                                    <input type="text" name="start_month" id="start_month"
                                        class="form-control start_month">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="end_month" class="col-sm-3 col-form-label">Pilih Bulan Akhir</label>
                                <div class="col-sm-9">
                                    <input type="text" name="end_month" id="end_month" class="form-control end_month">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-secondary">Cetak Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h3 class="card-title font-weight-bold">Laporan Peminjaman CD/DVD</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <form action="{{ route('backend.reports.export-lending-cd-dvd', 'lent') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="start_month" class="col-sm-3 col-form-label">Pilih Bulan Awal</label>
                                <div class="col-sm-9">
                                    <input type="text" name="start_month" id="start_month"
                                        class="form-control start_month">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="end_month" class="col-sm-3 col-form-label">Pilih Bulan Akhir</label>
                                <div class="col-sm-9">
                                    <input type="text" name="end_month" id="end_month"
                                        class="form-control end_month">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-secondary">Cetak Laporan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/plugins/monthSelect/style.css">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/plugins/monthSelect/index.js"></script>
    <script>
        $(document).ready(function() {
            // flatpickr for start month
            $('.start_month').flatpickr({
                disableMobile: "true",
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true,
                        dateFormat: "m/Y",
                        altFormat: "F Y",
                        theme: "material_blue"
                    })
                ]
            });
            // flatpickr for end month
            $('.end_month').flatpickr({
                disableMobile: "true",
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true,
                        dateFormat: "m/Y",
                        altFormat: "F Y",
                        theme: "material_blue"
                    })
                ]
            });
            // flatpickr for start year
            $('.start_year').flatpickr({
                disableMobile: "true",
                plugins: [
                    new monthSelectPlugin({
                        shorthand: true,
                        dateFormat: "Y",
                        altFormat: "Y",
                        theme: "material_blue"
                    })
                ]
            });
            // flatpickr for end year
            $('.end_year').flatpickr({

            });
        });

        function viewReport(form, type, status = null) {
            // get all input elements
            const inputs = form.querySelectorAll('input');
            // get all input values
            const values = Array.from(inputs).map(input => input.value);
            // get all input names
            const names = Array.from(inputs).map(input => input.name);
            // create an object from input names and values
            const data = names.reduce((acc, name, index) => {
                acc[name] = values[index];
                return acc;
            }, {});
            // create a query string from the object
            const queryString = new URLSearchParams(data).toString();
            // add status to the query string if it's not null
            if (status) {
                queryString += `&status=${status}`;
            }
            // redirect to the report page
            window.location.href = `/backend/reports/export-lending-${type}?${queryString}`;
        }
    </script>
@endpush
