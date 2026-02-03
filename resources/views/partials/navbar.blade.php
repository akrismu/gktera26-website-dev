<header 
    class="navbar" 
    x-data="{ 
        isMenuOpen: false, 
        isDropdownOpen: false, 
        shadow: false,
        currentLang: '{{ app()->getLocale() }}', // Gets current Laravel locale (en or id)

        // Mimics React's toggleMenu
        toggleMenu() { 
            this.isMenuOpen = !this.isMenuOpen;
        },

        // Mimics React's handleClickDropDown
        closeMenu() {
            this.isMenuOpen = false;
            this.isDropdownOpen = false;
        },

        // Mimics React's toggleDropdown logic
        toggleDropdown(e) {
            if (this.isDropdownOpen) {
                window.location.href = '{{ url('/about') }}';
                this.closeMenu();
            } else {
                this.isDropdownOpen = true;
            }
        },

        // Mimics React's changeLanguage
        changeLanguage(lang) {
            // Note: In Laravel, we usually redirect to a route to set session locale
            window.location.href = '/locale/' + lang; 
        }
    }"
    @scroll.window="shadow = (window.pageYOffset > 0)"
    @resize.window="if(window.innerWidth > 768) isMenuOpen = false"
    :class="{ 'sticky': shadow }"
>

    <div class="navbar__menu-icon" @click="isMenuOpen = !isMenuOpen">
        <img id='hamburger-icon' src="{{ asset('images/navRes/menu.png') }}" alt='hamburger'/>
    </div>

    <div 
        class="navbar__popup-menu" 
        :class="{ 'open': isMenuOpen }"
    >
        <div class="close-button" @click="isMenuOpen = false">
            <img src="{{ asset('images/navRes/close.png') }}" alt="Close" />
        </div>

        <div class="popup-menu-links">
            <a href="{{ url('/') }}" @click="isMenuOpen = false">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.home') }}</a>
            <a href="{{ url('/news') }}" @click="isMenuOpen = false">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.news') }}</a>
            <a href="{{ url('/churches') }}" @click="isMenuOpen = false">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.churches') }}</a>
            
            <div class="dropdown">
                <a href="javascript:void(0)" @click="toggleDropdown($event)">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.about') }}</a>
                
                <div class="dropdown-content" x-show="isDropdownOpen" style="display: none;" x-transition>
                    <a href="{{ url('/about') }}" @click="closeMenu">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.sinode') }}</a>
                    <a href="{{ url('/about/history') }}" @click="closeMenu">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.history') }}</a>
                    <a href="{{ url('/about/mission') }}" @click="closeMenu">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.mission') }}</a>
                    <a href="{{ url('/about/ministrys') }}" @click="closeMenu">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.ministry') }}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar__logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('images/navRes/gkjtu_logo.png') }}" alt="Church Logo" />
        </a>
    </div>

    <nav class="navbar__links">
        <a href="{{ url('/') }}">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.home') }}</a>
        <a href="{{ url('/news') }}">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.news') }}</a>
        <a href="{{ url('/churches') }}">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.churches') }}</a>
        
        <div class="dropdown">
            <a href="{{ url('/about') }}" class="dropbtn">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.about') }}</a>
            <div class="dropdown-content">
                <a href="{{ url('/about') }}">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.sinode') }}</a>
                <a href="{{ url('/about/history') }}">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.history') }}</a>
                <a href="{{ url('/about/mission') }}">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.mission') }}</a>
                <a href="{{ url('/about/ministrys') }}">{{ Awcodes\Curator\Support\Helpers::trans_json('navBar.ministry') }}</a>
            </div>
        </div>
    </nav>

    <div class="navbar__language-switch">
        <button 
            @click="changeLanguage('en')"
            :class="{ 'active-lang': currentLang === 'en' }"
        >
          EN
        </button>
        <button 
            @click="changeLanguage('id')"
            :class="{ 'active-lang': currentLang === 'id' }"
        >
          ID
        </button>
    </div>
</header>