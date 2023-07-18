<header class="Header Header--bottom Header--index-gallery" id="head">
    <div class="Header-inner Header-inner--bottom" data-nc-group="bottom">
        <div data-nc-container="bottom-left">
            <nav class="Header-nav Header-nav--primary" data-nc-element="primary-nav" data-content-field="navigation">
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
                        Classes</a><a href="the-team.html" class="Header-nav-item" data-test="template-nav"></a>
                    <a href="{{route('about')}}" class="Header-nav-item" data-test="template-nav" style="color:#8fd241">All About
                        Junk</a>
                    <a href="{{ route('team') }}" class="Header-nav-item" data-test="template-nav"></a>
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
                        JAMS</a><a href="{{ route('team') }}" class="Header-nav-item" data-test="template-nav"></a>

                    <!-- <span class="Header-nav-folder">


                <a href="dubai-dubai-schedule.html" class="Header-nav-folder-item" data-test="template-nav">Dubai</a>



                <a href="abu-dhabi-dubai-schedule.html" class="Header-nav-folder-item" data-test="template-nav">Abu Dhabi</a>



        </span>-->
                    <a href="{{route('team')}}" class="Header-nav-item" data-test="template-nav" style="color:#8fd241">Meet The Team</a>
                    <a href="{{ route('team') }}" class="Header-nav-item" data-test="template-nav"></a>
                    <a href="{{ route('web_calander_data_show') }}"
                        class="Header-nav-item" data-test="template-nav">Schedule</a><a href="{{ route('team') }}"
                        class="Header-nav-item" data-test="template-nav"></a>
                    <a href="{{route('buy-packages')}}" class="Header-nav-item" data-test="template-nav" style="color:#8fd241">
                        Packages</a>
                    <a href="{{ route('team') }}" class="Header-nav-item"
                        data-test="template-nav"></a>

                    <a href="{{route('covid-19')}}" class="Header-nav-item" data-test="template-nav" >COVID-19</a>
                    @auth
                        <a style="color:#8fd241" href="{{ route('my-profile') }}" class="Header-nav-item" data-test="template-nav">My
                            Account</a><a href="{{ route('my-profile') }}" class="Header-nav-item"
                            data-test="template-nav" ></a>
                        <a href="{{ route('web_logout') }}" class="Header-nav-item" data-test="template-nav">Logout</a>
                    @endauth
                    @guest
                    <a href="#map-parking" class="Header-nav-item" data-test="template-nav" style="color:#8fd241">location</a>
                        <a href="{{ route('login') }}" class="Header-nav-item" data-test="template-nav" style="color:#fff">Login</a>
                        <a href="{{ route('signUp') }}" class="Header-nav-item" data-test="template-nav"
                            style="color: rgb(0 0 0); background-color: #8fd241; padding: 10px 20px;border-radius: 25px!important;display: none;"
                            id="free-class">Free
                            Class</a>
                    @endguest
                </div>

            </nav>

        </div>
    </div>
</header>
