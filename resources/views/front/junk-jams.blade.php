@extends('layouts.front.base')
@section('pageTitle', 'Junk-jams')
@section('custom-style')
    <style>
        .btn-book{
            margin:0;
        }
        .div-btn{
            text-align: -webkit-right;
            text-align:-moz-right;
        }
        a:hover {
            text-decoration: none;
        }

        .music-section {
            background: #fff;
            padding: 70px 102px;
        }

        @media screen and (max-width: 1024px) {
            .music-section {
                padding-left: 64px;
                padding-right: 64px;
            }
        }

        @media screen and (max-width: 960px) {
            .music-section {
                padding-left: 48px;
                padding-right: 48px;
            }
        }

        @media screen and (max-width: 768px) {
            .music-section {
                padding-left: 36px;
                padding-right: 36px;
            }
        }

        @media screen and (max-width: 640px) {
            .music-section {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        .content-music {
            align-items: center;
            margin-bottom:0rem;
        }

        .content-music img {
            width:100%;
            border-radius: 50%;

        }

        .content-music p {
            padding: .5rem 5rem 0 0;
        }

        /* .banner {
          background-image: url('../JUNK/front/img/Membership\ Pass\ Junk\ Final-02.jpg');
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
          height: 500px;
        } */
        .c1 .co-content {
            text-align: right;
        }

        .c1 .co-text {
            text-align: left;
        }

        .c2 .co-content {
            text-align: left;
        }

        .c2 .co-text {
            text-align: right;
        }

        .c2 .co-text p {
            padding: .5rem 0 0 5rem;
        }

        @media screen and (max-width: 991.5px) {
            .c1 .co-content, .c2 .co-content {
                text-align: center;
            }

            .c2 .co-text, .c1 .co-text {
                text-align: left;
                padding:0 2rem;
                margin-bottom:0;
            }

            .c2 .co-text p, .content-music p {
                padding: .5rem 0;
            }

            .content-music {
                margin-bottom: 2rem 1rem;
            }
            .div-btn{
            text-align: -webkit-left;
            text-align:-moz-left;
        }
        }

        @media screen and (max-width: 1200px) {
            .content-music img {
                width: 100%;
            }
        }

        /* The sticky class is added to the header with JS when it reaches its scroll position */
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999999;

        }

        #free-class:hover {
            color: #8fd241 !important;
            background-color: rgb(0 0 0) !important;
        }

    </style>
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection
@section('content')
    <div class="Content-outer">


        <main class="Index" data-collection-id="5b279fe0758d4684330aa811"
              data-controller="IndexFirstSectionHeight, Parallax, IndexNavigation">
            <div class="banner">
                <a href="{{route('buy-packages')}}">
                <img src="{{asset('front/img/junk-jums.jpg')}}" style="width: 100%;">
    </a>
            </div>
            <div class="music-section">
           
                <div class="row content-music c1" id="90classic" >
                    <div class="col-lg-6 col-md-6 col-12 co-content"  data-aos="fade-up"
                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                        <img src="{{asset('front/img/90classes-junk.png')}}">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 co-text" data-aos="fade-up"
                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                        <h3>90’S CLASSIC</h3>
                        <p>Reee-wind. We’re taking you right back to the old school with our 90’s classics classes.
                            Relive the euphoric
                            sound of your youth – expect a special mix of thunderous club classics from N-Trance to
                            angsty Britpop.</p>
                            <a href="{{route('web_calander_data_show')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                    </div>
                </div>
                <div class="row content-music c2" id="cheesy" style="flex-direction: row-reverse;">
                    <div class="col-lg-6 col-md-6 col-12 co-content" data-aos="fade-up"
                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                        <img src="{{asset('front/img/pop-junk.png')}}" style="background: #000;">
                    </div>
                    <div class="col-lg-6  col-md-6 col-12 co-text" data-aos="fade-up"
                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000"> >
                        <h3>CHEESY POP</h3>
                        <p>It’s Britney,b*tch! Get some pep in your step at a class where anything goes. Just like the
                            boybands, you’ll
                            be miming along to those clean cut autotuned bangers throughout your workout. Don’t come
                            here to be cool, come
                            here to have fun, to let it all go! </p>
                            <div class="div-btn">
                            <a href="{{route('web_calander_data_show')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
    </div>
                    </div>
                </div>
                <div class="row content-music c1" id="rave" >
                    <div class="col-lg-6 col-md-6 col-12 co-content " data-aos="fade-up"
                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                        <img src="{{asset('front/img/rave-junk.png')}}" style="background: #000;">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 co-text" data-aos="fade-up"
                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000">>
                        <h3>RAVE</h3>
                        <p>It’s clubland, but not as you know it. Fast paced and jam packed full of energy, you’ll be
                            challenging
                            yourself to keep up with the beat of this up-tempo class. Get that heart rate up to electro
                            pop remixes, and
                            hardcore trance hits – this genre is guaranteed to leave you on a ravers high!

                        </p>
                
                            <a href="{{route('web_calander_data_show')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>

                    </div>
                </div>
                <div class="row content-music c2" id="randbeat" style="flex-direction: row-reverse;">
                    <div class="col-lg-6 col-md-6 col-12 co-content " data-aos="fade-up"
                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                        <img src="{{asset('front/img/r-junk.png')}}" style="background: #000;">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 co-text" data-aos="fade-up"
                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000">>
                        <h3>R & BEAT</h3>
                        <p>Is it getting hot in herrrrrreee…..or is that just us? Get your grind on to our vibey mix of
                            modern and
                            classic R&B and hip hop and set those calories on fire as we get your body moving and
                            grooving.

                        </p>
                        <div class="div-btn">
                        <a href="{{route('web_calander_data_show')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                    </div></div>
                </div>

                <div class="row content-music c1" id="dance">
                    <div class="col-lg-6 col-md-6 col-12 co-content" data-aos="fade-up"
                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                        <img src="{{asset('front/img/house-junk.png')}}" style="background: #000;">
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 co-text" data-aos="fade-up"
                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000">>
                        <h3>HOUSE</h3>
                        <p>We don’t like house music…..we LOVE it! From jungle to funk, dubstep to tropical house, we’re
                            bringing you
                            the hottest dance tracks from all time to take you through an explosive workout. When the
                            beat drops – welcome
                            to our HOUSE!

                        </p>
                        <a href="{{route('web_calander_data_show')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
