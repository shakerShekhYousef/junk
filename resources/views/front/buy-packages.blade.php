@extends('layouts.front.base')
@section('pageTitle', 'Buy-packages')
@section('custom-style')
    <style>
        .package-section {
            padding: 0 102px;
        }

        a:hover {
            text-decoration: none;
        }


        label {
            font-family: 'Futura';
        }

        .package-section .logo-head {
            align-items: flex-end;
        }

        .package-section .logo-head h6 {
            font-size: 1.25rem;
            color: #000;
            padding-left: 8px;
            text-transform: uppercase;
        }

        .package-section .section-buy .section-buy-content {
            padding-bottom: 3rem;
        }

        .package-section .section-buy .section-buy-content img {
            width: 100%;
        }

        .div-two,
        .div-three {
            display: none
        }

        .package-section .list {
            justify-content: space-between;
            background: #f8f9fa !important;
            padding: 1rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .package-section .list ul {
            display: flex;
            margin-bottom: 0 !important;

        }

        .package-section .list .list1 li {
            padding-right: 20px;
        }

        .package-section .list .list2 li {
            padding-left: 20px;
        }

        .package-section .list a {
            color: #000;
            text-transform: capitalize;
            font-size: 16px;
            font-family: 'Futura';
            font-weight: 500;
        }

        .package-section .list a:hover {
            color: #90D242;
            text-decoration: none;
        }

        ul>.active>a {
            border-bottom: 3px solid #90D242;
        }

        .package-section .section-buy h2 {
            margin-bottom: 20px;
        }

        .Main--page {
            /*background: #fff !important;*/
            margin: 0rem 0rem;
        }

        .package-section .section-container {
            background: #000;
            /*padding-right: 50px;
                                                                                                                                                                                    padding-left: 50px;*/
            margin: 5rem auto;
            padding-top: 3rem;
            padding-bottom: 5rem;
        }

        body {
            background: #000 !important;
        }



        .card-header {
            font-size: 20px;
            font-weight: 600;
            background: #90D242 !important;
            color: #fff;
        }

        .login-btn {
            box-shadow: none !important;
            background: #90d242 !important;
            border: none !important;
            font-size: 17px !important;
            font-weight: 600 !important;
            padding: 10px 50px !important;
            border-radius: 25px !important;
            color: #fff !important;
        }

        .login-btn:hover {
            box-shadow: 0px 3px 4px 1px #5faa07 !important;
            background: #67be00 !important;

        }

        .card-body input {
            box-shadow: none !important;
            border: 1px solid #ced4da !important;
        }

        .card-fo a:hover {
            color: #90D242;
            text-decoration: none;
        }

        .Footer {
            background-color: black !important;
        }

        @media (max-width: 991px) {
            .Main--page {
                margin: 0rem 3rem;
            }
        }

        @media screen and (max-width: 1024px) {
            .package-section {
                padding-left: 64px;
                padding-right: 64px;
            }
        }

        @media screen and (max-width: 960px) {
            .package-section {
                padding-left: 48px;
                padding-right: 48px;
            }
        }

        @media screen and (max-width: 768px) {
            .package-section {
                padding-left: 36px;
                padding-right: 36px;
            }

            .package-section .list ul {}
        }

        @media screen and (max-width: 767.5px) {
            .package-section .section-buy .section-buy-content {
                padding-bottom: 0rem;
            }

            .package-section .section-buy .section-buy-content img {
                margin-bottom: 2rem;
            }

            .list {
                justify-content: center !important;
            }

            .package-section .list .list1 li {}

            .package-section .list .list2 li {
                padding-left: 0;
            }

            .list li {
                padding-right: 10px !important;
            }
        }

        @media screen and (max-width: 640px) {
            .package-section {
                padding-left: 20px;
                padding-right: 20px;
            }
        }

        @media screen and (max-width: 575px) {
            .Main--page {
                margin: auto;
                background: #000 !important;
            }

            .package-section .section-container {
                padding-right: 0;
                padding-left: 0;
                margin: 0 auto;
                padding-top: 3rem;
                padding-bottom: 5rem;
            }

            .info-package img {
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
        <main class="Main Main--page ">
            <div class=" package-section">
                <div class="container">
                    <div class="section-container">
                        <div class="row logo-head">
                            <a href="{{ route('front-home') }}">
                                <img src="{{ asset('front/img/logo.png') }}">
                            </a>
                            <h6>Secure Payment System</h6>
                        </div>
                        <div class="row list">
                            <ul class="list-unstyled list1">
                                <li><a href="#">PACKAGES</a></li>
                                <li style="display: none;"><a href="{{ route('my-profile') }}" class=""
                                        data-div="">YOUR ACCOUNT</a></li>
                            </ul>
                            @guest
                                <ul style="display: none;" class="list-unstyled list2">

                                    <li><a href="#" target="_blank">Sign up</a></li>
                                </ul>
                            @endguest
                        </div>
                        <div class=" div-one content section-buy">
                            <h1 style="text-transform: uppercase;">Buy Sessions</h1>
                            <?php $j = 0; ?>
                            <div class="row">
                                {{-- <div class="col-md-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                    data-aos-duration="1000">
                                    <a href="{{ route('fclassf') }}" target="_blank"><img src="{{ asset($packages[0]['image']) }}"
                                            width="100%"></a>
                                </div> --}}
                                <div class="col-md-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                    data-aos-duration="1000">
                                    <a
                                        href="https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/626a66eb048e4e770c30b745/plan/1651140313077/buy" target="_blank"><img
                                            src="{{ asset($packages[1]['image']) }}" width="100%"></a>
                                </div>

                            </div>
                            {{-- <div class="row mt-4">
                                <div class="col-md-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                    data-aos-duration="1000">
                                    <a
                                        href="https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c78f43468a224878ecee/plan/1639499605557/buy"><img
                                            src="{{ asset($packages[2]['image']) }}" width="100%"></a>
                                </div>
                                <div class="col-md-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                    data-aos-duration="1000">
                                    <a
                                        href="https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c83f1677b3654100215d/plan/1639499792492/buy"><img
                                            src="{{ asset($packages[3]['image']) }}" width="100%"></a>
                                </div>
                            </div> --}}
                            {{-- <div class="row mt-4">

                                <div class="col-md-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                    data-aos-duration="1000">
                                    <a
                                        href="https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08cf2d185d43b9b0c937d/plan/1640008897151/buy"><img
                                            src="{{ asset($packages[4]['image']) }}" width="100%"></a>
                                </div>
                                <div class="col-md-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                    data-aos-duration="1000">
                                    <a
                                        href="https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61b8c736e1a1fb536c2aaf85/plan/1639499391288/buy"><img
                                            src="{{ asset($packages[1]['image']) }}" width="100%"></a>
                                </div>

                            </div> --}}
                            {{-- <div class="row mt-4">
                                <div class="col-md-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                    data-aos-duration="1000">
                                    <a
                                        href="https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c0a6636b190c16a8436f76/plan/1640015431674/buy"><img
                                            src="{{ asset($packages[6]['image']) }}" width="100%"></a>
                                </div>
                                <div class="col-md-6" data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                    data-aos-duration="1000">
                                    <a
                                        href="https://app.glofox.com/portal/#/branch/61b2187f0f16027667682fe3/memberships/61c08e514428b06ece26c0ab/plan/1640009280807/buy"><img
                                            src="{{ asset($packages[5]['image']) }}" width="100%"></a>
                                </div>
                            </div> --}}

                            <div class="info-package">
                                <p>* Prices are inclusive of VAT</p>
                                <p>* Packages are non-transferable between members</p>
                                <p>* Complimentary suspension on paid in full class pass purchase is available </p>
                                <p>* Certain restrictions apply</p>
                                <div class="text-center pt-5">
                                    <p>We accept payments online using Visa and MasterCard credit/debit card in AED</p>
                                    <img src="{{ asset('front/img/cards_accepted_white.png') }}">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @guest
                    <div class="  div-three content section-login">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-2 col-xs-12"></div>
                            <div class="col-xl-4 col-lg-4 col-md-8 col-xs-12">
                                <div class="card text-center" style="    box-shadow: 0 2px 8px 1px rgb(0 0 0 / 20%);">
                                    <div class="card-header"
                                        style="    font-family: 'heavy_dock11';
                                                                                                                                                                                                                                                                                                                                                                                          text-transform: uppercase;">
                                        Sign in
                                    </div>
                                    <div class="card-body">
                                        <form action="#" name="mind_body_payments_bundle_login_type" method="post">
                                            @csrf
                                            <!--   <div class="form-group">
                                                                                                                                                                                                                                                                                                                                                                                                                          <label for="mind_body_payments_bundle_login_type_site" class="required">Site</label>
                                                                                                                                                                                                                                                                                                                                                                                                                          <select id="mind_body_payments_bundle_login_type_site" name="mind_body_payments_bundle_login_type[site]" class="form-control"><option value="abu_dhabi">Abu Dhabi</option><option value="dubai" selected="selected">Dubai</option></select>
                                                                                                                                                                                                                                                                                                                                                                                                                      </div> -->
                                            <div class="form-group">
                                                <label for="mind_body_payments_bundle_login_type_email"
                                                    class="required">Email</label>
                                                <input type="email" id="mind_body_payments_bundle_login_type_email"
                                                    name="mind_body_payments_bundle_login_type[email]" required="required"
                                                    class="form-control" />
                                            </div>
                                            <div class="form-group">
                                                <label for="mind_body_payments_bundle_login_type_password"
                                                    class="required">Password</label>
                                                <input type="password" id="mind_body_payments_bundle_login_type_password"
                                                    name="mind_body_payments_bundle_login_type[password]" required="required"
                                                    class="form-control" />
                                            </div>
                                            <div class="row">
                                                <div class="col form-group form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="remember_me"
                                                        name="remember" checked />
                                                    <label class="form-check-label" for="remember_me"><small>Remember
                                                            me</small></label>
                                                </div>
                                                {{-- <div class="col">
                                                        <a href="/reset-password"><small>Forgot Password?</small></a>
                                                    </div> --}}
                                            </div>
                                            <button type="submit" class="btn  login-btn" style=" text-transform: uppercase;">
                                                <i style="display: none;" class="fa fa-circle-o-notch fa-spin fa-fw"></i> Login
                                            </button>
                                            <input type="hidden" id="mind_body_payments_bundle_login_type__token"
                                                name="mind_body_payments_bundle_login_type[_token]"
                                                value="f6f1d.RNU_OIg94QCJSyoBMcUMeb4yINnjPtFj8hYXnVApams.CaMOaMZ4sjmkIklvWaB0IOkFQuiSV5AiymNV1iZ9MC0M5X1W0Uy0T-w_cw" />
                                        </form>
                                        <div class="row card-fo">
                                            <div class="col pt-4" style="font-family: 'Futura';">New to JUNK? <a href="#"
                                                    target="_blank"
                                                    style="    font-family: 'heavy_dock11';
                                                                                                                                                                                                                                                                                                                                                                                                  text-transform: uppercase;">Sign
                                                    up
                                                    now.</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endguest

            </div>
    </div>
    </div>
    </main>

    </div>
@section('custom-script')
    <script>
        $('.tab-link').click(function() {
            var contClass = $(this).data('div');
            $('.content').hide().filter('.' + contClass).show()
        })
    </script>
    <script>
        $('.tab-link2').click(function() {
            var contClass = $(this).data('div');
            $('.content').hide().filter('.' + contClass).show()
        })
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection
@endsection
