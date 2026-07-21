@extends('layouts.app')

@section('title', $news->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homeRes/Banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homeRes/NewsCards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsRes/NewsDetailPage.css') }}">
@endpush

@section('content')
<div class="news-detail-wrapper">
    {{-- Banner --}}
    @php
        $bannerUrl = $news->bannerMedia
            ? asset('storage/' . $news->bannerMedia->path)
            : null;
    @endphp
    <div class="banner darker" style="{{ $bannerUrl ? "background-image: url('{$bannerUrl}'); background-size: cover; background-position: center;" : 'background-color: #1657ac;' }}">
        <div class="banner-content">
            <h1>{{ $news->title }}</h1>
            <div class="divider"></div>
        </div>
    </div>

    {{-- Article content --}}
    <div class="news-detail-page">
        <p style="color: #888; margin-bottom: 1.5rem;">
            {{ $news->author ?? 'Admin' }} &mdash;
            {{ $news->published_at ? $news->published_at->locale('id')->translatedFormat('d F Y') : '' }}
        </p>

        <div class="news-content">
            {!! $news->content !!}
        </div>

        {{-- Image gallery --}}
        @if($news->images && $news->images->count() > 0)
            <div class="news-images">
                @foreach($news->images as $newsImage)
                    @if($newsImage->media)
                        <div class="image-container">
                            <img
                                src="{{ asset('storage/' . $newsImage->media->path) }}"
                                class="news-article-image"
                                alt="News Article image"
                            />
                            @if($newsImage->media->description)
                                <em class="image-description">{{ $newsImage->media->description }}</em>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        @if(isset($relatedNews) && $relatedNews->count() > 0)
            <section class="related-news-section">
                <div class="related-news-header">
                    <h2>Related News</h2>
                    <p>Berita lain yang mungkin kamu suka</p>
                </div>

                <div class="related-news-header">
                    @include('components.home.news-cards', ['latestNews' => $relatedNews, 'showControls' => true])
                </div>
            </section>
        @endif
    </div>
</div>
@endsection