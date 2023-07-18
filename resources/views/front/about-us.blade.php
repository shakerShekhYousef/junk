@extends('layouts.front.base')
@section('pageTitle', 'About')
@section('custom-style')
@endsection
@section('content')

    <style type="text/css">
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
        .whats-app {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 40px;
            background-color: #22ec44;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 3px 4px 3px #999;
            left: 15px;
            z-index: 100;
        }

        .my-float {
            margin-top: 10px;
        }
    </style>

    <a  class="whats-app" href="https://wa.me/971585357917" target="_blank">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <i style="z-index: 999" class="fab fa-whatsapp my-float"  aria-hidden="true"></i>
    </a>

    <div class="Content-outer">
        <main class="Main Main--page">
            <section class="Main-content" data-content-field="main-content">
                <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629807432669"
                     id="page-5b27a5f103ce643d6e7645d5">
                    <div class="row sqs-row">
                        <div class="col-lg-6 col-md-12 col-xs-12">
                            <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                 id="block-yui_3_17_2_1_1529325150226_5637">
                                <div class="sqs-block-content">
                                    <h1>ABOUT US</h1>
                                    <p><strong>THE ULTIMATE CLUB NIGHT REMIXED WITH
                                            YOUR<br><span style="color: #90D242">FAVORITE WORKOUT</span></strong></p>
                                    <br>
                                    <p class="">Junk is a one of a kind fitness nightclub experience,
                                        bringing the energy of the club to the intensity of your workout.</p>
                                    <p class="">We are driven by music and powered by a state of the art
                                        sound and lighting system. You’ll experience an exhilarating way of working out
                                        with LED lights
                                        and visual effects powering, inspiring and driving your every movement.</p>
                                    <p class="">Our set lists have been carefully curated by our JUNK
                                        MCs, to help you get the most from your workout.</p>
                                    <p class="">Your class takes place on our “Dance” floor,</p>
                                    <div><a href="#">
                                            <button id="sub"
                                                    style="font-family: Nunito; border: none;padding: 10px 20px;font-size: 18px;font-weight: 600;text-transform: uppercase;line-height: 2.0em;letter-spacing: 0.1px;fill: #ffffff;color: #ffffff;background-color: #90D242;border-radius: 9px 9px 9px 9px;">
                                                BOOK
                                                FIRST CLASS FREE
                                            </button>
                                        </a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col sqs-col-6 span-6" id="col-right">

                            <div class="sqs-block map-block sqs-block-map sized vsize-12" data-block-type="4"
                                 id="block-yui_3_17_2_1_1534356047510_5421">
                                <div class="sqs-block-content">&nbsp;
                                    <!--new-->
                                    <div style="" data-aos="fade-up" data-aos-duration="1000"><img
                                            style="width: 100%;"
                                            src="{{asset('front/img/top2.jpg')}}"></div>
                                    <!---->
                                </div>
                            </div>
                        </div>
                    </div>
                    <h1 style="margin-top: 4rem">FITNESS PROGRAMS</h1>
                    <div class="row sqs-row">

                        <div class="col-lg-1 col-md-6 col-xs-6 co-fit"></div>
                        <div class="col-lg-5 col-md-6 col-xs-6"
                             style="padding: 10px;background: #fff;border-radius: 10px;"
                             data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                            <div class="sqs-block image-block sqs-block-image" data-block-type="5"
                                 id="block-yui_3_17_2_1_1536784135462_17192" style="box-shadow: 0px 5px 7px #33333340;
    border-radius: 10px;">
                                <div class="sqs-block-content">
                                    <div class="
          image-block-outer-wrapper
                       layout-caption-overlay-hover
          design-layout-inline
          combination-animation-none
          individual-animation-none
          individual-text-animation-none
        " data-test="image-block-inline-outer-wrapper">


                                        <figure class="
              sqs-block-image-figure
              intrinsic
            " style="max-width:2500px;
  overflow: hidden;">
                                            <div class="image-block-wrapper" data-animation-role="image">
                                                <div class="sqs-image-shape-container-element has-aspect-ratio
            " style="
                position: relative;

                  padding-bottom:100%;


  overflow: hidden;







              ">
                                                    <noscript><img src="{{asset('front/img/LARGETRIES.jpg')}}" alt="KEN CALLEJA"/>
                                                    </noscript>
                                                    <img
                                                        style="background: #fff;border-radius: 10px;"
                                                        class="thumb-image"
                                                        data-src="{{asset('front/img/LARGETRIES.jpg')}}" data-image=""
                                                        data-image-dimensions="2500x2500"
                                                        data-image-focal-point="0.5,0.5" alt="" data-load="false"
                                                        data-type="image"/>
                                                </div>
                                            </div>


                                            <figcaption class="image-caption-wrapper">
                                                <div class="image-caption">
                                                    <p class="" style="white-space:pre-wrap;"><strong
                                                            style="text-align: center;">LARGE
                                                            TIRES</strong><br>Developing force from the ground up. We
                                                        have replaced the typical
                                                        gym equipment in your workout with an explosive lower-body drive
                                                        to help build strength
                                                        and endurance and burn major calories.
                                                    </p>
                                                </div>
                                            </figcaption>


                                        </figure>


                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-6 col-xs-6" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom"
                             data-aos-duration="1000" data-aos-delay="250"
                             style="padding: 10px;background: #fff;border-radius:10px">
                            <div class="sqs-block image-block sqs-block-image" data-block-type="5"
                                 id="block-yui_3_17_2_1_1536784135462_25498" style="box-shadow: 0px 5px 7px #33333340;
    border-radius: 10px;
">
                                <div class="sqs-block-content">
                                    <div class="image-block-outer-wrapper
          layout-caption-overlay-hover
          design-layout-inline
          combination-animation-none
          individual-animation-none
          individual-text-animation-none" data-test="image-block-inline-outer-wrapper">
                                        <figure class="sqs-block-image-figure intrinsic"
                                                style="max-width:2500px;  overflow: hidden;">
                                            <div class="image-block-wrapper" data-animation-role="image">
                                                <div class="sqs-image-shape-container-element
              has-aspect-ratio" style="
                position: relative;
                 padding-bottom:100%;overflow: hidden;">
                                                    <noscript><img src="{{asset('front/img/bodyexercise.jpg')}}" alt="KOUROSH DARA"/>
                                                    </noscript>
                                                    <img
                                                        style="background: #fff;border-radius: 10px;"
                                                        class="thumb-image"
                                                        data-src="{{asset('front/img/bodyexercise.jpg')}}" data-image=""
                                                        data-image-dimensions="2500x2500"
                                                        data-image-focal-point="0.5,0.5" alt="KOUROSH DARA"
                                                        data-load="false"
                                                        data-image-id="5b9b8f428a922db50d2780fb" data-type="image"/>
                                                </div>
                                            </div>
                                            <figcaption class="image-caption-wrapper">
                                                <div class="image-caption">
                                                    <p class=""><strong style="text-align: center;">KETTLE
                                                            BELLS</strong><br>Building Strength without the bulk. Swing,
                                                        curl or press your way
                                                        into strength focused technique resulting in a lean, toned, and
                                                        firm physique. You
                                                        select your KGs, we coach you towards your desired end result.
                                                    </p>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>


                                </div>
                            </div>
                        </div>


                        <div class="col-lg-1 col-md-6 col-xs-6  co-fit"></div>
                    </div>
                    <div class="row sqs-row">
                        <div class="col-lg-1 col-md-6 col-xs-6  co-fit"></div>
                        <div class="col-lg-5 col-md-6 col-xs-6" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom"
                             data-aos-duration="1000" data-aos-delay="500"
                             style="padding: 10px;background: #fff;border-radius:10px">
                            <div class="sqs-block image-block sqs-block-image" data-block-type="5"
                                 id="block-yui_3_17_2_1_1536784135462_27011" style="box-shadow: 0px 5px 7px #33333340;
    border-radius: 10px;
">
                                <div class="sqs-block-content">


                                    <div class="
          image-block-outer-wrapper
          layout-caption-overlay-hover
          design-layout-inline
          combination-animation-none
          individual-animation-none
          individual-text-animation-none
        " data-test="image-block-inline-outer-wrapper">


                                        <figure class="
              sqs-block-image-figure
              intrinsic
            " style="max-width:2500px;
  overflow: hidden;






">


                                            <div class="image-block-wrapper" data-animation-role="image">
                                                <div class="sqs-image-shape-container-element



              has-aspect-ratio
            " style="
                position: relative;

                  padding-bottom:100%;


  overflow: hidden;







              ">
                                                    <noscript><img src="{{asset('front/img/battlerope.jpg')}}" alt=""/></noscript>
                                                    <img
                                                        style="background: #fff;border-radius: 10px;"
                                                        class="thumb-image"
                                                        data-src="{{asset('front/img/battlerope.jpg')}}" data-image=""
                                                        data-image-dimensions="2500x2500"
                                                        data-image-focal-point="0.5,0.5" alt="" data-load="false"
                                                        data-image-id="5b9b91a80ebbe8e89b837482" data-type="image"/>
                                                </div>
                                            </div>


                                            <figcaption class="image-caption-wrapper">
                                                <div class="image-caption">
                                                    <p class=""><strong style="text-align: center;">BATTLE
                                                            ROPE</strong><br>Not your average playground rope. Battle
                                                        ropes blast fat, increase
                                                        mobility, sculpt muscle and much more. This functional workout
                                                        tool will target your
                                                        upper body, abs, back, glutes and legs.</p>
                                                </div>
                                            </figcaption>


                                        </figure>


                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 col-xs-6" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom"
                             data-aos-duration="1000" data-aos-delay="750"
                             style="padding: 10px;background: #fff;border-radius:10px">
                            <div class="sqs-block image-block sqs-block-image" data-block-type="5"
                                 id="block-yui_3_17_2_1_1536784135462_28616" style="box-shadow: 0px 5px 7px #33333340;
    border-radius: 10px;
">
                                <div class="sqs-block-content">


                                    <div class="
          image-block-outer-wrapper
          layout-caption-overlay-hover
          design-layout-inline
          combination-animation-none
          individual-animation-none
          individual-text-animation-none
        " data-test="image-block-inline-outer-wrapper">


                                        <figure class="
              sqs-block-image-figure
              intrinsic
            " style="max-width:2500px;
  overflow: hidden;






">


                                            <div class="image-block-wrapper" data-animation-role="image">
                                                <div class="sqs-image-shape-container-element



              has-aspect-ratio
            " style="
                position: relative;

                  padding-bottom:100%;


  overflow: hidden;







              ">
                                                    <noscript><img src="{{asset('front/img/kettlebells1.jpg')}}" alt="SAMI HAKIM"/>
                                                    </noscript>
                                                    <img
                                                        style="background: #fff;border-radius: 10px;"
                                                        class="thumb-image"
                                                        data-src="{{asset('front/img/kettlebells1.jpg')}}" data-image=""
                                                        data-image-dimensions="2500x2500"
                                                        data-image-focal-point="0.5,0.5" alt="SAMI HAKIM"
                                                        data-load="false"
                                                        data-image-id="5b9b90fa21c67c95e7115aa7" data-type="image"/>
                                                </div>
                                            </div>


                                            <figcaption class="image-caption-wrapper">
                                                <div class="image-caption">
                                                    <p class=""><strong style="text-align: center;">BODY WEIGHT
                                                            EXERCISES</strong><br>No expensive machines or heavy weights
                                                        required. By focusing on
                                                        the body’s natural movements, we have fewer limitations in range
                                                        of motion. Our
                                                        techniques will Improve strength, stability, endurance, power,
                                                        and burn major calories.
                                                    </p>
                                                </div>
                                            </figcaption>


                                        </figure>


                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-6 col-xs-6  co-fit"></div>
                    </div>


            </section>
        </main>

    </div>
@endsection
