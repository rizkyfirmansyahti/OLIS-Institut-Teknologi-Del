@extends('layouts.frontend.master')
@section('title', $compactDisk->title)
@section('content')
    <div class="title-container">
        <h2 style="font-size: 20px; font-weight: 700; line-height: 36px; margin-left: 41px; margin-bottom: 3px;">
            {{ $compactDisk->title }}</h2>
        <p style="font-size: 20px; font-weight: 500; line-height: 30px; margin-left: 41px; color: #494646; margin-top: 0;">
            {{ $compactDisk->author }}</p>
        <hr style="border-color: black; width: 95%; margin: 0 auto;">
    </div>
    <div class="container-fluid py-5" style="background-color: #E7E7E7;">
        <div class="row">
            <div class="col-4" style="display: flex; flex-direction: column; align-items: center;">
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <img style="height: 362px; width: 259px" src="{{ $compactDisk->cover }}" alt={{ $compactDisk->title }}
                        onerror="this.onerror=null; this.src='{{ asset('frontend/dist/img/cd.png') }}'">
                </div>
            </div>
            <div class="col-4">
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Kode</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $compactDisk->code }}</p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Judul</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $compactDisk->title }}
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Subjek</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $compactDisk->subject }}
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Pengarang</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $compactDisk->author }}
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Deskipsi</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $compactDisk->description }}</p>
                </div>
            </div>
            <div class="col-4">
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Jurusan</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $compactDisk->major }}</p>
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">CD/DVD</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $compactDisk->type }}</p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Tahun</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $compactDisk->year }}
                    </p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Penerbit</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $compactDisk->publisher }}</p>
                </div>
                <div style="margin: 0 0 8px auto;">
                    <p style="font-weight: 700; margin-bottom: 3px;">Sumber</p>
                    <p style="font-weight: 400; margin-top: 0;">
                        {{ $compactDisk->source }}</p>
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

            // on enter key
            $(document).on('keyup', function(e) {
                console.log(e.key);
            });
        });
    </script>
@endpush
