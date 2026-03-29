@extends('layouts.app')

@section('title', App\Http\Helpers\Helper::trans_json('historyPage.title'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homeRes/Banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aboutRes/HistoryPage.css') }}">
@endpush

@section('content')
<div class="history-page">
    {{-- Banner --}}
    @if($banner && $banner->media)
        <div class="banner darker" style="background-image: url('{{ asset('storage/' . $banner->media->path) }}'); background-size: cover; background-position: center;">
            <div class="banner-content">
                <h1>{{ App\Http\Helpers\Helper::trans_json('historyPage.title') }}</h1>
                <div class="divider"></div>
            </div>
        </div>
    @else
        <div class="banner darker" style="background-color: #1657ac;">
            <div class="banner-content">
                <h1>{{ App\Http\Helpers\Helper::trans_json('historyPage.title') }}</h1>
                <div class="divider"></div>
            </div>
        </div>
    @endif

    {{-- Timeline --}}
    <h2 class="TimelineHeading">{{ App\Http\Helpers\Helper::trans_json('historyPage.timeline') }}</h2>

    @php
        $events = App\Http\Helpers\Helper::trans_json('historyPage.events');
    @endphp

    <div class="timeline-container" x-data="{ isExpandable: window.innerWidth < 768 }"
         x-init="window.addEventListener('resize', () => { isExpandable = window.innerWidth < 768 })">
        <div class="timeline">
            @if(is_array($events))
                @foreach($events as $index => $event)
                    <div class="timeline-event"
                         x-data="{ isOpen: false }"
                         @click="if(isExpandable) isOpen = !isOpen">
                        {{-- Desktop: show marker --}}
                        <template x-if="!isExpandable">
                            <div class="event-marker"></div>
                        </template>
                        <div class="event-content">
                            <h3>{{ $event['year'] ?? '' }}</h3>
                            <h3>
                                {{ $event['title'] ?? '' }}
                                <template x-if="isExpandable">
                                    <span class="toggle-visibility"
                                          :style="isOpen ? 'transform: rotate(180deg); display:inline-block;' : 'display:inline-block;'">
                                        ▼
                                    </span>
                                </template>
                            </h3>
                            <template x-if="!isExpandable || isOpen">
                                <p>{{ $event['description'] ?? '' }}</p>
                            </template>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
