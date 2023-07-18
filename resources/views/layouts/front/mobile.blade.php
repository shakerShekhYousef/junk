<div class="Loader"></div>
<div class="Mobile" data-nc-base="mobile-bar" data-controller="AncillaryLayout" id="mob">
    <div class="Mobile-bar Mobile-bar--top" data-nc-group="top" data-controller="MobileOffset">

        <div data-nc-container="top-left">
            <a href="{{route('front-home')}}" class="Mobile-bar-branding" data-nc-element="branding" data-content-field="site-title">


                <img src="{{asset('front/img/logo.png')}}" alt="JUNK" class="Mobile-bar-branding-logo"/>


            </a>
        </div>
        <div data-nc-container="top-center"></div>
        <div data-nc-container="top-right"></div>
    </div>
    <div class="Mobile-bar Mobile-bar--bottom" data-nc-group="bottom" data-controller="MobileOffset">
        <div data-nc-container="bottom-left">
            <button class="Mobile-bar-menu" data-nc-element="menu-icon" data-controller-overlay="menu"
                    data-controller="MobileOverlayToggle">

                <i class="fa fa-bars Icon Icon--hamburger"></i>

                <svg class="Icon Icon--hotdog" viewBox="0 0 24 14">
                    <use xlink:href="/assets/ui-icons.svg#hotdog-icon--even" class="use--even"></use>
                    <use xlink:href="/assets/ui-icons.svg#hotdog-icon--odd" class="use--odd"></use>
                </svg>
                <svg class="Icon Icon--plus" viewBox="0 0 20 20">
                    <use xlink:href="/assets/ui-icons.svg#plus-icon--even" class="use--even"></use>
                    <use xlink:href="/assets/ui-icons.svg#plus-icon--odd" class="use--odd"></use>
                </svg>
                <svg class="Icon Icon--dots-horizontal" viewBox="0 0 25 7">
                    <use xlink:href="/assets/ui-icons.svg#dots-horizontal-icon--even" class="use--even"></use>
                    <use xlink:href="/assets/ui-icons.svg#dots-horizontal-icon--odd" class="use--odd"></use>
                </svg>
                <svg class="Icon Icon--dots-vertical" viewBox="0 0 7 25">
                    <use xlink:href="/assets/ui-icons.svg#dots-vertical-icon--even" class="use--even"></use>
                    <use xlink:href="/assets/ui-icons.svg#dots-vertical-icon--odd" class="use--odd"></use>
                </svg>
                <svg class="Icon Icon--squares-horizontal" viewBox="0 0 25 7">
                    <use xlink:href="/assets/ui-icons.svg#squares-horizontal-icon--even" class="use--even"></use>
                    <use xlink:href="/assets/ui-icons.svg#squares-horizontal-icon--odd" class="use--odd"></use>
                </svg>
                <svg class="Icon Icon--squares-vertical" viewBox="0 0 7 25">
                    <use xlink:href="/assets/ui-icons.svg#squares-vertical-icon--even" class="use--even"></use>
                    <use xlink:href="/assets/ui-icons.svg#squares-vertical-icon--odd" class="use--odd"></use>
                </svg>
            </button>
        </div>
        <div data-nc-container="bottom-center">

        </div>
        <div data-nc-container="bottom-right">

            <a href="https://www.JUNK-fit.com/search" class="Mobile-bar-search" data-nc-element="search-icon">
                <svg class="Icon Icon--search" viewBox="0 0 20 20">
                    <use xlink:href="/assets/ui-icons.svg#search-icon"></use>
                </svg>
            </a>
        </div>
    </div>
    <div class="Mobile-overlay">
        <div class="Mobile-overlay-menu" data-controller="MobileOverlayFolders">
            <div class="Mobile-overlay-menu-main">
                <nav class="Mobile-overlay-nav Mobile-overlay-nav--primary" data-content-field="navigation">

                </nav>
                <nav class="Mobile-overlay-nav Mobile-overlay-nav--secondary" data-content-field="navigation">
                    <a href="{{ route('front-classes') }}" class="Mobile-overlay-nav-item">
                        OUR CLASSES
                    </a>
                    <!--<button class="Mobile-overlay-nav-item Mobile-overlay-nav-item--folder" data-controller-folder-toggle="schedule-1">
                    <span class="Mobile-overlay-nav-item--folder-label">ALL ABOUT JUNK</span>
                  </button>-->
                    <a href="{{ route('about') }}" class="Mobile-overlay-nav-item">
                        ALL ABOUT JUNK
                    </a>
                    <a href="{{ route('junk-jams') }}" class="Mobile-overlay-nav-item">
                        JUNK JAMS
                    </a>
                    <a href="{{ route('team') }}" class="Mobile-overlay-nav-item">
                        MEET THE TEAM
                    </a>
                    <a href="{{ route('web_calander_data_show') }}" class="Mobile-overlay-nav-item">
                        SCHEDULE
                    </a>
                    <a href="{{ route('buy-packages') }}" class="Mobile-overlay-nav-item">
                        Packages
                    </a>
                    @auth
                        <a href="{{ route('my-profile') }}" class="Mobile-overlay-nav-item">
                            My Account
                        </a>
                        <a href="{{ route('web_logout') }}" class="Mobile-overlay-nav-item">
                            Logout
                        </a>
                    @endauth
                    <a href="{{ route('covid-19') }}" class="Mobile-overlay-nav-item">
                        COVID-19
                    </a>
                    @guest
                            <a href="#map-parking" class="Mobile-overlay-nav-item" >location</a>
                            <a href="{{ route('login') }}" class="Mobile-overlay-nav-item" data-test="template-nav" style="color:#fff">Login</a>
                            <a style="color: rgb(0 0 0);display: none;" href="{{ route('signUp') }}" class="Mobile-overlay-nav-item">
                        Free Class
                    </a>
                           
                        @endguest
                    
                </nav>
            </div>
            <div class="Mobile-overlay-folders" data-content-field="navigation">


                <div class="Mobile-overlay-folder" data-controller-folder="schedule-1">
                    <button class="Mobile-overlay-folder-item Mobile-overlay-folder-item--toggle"
                            data-controller-folder-toggle="schedule-1">
              <span class="Mobile-overlay-folder-item--toggle-label"><i class="fa fa-arrow-left" aria-hidden="true"></i>
              </span>
                    </button>


                    <a href="our-story.html" class="Mobile-overlay-folder-item" style="color: #FFF;">
                        OUR STORY
                    </a>


                    <a href="the-mission.html" class="Mobile-overlay-folder-item" style="color: #FFF;">
                        THE MISSION
                    </a>
                    <a href="the-amenities.html" class="Mobile-overlay-folder-item" style="color: #FFF;">
                        THE AMENITIES
                    </a>
                    <a href="the-protein-bar.html" class="Mobile-overlay-folder-item" style="color: #FFF;">
                        THE PROTEIN BAR
                    </a>
                    <a href="the-rack.html" class="Mobile-overlay-folder-item" style="color: #FFF;">
                        THE RACK
                    </a>
                    <a href="the-hangout.html" class="Mobile-overlay-folder-item" style="color: #FFF;">
                        THE HANGOUT
                    </a>


                </div>


                <div class="Mobile-overlay-folder" data-controller-folder="buy-packages1">
                    <button class="Mobile-overlay-folder-item Mobile-overlay-folder-item--toggle"
                            data-controller-folder-toggle="buy-packages1">
                        <span class="Mobile-overlay-folder-item--toggle-label">Back</span>
                    </button>


                    <a href="dubai-buy-packages.html" class="Mobile-overlay-folder-item">
                        Dubai
                    </a>


                    <a href="abudhabi-buy-packages.html" class="Mobile-overlay-folder-item">
                        Abu Dhabi
                    </a>


                </div>


                <div class="Mobile-overlay-folder" data-controller-folder="my-account1">
                    <button class="Mobile-overlay-folder-item Mobile-overlay-folder-item--toggle"
                            data-controller-folder-toggle="my-account1">
                        <span class="Mobile-overlay-folder-item--toggle-label">Back</span>
                    </button>


                    <a href="index.html" class="Mobile-overlay-folder-item">
                        Dubai
                    </a>


                    <a href="sing-up-abudhabi.html" class="Mobile-overlay-folder-item">
                        Abu Dhabi
                    </a>


                </div>


            </div>
        </div>
        <button class="Mobile-overlay-close" data-controller="MobileOverlayToggle">
            <i class="fas fa-times Icon Icon--close"></i>

        </button>
        <div class="Mobile-overlay-back" data-controller="MobileOverlayToggle"></div>
    </div>
</div>
<div class="Parallax-host-outer">
    <div class="Parallax-host" data-parallax-host>
        <div class="Parallax-item" data-parallax-item data-parallax-id="5e674dd32293d941d09984a4"></div>
    </div>
</div>
