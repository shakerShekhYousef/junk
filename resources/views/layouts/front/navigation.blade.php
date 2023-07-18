<header class="Header Header--top" id="myHeader">
    <div class="Header-inner Header-inner--top" data-nc-group="top">
        <div data-nc-container="top-left" style="justify-content: center;">

            <div class="Header-search" data-nc-element="search">
                <form class="Header-search-form" action="https://www.JUNK-fit.com/search" method="get">
                    @csrf
                    <input class="Header-search-form-input" name="q" type="text" spellcheck="false" value=""
                        autocomplete="off" placeholder="Search" />
                    <button class="Header-search-form-submit" type="submit" data-test="template-search">
                        <svg class="Icon Icon--search--small" viewBox="0 0 15 15">
                            <use xlink:href="/assets/ui-icons.svg#search-icon--small"></use>
                        </svg>
                        <svg class="Icon Icon--search" viewBox="0 0 20 20">
                            <use xlink:href="/assets/ui-icons.svg#search-icon"></use>
                        </svg>
                    </button>
                </form>
            </div>

        </div>
        <div data-nc-container="top-center">


            <div class="Header-social" data-nc-element="social">

                <nav class="SocialLinks" data-content-field="connected-accounts">
                    <div class="SocialLinks-inner">
                        <a href="https://www.instagram.com/junkdubai/" target="_blank"
                            class="SocialLinks-link instagram" style="">
                            <div>
                                <svg class="SocialLinks-link-svg" viewBox="0 0 64 64">

                                    <use class="SocialLinks-link-icon" xlink:href="#instagram-icon"></use>
                                    <use class="SocialLinks-link-mask" xlink:href="#instagram-mask"></use>
                                </svg>
                            </div>
                        </a><a href="https://www.facebook.com/JunkDubai/" target="_blank"
                            class="SocialLinks-link facebook" style="">
                            <div>
                                <svg class="SocialLinks-link-svg" viewBox="0 0 64 64">

                                    <use class="SocialLinks-link-icon" xlink:href="#facebook-icon"></use>
                                    <use class="SocialLinks-link-mask" xlink:href="#facebook-mask"></use>
                                </svg>
                            </div>
                        </a>
                    </div>
                </nav>

            </div>

        </div>
        <div data-nc-container="top-right">



        </div>
    </div>
</header>

<div class="Site-inner Site-inner--index" data-controller="HeaderOverlay">

    <header class="Header Header--bottom Header--index-gallery">
        <div class="Header-inner Header-inner--bottom" data-nc-group="bottom">
            <div data-nc-container="bottom-left">
                <nav class="Header-nav Header-nav--primary" data-nc-element="primary-nav"
                    data-content-field="navigation">

                </nav>
            </div>
            <div data-nc-container="bottom-center">

                <a href="{{ route('front-home') }}" class="Header-branding" data-nc-element="branding"
                    data-content-field="site-title">


                    <img src="{{ asset('front/img/logo.png') }}" alt="JUNK" class="Header-branding-logo" />


                </a>


            </div>
            <div data-nc-container="bottom-right">

                <nav class="Header-nav Header-nav--secondary" data-nc-element="secondary-nav"
                    data-content-field="navigation">

                    <div class="Header-nav-inner">
                        <a href="{{ route('front-classes') }}" class="Header-nav-item" data-test="template-nav">Our
                            Classes</a><a href="{{ route('team') }}" class="Header-nav-item"
                            data-test="template-nav"></a>
                        <a href="{{ route('about') }}" class="Header-nav-item" data-test="template-nav">All About
                            Junk</a><a href="{{ route('team') }}" class="Header-nav-item"
                            data-test="template-nav"></a>
                        <!--<span class="Header-nav-item Header-nav-item--folder">

              <a href="dubai-dubai-schedule.html" class="Header-nav-folder-title" data-controller="HeaderNavFolderTouch">All About Junk</a>

              <span class="Header-nav-folder">


                    <a href="our-story.html" class="Header-nav-folder-item" data-test="template-nav">Our Story</a>



                    <a href="the-mission.html" class="Header-nav-folder-item" data-test="template-nav">The Mission</a>
                    <a href="the-amenities.html" class="Header-nav-folder-item" data-test="template-nav">The Amenities</a>
                    <a href="the-protein-bar.html" class="Header-nav-folder-item" data-test="template-nav">The Protein Bar</a>
                    <a href="the-rack.html" class="Header-nav-folder-item" data-test="template-nav">The Rack</a>
                    <a href="the-hangout.html" class="Header-nav-folder-item" data-test="template-nav">The Hangout</a>


              </span>
            </span>-->


                        <a href="{{ route('junk-jams') }}" class="Header-nav-item" data-test="template-nav">JUNK
                            JAMS</a><a href="{{ route('team') }}" class="Header-nav-item"
                            data-test="template-nav"></a>

                        <!-- <span class="Header-nav-folder">


                    <a href="dubai-dubai-schedule.html" class="Header-nav-folder-item" data-test="template-nav">Dubai</a>



                    <a href="abu-dhabi-dubai-schedule.html" class="Header-nav-folder-item" data-test="template-nav">Abu Dhabi</a>



            </span>-->
                        <a href="{{ route('team') }}" class="Header-nav-item" data-test="template-nav">Meet The
                            Team</a><a href="{{ route('team') }}" class="Header-nav-item"
                            data-test="template-nav"></a>
                        <a href="{{ route('web_calander_data_show') }}"
                            class="Header-nav-item" data-test="template-nav">Schedule</a><a
                            href="{{ route('team') }}" class="Header-nav-item" data-test="template-nav"></a>
                        <a href="{{ route('buy-packages') }}" class="Header-nav-item" data-test="template-nav">
                            Packages</a><a href="{{ route('team') }}" class="Header-nav-item"
                            data-test="template-nav"></a>
                        <a href="{{ route('front-home') }}" class="Header-nav-item" data-test="template-nav">My
                            Account</a><a href="{{ route('team') }}" class="Header-nav-item"
                            data-test="template-nav"></a>

                        <a href="{{ route('covid-19') }}" class="Header-nav-item"
                            data-test="template-nav">COVID-19</a>
                        @auth
                            <a href="{{ route('my-profile') }}" class="Header-nav-item" data-test="template-nav">My
                                Account</a><a href="{{ route('my-profile') }}" class="Header-nav-item"
                                data-test="template-nav"></a>
                            <a href="{{ route('web_logout') }}" class="Header-nav-item"
                                data-test="template-nav">Logout</a>
                        @endauth
                        @guest
                            <a href="#map-parking" class="Header-nav-item" data-test="template-nav">location</a>
                            <a href="{{ route('login') }}" class="Header-nav-item" data-test="template-nav" style="color:#fff">Login</a>
                            <a href="{{ route('signUp') }}" class="Header-nav-item" data-test="template-nav"
                                style="color: rgb(0 0 0); background-color: #8fd241; padding: 10px 20px;border-radius: 25px!important;display: none;"
                                id="free-class">Free Class</a>
                        @endguest
                    </div>

                </nav>

            </div>
        </div>
    </header>
</div>
