<div class="quick-links-box">
    <div class="quick-links-box-content">
        <h2 class="h2blue">{{ App\Http\Helpers\Helper::trans_json('quickLinks.title') }}</h2>
        <p>{{ App\Http\Helpers\Helper::trans_json('quickLinks.description') }}</p>

        <div class="quick-links">
            @if(isset($churches) && count($churches) > 0)
                @foreach($churches as $church)
                    <button 
                        onclick="window.location.href='{{ url('/churches/' . $church->slug) }}'"
                    >
                        {{ $church->name }}
                    </button>
                @endforeach
            @else
                <p>Loading...</p>
            @endif
        </div>

        <div>
            <button
                class="seeMoreButton"
                onclick="window.location.href='{{ url('/churches') }}'"
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
</div>