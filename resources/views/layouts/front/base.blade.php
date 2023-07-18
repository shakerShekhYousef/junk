<!doctype html>
<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" lang="en-US">

<head>
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '4943593525692534');
        fbq('track', 'PageView');
        fbq('track', 'AddPaymentInfo');
        fbq('track', 'AddToCart');
        fbq('track', 'AddToWishlist');
        fbq('track', 'CompleteRegistration');
        fbq('track', 'Contact');
        fbq('track', 'CustomizeProduct');
        fbq('track', 'Donate');
        fbq('track', 'FindLocation');
        fbq('track', 'InitiateCheckout');
        fbq('track', 'Lead');
        fbq('track', 'Purchase', {
            value: 0.00,
            currency: 'USD'
        });
        fbq('track', 'Schedule');
        fbq('track', 'Search');
        fbq('track', 'StartTrial', {
            value: '0.00',
            currency: 'USD',
            predicted_ltv: '0.00'
        });
        fbq('track', 'SubmitApplication');
        fbq('track', 'Subscribe', {
            value: '0.00',
            currency: 'USD',
            predicted_ltv: '0.00'
        });
        fbq('track', 'ViewContent');
    </script>
    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=4943593525692534&ev=PageView
            &noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1">

    <!-- This is Squarespace. -->
    <!-- JUNK-fit -->
    <!--<base href="">-->
    <meta charset="utf-8" />
    <title>@yield('pageTitle') - {{ config('app.name') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/img/logo-icon.png') }}" />
    <link rel="canonical" href="dubai-schedule.html" />
    <meta property="og:site_name" content="JUNK" />
    <meta property="og:title" content="Schedule – JUNK Fitness Dubai &mdash; JUNK" />
    <meta property="og:url" content="https://www.junk-fit.com/dubai-schedule" />
    <meta property="og:type" content="website" />
    <meta property="og:description"
        content="Login to your JUNK account and check out your stats, credits and bookings!" />
    <meta itemprop="name" content="schedule – JUNK Fitness Dubai — JUNK" />
    <meta itemprop="url" content="https://www.JUNK-fit.com/dubai-schedule" />
    <meta itemprop="description" content="Login to your JUNK account and check out your stats, credits and bookings!" />
    <meta name="twitter:title" content="Schedule – JUNK Fitness Dubai — JUNK" />
    <meta name="twitter:url" content="https://www.JUNK-fit.com/dubai-schedule" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description"
        content="Login to your JUNK account and check out your stats, credits and bookings!" />
    <meta name="description" content="Login to your JUNK account and check out your stats, credits and bookings!" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @include('layouts.front.styles')
    <!-- scripts for each page -->
    @yield('custom-style')
    <style>
        .whats-app {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 50px;
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
    <!-- /.scripts for each page -->
</head>

<body id="collection-60e38d4b1b5b112f454f4a56"
    class="tweak-social-icons-style-solid tweak-social-icons-shape-square tweak-site-width-option-constrained-width tweak-icon-weight-medium   tweak-site-ajax-loading-bar-show ancillary-header-top-left-layout-horizontal ancillary-header-top-center-layout-horizontal ancillary-header-top-right-layout-horizontal ancillary-header-bottom-left-layout-stacked ancillary-header-bottom-center-layout-horizontal ancillary-header-bottom-right-layout-horizontal ancillary-header-branding-position-top-left ancillary-header-tagline-position-hide ancillary-header-primary-nav-position-top-right ancillary-header-secondary-nav-position-top-right ancillary-header-social-position-hide ancillary-header-search-position-hide ancillary-header-cart-position-hide ancillary-header-account-position-hide tweak-header-primary-nav-hover-style-plain tweak-header-primary-nav-button-style-solid tweak-header-primary-nav-button-shape-square  tweak-header-secondary-nav-hover-style-plain tweak-header-secondary-nav-button-style-raised tweak-header-secondary-nav-button-shape-square tweak-header-search-style-rectangle tweak-header-search-placeholder-show tweak-header-cart-style-cart tweak-header-account-style-text   tweak-index-nav-style-none tweak-index-nav-position-right tweak-index-nav-text-show tweak-index-page-fullscreen-none  tweak-index-page-scroll-indicator-none tweak-index-page-scroll-indicator-icon-arrow tweak-index-page-scroll-indicator-icon-weight-hairline  tweak-index-gallery-layout-packed tweak-index-gallery-spacing-sides-show tweak-index-gallery-spacing-top-bottom-show tweak-index-gallery-fixed-height tweak-index-gallery-apply-bottom-spacing tweak-index-gallery-hover-style-plain tweak-index-gallery-controls-small-arrows tweak-index-gallery-controls-icon-weight-hairline tweak-index-gallery-indicators-lines tweak-index-gallery-autoplay-enable tweak-index-gallery-transition-fade tweak-index-gallery-content-position-middle-center tweak-index-gallery-content-text-alignment-center tweak-footer-show tweak-footer-layout-columns tweak-footer-layout-columns-auto tweak-footer-stacked-alignment-left   tweak-mobile-bar-top-fixed ancillary-mobile-bar-branding-position-top-left ancillary-mobile-bar-menu-icon-position-top-right tweak-mobile-bar-menu-icon-hamburger ancillary-mobile-bar-search-icon-position-hide ancillary-mobile-bar-cart-position-hide tweak-mobile-bar-cart-style-text ancillary-mobile-bar-account-position-hide tweak-mobile-bar-account-style-text tweak-mobile-overlay-slide-origin-left tweak-mobile-overlay-close-show  tweak-mobile-overlay-menu-primary-button-style-solid tweak-mobile-overlay-menu-primary-button-shape-square   tweak-mobile-overlay-menu-secondary-button-style-solid tweak-mobile-overlay-menu-secondary-button-shape-square tweak-quote-block-alignment-left  tweak-blog-meta-primary-author tweak-blog-meta-secondary-date tweak-blog-list-style-grid tweak-blog-list-separator-show tweak-blog-list-alignment-left  tweak-blog-list-item-image-aspect-ratio-grid-34-three-four-vertical tweak-blog-list-item-image-aspect-ratio-stacked-11-square tweak-blog-list-item-title-show tweak-blog-list-item-excerpt-show tweak-blog-list-item-body-show tweak-blog-list-item-readmore-inline tweak-blog-list-item-meta-position-above-title tweak-blog-list-pagination-link-label-show tweak-blog-list-pagination-link-icon-show tweak-blog-list-pagination-link-icon-weight-light tweak-blog-item-alignment-left tweak-blog-item-meta-position-above-title tweak-blog-item-share-position-below-content tweak-blog-item-pagination-link-icon-show tweak-blog-item-pagination-link-label-show tweak-blog-item-pagination-link-title-show tweak-blog-item-pagination-link-meta-hide tweak-blog-item-pagination-link-icon-weight-light   event-thumbnails event-thumbnail-size-32-standard event-date-label  event-list-show-cats event-list-date event-list-time event-list-address     event-excerpts  event-item-back-link    gallery-design-slideshow aspect-ratio-auto lightbox-style-dark gallery-navigation-bullets gallery-info-overlay-show-on-hover gallery-aspect-ratio-32-standard gallery-arrow-style-no-background gallery-transitions-fade gallery-show-arrows gallery-auto-crop   tweak-product-list-image-aspect-ratio-34-three-four-vertical tweak-product-list-item-hover-behavior-show-alternate-image tweak-product-list-meta-position-overlay tweak-product-list-mobile-meta-position-overlay tweak-product-list-meta-alignment-under-left tweak-product-list-meta-alignment-overlay-center-left tweak-product-list-show-title tweak-product-list-show-price tweak-product-list-filter-display-hide tweak-product-list-filter-alignment-left tweak-product-item-nav-show-none tweak-product-item-nav-pagination-style-previousnext tweak-product-item-nav-breadcrumb-alignment-left tweak-product-item-nav-pagination-alignment-split tweak-product-item-gallery-position-right tweak-product-item-gallery-design-stacked tweak-product-item-gallery-aspect-ratio-34-three-four-vertical tweak-product-item-gallery-thumbnail-alignment-left tweak-product-item-details-alignment-left tweak-product-item-details-show-title tweak-product-item-details-show-price tweak-product-item-details-show-excerpt tweak-product-item-details-excerpt-position-above-price tweak-product-item-details-show-share-buttons tweak-product-item-details-show-variants tweak-product-item-details-show-quantity tweak-product-item-details-options-style-square tweak-product-item-details-show-add-to-cart-button tweak-product-item-details-add-to-cart-button-style-solid tweak-product-item-details-add-to-cart-button-shape-square tweak-product-item-details-add-to-cart-button-padding-large  tweak-product-item-image-zoom-behavior-click tweak-product-item-lightbox-enabled tweak-related-products-image-aspect-ratio-11-square tweak-related-products-meta-alignment-under-center tweak-product-badge-style-square tweak-product-badge-position-top-left tweak-product-badge-inset-floating newsletter-style-custom hide-opentable-icons opentable-style-dark small-button-style-solid small-button-shape-square medium-button-style-solid medium-button-shape-square large-button-style-solid large-button-shape-square image-block-poster-text-alignment-center image-block-card-dynamic-font-sizing image-block-card-content-position-center image-block-card-text-alignment-left image-block-overlap-dynamic-font-sizing image-block-overlap-content-position-center image-block-overlap-text-alignment-left image-block-collage-dynamic-font-sizing image-block-collage-content-position-top image-block-collage-text-alignment-left image-block-stack-dynamic-font-sizing image-block-stack-text-alignment-left button-style-outline button-corner-style-square tweak-product-quick-view-button-style-floating tweak-product-quick-view-button-position-bottom tweak-product-quick-view-lightbox-excerpt-display-hide tweak-product-quick-view-lightbox-show-arrows tweak-product-quick-view-lightbox-show-close-button tweak-product-quick-view-lightbox-controls-weight-medium tweak-share-buttons-style-outline tweak-share-buttons-icons-show tweak-share-buttons-labels-show native-currency-code-usd collection-type-page collection-60e38d4b1b5b112f454f4a56 collection-layout-default mobile-style-available sqs-has-custom-cart has-logo-image has-social enable-load-effects has-secondary-nav"
    data-controller="HashManager, SiteLoader, MobileClassname">

    @include('layouts.front.mobile')
    <div class="Site" data-nc-base="header" data-controller="AncillaryLayout">
        <div class="sqs-announcement-bar-dropzone"></div>
        <!-- Navbar -->
        @include('layouts.front.navigation')

        <!-- /.navbar -->
        <!-- main -->
        <div class="Site-inner Site-inner--index" data-controller="HeaderOverlay">
            @include('layouts.front.header')
            <main class="main">
                <!-- Whatsapp icon -->
                <a class="whats-app" href="https://wa.me/971585357917" target="_blank">
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
                    <i style="z-index: 999" class="fab fa-whatsapp my-float" aria-hidden="true"></i>
                </a>
                <!-- /.Whatsapp icon -->
                @yield('content')
            </main>
        </div>
        <!-- scripts -->
        @include('layouts.front.scripts')
        <!-- /.scripts -->
        <!-- scripts for each page -->
        @yield('custom-script')
        <!-- /.scripts for each page -->

</body>
@include('layouts.front.footer')

</html>
