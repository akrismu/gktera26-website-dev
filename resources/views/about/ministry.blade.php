@extends('layouts.app')

@section('title', App\Http\Helpers\Helper::trans_json('navBar.ministry'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homeRes/Banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aboutRes/MinistryPage.css') }}">
@endpush

@section('content')
<div>
    {{-- Banner --}}
    @if($banner && $banner->media)
        <div class="banner darker" style="background-image: url('{{ asset('storage/' . $banner->media->path) }}'); background-size: cover; background-position: center;">
            <div class="banner-content">
                <h1>{{ App\Http\Helpers\Helper::trans_json('navBar.ministry') }}</h1>
                <div class="divider"></div>
            </div>
        </div>
    @else
        <div class="banner darker" style="background-color: #1657ac;">
            <div class="banner-content">
                <h1>{{ App\Http\Helpers\Helper::trans_json('navBar.ministry') }}</h1>
                <div class="divider"></div>
            </div>
        </div>
    @endif

    {{-- Ministry Listing --}}
    <div class="ministry-listing">
        @if(isset($ministries) && $ministries->count() > 0)
            @foreach($ministries as $ministry)
                <a href="{{ route('about.ministry.show', $ministry->slug) }}" class="ministry-item" style="text-decoration: none;">
                    <div class="ministry-content">
                        <h2>{{ $ministry->title }}</h2>
                        <p class="description">{{ $ministry->short_description }}</p>
                    </div>
                    <span class="arrow-icon">&#10132;</span>
                </a>
            @endforeach
        @else
            <p style="text-align: center; color: #888; padding: 40px;">No ministries available yet.</p>
        @endif
    </div>
</div>
@endsection
