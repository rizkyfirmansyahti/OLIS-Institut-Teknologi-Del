@extends('layouts.frontend.master')
@section('title', 'Peraturan Perpustakaan')
@section('content')
    <div class="title-container">
        <h1 style="font-size: 20px; font-weight: 700; line-height: 36px;">Peraturan
            Perpustakaan</h1>
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


    <div class="card" style="background-color: #E7E7E7; padding: 40px;">
        <embed type="application/pdf" width="100%" height="600px" id="file">
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var file = document.getElementById('file');
            var fileUrl = '{{ $libraryArchive->file }}';
            file.src = 'https://drive.google.com/viewerng/viewer?embedded=true&url=' + fileUrl;
        });
    </script>
@endpush
