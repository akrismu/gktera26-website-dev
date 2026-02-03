{{-- 
    DATA EXPECTATIONS:
    $imgUrl: String (URL for the image) - Pass this from your Controller.
--}}

<div class="story">
    <div>
        <h2 class="h2blue">{{ Awcodes\Curator\Support\Helpers::trans_json('storySection.title') }}</h2>
        <p>{{ Awcodes\Curator\Support\Helpers::trans_json('storySection.description') }}</p>
        
        <div class="container">
            <div>
                <div class="story-card" onclick="window.location.href='{{ url('/about/history') }}'">
                    <h3>{{ Awcodes\Curator\Support\Helpers::trans_json('storySection.storyTitle') }}</h3>
                    <p>{{ Awcodes\Curator\Support\Helpers::trans_json('storySection.story') }}</p>
                    <p class="moreButton">{{ Awcodes\Curator\Support\Helpers::trans_json('storySection.more') }}</p>
                </div>

                <button 
                    class="seeMoreButton"
                    onclick="window.location.href='{{ url('/about/history') }}'"
                    x-data="{ 
                        arrowSrc: '{{ asset('images/homeRes/arrow.png') }}',
                        arrowDefault: '{{ asset('images/homeRes/arrow.png') }}',
                        arrowHover: '{{ asset('images/homeRes/arrow-blue.png') }}'
                    }"
                    @mouseenter="arrowSrc = arrowHover"
                    @mouseleave="arrowSrc = arrowDefault"
                >
                    <p class="seeMore">{{ Awcodes\Curator\Support\Helpers::trans_json('seeMoreBtn') }}</p>
                    <img :src="arrowSrc" alt="Arrow" class="arrowImage"/>
                </button>
            </div>

            <div class="story-image">
                @foreach ($imgUrl as $img)
                    <img src="{{ $img->media->url }}" alt="Church Activity" />
                @endforeach
                {{-- @else  --}}
                    {{-- <div class="loading-placeholder">Loading...</div>
                @endif --}}
            </div>
        </div>
    </div>
</div>