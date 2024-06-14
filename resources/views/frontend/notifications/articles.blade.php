@extends('layouts.frontend.master')
@section('title', 'List Artikel')
@section('content')
    <div class="title-container">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; line-height: 36px;">Artikel</h1>
        <div style="position: relative;">
            <hr
                style="height: 4px;
            border-top-width: 1px;
            border-color: 3px solid #6F410B;
            margin: 20px auto;
            border-radius: 20px;
            width: 17%;">
        </div>
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
        <p class="fw-bold">Artikel Terbaru Sejak
            {{ $lastUpdated->updated_at->format('d F Y') }}</p>
        {{ $articles->links('components.pagination') }}
    </div>
    <div class="container-fluid py-5" style="background-color: #E7E7E7;">
        <div class="row">
            @foreach ($articles as $article)
                <div class="col-4">
                    <a href="{{ route('articles.show', $article->slug) }}" style="text-decoration: none; color: black;">
                        <div style="display: flex; flex-direction: column;">
                            <div class="sub-card-container-book">
                                <img src="{{ $article->image }}" alt="{{ $article->title }}" class="img-fluid"
                                    onerror="this.onerror=null; this.src='https://lancangkuning.com/image/NoImage.png'">
                                <div>
                                    <table style="border-collapse: collapse;">
                                        <tr>
                                            <td colspan="2">
                                                <p
                                                    style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; margin-top: 5px; margin-bottom:5px; color: #1C24E1;">
                                                    {{ $article->title }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center; align-items: center; justify-content: center;">
                                                <i class="fas fa-user-alt fa-sm" style="color: #000000;"></i>
                                            </td>
                                            <td style="width: 300px;">
                                                <p
                                                    style="font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 400; margin: 0 5px auto;">
                                                    {{ $article->author }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><i>
                                                    <p
                                                        style="font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 500; margin: 15px 0 auto;">
                                                        Artikel</p>
                                                </i></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><i>
                                                    <p
                                                        style="font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 500; margin: 0;">
                                                        Dibuat pada {{ $article->created_at->format('d M Y H:i') }} WIB
                                                    </p>
                                                </i></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p
                                                    style="font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 500; margin: 15px 0 auto;">
                                                    Dilihat Sebanyak {{ $article->views }} Kali</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div style="position: relative;">
                                <p
                                    style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 400; position: absolute; bottom: -10px; margin-left: 30px;">
                                    {{ $article->code }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
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
