@extends('layouts.backend.master')
@section('title', 'Profile')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
    </ol>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('backend/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
                        <p class="text-muted text-center">{{ auth()->user()->email }}</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group item">
                                <b>Phone</b> <a class="float-right">{{ auth()->user()->phone }}</a>
                            </li>
                            <li class="list-group item">
                                <b>Address</b> <a class="float-right">{{ auth()->user()->address }}</a>
                            </li>
                            <li class="list-group item">
                                <b>Major</b> <a class="float-right">{{ auth()->user()->major }}</a>
                            </li>
                            <li class="list-group item">
                                <b>Position</b> <a class="float-right">{{ auth()->user()->position }}</a>
                            </li>
                            <li class="list-group item">
                                <b>Lending Limit</b> <a class="float-right">{{ auth()->user()->lending_limit }}</a>
                            </li>
                            <li class="list-group item">
                                <b>Fine</b> <a class="float-right">{{ auth()->user()->fine }}</a>
                            </li>
                            <li class="list-group item">
                                <b>Lending Count</b> <a class="float-right">{{ auth()->user()->lending_count }}</a>
                            </li>
                            <li class="list-group item">
                                <b>Status</b> <a class="float-right">{{ auth()->user()->status }}</a>
                            </li>
                        </ul>
                        <a href="{{ route('profile.edit', auth()->user()->id) }}" class="btn btn-primary btn-block"><b>Edit
                                Profile</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
