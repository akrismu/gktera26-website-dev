<footer class="footer">
    @php
        $instagramUrl = "https://www.instagram.com/gkjtu.media/";
        $youtubeUrl = "https://www.youtube.com/@MediaGKJTU";
    @endphp

    <div class="footer-content">
        <div class="footer-section">
            <img id="footer-logo" src="{{ asset('images/navRes/gkjtu_logo.png') }}" alt="Church Logo" />
        </div>

        <div class="footer-section footer-emails-address">
            <p>Addr: Jl. Letjend Sukowati 74 Salatiga - Indonesia</p>
            <p>Tel: +62 298-321149</p>
            <p>Email: gkjtu@indo.net.id</p>
        </div>

        <div class="footer-section footer-social-media">
            <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer">
                <img class="SocialMediaIco" src="{{ asset('images/footerRes/instagram.svg') }}" alt='Instagram'>
            </a>
            <p></p>
            <a href="{{ $youtubeUrl }}" target="_blank" rel="noopener noreferrer">
                <img class="SocialMediaIco" src="{{ asset('images/footerRes/youtube.svg') }}" alt='Youtube'>
            </a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© {{ date('Y') }} Gereja Kristen Jawa Tengah Utara</p>
    </div>
</footer>