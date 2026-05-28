@extends('layouts.app')

@section('title', App\Http\Helpers\Helper::trans_json('navBar.newsletter'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homeRes/Banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aboutRes/NewsletterPage.css') }}">
@endpush

@section('content')
<div>
    {{-- Banner --}}
    @if($banner && $banner->media)
        <div class="banner darker" style="background-image: url('{{ asset('storage/' . $banner->media->path) }}'); background-size: cover; background-position: center;">
            <div class="banner-content">
                <h1>{{ App\Http\Helpers\Helper::trans_json('newsletterPage.title') }}</h1>
                <div class="divider"></div>
            </div>
        </div>
    @else
        <div class="banner darker" style="background-color: #1657ac;">
            <div class="banner-content">
                <h1>{{ App\Http\Helpers\Helper::trans_json('newsletterPage.title') }}</h1>
                <div class="divider"></div>
            </div>
        </div>
    @endif

    {{-- Newsletter List --}}
    <div class="newsletter-page">
        <p class="newsletter-description">{{ App\Http\Helpers\Helper::trans_json('newsletterPage.description') }}</p>

        @if($newsletters->count() > 0)
            @foreach($newslettersByYear as $year => $yearNewsletters)
                <div class="newsletter-year-group">
                    <h2 class="year-heading">{{ $year }}</h2>
                    <div class="newsletter-list">
                        @foreach($yearNewsletters as $newsletter)
                            <div class="newsletter-row">
                                <div class="newsletter-info">
                                    <div class="file-icon">
                                        @if($newsletter->file_type === 'pdf')
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#e74c3c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2b579a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="newsletter-details">
                                        <span class="newsletter-title">{{ $newsletter->title }}</span>
                                        <span class="newsletter-file-name">{{ $newsletter->file_name }}</span>
                                    </div>
                                </div>
                                <a href="{{ $newsletter->download_url }}" 
                                   class="download-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                    {{ App\Http\Helpers\Helper::trans_json('newsletterPage.download') }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <p class="no-newsletters">{{ App\Http\Helpers\Helper::trans_json('newsletterPage.empty') }}</p>
        @endif
    </div>
</div>
@endsection
