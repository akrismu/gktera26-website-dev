@extends('layouts.app')

@section('title', $church->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homeRes/Banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/churches/ChurchDetailPage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homeRes/NewsCards.css') }}">
@endpush

@section('content')
<div class="church-detail-page">
    {{-- Banner --}}
    @php
        $bannerUrl = $church->bannerMedia
            ? asset('storage/' . $church->bannerMedia->path)
            : ($church->previewMedia
                ? asset('storage/' . $church->previewMedia->path)
                : null);
    @endphp
    @if($bannerUrl)
        <div class="church-banner" style="background-image: url('{{ $bannerUrl }}'); background-size: cover; background-position: center center;">
            <div class="banner-content">
                <h1>{{ $church->name }}</h1>
                <div class="divider"></div>
            </div>
        </div>
    @endif

    {{-- Detail Content --}}
    <div class="church-detail-content">
        <div class="church-detail-text">
            <h1>{{ $church->name }}</h1>

            <h2>{{ App\Http\Helpers\Helper::trans_json('churchPages.history') }}</h2>
            <div class="church-description">
                {!! $church->description !!}
            </div>

            <h2>{{ App\Http\Helpers\Helper::trans_json('churchPages.service') }}</h2>
            @if($church->services && $church->services->count() > 0)
                @foreach($church->services as $service)
                    <p>{{ $service->service }}</p>
                @endforeach
            @else
                <p>No services available</p>
            @endif

            <h2>{{ App\Http\Helpers\Helper::trans_json('churchPages.contact') }}</h2>
            @if($church->contact)
                <p>{{ $church->contact->name }}</p>
                <p>{{ $church->contact->phone }}</p>
                <p>{{ $church->contact->address }}</p>
            @else
                <p>No contact information available</p>
            @endif
        </div>

        {{-- Image Gallery --}}
        @if($church->images && $church->images->count() > 0)
            <div class="church-images-section">
                <div class="church-images-grid" x-data="{ dimensions: {} }">
                    @foreach($church->images as $img)
                        @if($img->media)
                            <div class="image-card">
                                <div class="image-card-wrapper landscape">
                                    <img
                                        src="{{ asset('storage/' . $img->media->path) }}"
                                        alt="Church image"
                                        class="image-card-img"
                                    />
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Latest News Cards (outside church-detail-page so it renders full-width like on home) --}}
{{-- @if(isset($latestNews) && count($latestNews) > 0)
    @include('components.home.news-cards', ['latestNews' => $latestNews])
@endif --}}
@endsection
