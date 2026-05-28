@extends('layouts.app')

@section('title', $ministry->title)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homeRes/Banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aboutRes/MinistryDetailPage.css') }}">
@endpush

@section('content')
<div>
    {{-- Banner --}}
    @if($ministry->bannerMedia)
        <div class="banner darker" style="background-image: url('{{ asset('storage/' . $ministry->bannerMedia->path) }}'); background-size: cover; background-position: center;">
            <div class="banner-content">
                <h1>{{ $ministry->title }}</h1>
                <div class="divider"></div>
            </div>
        </div>
    @else
        <div class="banner darker" style="background-color: #1657ac;">
            <div class="banner-content">
                <h1>{{ $ministry->title }}</h1>
                <div class="divider"></div>
            </div>
        </div>
    @endif

    <div class="ministry-detail-page">
        {{-- Description --}}
        @if($ministry->description)
            <div class="ministry-description">
                {!! $ministry->description !!}
            </div>
        @endif

        {{-- Sub-Departments --}}
        @php
            $subDepts = $ministry->sub_departments;
        @endphp
        @if(is_array($subDepts) && count($subDepts) > 0)
            <div class="sub-departments">
                @foreach($subDepts as $dept)
                    <div class="sub-department">
                        <h3>{{ $dept['title'] ?? '' }}</h3>
                        @if(!empty($dept['description']))
                            <p>{{ $dept['description'] }}</p>
                        @endif
                        @if(isset($dept['programs']) && is_array($dept['programs']) && count($dept['programs']) > 0)
                            <ul>
                                @foreach($dept['programs'] as $program)
                                    <li>{{ is_array($program) ? ($program['program'] ?? '') : $program }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Goals --}}
        @php
            $goals = $ministry->goals;
        @endphp
        @if(is_array($goals) && count($goals) > 0)
            <div class="goals-section">
                <h2>Goals & Projects</h2>
                <ol>
                    @foreach($goals as $goal)
                        <li>{{ is_array($goal) ? ($goal['goal'] ?? '') : $goal }}</li>
                    @endforeach
                </ol>
            </div>
        @endif

        {{-- Image Gallery --}}
        @if($ministry->images && $ministry->images->count() > 0)
            <div class="ministry-gallery">
                <h2>Gallery</h2>
                <div class="ministry-gallery-grid">
                    @foreach($ministry->images as $img)
                        @if($img->media)
                            <img src="{{ asset('storage/' . $img->media->path) }}" alt="{{ $ministry->title }}" />
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
