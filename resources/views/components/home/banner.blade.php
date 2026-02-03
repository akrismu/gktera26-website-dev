<section class="banner">
    @foreach($banners as $banner)
        <div class="banner" style="background-image: url('{{ $banner->media->url }}');">

            <div class="banner-content">
                
                <h1>{{ $banner->title }}</h1>
                <p>{{ $banner->description }}</p>

            </div>
        </div>
    @endforeach
</section>