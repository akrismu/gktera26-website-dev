<section class="banner">
    @foreach($banners as $banner)
        <div class="banner darker" style="background-image: url('{{ $banner->media ? asset('storage/' . $banner->media->path) : '' }}');">
            <div class="banner-content">
                <h1>{{ $banner->title ?? App\Http\Helpers\Helper::trans_json('banner.welcomeMessage') }}</h1>
                @if($banner->subtitle)
                    <p>{{ $banner->subtitle }}</p>
                @endif
            </div>
        </div>
    @endforeach
</section>