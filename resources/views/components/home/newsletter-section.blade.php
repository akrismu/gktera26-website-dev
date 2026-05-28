@if(isset($latestNewsletters) && $latestNewsletters->count() > 0)
<div class="newsletter-home-box">
    <h2 class="h2blue">{{ App\Http\Helpers\Helper::trans_json('newsletterPage.title') }}</h2>
    <p>{{ App\Http\Helpers\Helper::trans_json('newsletterPage.description') }}</p>

    <div class="newsletter-home-items">
        @foreach($latestNewsletters as $newsletter)
            <a href="{{ $newsletter->download_url }}" class="newsletter-home-card">
                <span class="newsletter-home-year">{{ $newsletter->year }}</span>
                <span class="newsletter-home-title">{{ $newsletter->title }}</span>
                <img src="{{ asset('images/homeRes/arrow.png') }}" alt="Download" class="arrowImage"/>
            </a>
        @endforeach
    </div>

    <div>
        <button
            class="seeMoreButton"
            onclick="window.location.href='{{ route('about.newsletters') }}'"
            x-data="{ 
                arrowSrc: '{{ asset('images/homeRes/arrow.png') }}',
                arrowDefault: '{{ asset('images/homeRes/arrow.png') }}',
                arrowHover: '{{ asset('images/homeRes/arrow-blue.png') }}'
            }"
            @mouseenter="arrowSrc = arrowHover"
            @mouseleave="arrowSrc = arrowDefault"
        >
            <p class="seeMore">{{ App\Http\Helpers\Helper::trans_json('seeMoreBtn') }}</p>
            <img :src="arrowSrc" alt="Arrow" class="arrowImage"/>
        </button>
    </div>
</div>
@endif
