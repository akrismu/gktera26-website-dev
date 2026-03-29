<div class="news-listing">
    <template x-for="article in getFilteredArticles()" :key="article.id">
        <div class="news-article" @click="goToDetail(article.slug)">
            <div class="news-image-wrapper" style="float: left; margin-right: 20px;">
                <img :src="article.previewImage.url" :alt="article.title" style="width: 200px; height: 150px; object-fit: cover; border-radius: 8px;">
            </div>

            <div class="news-content-wrapper">
                <h2 x-text="article.title"></h2>
                
                <div class="article-meta">
                    <span class="author">{{ __('By') }} <span x-text="article.author"></span></span>
                    <span class="mx-2">|</span>
                    <span class="date" x-text="formatDate(article.date)"></span>
                </div>

                <p class="article-preview" x-text="article.excerpt"></p>
            </div>
            
            <div style="clear: both;"></div>
        </div>
    </template>

    <div x-show="getFilteredArticles().length === 0" style="text-align: center; padding: 20px;">
        <p>{{ __('No articles found.') }}</p>
    </div>
</div>