@extends('layouts.frontend.master')
@section('title', 'List CD/DVD')
@section('content')
    <div class="title-container">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; line-height: 36px;">CD/DVD</h1>
        <hr
            style="height: 4px;
        border-top-width: 1px;
        border-color: 3px solid #6F410B;
        margin: 20px auto;
        border-radius: 20px;
        width: 17%;">
    </div>
    <div class="d-flex justify-content-end align-items-center">
        <div class="me-3">
            <select class="form-select border rounded-pill" placeholder="Filter Buku">
                <option selected>Filter Buku</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="ms-3">
            <div class="input-group">
                <input class="form-control border rounded-pill" type="text" placeholder="Cari Buku">
                <span class="input-group-append" style="margin-left: -40px;">
                    <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5"
                        type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3 p-3">
        <p class="fw-bold">CD/DVD Terbaru Sejak
            {{ $lastUpdated->updated_at->format('d F Y') }}</p>
        {{ $compactDisks->links('components.pagination') }}
    </div>
    <div class="container-fluid py-5" style="background-color: #E7E7E7;">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @foreach ($compactDisks as $cd)
                        <div class="col-md-4">
                            <a href="{{ route('compact-disks.show', encodeId($cd->id)) }}"
                                style="text-decoration: none; color: black;">
                                <div style="display: flex; flex-direction: column;">
                                    <div class="sub-card-container-book">
                                        <img src="{{ asset('dist/img/cd.PNG') }}" alt="{{ $cd->title }}"
                                            class="img-fluid"
                                            onerror="this.onerror=null; this.src='https://lancangkuning.com/image/NoImage.png'">
                                        <div>
                                            <table style="border-collapse: collapse;">
                                                <tr>
                                                    <td colspan="2">
                                                        <p
                                                            style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; margin-top: 5px; margin-bottom:5px; color: #1C24E1;">
                                                            CHIP 12/2006</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="text-align: center; align-items: center; justify-content: center;">
                                                        <i class="fas fa-map-marker-alt fa-sm" style="color: #000000;"></i>
                                                    </td>
                                                    <td style="width: 300px;">
                                                        <p
                                                            style="font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 400; margin: 0 5px auto;">
                                                            Lt. 1</p>
                                                    </td>
                                                </tr>
                                                <tr style="margin-top: 3px;">
                                                    <td
                                                        style="text-align: center; align-items: center; justify-content: center; margin-top: 5px;">
                                                        <i class="fas fa-calendar-alt fa-sm" style="color: #000000;"></i>
                                                    </td>
                                                    <td style="width: 300px;">
                                                        <p
                                                            style="font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 400; margin: 0 5px auto;">
                                                            2011-08-09</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><i>
                                                            <p
                                                                style="font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 500; margin: 15px 0 auto;">
                                                                DVD</p>
                                                        </i></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><i>
                                                            <p
                                                                style="font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 500; margin: 0;">
                                                                ID MASTER: 116</p>
                                                        </i></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div style="position: relative;">
                                        <p
                                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 400; position: absolute; bottom: -10px; margin-left: 30px;">
                                            TB023.0367</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            let images = document.querySelectorAll('img');
            images.forEach((img) => {
                let fileUrl = img.src;
                if (fileUrl.includes('drive.google.com')) {
                    var fileId = fileUrl.split('=')[1];
                    fileId = fileId.split('&')[0];
                    img.src = `https://drive.google.com/thumbnail?id=${fileId}`;
                }
            });
        });
    </script>
@endpush
