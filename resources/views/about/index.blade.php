@extends('layouts.app')

@section('title', App\Http\Helpers\Helper::trans_json('aboutPage.title'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homeRes/Banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aboutRes/SinodePage.css') }}">
@endpush

@section('content')
<div>
    {{-- Banner --}}
    @if($banner && $banner->media)
        <div class="banner darker" style="background-image: url('{{ asset('storage/' . $banner->media->path) }}'); background-size: cover; background-position: center;">
            <div class="banner-content">
                <h1>{{ App\Http\Helpers\Helper::trans_json('aboutPage.title') }}</h1>
                <div class="divider"></div>
                <p>{{ App\Http\Helpers\Helper::trans_json('aboutPage.description') }}</p>
            </div>
        </div>
    @else
        <div class="banner darker" style="background-color: #1657ac;">
            <div class="banner-content">
                <h1>{{ App\Http\Helpers\Helper::trans_json('aboutPage.title') }}</h1>
                <div class="divider"></div>
                <p>{{ App\Http\Helpers\Helper::trans_json('aboutPage.description') }}</p>
            </div>
        </div>
    @endif

    {{-- Employee Sections --}}
    <div class="about-page">
        {{-- Chairmen Section --}}
        @if((isset($chairmen) && $chairmen->count() > 0) || (isset($boardMembers) && $boardMembers->count() > 0))
            @if(isset($chairmen) && $chairmen->count() > 0)
                <div class="section">
                    <h2>{{ App\Http\Helpers\Helper::trans_json('aboutPage.chairmen') }}</h2>
                    <div class="employee-grid">
                        @foreach($chairmen as $chairman)
                            <div class="employee-card">
                                <div class="employee-image-wrapper">
                                    @if($chairman->photoMedia)
                                        <img src="{{ asset('storage/' . $chairman->photoMedia->path) }}" alt="Headshot of {{ $chairman->name }}" class="employee-image" />
                                    @else
                                        <img src="{{ asset('images/default-avatar.jpg') }}" alt="{{ $chairman->name }}" class="employee-image" />
                                    @endif
                                </div>
                                <div class="employee-info">
                                    <h3>{{ $chairman->name }}</h3>
                                    <p class="role">{{ $chairman->position }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Board Members / Employees --}}
            @if(isset($boardMembers) && $boardMembers->count() > 0)
                <div class="section">
                    <h2>{{ App\Http\Helpers\Helper::trans_json('aboutPage.employee') }}</h2>
                    <div class="employee-grid">
                        @foreach($boardMembers as $employee)
                            <div class="employee-card">
                                <div class="employee-image-wrapper">
                                    @if($employee->photoMedia)
                                        <img src="{{ asset('storage/' . $employee->photoMedia->path) }}" alt="Headshot of {{ $employee->name }}" class="employee-image" />
                                    @else
                                        <img src="{{ asset('images/default-avatar.jpg') }}" alt="{{ $employee->name }}" class="employee-image" />
                                    @endif
                                </div>
                                <div class="employee-info">
                                    <h3>{{ $employee->name }}</h3>
                                    <p class="role">{{ $employee->position }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
