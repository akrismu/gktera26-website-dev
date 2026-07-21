<div 
    x-data="{
        currentIndex: 0,
        totalArticles: {{ isset($latestNews) ? count($latestNews) : 0 }},
        showControls: {{ isset($showControls) ? ($showControls ? 'true' : 'false') : 'true' }},
        
        handleNext() {
            this.currentIndex = (this.currentIndex + 1) % this.totalArticles;
        },
        
        handlePrevious() {
            this.currentIndex = (this.currentIndex - 1 + this.totalArticles) % this.totalArticles;
        },
        
        // Mimic logic for shownImages class
        get containerClass() {
             if (this.totalArticles === 1) return 'one-slide';
             if (this.totalArticles === 2) return 'two-slides';
             return '';
        }
    }"
    class="news-container"
    :class="containerClass"
>
    <div class="news-carousel">
        @if(isset($latestNews) && count($latestNews) > 0)
            @foreach($latestNews as $article)
                <div 
                    class="news-block"
                    onclick="window.location.href='{{ route('news.show', $article->slug) }}'"
                    :style="'transform: translateX(-' + (currentIndex * 105) + '%)'"
                >
                    <div class="news-image-container">
                        <img 
                            src="{{ $article->featuredMedia ? asset('storage/' . $article->featuredMedia->path) : ($article->previewMedia ? asset('storage/' . $article->previewMedia->path) : asset('images/homeRes/gkjtu-logo.jpg')) }}"
                            alt="{{ $article['title'] }}"
                        />
                    </div>
                    <div class="news-info">
                        <h3>{{ $article['title'] }}</h3>
                        <div class="news-meta">
                            <span class="news-author">{{ $article->author ?? 'Admin' }}</span>
                            <span class="news-divider">&middot;</span>
                            <span class="news-date">
                                {{ $article->published_at ? $article->published_at->locale('id')->translatedFormat('d F Y') : '' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{-- Navigation & See More --}}
    <div class="navigation" x-show="showControls">
        <div class="dummyDiv"></div>
        
        <div class="news-navigation">
            <button @click="handlePrevious" class="navigation-button">
                <img src="{{ asset('images/newsRes/arrow-white.png') }}" alt="arrow" width="15px"/>
            </button>
            <button @click="handleNext" class="navigation-button">
                <img src="{{ asset('images/newsRes/arrow-white.png') }}" alt="arrow" id="nexzImg" width="15px"/>
            </button>
        </div>

        {{-- SeeMoreButton Component Logic (Reused) --}}
        <div>
            <button
                class="seeMoreButton"
                onclick="window.location.href='{{ url('/news') }}'"
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