@extends('layouts.frontend_revisi.master')
@section('title', 'Profile')

@section('content')
    <div class="page-content bg-white">
        <div class="content-block">
            <!-- Browse Jobs -->
            <section class="content-inner bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 m-b30">
                            <div class="sticky-top">
                                <div class="shop-account">
                                    <div class="account-detail text-center">
                                        <div class="my-image">
                                            <a href="javascript:void(0);">
                                                <img alt=""
                                                    src="{{ asset('frontend_revisi/images/profile3.jpg') }}">
                                            </a>
                                        </div>
                                        <div class="account-title">
                                            <div class="">
                                                <h4 class="m-b5"><a
                                                        href="javascript:void(0);">{{ auth()->user()->name }}</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-8 m-b30">
                            <div class="shop-bx shop-profile">
                                <form>
                                    <div class="shop-bx-title clearfix">
                                        <h5 class="text-uppercase">My Profile</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="mb-3">
                                                <label for="formcontrolinput5" class="form-label">Nama:</label>
                                                <input type="text" class="form-control" id="formcontrolinput5"
                                                    placeholder="{{ auth()->user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="mb-3">
                                                <label for="formcontrolinput6" class="form-label">NIM:</label>
                                                <input type="text" class="form-control" id="formcontrolinput6"
                                                    placeholder="{{ auth()->user()->id_member }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="mb-3">
                                                <label for="formcontrolinput7" class="form-label">Program Studi:</label>
                                                <input type="text" class="form-control" id="formcontrolinput7"
                                                    placeholder="{{ auth()->user()->major }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btnhover">Save Setting</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Browse Jobs END -->
        </div>
    </div>
@endsection
