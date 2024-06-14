@extends('layouts.backend.master')
@section('title', 'Detail Link Lainnya')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('backend.site-links.index') }}">Link Lainnya</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Link Lainnya</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 col-form-label">
                                Nama Link Lainnya
                            </label>
                            <input type="text" class="form-control" id="name" name="name" readonly
                                value="{{ $siteLink->name }}">
                        </div>

                        <div class="form-group">
                            <label for="url" class="col-sm-2 col-form-label">
                                URL
                            </label>
                            <input type="text" class="form-control" id="url" name="url" readonly
                                value="{{ $siteLink->url }}">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
