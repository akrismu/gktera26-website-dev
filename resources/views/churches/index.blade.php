@extends('layouts.app')

@section('title', App\Http\Helpers\Helper::trans_json('churchList.title'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/homeRes/Banner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/churches/ChurchesListPage.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
<div>
    {{-- Map Section --}}
    <div class="churches-list-page">
        <div id="map-container" style="height: 600px; width: 100%;"></div>
    </div>

    {{-- Church Story Text --}}
    <div class="church-text">
        <h2>{{ App\Http\Helpers\Helper::trans_json('churchList.title') }}</h2>
        @php
            $storyParagraphs = App\Http\Helpers\Helper::trans_json('churchList.story');
        @endphp
        @if(is_array($storyParagraphs))
            @foreach($storyParagraphs as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        @endif
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const defaultLatitude = -7.3305;
    const defaultLongitude = 110.5084;
    const churches = @json($churchDataForMap);

    const map = L.map('map-container').setView([defaultLatitude, defaultLongitude], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    const customIcon = L.icon({
        iconUrl: '{{ asset("images/churchRes/record.svg") }}',
        className: 'church-icon',
        iconSize: [27, 25],
        iconAnchor: [12, 25],
        popupAnchor: [0, -25],
    });

    const customIconHover = L.icon({
        iconUrl: '{{ asset("images/churchRes/record.svg") }}',
        className: 'church-icon',
        iconSize: [35, 33],
        iconAnchor: [15, 27],
        popupAnchor: [0, -25],
    });

    churches.forEach(function(church) {
        if (!church.latitude || !church.longitude) return;

        const marker = L.marker([church.latitude, church.longitude], {
            icon: customIcon
        }).addTo(map);

        const popupContent = `
            <div class="popup-content">
                ${church.previewImage ? '<img src="' + church.previewImage + '" alt="Church preview" />' : ''}
                <div class="popup-text-block">
                    <h3>${church.name}</h3>
                    <p>${church.short_description || ''}</p>
                </div>
            </div>
        `;

        const popup = L.popup({
            closeButton: false,
            offset: L.point(0, -30)
        }).setContent(popupContent);

        marker.bindPopup(popup);

        marker.on('mouseover', function() {
            this.setIcon(customIconHover);
            this.openPopup();
        });

        marker.on('mouseout', function() {
            this.setIcon(customIcon);
            this.closePopup();
        });

        marker.on('click', function() {
            window.location.href = '/churches/' + church.slug;
        });
    });
});
</script>
@endsection
