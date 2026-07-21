<div class="news-listing">
    <template x-for="(article, index) in getFilteredArticles()" :key="article.id">
        <div class="news-article" :class="index === 0 ? 'news-article--featured' : 'news-article--compact'" @click="goToDetail(article.slug)">
            <div class="news-image-wrapper">
                <img :src="article.previewImage.url" :alt="article.title" class="news-card-image">
                <div class="news-overlay">
                    <div class="news-overlay-content">
                        <h2 x-text="article.title"></h2>

                        <div class="article-meta">
                            <span class="author">{{ __('By') }} <span x-text="article.author"></span></span>
                            <span class="date" x-text="formatDate(article.date)"></span>
                        </div>

                        <p class="article-preview" x-text="article.excerpt"></p>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <div x-show="getFilteredArticles().length === 0" style="text-align: center; padding: 20px;">
        <p>{{ __('No articles found.') }}</p>
    </div>
</div>