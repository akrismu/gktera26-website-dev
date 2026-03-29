<script>
    function newsPageHandler(initialArticles) {
        return {
            articles: initialArticles,
            
            showFilterDropdown: false,
            sortOrder: 'desc',

            toggleSort() {
                this.sortOrder = this.sortOrder === 'desc' ? 'asc' : 'desc';
                this.showFilterDropdown = false;
            },

            formatDate(dateString) {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return new Date(dateString).toLocaleDateString('{{ app()->getLocale() }}', options);
            },

            goToDetail(slug) {
                window.location.href = "{{ url('/news') }}/" + slug;
            },

            getFilteredArticles() {
                let result = this.articles;

                return result.sort((a, b) => {
                    const dateA = new Date(a.date);
                    const dateB = new Date(b.date);
                    return this.sortOrder === 'desc' 
                        ? dateB - dateA 
                        : dateA - dateB;
                });
            }
        }
    }
</script>