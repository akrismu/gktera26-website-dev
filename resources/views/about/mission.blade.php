@extends('layouts.app')

@section('title', App\Http\Helpers\Helper::trans_json('missionPage.title'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homeRes/Banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aboutRes/MissionPage.css') }}">
@endpush

@section('content')
<div class="mission-page">
    {{-- Banner --}}
    @if($banner && $banner->media)
        <div class="banner darker" style="background-image: url('{{ asset('storage/' . $banner->media->path) }}'); background-size: cover; background-position: center;">
            <div class="banner-content">
                <h1>{{ App\Http\Helpers\Helper::trans_json('missionPage.title') }}</h1>
                <div class="divider"></div>
                <p>{{ App\Http\Helpers\Helper::trans_json('missionPage.description') }}</p>
            </div>
        </div>
    @else
        <div class="banner darker" style="background-color: #1657ac;">
            <div class="banner-content">
                <h1>{{ App\Http\Helpers\Helper::trans_json('missionPage.title') }}</h1>
                <div class="divider"></div>
                <p>{{ App\Http\Helpers\Helper::trans_json('missionPage.description') }}</p>
            </div>
        </div>
    @endif

    {{-- Mission Statements --}}
    @php
        $statements = App\Http\Helpers\Helper::trans_json('missionPage.statements');
    @endphp

    @if(is_array($statements))
        @foreach($statements as $statement)
            <section class="mission-section">
                <div class="mission-header">
                    <h2>{{ $statement['title'] ?? '' }}</h2>
                    @if(!empty($statement['description']))
                        <p class="mission-description">{{ $statement['description'] }}</p>
                    @endif
                </div>
                @if(isset($statement['text']) && is_array($statement['text']))
                    <ol class="mission-text">
                        @foreach($statement['text'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ol>
                @endif
            </section>
        @endforeach
    @endif
</div>
@endsection
