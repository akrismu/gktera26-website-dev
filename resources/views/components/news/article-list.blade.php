<div class="news-listing">
    <template x-for="article in getFilteredArticles()" :key="article.id">
        <div class="news-article flex flex-col md:flex-row" @click="goToDetail(article.slug)">
            <div class="news-image-wrapper mb-4 md:mb-0 md:mr-5">
                <img :src="article.previewImage.url" :alt="article.title" class="w-full md:w-[200px] h-[200px] md:h-[150px] object-cover rounded-lg">
            </div>

            <div class="news-content-wrapper">
                <h2 x-text="article.title"></h2>
                
                <div class="article-meta flex flex-col md:flex-row md:items-center">
                    <span class="author">{{ __('By') }} <span x-text="article.author"></span></span>
                    <span class="hidden md:inline mx-2">|</span>
                    <span class="date" x-text="formatDate(article.date)"></span>
                </div>

                <p class="article-preview hidden md:block" x-text="article.excerpt"></p>
            </div>
        </div>
    </template>

    <div x-show="getFilteredArticles().length === 0" style="text-align: center; padding: 20px;">
        <p>{{ __('No articles found.') }}</p>
    </div>
</div>