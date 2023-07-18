@extends('layouts.front.base')

@section('pageTitle', 'Dubais biggest fitness night club')
@section('custom-style')
    <style type="text/css">
        a:hover {
            text-decoration: none;
        }

        .btn:active,
        .btn:focus {
            outline: none;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
        }

        /* The sticky class is added to the header with JS when it reaches its scroll position */
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999999;

        }

        #myVid1 {
            display: none;
        }

        @media (max-width: 575.5px) {
            #myVid {
                display: none;
            }

            #myVid1 {
                display: block;
            }
        }

        select:focus {
            outline: none;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #ced4da !important;
        }

        #free-class:hover {
            color: #8fd241 !important;
            background-color: rgb(0 0 0) !important;
        }

        @media (max-width: 768px) {
            #btn-join {
                margin: 2rem auto;
            }
        }

        @media (max-width: 575px) {
            .play-btn {

                top: 6rem;
                right: 47%;
                color: #8fd241;
                font-size: 3rem;
            }

            .img-video {

                height: 260px;
            }
        }

        @media (max-width: 500px) {
            .play-btn {
                right: 44%;
            }
        }

        @media (max-width: 400px) {
            .play-btn {
                top: 6rem;
                right: 42%;
            }
        }





        .modal {
            border-radius: 7px;
            overflow: hidden;
            background-color: transparent;
        }

        .modal .logo a img {
            width: 30px;
        }

        .modal .modal-content {
            background-color: transparent;
            border: none;
            border-radius: 7px;
        }

        .modal .modal-content .modal-body {
            border-radius: 7px;
            overflow: hidden;
            background-color: #fff;
            padding-left: 0px;
            padding-right: 0px;
            -webkit-box-shadow: 0 10px 50px -10px rgba(0, 0, 0, 0.9);
            box-shadow: 0 10px 50px -10px rgba(0, 0, 0, 0.9);
        }

        .modal .modal-content .modal-body h2 {
            font-size: 18px;
        }

        .modal .modal-content .modal-body p {
            color: #777;
            font-size: 14px;
        }

        .modal .modal-content .modal-body h3 {
            color: #000;
            font-size: 22px;
        }

        .modal .modal-content .modal-body .close-btn {
            color: #000;
        }

        .modal .modal-content .modal-body .promo-img {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
        }

        .modal .modal-content .modal-body .promo-img .price {
            top: 20px;
            left: 20px;
            position: absolute;
            color: #fff;
        }

        .modal .btn {
            border-radius: 30px;
        }

        .modal .warp-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            position: relative;
            background: rgba(62, 100, 255, 0.05);
            color: #3e64ff;
            border-radius: 50%;
        }

        .modal .warp-icon span {
            font-size: 40px;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }





        .btn {
            border-radius: 4px;
            border: none;
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 30px;
            padding-right: 30px;
        }

        .btn:active,
        .btn:focus {
            outline: none;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
        }

        .close-btn {
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 20px;
        }

        .close-btn span {
            color: #ccc;
        }

        .close-btn:hover span {
            color: #699239;
        }

        .modal-open .modal {
            padding-right: 0 !important;
        }

        @media screen and (max-width: 575px) {
            .register-section .reg-content {

                padding: 0;
            }

            .register-section .form-reg-box {
                padding: 0;
            }
        }

        a:hover {
            text-decoration: none;
        }

        @media screen and (max-width: 640px) {
            .register-section {
                padding-left: 20px;
                padding-right: 20px;
            }

            .register-section .reg-content {
                padding: 0;

            }

            .register-section .form-reg-box {
                padding: 0;
            }
        }

        .t {
            margin-bottom: 10px !important;
            background-color: #000 !important;
            border: 1px solid #8fd241 !important;
            border-radius: 0 !important;
            box-shadow: 0 0 1px #b3ff51, 0 0 2px #b3ff51, 0 0 1px #b3ff51, 0 0 1px #b3ff51, inset 0 0 1px #b3ff51, inset 0 0 0 #b3ff51, inset 0 0 0 #b3ff51, inset 0 0 6px #b3ff52 !important;
        }

        .t1 {
            margin-bottom: 10px !important;
            background-color: #000 !important;
            border: 1px solid #ff114c !important;
            border-radius: 0 !important;
            box-shadow: 0 0 1px #ff114c, 0 0 2px #ff114c, 0 0 1px #ff114c, 0 0 1px #ff114c, inset 0 0 1px #ff114c, inset 0 0 0 #ff114c, inset 0 0 0 #ff114c, inset 0 0 6px #ff114c !important;
        }

        .t3 {
            margin-bottom: 10px !important;
            background-color: #000 !important;
            border: 1px solid #ed6768 !important;
            border-radius: 0 !important;
            box-shadow: 0 0 1px #ed6768, 0 0 2px #ed6768, 0 0 1px #ed6768, 0 0 1px #ed6768, inset 0 0 1px #ed6768, inset 0 0 0 #ed6768, inset 0 0 0 #ed6768, inset 0 0 6px #ed6768 !important;
        }

        .t4 {
            margin-bottom: 10px !important;
            background-color: #000 !important;
            border: 1px solid #c175fe !important;
            border-radius: 0 !important;
            box-shadow: 0 0 1px #c175fe, 0 0 2px #c175fe, 0 0 1px #c175fe, 0 0 1px #c175fe, inset 0 0 1px #c175fe, inset 0 0 0 #c175fe, inset 0 0 0 #c175fe, inset 0 0 6px #c175fe !important;
        }


        .mobile {
            display: none;
        }

        @media(min-width: 600px) {
            .disktop {
                display: flex !important;
            }

            .mobile {
                display: none !important;
            }
        }

        @media(max-width: 599px) {
            .disktop {
                display: none !important;
            }

            .mobile {
                display: block !important;
            }

            #booknow {
                display: none !important;
            }
        }

    </style>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

@endsection
@section('content')
    <div class="Content-outer">
        <main class="Index" data-collection-id="5b279fe0758d4684330aa811"
            data-controller="IndexFirstSectionHeight, Parallax, IndexNavigation">

            <section id="new-gallery-1" class="Index-gallery" data-controller="IndexGallery"
                data-collection-id="5e674dd32293d941d09984a4">
                <div class="Index-gallery-wrapper">
                    <button class="Index-gallery-control Index-gallery-control--left">
                        <svg class="Icon Icon--caretLarge--left" viewBox="0 0 23 48">
                            <use xlink:href="/assets/ui-icons.svg#caret-left-icon--large"></use>
                        </svg>
                        <svg class="Icon Icon--caretSmall--left" viewBox="0 0 9 16">
                            <use xlink:href="/assets/ui-icons.svg#caret-left-icon--small"></use>
                        </svg>
                    </button>
                    <button class="Index-gallery-control Index-gallery-control--right">
                        <svg class="Icon Icon--caretLarge--right" viewBox="0 0 23 48">
                            <use xlink:href="/assets/ui-icons.svg#caret-right-icon--large"></use>
                        </svg>
                        <svg class="Icon Icon--caretSmall--left" viewBox="0 0 9 16">
                            <use xlink:href="/assets/ui-icons.svg#caret-right-icon--small"></use>
                        </svg>
                    </button>

                    <div class="Index-gallery-indicators">
                        <button class="Index-gallery-indicators-item"><span
                                class="Index-gallery-indicators-item-inner"></span></button>
                    </div>

                </div>
            </section>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <nav class="Index-nav">
                <div class="Index-nav-inner">

                    <a href="#new-gallery-1" class="Index-nav-item active">
                        <div class="Index-nav-indicator"></div>
                        <div class="Index-nav-text"><span>New Gallery</span></div>
                    </a>

                </div>
            </nav>
            <!--   <section>

                                 <div class="Container-fluid" style="padding-left: 0!important;padding-right: 0!important">

                                    <a href="{{ route('buy-packages') }}">
                                        <img src="{{ asset('front/img/banner2.jpg') }}" width="100%" id="myvideo">
                                    </a>

                                </div>
                 -->
            </section>
            <!-- <div class="img-video"></div>


               <i class="fas fa-play-circle play-btn " style="cursor: pointer;"></i>
            </a>
            </div> -->
            <!-- video desktop -->
            <video src="{{ asset('front/img/video1.mp4') }}" autoplay controls loop width="100%" id="myVid"></video>
            <!-- video mobile -->
            <video src="{{ asset('front/img/video1.mp4') }}" autoplay controls loop width="100%" id="myVid1"></video>
            <!--first section-->
            <div class="Container-fluid home-p">


                <!--<div class="row" style="width:100%" data-aos="fade-up" data-aos-anchor-placement="center-bottom"-->
                <!--    data-aos-duration="1000">-->
                <!--    <div class="col-12 home-p1">-->
                <!--        <h2>What JUNK IS</h2>-->
                <!--        <p>Created to remix the ultimate fitness - nightclub experience! Powered by MUSIC and Inspired by-->
                <!--            PASSION !! </p>-->
                <!--        <p><strong>Leave it all out on our “Dance” floor.</strong> <br>-->

                <!--            <strong>Welcome to JUNK.</strong>-->

                <!--        </p>-->
                <!--    </div>-->
                <!--</div>-->













            </div>
            <!--end of first section-->

            <!--third section-->
            <section class="music-section2">
                <div class="Container-fluid">


                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12 col-md-12 col-sm-12" data-aos="fade-up"
                            data-aos-anchor-placement="center-bottom" data-aos-duration="2000" data-aos-delay="560"
                            style="padding: 0!important">

                            <a
                                href="https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/626a66eb048e4e770c30b745/plan/1651140313077/buy">
                                <img src="{{ asset('front/img/baner-final1.jpeg') }}" width="100%" id="myvideo">
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">

                </div>


                <div class="row" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                    data-aos-duration="2000" data-aos-delay="500">
                    <div class="col-12 ">
                        <h2 style="display: none;">Join the party</h2>
                        <p style="display: none;"> Every class is designed to make each workout fun, unique and powerful. We
                            have 5 class
                            types and 5 music genres to choose from. So, whatever your mood, we’ve got you
                            covered!</p>
                    </div>
                </div>
                <div class="row d-flex justify-content-center " style="width:100%">
                    <div class="col-12" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                        data-aos-duration="2000" data-aos-delay="550">
                        <a href="{{ route('front-classes') }}">
                            <button id="btn-join" class="btn-book">Join us</button>
                        </a>
                    </div>
                </div>
    </div>
    </section>
    <!--end of third section-->






    <!--section without popup in mobile size-->
    <div class="row d-flex justify-content-center home-img mobile"
        style="width:100%;padding-bottom: 40px; padding-top: 40px;">
        <!---->
        <div class="col-12 col-md-2" style="margin-bottom: 10px;">
            <a href="" data-toggle="modal" data-target="" style="color:#fff;">
                <img src="{{ asset('front/img/reboot-junk.png') }}" width="100%" style="background-color: #000;"
                    data-aos="fade-up" style="background-color: #000;" data-aos="fade-up"
                    data-aos-anchor-placement="center-bottom" data-aos-duration="1500">
            </a>
        </div>


        <!-- Modal -1 -->



        <div class="container t" style="width: 92%!important" data-aos="fade-up" data-aos="fade-up"
            data-aos-anchor-placement="center-bottom" data-aos-duration="1500">
            <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                id="page-5b27a52f88251ba76209d826">
                <div class="row sqs-row">
                    <div class="col-12 col-md-2">
                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                            id="block-8055dd57ca174b82e253">
                            <div class="sqs-block-content">

                                <p style="text-align:center; color:#fff!important;margin-top: 1rem;margin-bottom: 2rem;font-size: 30px!important"
                                    class=""><strong
                                        style="text-align:center; color:#8fd241!important;">RE-BOOT</strong>
                                </p>

                                <p>JUNK bootcamp provides you with high-intensity, total body conditioning
                                    exercises, using both bodyweight and equipment, designed to strengthen
                                    and leave you with a lasting burn. Tighten those abs, burn fat and get
                                    rid of the junk in your trunk.</p>


                                <div class="row" style="margin-top: 2rem;margin-bottom: 1rem">


                                    <span class="col-lg-12 col-12">
                                        {{-- <select id="packages_list_1" name="month" class="form-control">
                                                        <option style="display: none;" value="01">Select your package
                                                        </option>
                                                        @foreach ($packages as $package)
                                                            <option value="{{ $package->id }}">
                                                                {{ $package->name }}</option>
                                                        @endforeach
                                                    </select> --}}
                                    </span>
                                </div>

                                <div class="row d-flex justify-content-center " style="width:100%;margin: 0!important">
                                    <div class="col-12" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                        data-aos-duration="1000">
                                        <button class="btn-book" onclick="func1()">BUy NOW</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end-->
        <!--bet-->
        <div class="col-12 col-md-2" style="margin-bottom: 10px;">
            <a href="" data-toggle="modal" data-target="" style="color:#fff;">
                <img src="{{ asset('front/img/box-junk.jpg') }}" width="100%" style="background-color: #000;"
                    data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1500"
                    data-aos-delay="500">
            </a>
        </div>

        <!-- Modal -2 -->



        <div class="container t1" style="width: 92%!important" data-aos="fade-up" data-aos="fade-up"
            data-aos-anchor-placement="center-bottom" data-aos-duration="1500">
            <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                id="page-5b27a52f88251ba76209d826">
                <div class="row sqs-row">
                    <div class="col-12 col-md-2">
                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                            id="block-8055dd57ca174b82e253">
                            <div class="sqs-block-content">
                                <p style="text-align:center; color:#fff!important;margin-top: 1rem;margin-bottom: 2rem;font-size: 30px!important"
                                    class=""><strong
                                        style="text-align:center; color:#ff114c!important;">BEATBOX</strong>
                                </p>

                                <p>The JUNK fitness class that packs a punch! Let your body mimic the beat
                                    as you take on this high energy box fit class – high knees, powerful
                                    jabs and stealthy movements come together to create a full body workout,
                                    improving both stamina and coordination.</p>


                                <div class="row" style="margin-top: 2rem;margin-bottom: 1rem">


                                    <span class="col-lg-12 col-12">
                                        {{-- <select id="packages_list_2" name="month" class="form-control">
                                                        <option style="display: none;" value="01">Select your package
                                                        </option>

                                                        @foreach ($packages as $package)
                                                            <option value="{{ $package->id }}">
                                                                {{ $package->name }}</option>
                                                        @endforeach
                                                    </select> --}}
                                    </span>
                                </div>

                                <div class="row d-flex justify-content-center " style="width:100%;margin: 0!important">
                                    <div class="col-12" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                        data-aos-duration="1000">
                                        <button class="btn-book" onclick="func2()"
                                            style="background: linear-gradient(45deg, #ff114c, #ff114c)">BUy
                                            NOW</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end-->

        <!--dance-->
        <div class="col-12 col-md-2" style="margin-bottom: 10px;">
            <a href="" data-toggle="modal" data-target="" style="color:#fff;">
                <img src="{{ asset('front/img/dance-junk.jpg') }}" width="100%" style="background-color: #000;"
                    data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1500"
                    data-aos-delay="1000">
            </a>
        </div>

        <!-- Modal -3 -->



        <div class="container t3" style="width: 92%!important" data-aos="fade-up" data-aos="fade-up"
            data-aos-anchor-placement="center-bottom" data-aos-duration="1500">
            <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                id="page-5b27a52f88251ba76209d826">
                <div class="row sqs-row">
                    <div class="col-12 col-md-2">
                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                            id="block-8055dd57ca174b82e253">
                            <div class="sqs-block-content">

                                <p style="text-align:center; color:#fff!important;margin-top: 1rem;margin-bottom: 2rem;font-size: 30px!important"
                                    class=""><strong
                                        style="text-align:center; color:#dc878a!important;">DANCE</strong>
                                </p>

                                <p>We WANT you on our “dance” floor. This addictive fitness class is
                                    designed with FUN in mind. Our Dance MC will lead you through this FUN,
                                    calorie-burning, mood enhancing, electrifying workout.</p>


                                <div class="row" style="margin-top: 2rem;margin-bottom: 1rem">


                                    <span class="col-lg-12 col-12">
                                        {{-- <select id="packages_list_3" name="month" class="form-control">
                                                        <option style="display: none;" value="01">Select your package
                                                        </option>

                                                        @foreach ($packages as $package)
                                                            <option value="{{ $package->id }}">
                                                                {{ $package->name }}</option>
                                                        @endforeach
                                                    </select> --}}
                                    </span>
                                </div>

                                <div class="row d-flex justify-content-center " style="width:100%;margin: 0!important">
                                    <div class="col-12" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                        data-aos-duration="1000">
                                        <button class="btn-book" onclick="func3()"
                                            style="background: linear-gradient(45deg, #dc878a, #dc878a)">BUy
                                            NOW</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end-->
        <!--yoga-->
        <div class="col-12 col-md-2" style="margin-bottom: 10px;">
            <a href="" data-toggle="modal" data-target="" style="color:#fff;">
                <img src="{{ asset('front/img/Logo_yoga1.png') }}" width="100%" style="background-color: #000;"
                    data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1500"
                    data-aos-delay="750">
            </a>
        </div>
        <!-- Modal -4 -->



        <div class="container t4" style="width: 92%!important" data-aos="fade-up" data-aos="fade-up"
            data-aos-anchor-placement="center-bottom" data-aos-duration="1500">
            <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                id="page-5b27a52f88251ba76209d826">
                <div class="row sqs-row">
                    <div class="col-12 col-md-2">
                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                            id="block-8055dd57ca174b82e253">
                            <div class="sqs-block-content">

                                <p style="text-align:center; color:#fff!important;margin-top: 1rem;margin-bottom: 2rem;font-size: 30px!important"
                                    class=""><strong
                                        style="text-align:center; color:#644189!important;">YOGA</strong>
                                </p>

                                <p>JUNK Yoga will take you through a series of poses and salutations
                                    designed to relieve stress, improve posture, increase flexibility and to
                                    strengthen and tone the body. Channel the zen from within with our
                                    hypnotic- meditative yoga or join us for a blood pumping, body
                                    sculpting- high intensity power yoga.</p>


                                <div class="row" style="margin-top: 2rem;margin-bottom: 1rem">


                                    <span class="col-lg-12 col-12">
                                        {{-- <select id="packages_list_4" name="month" class="form-control">
                                                        <option style="display: none;" value="01">Select your package
                                                        </option>

                                                        @foreach ($packages as $package)
                                                            <option value="{{ $package->id }}">
                                                                {{ $package->name }}</option>
                                                        @endforeach
                                                    </select> --}}
                                    </span>
                                </div>

                                <div class="row d-flex justify-content-center " style="width:100%;margin: 0!important">
                                    <div class="col-12" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                        data-aos-duration="1000">
                                        <button class="btn-book" onclick="func4()"
                                            style="background: linear-gradient(45deg, #644189, #644189);">BUy
                                            NOW</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end-->
        <!--recycle-->
        <div class="col-12 col-md-2" style="margin-bottom: 10px;">
            <a href="" data-toggle="modal" data-target="" style="color:#fff;">
                <img src="{{ asset('front/img/Logo_recycle1.png') }}" width="100%" style="background-color: #000;"
                    data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1500"
                    data-aos-delay="250">
            </a>
        </div>
        <!-- Modal -5 -->



        <div class="container t" style="width: 92%!important" data-aos="fade-up" data-aos="fade-up"
            data-aos-anchor-placement="center-bottom" data-aos-duration="1500">
            <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                id="page-5b27a52f88251ba76209d826">
                <div class="row sqs-row">
                    <div class="col-12 col-md-2">
                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                            id="block-8055dd57ca174b82e253">
                            <div class="sqs-block-content">

                                <p style="text-align:center; color:#fff!important;margin-top: 1rem;margin-bottom: 2rem;font-size: 30px!important"
                                    class=""><strong
                                        style="text-align:center; color:#8fd241!important;">RE-CYCLE</strong>
                                </p>

                                <p>Our JUNK version of cycling is the only rave without a comedown. Our
                                    instructors will take you through an energetic, sensory journey giving
                                    you full-body workout as you tackle a series of powerful sprints and
                                    quad burning climbs.</p>


                                <div class="row" style="margin-top: 2rem;margin-bottom: 1rem">


                                    <span class="col-lg-12 col-12">
                                        {{-- <select id="packages_list_5" name="month" class="form-control">
                                                        <option style="display: none;" value="01">Select your package
                                                        </option>
                                                        @foreach ($packages as $package)
                                                            <option value="{{ $package->id }}">
                                                                <a href="">{{ $package->name }}</a>
                                                            </option>
                                                        @endforeach
                                                    </select> --}}
                                    </span>
                                </div>

                                <div class="row d-flex justify-content-center " style="width:100%;margin: 0!important">
                                    <div class="col-12" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                        data-aos-duration="1000">
                                        <button class="btn-book" onclick="func5()">BUy NOW</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--end-->

    </div>
    <!---->




    <div class="row d-flex justify-content-center home-img disktop"
        style="width:100%;padding-bottom: 40px; padding-top: 40px;">
        <!---->
        <div class="col-12 col-md-2" style="margin-bottom: 10px;">
            <a href="" data-toggle="modal" data-target="#exampleModalCenter1" style="color:#fff;">
                <img src="{{ asset('front/img/reboot-junk.png') }}" width="100%" style="background-color: #000;"
                    data-aos="fade-up" style="background-color: #000;" data-aos="fade-up"
                    data-aos-anchor-placement="center-bottom" data-aos-duration="1500">
            </a>
        </div>
        <!--bet-->
        <div class="col-12 col-md-2" style="margin-bottom: 10px;">
            <a href="" data-toggle="modal" data-target="#exampleModalCenter2" style="color:#fff;">
                <img src="{{ asset('front/img/box-junk.jpg') }}" width="100%" style="background-color: #000;"
                    data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1500"
                    data-aos-delay="500">
            </a>
        </div>

        <!--dance-->
        <div class="col-12 col-md-2" style="margin-bottom: 10px;">
            <a href="" data-toggle="modal" data-target="#exampleModalCenter3" style="color:#fff;">
                <img src="{{ asset('front/img/dance-junk.jpg') }}" width="100%" style="background-color: #000;"
                    data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1500"
                    data-aos-delay="1000">
            </a>
        </div>
        <!--yoga-->
        <div class="col-12 col-md-2" style="margin-bottom: 10px;">
            <a href="" data-toggle="modal" data-target="#exampleModalCenter4" style="color:#fff;">
                <img src="{{ asset('front/img/Logo_yoga1.png') }}" width="100%" style="background-color: #000;"
                    data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1500"
                    data-aos-delay="750">
            </a>
        </div>
        <!--recycle-->
        <div class="col-12 col-md-2" style="margin-bottom: 10px;">
            <a href="" data-toggle="modal" data-target="#exampleModalCenter5" style="color:#fff;">
                <img src="{{ asset('front/img/Logo_recycle1.png') }}" width="100%" style="background-color: #000;"
                    data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1500"
                    data-aos-delay="250">
            </a>
        </div>

    </div>


    <div class="row d-flex justify-content-center " style="width:100%" id="booknow">
        <div class="col-12" data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
            <a href="{{ route('front-classes') }}">
                <button class="btn-book">book classes</button>
            </a>
        </div>
    </div>



    </div>
    <!--end of first section-->

    <!--third section-->
    <section class="music-section2" style="display: none;">
    </section>
    <!--end of third section-->
    <!--second section-->
    <section class="classes-section ">
        <div class="Container-fluid">
            <div class="row" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-mirror="true"
                data-aos-once="false" data-aos-anchor-placement="top-center" data-aos-duration="1000">

                <div class="col-12">
                    <div class="row" style="justify-content: center;margin-top: 2rem;">
                        <div class="col-12 col-md-2">
                            <a href="{{ route('junk-jams') }}#90classic" target="_blank">
                                <img src="{{ asset('front/img/90classes-junk.png') }}" width="100%">
                            </a>
                        </div>
                        <div class="col-12 col-md-2">
                            <a href="{{ route('junk-jams') }}#cheesy" target="_blank">
                                <img src="{{ asset('front/img/pop-junk.png') }}" width="100%">
                            </a>
                        </div>
                        <div class="col-12 col-md-2">
                            <a href="{{ route('junk-jams') }}#rave" target="_blank">
                                <img src="{{ asset('front/img/rave-junk.png') }}" width="100%">
                            </a>
                        </div>
                        <div class="col-12 col-md-2">
                            <a href="{{ route('junk-jams') }}#randbeat" target="_blank">
                                <img src="{{ asset('front/img/r-junk.png') }}" width="100%">
                            </a>
                        </div>

                        <div class="col-12 col-md-2">
                            <a href="{{ route('junk-jams') }}#dance" target="_blank">
                                <img src="{{ asset('front/img/house-junk.png') }}" width="100%">
                            </a>
                        </div>
                        <div class="col-12 col-md-12 party text-center mt-5">
                            <h2>JAM WITH US</h2>
                            <p>Our set lists have been carefully curated by our DJ, to help you get the most from your
                                workout.,<br> From 90’s classics to cheesy pop to R&Beat, there’s something in here for
                                everyone!</p>
                            <a href="{{ route('junk-jams') }}">
                                <button class="btn-classes">JUNK JAMS</button>
                            </a>
                        </div>
                    </div>
                </div>
    </section>
    <!--end of second section-->

    </main>
    </div>
    </div>

    <!-- Modal -1 -->
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-right: 0!important;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 t">


                    <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><span class="fa fa-close"></span></span>
                    </a>

                    <div class="Content-outer">


                        <section>
                            <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                                id="page-5b27a52f88251ba76209d826">
                                <div class="row sqs-row">
                                    <div class="col sqs-col-12 span-12">
                                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                            id="block-8055dd57ca174b82e253">
                                            <div class="sqs-block-content">

                                                <p style="text-align:center; color:#fff!important;margin-top: 1rem;margin-bottom: 2rem;font-size: 30px!important"
                                                    class=""><strong
                                                        style="text-align:center; color:#8fd241!important;">RE-BOOT</strong>
                                                </p>

                                                <p>JUNK bootcamp provides you with high-intensity, total body conditioning
                                                    exercises, using both bodyweight and equipment, designed to strengthen
                                                    and leave you with a lasting burn. Tighten those abs, burn fat and get
                                                    rid of the junk in your trunk.</p>


                                                <div class="row" style="margin-top: 2rem;margin-bottom: 1rem">


                                                    <span class="col-lg-12 col-12">
                                                        <select id="packages_list_1" name="month" class="form-control">
                                                            <option style="display: none;" value="01">Select your package
                                                            </option>
                                                            @foreach ($packages as $package)
                                                                @if($package->id != 1)
                                                                    <option value="{{ $package->id }}">
                                                                        {{ $package->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </div>

                                                <div class="row d-flex justify-content-center " style="width:100%">
                                                    <div class="col-12" data-aos="fade-up"
                                                        data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                                                        <button class="btn-book" onclick="func1()">BUy NOW</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-->

    <!-- Modal -2 -->
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-right: 0!important;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-2 px-3 t">


                    <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close" style="z-index: 999">
                        <span aria-hidden="true"><span class="fa fa-close"></span></span>
                    </a>

                    <div class="Content-outer">


                        <section>
                            <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                                id="page-5b27a52f88251ba76209d826">
                                <div class="row sqs-row">
                                    <div class="col sqs-col-12 span-12">
                                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                            id="block-8055dd57ca174b82e253">
                                            <div class="sqs-block-content">
                                                <p style="text-align:center; color:#fff!important;margin-top: 1rem;margin-bottom: 2rem;font-size: 30px!important"
                                                    class=""><strong
                                                        style="text-align:center; color:#8fd241!important;">BEATBOX</strong>
                                                </p>

                                                <p>The JUNK fitness class that packs a punch! Let your body mimic the beat
                                                    as you take on this high energy box fit class – high knees, powerful
                                                    jabs and stealthy movements come together to create a full body workout,
                                                    improving both stamina and coordination.</p>


                                                <div class="row" style="margin-top: 2rem;margin-bottom: 1rem">


                                                    <span class="col-lg-12 col-12">
                                                        <select id="packages_list_2" name="month" class="form-control">
                                                            <option style="display: none;" value="01">Select your package
                                                            </option>

                                                            @foreach ($packages as $package)
                                                                @if($package->id != 1)
                                                                    <option value="{{ $package->id }}">
                                                                        {{ $package->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </div>

                                                <div class="row d-flex justify-content-center " style="width:100%">
                                                    <div class="col-12" data-aos="fade-up"
                                                        data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                                                        <button class="btn-book" onclick="func2()">BUy NOW</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-->

    <!-- Modal -3 -->
    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-right: 0!important;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 t">


                    <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><span class="fa fa-close"></span></span>
                    </a>

                    <div class="Content-outer">


                        <section>
                            <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                                id="page-5b27a52f88251ba76209d826">
                                <div class="row sqs-row">
                                    <div class="col sqs-col-12 span-12">
                                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                            id="block-8055dd57ca174b82e253">
                                            <div class="sqs-block-content">

                                                <p style="text-align:center; color:#fff!important;margin-top: 1rem;margin-bottom: 2rem;font-size: 30px!important"
                                                    class=""><strong
                                                        style="text-align:center; color:#8fd241!important;">DANCE</strong>
                                                </p>

                                                <p>We WANT you on our “dance” floor. This addictive fitness class is
                                                    designed with FUN in mind. Our Dance MC will lead you through this FUN,
                                                    calorie-burning, mood enhancing, electrifying workout.</p>


                                                <div class="row" style="margin-top: 2rem;margin-bottom: 1rem">


                                                    <span class="col-lg-12 col-12">
                                                        <select id="packages_list_3" name="month" class="form-control">
                                                            <option style="display: none;" value="01">Select your package
                                                            </option>

                                                            @foreach ($packages as $package)
                                                                @if($package->id != 1)
                                                                    <option value="{{ $package->id }}">
                                                                        {{ $package->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </div>

                                                <div class="row d-flex justify-content-center " style="width:100%">
                                                    <div class="col-12" data-aos="fade-up"
                                                        data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                                                        <button class="btn-book" onclick="func3()">BUy NOW</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-->

    <!-- Modal -4 -->
    <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-right: 0!important;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-2 px-3 t">


                    <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close" style="z-index: 999">
                        <span aria-hidden="true"><span class="fa fa-close"></span></span>
                    </a>

                    <div class="Content-outer">


                        <section>
                            <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                                id="page-5b27a52f88251ba76209d826">
                                <div class="row sqs-row">
                                    <div class="col sqs-col-12 span-12">
                                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                            id="block-8055dd57ca174b82e253">
                                            <div class="sqs-block-content">

                                                <p style="text-align:center; color:#fff!important;margin-top: 1rem;margin-bottom: 2rem;font-size: 30px!important"
                                                    class=""><strong
                                                        style="text-align:center; color:#8fd241!important;">YOGA</strong>
                                                </p>

                                                <p>JUNK Yoga will take you through a series of poses and salutations
                                                    designed to relieve stress, improve posture, increase flexibility and to
                                                    strengthen and tone the body. Channel the zen from within with our
                                                    hypnotic- meditative yoga or join us for a blood pumping, body
                                                    sculpting- high intensity power yoga.</p>


                                                <div class="row" style="margin-top: 2rem;margin-bottom: 1rem">


                                                    <span class="col-lg-12 col-12">
                                                        <select id="packages_list_4" name="month" class="form-control">
                                                            <option style="display: none;" value="01">Select your package
                                                            </option>

                                                            @foreach ($packages as $package)
                                                                @if($package->id != 1)
                                                                    <option value="{{ $package->id }}">
                                                                        {{ $package->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </div>

                                                <div class="row d-flex justify-content-center " style="width:100%">
                                                    <div class="col-12" data-aos="fade-up"
                                                        data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                                                        <button class="btn-book" onclick="func4()">BUy NOW</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-->

    <!-- Modal -5 -->
    <div class="modal fade" id="exampleModalCenter5" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-right: 0!important;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5 t">


                    <a href="#" class="close-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><span class="fa fa-close"></span></span>
                    </a>

                    <div class="Content-outer">


                        <section>
                            <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                                id="page-5b27a52f88251ba76209d826">
                                <div class="row sqs-row">
                                    <div class="col sqs-col-12 span-12">
                                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                            id="block-8055dd57ca174b82e253">
                                            <div class="sqs-block-content">

                                                <p style="text-align:center; color:#fff!important;margin-top: 1rem;margin-bottom: 2rem;font-size: 30px!important"
                                                    class=""><strong
                                                        style="text-align:center; color:#8fd241!important;">RE-CYCLE</strong>
                                                </p>

                                                <p>Our JUNK version of cycling is the only rave without a comedown. Our
                                                    instructors will take you through an energetic, sensory journey giving
                                                    you full-body workout as you tackle a series of powerful sprints and
                                                    quad burning climbs.</p>


                                                <div class="row" style="margin-top: 2rem;margin-bottom: 1rem">


                                                    <span class="col-lg-12 col-12">
                                                        <select id="packages_list_5" name="month" class="form-control">
                                                            <option style="display: none;" value="01">Select your package
                                                            </option>
                                                            @foreach ($packages as $package)
                                                               @if($package->id != 1)
                                                                    <option value="{{ $package->id }}">
                                                                        {{ $package->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </div>

                                                <div class="row d-flex justify-content-center " style="width:100%">
                                                    <div class="col-12" data-aos="fade-up"
                                                        data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                                                        <button class="btn-book" onclick="func5()">BUy NOW</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end-->

@section('custom-script')

    <script>
        function func1() {
            $package = $('#packages_list_1').val();
            if ($package == 1) {
                window.location.href =
                    "{{ route('fclassf') }}";
            }
            if ($package == 2) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c736e1a1fb536c2aaf85/plan/1639499391288/buy";
            }
            if ($package == 3) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c78f43468a224878ecee/plan/1639499605557/buy";
            }
            if ($package == 4) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c83f1677b3654100215d/plan/1639499792492/buy";
            }
            if ($package == 5) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08cf2d185d43b9b0c937d/plan/1640008897151/buy";
            }
            if ($package == 6) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08e514428b06ece26c0ab/plan/1640009280807/buy";
            }
            if ($package == 7) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c0a6636b190c16a8436f76/plan/1640015431674/buy";

            }
            if ($package == 8) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/626a66eb048e4e770c30b745/plan/1651140313077/buy";
            }
        }

        function func2() {
            $package = $('#packages_list_2').val();
            if ($package == 1) {
                window.location.href =
                    "{{ route('fclassf') }}";}
            if ($package == 2) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c736e1a1fb536c2aaf85/plan/1639499391288/buy";
            }
            if ($package == 3) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c78f43468a224878ecee/plan/1639499605557/buy";
            }
            if ($package == 4) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c83f1677b3654100215d/plan/1639499792492/buy";
            }
            if ($package == 5) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08cf2d185d43b9b0c937d/plan/1640008897151/buy";
            }
            if ($package == 6) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08e514428b06ece26c0ab/plan/1640009280807/buy";
            }
            if ($package == 7) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c0a6636b190c16a8436f76/plan/1640015431674/buy";

            }
            if ($package == 8) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/626a66eb048e4e770c30b745/plan/1651140313077/buy";
            }
        }

        function func3() {
            $package = $('#packages_list_3').val();
            if ($package == 1) {
                window.location.href =
                    "{{ route('fclassf') }}";}
            if ($package == 2) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c736e1a1fb536c2aaf85/plan/1639499391288/buy";
            }
            if ($package == 3) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c78f43468a224878ecee/plan/1639499605557/buy";
            }
            if ($package == 4) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c83f1677b3654100215d/plan/1639499792492/buy";
            }
            if ($package == 5) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08cf2d185d43b9b0c937d/plan/1640008897151/buy";
            }
            if ($package == 6) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08e514428b06ece26c0ab/plan/1640009280807/buy";
            }
            if ($package == 7) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c0a6636b190c16a8436f76/plan/1640015431674/buy";

            }
            if ($package == 8) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/626a66eb048e4e770c30b745/plan/1651140313077/buy";
            }
        }

        function func4() {
            $package = $('#packages_list_4').val();
            if ($package == 1) {
                window.location.href =
                    "{{ route('fclassf') }}";}
            if ($package == 2) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c736e1a1fb536c2aaf85/plan/1639499391288/buy";
            }
            if ($package == 3) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c78f43468a224878ecee/plan/1639499605557/buy";
            }
            if ($package == 4) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c83f1677b3654100215d/plan/1639499792492/buy";
            }
            if ($package == 5) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08cf2d185d43b9b0c937d/plan/1640008897151/buy";
            }
            if ($package == 6) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08e514428b06ece26c0ab/plan/1640009280807/buy";
            }
            if ($package == 7) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c0a6636b190c16a8436f76/plan/1640015431674/buy";

            }
            if ($package == 8) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/626a66eb048e4e770c30b745/plan/1651140313077/buy";
            }
        }

        function func5() {
            $package = $('#packages_list_5').val();
            if ($package == 1) {
                window.location.href =
                    "{{ route('fclassf') }}";}
            if ($package == 2) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c736e1a1fb536c2aaf85/plan/1639499391288/buy";
            }
            if ($package == 3) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c78f43468a224878ecee/plan/1639499605557/buy";
            }
            if ($package == 4) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c83f1677b3654100215d/plan/1639499792492/buy";
            }
            if ($package == 5) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08cf2d185d43b9b0c937d/plan/1640008897151/buy";
            }
            if ($package == 6) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08e514428b06ece26c0ab/plan/1640009280807/buy";
            }
            if ($package == 7) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c0a6636b190c16a8436f76/plan/1640015431674/buy";

            }
            if ($package == 8) {
                window.location.href =
                    "https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/626a66eb048e4e770c30b745/plan/1651140313077/buy";
            }
        }
    </script>
    <script type="text/javascript" data-sqs-type="imageloader-bootstrapper">
        (function() {
            if (window.ImageLoader) {
                window.ImageLoader.bootstrap({}, document);
            }
        })();
    </script>___scripts_1___<svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display:none"
        data-usage="social-icons-svg">
        <symbol id="instagram-icon" viewBox="0 0 64 64">
            <path
                d="M46.91,25.816c-0.073-1.597-0.326-2.687-0.697-3.641c-0.383-0.986-0.896-1.823-1.73-2.657c-0.834-0.834-1.67-1.347-2.657-1.73c-0.954-0.371-2.045-0.624-3.641-0.697C36.585,17.017,36.074,17,32,17s-4.585,0.017-6.184,0.09c-1.597,0.073-2.687,0.326-3.641,0.697c-0.986,0.383-1.823,0.896-2.657,1.73c-0.834,0.834-1.347,1.67-1.73,2.657c-0.371,0.954-0.624,2.045-0.697,3.641C17.017,27.415,17,27.926,17,32c0,4.074,0.017,4.585,0.09,6.184c0.073,1.597,0.326,2.687,0.697,3.641c0.383,0.986,0.896,1.823,1.73,2.657c0.834,0.834,1.67,1.347,2.657,1.73c0.954,0.371,2.045,0.624,3.641,0.697C27.415,46.983,27.926,47,32,47s4.585-0.017,6.184-0.09c1.597-0.073,2.687-0.326,3.641-0.697c0.986-0.383,1.823-0.896,2.657-1.73c0.834-0.834,1.347-1.67,1.73-2.657c0.371-0.954,0.624-2.045,0.697-3.641C46.983,36.585,47,36.074,47,32S46.983,27.415,46.91,25.816z M44.21,38.061c-0.067,1.462-0.311,2.257-0.516,2.785c-0.272,0.7-0.597,1.2-1.122,1.725c-0.525,0.525-1.025,0.85-1.725,1.122c-0.529,0.205-1.323,0.45-2.785,0.516c-1.581,0.072-2.056,0.087-6.061,0.087s-4.48-0.015-6.061-0.087c-1.462-0.067-2.257-0.311-2.785-0.516c-0.7-0.272-1.2-0.597-1.725-1.122c-0.525-0.525-0.85-1.025-1.122-1.725c-0.205-0.529-0.45-1.323-0.516-2.785c-0.072-1.582-0.087-2.056-0.087-6.061s0.015-4.48,0.087-6.061c0.067-1.462,0.311-2.257,0.516-2.785c0.272-0.7,0.597-1.2,1.122-1.725c0.525-0.525,1.025-0.85,1.725-1.122c0.529-0.205,1.323-0.45,2.785-0.516c1.582-0.072,2.056-0.087,6.061-0.087s4.48,0.015,6.061,0.087c1.462,0.067,2.257,0.311,2.785,0.516c0.7,0.272,1.2,0.597,1.725,1.122c0.525,0.525,0.85,1.025,1.122,1.725c0.205,0.529,0.45,1.323,0.516,2.785c0.072,1.582,0.087,2.056,0.087,6.061S44.282,36.48,44.21,38.061z M32,24.297c-4.254,0-7.703,3.449-7.703,7.703c0,4.254,3.449,7.703,7.703,7.703c4.254,0,7.703-3.449,7.703-7.703C39.703,27.746,36.254,24.297,32,24.297z M32,37c-2.761,0-5-2.239-5-5c0-2.761,2.239-5,5-5s5,2.239,5,5C37,34.761,34.761,37,32,37z M40.007,22.193c-0.994,0-1.8,0.806-1.8,1.8c0,0.994,0.806,1.8,1.8,1.8c0.994,0,1.8-0.806,1.8-1.8C41.807,22.999,41.001,22.193,40.007,22.193z" />
        </symbol>
        <symbol id="instagram-mask" viewBox="0 0 64 64">
            <path
                d="M43.693,23.153c-0.272-0.7-0.597-1.2-1.122-1.725c-0.525-0.525-1.025-0.85-1.725-1.122c-0.529-0.205-1.323-0.45-2.785-0.517c-1.582-0.072-2.056-0.087-6.061-0.087s-4.48,0.015-6.061,0.087c-1.462,0.067-2.257,0.311-2.785,0.517c-0.7,0.272-1.2,0.597-1.725,1.122c-0.525,0.525-0.85,1.025-1.122,1.725c-0.205,0.529-0.45,1.323-0.516,2.785c-0.072,1.582-0.087,2.056-0.087,6.061s0.015,4.48,0.087,6.061c0.067,1.462,0.311,2.257,0.516,2.785c0.272,0.7,0.597,1.2,1.122,1.725s1.025,0.85,1.725,1.122c0.529,0.205,1.323,0.45,2.785,0.516c1.581,0.072,2.056,0.087,6.061,0.087s4.48-0.015,6.061-0.087c1.462-0.067,2.257-0.311,2.785-0.516c0.7-0.272,1.2-0.597,1.725-1.122s0.85-1.025,1.122-1.725c0.205-0.529,0.45-1.323,0.516-2.785c0.072-1.582,0.087-2.056,0.087-6.061s-0.015-4.48-0.087-6.061C44.143,24.476,43.899,23.682,43.693,23.153z M32,39.703c-4.254,0-7.703-3.449-7.703-7.703s3.449-7.703,7.703-7.703s7.703,3.449,7.703,7.703S36.254,39.703,32,39.703z M40.007,25.793c-0.994,0-1.8-0.806-1.8-1.8c0-0.994,0.806-1.8,1.8-1.8c0.994,0,1.8,0.806,1.8,1.8C41.807,24.987,41.001,25.793,40.007,25.793z M0,0v64h64V0H0z M46.91,38.184c-0.073,1.597-0.326,2.687-0.697,3.641c-0.383,0.986-0.896,1.823-1.73,2.657c-0.834,0.834-1.67,1.347-2.657,1.73c-0.954,0.371-2.044,0.624-3.641,0.697C36.585,46.983,36.074,47,32,47s-4.585-0.017-6.184-0.09c-1.597-0.073-2.687-0.326-3.641-0.697c-0.986-0.383-1.823-0.896-2.657-1.73c-0.834-0.834-1.347-1.67-1.73-2.657c-0.371-0.954-0.624-2.044-0.697-3.641C17.017,36.585,17,36.074,17,32c0-4.074,0.017-4.585,0.09-6.185c0.073-1.597,0.326-2.687,0.697-3.641c0.383-0.986,0.896-1.823,1.73-2.657c0.834-0.834,1.67-1.347,2.657-1.73c0.954-0.371,2.045-0.624,3.641-0.697C27.415,17.017,27.926,17,32,17s4.585,0.017,6.184,0.09c1.597,0.073,2.687,0.326,3.641,0.697c0.986,0.383,1.823,0.896,2.657,1.73c0.834,0.834,1.347,1.67,1.73,2.657c0.371,0.954,0.624,2.044,0.697,3.641C46.983,27.415,47,27.926,47,32C47,36.074,46.983,36.585,46.91,38.184z M32,27c-2.761,0-5,2.239-5,5s2.239,5,5,5s5-2.239,5-5S34.761,27,32,27z" />
        </symbol>
        <symbol id="facebook-icon" viewBox="0 0 64 64">
            <path
                d="M34.1,47V33.3h4.6l0.7-5.3h-5.3v-3.4c0-1.5,0.4-2.6,2.6-2.6l2.8,0v-4.8c-0.5-0.1-2.2-0.2-4.1-0.2 c-4.1,0-6.9,2.5-6.9,7V28H24v5.3h4.6V47H34.1z" />
        </symbol>
        <symbol id="facebook-mask" viewBox="0 0 64 64">
            <path
                d="M0,0v64h64V0H0z M39.6,22l-2.8,0c-2.2,0-2.6,1.1-2.6,2.6V28h5.3l-0.7,5.3h-4.6V47h-5.5V33.3H24V28h4.6V24 c0-4.6,2.8-7,6.9-7c2,0,3.6,0.1,4.1,0.2V22z" />
        </symbol>
    </svg>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $("video").prop('muted', true);

        $("#mute-video").click(function() {
            if ($("video").prop('muted')) {
                $("video").prop('muted', false);
            } else {
                $("video").prop('muted', true);
            }
        });
    </script>

    <script>
        var myvid = $('#myVid')[0];
        $(window).scroll(function() {
            var scroll = $(this).scrollTop();
            scroll > 400 ? myvid.pause() : myvid.play()
        })
    </script>
    <script>
        var myvid1 = $('#myVid1')[0];
        $(window).scroll(function() {
            var scroll = $(this).scrollTop();
            scroll > 170 ? myvid1.pause() : myvid1.play()
        })
    </script>

@endsection
@endsection
