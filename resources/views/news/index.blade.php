@extends('layouts.app')

@section('title', 'News')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/newsRes/NewsBlock.css') }}">
@endpush

@section('content')
    <div class="news-page" 
         x-data="newsPageHandler({{ Js::from($newsArticles) }})">
         
        @include('components.news.filter-bar')

        @include('components.news.article-list')
        
    </div>
    @include('components.news.logic-script')
@endsection