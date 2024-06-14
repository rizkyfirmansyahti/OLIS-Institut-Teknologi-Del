@extends('layouts.frontend.master')
@section('title', 'Profile')
@section('content')
    <div class="container-fluid">
        <div class="title-container">
            <h2 style="color: #6F410B; text-align: center; padding-top: 1px;">Profil</h2>
            <center>
                <hr style="border-color: #6F410B; margin-bottom: 30px; width: 20%;" />
            </center>
        </div>

    </div>
    <div class="card" style="background-color: #E7E7E7; padding: 40px;">

        <div class="d-flex justify-content-between">
            <div style="align-self: center;"> <!-- Mengatur teks profil -->
                <p><strong>Nama :</strong> {{ auth()->user()->name }}</p>
                <hr style="border-color: #6F410B;">
                <p><strong>NIM :</strong> {{ auth()->user()->id_member }}</p>
                <hr>
                <p><strong>Program Studi :</strong> {{ auth()->user()->major }}</p>
                <hr>
            </div>
            <div>
                <div class="d-flex justify-content-center mb-2">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
                </div>
                <img src="{{ asset('dist/img/profil2.JPG') }}" style="max-width: 180px; ">
            </div>
        </div>
    </div>

@endsection
