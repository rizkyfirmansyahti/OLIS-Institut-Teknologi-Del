@extends('layouts.frontend.master')
@section('title', 'List Buku')
@section('content')
    <div class="title-container">
        <h1 style="font-size: 20px; font-weight: 700; line-height: 36px;">Buku</h1>
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
                    <input class="form-control border rounded-pill" type="text" name="search" placeholder="Cari Buku"
                        value="{{ request('search') }}">
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
    <div class="d-flex justify-content-between mb-3 py-3 px-5">
        <p class="fw-bold">Jumlah Buku: {{ $books->total() }}</p>
        {{ $books->links('components.pagination') }}
    </div>
    <div class="container-fluid py-5 px-5" style="background-color: #E7E7E7;">
        <div class="row justify-content-center mx-5">
            <div class="col-8">
                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-md-6">
                            <a href="{{ route('books.show', $book->slug) }}" style="text-decoration: none; color: black;">
                                <div style="display: flex; flex-direction: column; margin: 0 0 80px auto;">
                                    <div class="sub-card-container-book">
                                        <img src="{{ $book->cover }}" class="img-fluid" alt="{{ $book->title }}"
                                            onerror="this.onerror=null; this.src='https://lancangkuning.com/image/NoImage.png'">
                                        <div>
                                            <table style="border-collapse: collapse;">
                                                <tr>
                                                    <td colspan="2">

                                                        <p
                                                            style="font-size: 16px; font-weight: 600; margin-top: 5px; margin-bottom:5px; color: #1C24E1;">
                                                            {{ $book->title }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="text-align: center; align-items: center; justify-content: center;">
                                                        <i class="fas fa-pencil-alt fa-sm" style="color: #000000;"></i>
                                                    </td>
                                                    <td style="width: 300px;">
                                                        <p style="font-size: 14px; font-weight: 400; margin: 0 5px auto;">
                                                            {{ $book->author }}</p>
                                                    </td>
                                                </tr>
                                                <tr style="margin-top: 3px;">
                                                    <td
                                                        style="text-align: center; align-items: center; justify-content: center; margin-top: 5px;">
                                                        <i class="far fa-file-alt fa-sm" style="color: #000000;"></i>
                                                    </td>
                                                    <td style="width: 300px;">
                                                        <p style="font-size: 14px; font-weight: 400; margin: 0 5px auto;">
                                                            158 Hal</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="text-align: center; align-items: center; justify-content: center;">
                                                        <i class="fas fa-layer-group fa-sm" style="color: #000000;"></i>
                                                    </td>
                                                    <td style="width: 300px;">
                                                        <p style="font-size: 14px; font-weight: 400; margin: 0 5px auto;">
                                                            {{ $book->publisher }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><i>
                                                            <p
                                                                style="font-size: 12px; font-weight: 500; margin: 15px 0 auto;">
                                                                {{ $book->subject }}</p>
                                                        </i></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><i>
                                                            <p style="font-size: 12px; font-weight: 500; margin: 0;">
                                                                ISBN: {{ $book->isbn }}</p>
                                                        </i></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <p style="font-size: 12px; font-weight: 500; margin: 15px 0 auto;">
                                                            {{ $book->available }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="text-book">
                                                            <i class="fas fa-star fa-sm"
                                                                style="color: #FFD43B; margin-right: 2px;"></i>
                                                            <h5
                                                                style="font-size: 12px; font-weight: 400; margin-top: 10px;">
                                                                {{ $book->rating }}</h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div style="position: relative;">
                                        <p
                                            style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: 400; position: absolute; bottom: -10px; margin-left: 30px;">
                                            {{ $book->code }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col-4">
                <p style="font-weight: 700; font-size: 20px; color:#6F410B; margin-left: 30px;">
                    Rating Tertinggi</p>
                <table>
                    @foreach ($bestBooks as $books)
                        <tr>
                            <td style="text-align: center; align-items: center; justify-content: center;">
                                <p style="font-weight: 700; font-size: 50px; color:#6F410B; margin-left: 40px;">
                                    {{ $loop->iteration }}
                                </p>
                            </td>
                            <td style="width: 300px;">
                                <p style="font-size: 16px; font-weight: 600; margin: 20px 0 5px 20px; color: #1C24E1;">
                                    {{ $books->title }}</p>
                                <div class="text-book" style="margin: 5px 0 5px 20px;">
                                    @for ($i = 0; $i < $books->rating; $i++)
                                        <i class="fas fa-star fa-sm" style="color: #FFD43B; margin-right: 2px;"></i>
                                    @endfor
                                    <h5 style="font-size: 12px; font-weight: 400; margin-top: 10px;">
                                        {{ $books->rating }}
                                    </h5>
                                    <h5 style="font-size: 12px; font-weight: 400; margin: 10px 10px auto;">
                                        {{ $books->author }}
                                    </h5>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
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

            // on enter key
            $(document).on('keyup', function(e) {
                console.log(e.key);
            });
        });
    </script>
@endpush
