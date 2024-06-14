@extends('layouts.frontend_revisi.master')
@section('title', 'OLIS | Login')
@section('content')
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="dz-bnr-inr overlay-secondary-dark dz-bnr-inr-sm"
            style="background-image:url('{{ asset('frontend_revisi/images/header_2.jpg') }}');">
            <div class="container">
                <div class="dz-bnr-inr-entry">
                    <h1>LOGIN</h1>
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/"> Beranda</a></li>
                            <li class="breadcrumb-item">LOGIN</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- inner page banner End-->
        <section class="content-inner shop-account">
            <!-- Product -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 mb-4">
                        <div class="login-area">
                            <div class="tab-content nav">
                                <form id="login" class="tab-pane active col-12" action="{{ route('login') }}"
                                    method="post">
                                    @csrf
                                    <x-alert />
                                    <h4 class="text-secondary">LOGIN</h4>
                                    @if (session('status'))
                                        <div class="alert alert-danger">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                    <div class="mb-4">
                                        <label for="id_member"
                                            class="form-label @error('id_member') text-danger @enderror">ID Member
                                            *</label>
                                        <input name="id_member" id="id_member" required class="form-control"
                                            placeholder="ID Member" type="text" value="{{ old('id_member') }}">
                                        @error('id_member')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="password"
                                            class="form-label @error('password') text-danger @enderror">PASSWORD *</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Password" required>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="text-left">
                                        <button class="btn btn-primary btnhover me-2" type="submit">login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product END -->
        </section>


    </div>
@endsection
