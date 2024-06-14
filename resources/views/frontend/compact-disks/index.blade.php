@extends('layouts.frontend.master')
@section('title', 'List CD/DVD')
@section('content')
    <div class="title-container">
        <h1 style="font-size: 20px; font-weight: 700; line-height: 36px;">CD/DVD</h1>
        <hr
            style="height: 4px;
        border-top-width: 1px;
        border-color: 3px solid #6F410B;
        margin: 20px auto;
        border-radius: 20px;
        width: 17%;">
    </div>
    <div>
        <form action="" class="d-flex justify-content-end align-items-center px-3" method="GET">
            <div class="ms-3">
                <div class="input-group">
                    <input class="form-control border rounded-pill" type="text" placeholder="Cari CD/DVD">
                    <span class="input-group-append" style="margin-left: -40px;">
                        <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5"
                            type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </form>
    </div>
    <div class="d-flex justify-content-end mb-3 p-3">
        {{ $compactDisks->links('components.pagination') }}
    </div>
    <div class="container-fluid py-5 px-5" style="background-color: #E7E7E7;">
        <div class="row justify-content-center mx-5">
            <div class="col-12">
                <div class="row">
                    @foreach ($compactDisks as $cd)
                        <div class="col-md-4">
                            <a href="{{ route('compact-disks.show', encodeId($cd->id)) }}"
                                style="text-decoration: none; color: black;">
                                <div style="display: flex; flex-direction: column;">
                                    <div class="sub-card-container-book">
                                        <img src="{{ $cd->cover }}" alt={{ $cd->title }}
                                            onerror="this.onerror=null; this.src='{{ asset('frontend/dist/img/cd.png') }}'">
                                        <div>
                                            <table style="border-collapse: collapse;">
                                                <tr>
                                                    <td colspan="2">
                                                        <p
                                                            style="font-size: 16px; font-weight: 600; margin-top: 5px; margin-bottom:5px; color: #1C24E1;">
                                                            {{ $cd->title }}</p>
                                                    </td>
                                                </tr>
                                                <tr style="margin-top: 3px;">
                                                    <td
                                                        style="text-align: center; align-items: center; justify-content: center; margin-top: 5px;">
                                                        <i class="fas fa-calendar-alt fa-sm" style="color: #000000;"></i>
                                                    </td>
                                                    <td style="width: 300px;">
                                                        <p style="font-size: 14px; font-weight: 400; margin: 0 5px auto;">
                                                            {{ $cd->year }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fas fa-user fa-sm" style="color: #000000;"></i>
                                                    </td>
                                                    <td style="width: 300px;">
                                                        <p style="font-size: 12px; font-weight: 500; margin: 15px 0 auto;">
                                                            {{ $cd->author }}</p>
                                                    </td>
                                                    <p style="font-size: 14px; font-weight: 400; margin: 0 5px auto;">
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <!-- cd/dvd -->
                                                        <i class="fas fa-compact-disc fa-sm" style="color: #000000;"></i>
                                                    </td>
                                                    <td style="width: 300px;">
                                                        <p style="font-size: 12px; font-weight: 500; margin: 15px 0 auto;">
                                                            {{ $cd->cd_dvd }}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div style="position: relative;">
                                        <p
                                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 400; position: absolute; bottom: -10px; margin-left: 30px;">
                                            {{ $cd->code }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
