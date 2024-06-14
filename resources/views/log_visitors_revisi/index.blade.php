<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Responsive Cards</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_revisi/css/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('frontend_revisi/images/olis.png') }}" width="30" height="30" class="mr-2"
                alt="">
            <span class="font-weight-bold d-none d-md-block" style="color: #1a1668">INSTITUT TEKNOLOGI DEL</span>
        </a>
        <h4 class="font-weight-bold" style="color: #1a1668">Log Pengunjung</h4>
    </nav>


    <div class="container mt-4">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('log-visitors.store') }}" method="post" id="form">
                        @csrf
                        <div class="form-group row">
                            <label for="id_member" class="col-sm-3 col-form-label">ID Member</label>
                            <div class="col-sm-9">
                                <input type="text" name="id_member" id="id_member" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" id="name" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <span class="card-title font-weight-bold mt-2 ml-4 mb-0">Hari Ini {{ $visitorToday }} Pengunjung</span>
                <div class="card-body table-responsive">
                    <table id="visitor_datatable" class="table table-striped table-bordered">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            const url = window.location.href;
            const table = $('#visitor_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: url + '/data',
                columns: [{
                        data: null,
                        defaultContent: '',
                        orderable: false,
                        searchable: false,
                        render: function() {
                            return '';
                        },
                        className: 'text-center'
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
                    }
                ],
                order: [
                    [3, 'desc'],
                    [4, 'desc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari Pengunjung"
                },
                drawCallback: function(settings) {
                    var api = this.api();
                    api.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }
            });

            $('#visitor_datatable_filter').addClass('form-inline mb-3');
            $('#visitor_datatable_filter label').addClass('form-group');
            $('#visitor_datatable_filter input')
                .addClass('form-control ml-2')
                .attr('placeholder', 'Cari Pengunjung');

            $('#form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.message === 'error') {
                            alert(response.errors.id_member);
                        } else {
                            $('#name').val(response.user);
                            table.ajax.reload();
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
</body>

</html>
