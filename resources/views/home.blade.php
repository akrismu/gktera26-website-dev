@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homeRes/Banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homeRes/StorySection.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homeRes/QuickLinksBox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homeRes/NewsCards.css') }}">
@endpush

@section('content')
    <div class="home-page">
        @include('components.home.banner')

        @include('components.home.story-section')

        @include('components.home.quick-links')

        @include('components.home.news-cards')
    </div>
@endsection