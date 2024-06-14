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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('backend.log-visitors.store') }}" method="post" id="form">
                            @csrf
                            <div class="form-group row">
                                <label for="id_member" class="col-sm-3 col-form-label">ID Member</label>
                                <div class="col-sm-9">
                                    <input type="text" name="id_member" id="id_member" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" id="visitorToday">Hari Ini {{ $visitorToday }}</h3>
                        <div class="card-tools">
                            <div class="d-flex justify-content-end">
                                <div class="mr-2">
                                    <!-- filter dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-filter"></i>
                                            Filter Pengunjung
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <div class="form-group mb-2">
                                                <input type="text" class="form-control" id="start_date"
                                                    placeholder="Tanggal Awal">
                                            </div>
                                            <div class="form-group mb-2">
                                                <input type="text" class="form-control" id="end_date"
                                                    placeholder="Tanggal Akhir">
                                            </div>
                                            <div class="form-group mb-2 d-flex justify-content-end">
                                                <button class="btn btn-primary btn-sm" id="filter">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end filter dropdown -->
                                <!--begin::Search-->
                                <div class="input-group input-group-lg" style="width: 200px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">
                                </div>
                            </div>
                        </div>
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
            const url = window.location.href;
            const table = $('#visitor_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: url + '/data',
                columns: [{
                        data: 'DT_RowIndex',
                        defaultContent: '',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user.id_member',
                        name: 'user.id_member'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'date_in',
                        name: 'date_in'
                    },
                    {
                        data: 'time_in',
                        name: 'time_in'
                    },
                ],
                searching: false,
                lengthChange: false,
                columnDefs: [{
                    targets: 0,
                    className: 'text-center',
                    width: '5%',
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }],
                order: [
                    [3, 'desc'],
                    [4, 'desc']
                ]
            });

            $('#filter').on('click', function() {
                const start_date = $('#start_date').val();
                const end_date = $('#end_date').val();
                table.ajax.url(url + `?start_date=${start_date}&end_date=${end_date}`).load();
            });

            $('#start_date').flatpickr({
                altInput: true,
                altFormat: 'd-m-Y',
                dateFormat: 'Y-m-d',
            });

            $('#end_date').flatpickr({
                altInput: true,
                altFormat: 'd-m-Y',
                dateFormat: 'Y-m-d',
            });

            $('input[name="table_search"]').on('keyup', function() {
                table.search(this.value).draw();
            });

            // form submit
            $('#form').on('submit', function(e) {
                e.preventDefault();
                const id_member = $('#id_member').val();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: {
                        id_member: id_member
                    },
                    success: function(response) {
                        $('#name').val(response.user);
                        $('#visitorToday').text(`Hari Ini ${response.visitorToday}`);
                        table.ajax.reload();
                    }
                });
            });
        });
    </script>
@endpush
