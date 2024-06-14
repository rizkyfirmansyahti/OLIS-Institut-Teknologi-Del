@extends('layouts.frontend.master')
@section('title', 'Link Link Lainnya')
@section('content')
    <div class="title-container">
        <h2 style="color: #6F410B; text-align: center; padding-top: 1px;">Link Link Lainnya</h2>
        <center>
            <hr style="border-color: #6F410B; margin-bottom: 30px; width: 20%;">
        </center>
    </div>

    <div class="card" style="background-color: #E7E7E7; padding: 20px;">
        <div class="card-container-link">
            @foreach ($siteLinks as $siteLink)
                <div class="card-link">
                    <h2><a href="{{ $siteLink->url }}">{{ $siteLink->name }}</a></h2>
                </div>
            @endforeach
        </div>
    </div>
@endsection
