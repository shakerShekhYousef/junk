@extends('layouts.front.base')
@section('pageTitle', 'Contact Us')
@section('custom-style')
 <!--    <script data-name="static-context">
        Static = window.Static || {};
        Static.SQUARESPACE_CONTEXT = {
            "facebookAppId": "314192535267336",
            "facebookApiVersion": "v6.0",
            "rollups": {
                "squarespace-announcement-bar": {
                    "js": "//assets.squarespace.com/universal/scripts-compressed/announcement-bar-9bcaf347e25933575e4f4-min.en-US.js"
                },
                "squarespace-audio-player": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/audio-player-7273d8fcec67906942b35-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/audio-player-1ebec7d917680831e4c35-min.en-US.js"
                },
                "squarespace-blog-collection-list": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/blog-collection-list-3d55c64c25996c7633fc2-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/blog-collection-list-41fb020c05858537c749a-min.en-US.js"
                },
                "squarespace-calendar-block-renderer": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/calendar-block-renderer-5668de53c0ce16e20cc01-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/calendar-block-renderer-efd0c58a9eed6a4c98706-min.en-US.js"
                },
                "squarespace-chartjs-helpers": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/chartjs-helpers-58ae73137091cd0a61360-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/chartjs-helpers-90a05700972d4d6f84fa8-min.en-US.js"
                },
                "squarespace-comments": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/comments-eeb99f32a31032af774cb-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/comments-354bdbbf972bce4350594-min.en-US.js"
                },
                "squarespace-commerce-cart": {
                    "js": "//assets.squarespace.com/universal/scripts-compressed/commerce-cart-e7d4ddee4e92fae95be20-min.en-US.js"
                },
                "squarespace-dialog": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/dialog-7b3fdec47b80fd63e5e6f-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/dialog-2c6422ac81bc0221b9c6b-min.en-US.js"
                },
                "squarespace-events-collection": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/events-collection-5668de53c0ce16e20cc01-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/events-collection-b6629bfb395b931f71443-min.en-US.js"
                },
                "squarespace-form-rendering-utils": {
                    "js": "//assets.squarespace.com/universal/scripts-compressed/form-rendering-utils-fb61fb965f7aedb538deb-min.en-US.js"
                },
                "squarespace-forms": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/forms-1cc007b21ede0b73086c9-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/forms-473c95110781a82e3cf8e-min.en-US.js"
                },
                "squarespace-gallery-collection-list": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/gallery-collection-list-3d55c64c25996c7633fc2-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/gallery-collection-list-cd5d8e548068a3a2586f7-min.en-US.js"
                },
                "squarespace-image-zoom": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/image-zoom-60e14b9bac69739c96fa7-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/image-zoom-fa19933bfc5ac12f6e17f-min.en-US.js"
                },
                "squarespace-pinterest": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/pinterest-3d55c64c25996c7633fc2-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/pinterest-aadd564b6ff9f2d0330f4-min.en-US.js"
                },
                "squarespace-popup-overlay": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/popup-overlay-e4ea05bd2ae9c1568e432-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/popup-overlay-36fb9734b31dbd11202b5-min.en-US.js"
                },
                "squarespace-product-quick-view": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/product-quick-view-663fb8b8c08febe7303f1-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/product-quick-view-386035503536f5b4b0abd-min.en-US.js"
                },
                "squarespace-products-collection-item-v2": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/products-collection-item-v2-60e14b9bac69739c96fa7-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/products-collection-item-v2-0386f826066ff2395a868-min.en-US.js"
                },
                "squarespace-products-collection-list-v2": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/products-collection-list-v2-60e14b9bac69739c96fa7-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/products-collection-list-v2-1836a36b2936989782757-min.en-US.js"
                },
                "squarespace-search-page": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/search-page-568ad8f2a40e76c0175c8-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/search-page-45a0ee3d458c79aea38d6-min.en-US.js"
                },
                "squarespace-search-preview": {
                    "js": "//assets.squarespace.com/universal/scripts-compressed/search-preview-6920251a2a2db1c3332cb-min.en-US.js"
                },
                "squarespace-share-buttons": {
                    "js": "//assets.squarespace.com/universal/scripts-compressed/share-buttons-c4214afe6907e5aa1c4cc-min.en-US.js"
                },
                "squarespace-simple-liking": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/simple-liking-47606e375db2b296c3464-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/simple-liking-86a6810967083b1f49e97-min.en-US.js"
                },
                "squarespace-social-buttons": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/social-buttons-b186d09e02921fd7f8e00-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/social-buttons-1c2fd487bb73ea50d4e1d-min.en-US.js"
                },
                "squarespace-tourdates": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/tourdates-3d55c64c25996c7633fc2-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/tourdates-8009181c722692517a7a1-min.en-US.js"
                },
                "squarespace-website-overlays-manager": {
                    "css": "//assets.squarespace.com/universal/styles-compressed/website-overlays-manager-5c2f030f6ee94f066dc3d-min.en-US.css",
                    "js": "//assets.squarespace.com/universal/scripts-compressed/website-overlays-manager-d4761f75a94eee0914454-min.en-US.js"
                }
            },
            "pageType": 2,
            "website": {
                "id": "59ca5948e5dd5bf35994d6b4",
                "identifier": "JUNK-fit",
                "websiteType": 1,
                "contentModifiedOn": 1630389080670,
                "cloneable": false,
                "hasBeenCloneable": false,
                "siteStatus": {},
                "language": "en-US",
                "timeZone": "Asia/Dubai",
                "machineTimeZoneOffset": 14400000,
                "timeZoneOffset": 14400000,
                "timeZoneAbbr": "GST",
                "siteTitle": "JUNK",
                "fullSiteTitle": "Contact Us \u2014 JUNK",
                "siteTagLine": "",
                "siteDescription": "",
                "location": {
                    "mapLat": 25.2544562,
                    "mapLng": 55.3311827,
                    "addressTitle": "JUNK",
                    "addressLine1": "8th Street",
                    "addressLine2": "Dubai, Dubai, ",
                    "addressCountry": "United Arab Emirates"
                },
                "logoImageId": "5b9b889b88251b4c42ff17cd",
                "shareButtonOptions": {
                    "2": true,
                    "6": true,
                    "1": true
                },
                "logoImageUrl": "//images.squarespace-cdn.com/content/v1/59ca5948e5dd5bf35994d6b4/1536919707950-HFYMVNGOK9B0WT3AJ3OU/JUNK+logo+white+%281%29.png",
                "authenticUrl": "https://www.JUNK-fit.com",
                "internalUrl": "https://JUNK-fit.squarespace.com",
                "baseUrl": "https://www.JUNK-fit.com",
                "primaryDomain": "www.JUNK-fit.com",
                "sslSetting": 3,
                "isHstsEnabled": true,
                "socialAccounts": [{
                    "serviceId": 10,
                    "userId": "5457328344",
                    "userName": "JUNK.dubai",
                    "screenname": "JUNK",
                    "addedOn": 1536939935025,
                    "profileUrl": "http://instagram.com/JUNK.uae",
                    "iconUrl": "https://scontent.cdninstagram.com/vp/ce1b3d10ee8993102c5b0fadae749180/5C351862/t51.2885-19/s150x150/25015697_296192050903652_4685219380408090624_n.jpg",
                    "collectionId": "5b9bd79fe2ccd17b815d16f8",
                    "iconEnabled": true,
                    "serviceName": "instagram"
                }, {
                    "serviceId": 2,
                    "userId": "10101779312565396",
                    "screenname": "JUNK",
                    "addedOn": 1536942304152,
                    "profileUrl": "https://www.facebook.com/JUNK.dubai",
                    "iconUrl": "http://graph.facebook.com/10101779312565396/picture?type=square",
                    "metaData": {
                        "service": "facebook"
                    },
                    "iconEnabled": true,
                    "serviceName": "facebook"
                }],
                "typekitId": "",
                "statsMigrated": false,
                "imageMetadataProcessingEnabled": false,
                "screenshotId": "b7bcab93247c886c382b4b44c9df87bdff8976aefcaebd247c3e14d265ee2706",
                "showOwnerLogin": false
            },
            "websiteSettings": {
                "id": "59ca5948e5dd5bf35994d6b7",
                "websiteId": "59ca5948e5dd5bf35994d6b4",
                "subjects": [],
                "country": "AE",
                "state": "DU",
                "simpleLikingEnabled": true,
                "mobileInfoBarSettings": {
                    "isContactEmailEnabled": false,
                    "isContactPhoneNumberEnabled": false,
                    "isLocationEnabled": false,
                    "isBusinessHoursEnabled": false
                },
                "announcementBarSettings": {
                    "style": 1,
                    "text": "<p class=\"\" style=\"white-space:pre-wrap;\">You all showed up strong our technology couldn\u2019t handle the heat! </p><p class=\"\" style=\"white-space:pre-wrap;\">We are currently facing issues limiting the ability to view and book classes. </p><p class=\"\" style=\"white-space:pre-wrap;\">That\u2019s not to say you\u2019re off the hook! Please do reach out to us via email at info@JUNK-fit.com for bookings. </p>"
                },
                "commentLikesAllowed": true,
                "commentAnonAllowed": true,
                "commentThreaded": true,
                "commentApprovalRequired": false,
                "commentAvatarsOn": true,
                "commentSortType": 2,
                "commentFlagThreshold": 0,
                "commentFlagsAllowed": true,
                "commentEnableByDefault": true,
                "commentDisableAfterDaysDefault": 0,
                "disqusShortname": "",
                "commentsEnabled": false,
                "contactPhoneNumber": "043212095",
                "businessHours": {
                    "monday": {
                        "text": "",
                        "ranges": [{}]
                    },
                    "tuesday": {
                        "text": "",
                        "ranges": [{}]
                    },
                    "wednesday": {
                        "text": "",
                        "ranges": [{}]
                    },
                    "thursday": {
                        "text": "",
                        "ranges": [{}]
                    },
                    "friday": {
                        "text": "",
                        "ranges": [{}]
                    },
                    "saturday": {
                        "text": "",
                        "ranges": [{}]
                    },
                    "sunday": {
                        "text": "",
                        "ranges": [{}]
                    }
                },
                "storeSettings": {
                    "returnPolicy": null,
                    "termsOfService": null,
                    "privacyPolicy": null,
                    "expressCheckout": false,
                    "continueShoppingLinkUrl": "/",
                    "useLightCart": false,
                    "showNoteField": false,
                    "shippingCountryDefaultValue": "US",
                    "billToShippingDefaultValue": false,
                    "showShippingPhoneNumber": true,
                    "isShippingPhoneRequired": false,
                    "showBillingPhoneNumber": true,
                    "isBillingPhoneRequired": false,
                    "currenciesSupported": ["CHF", "HKD", "MXN", "EUR", "DKK", "USD", "CAD", "MYR", "NOK", "THB", "AUD",
                        "SGD", "ILS", "PLN", "GBP", "CZK", "SEK", "NZD", "PHP", "RUB"
                    ],
                    "defaultCurrency": "USD",
                    "selectedCurrency": "USD",
                    "measurementStandard": 1,
                    "showCustomCheckoutForm": false,
                    "enableMailingListOptInByDefault": false,
                    "sameAsRetailLocation": false,
                    "merchandisingSettings": {
                        "scarcityEnabledOnProductItems": false,
                        "scarcityEnabledOnProductBlocks": false,
                        "scarcityMessageType": "DEFAULT_SCARCITY_MESSAGE",
                        "scarcityThreshold": 10,
                        "multipleQuantityAllowedForServices": true,
                        "restockNotificationsEnabled": false,
                        "restockNotificationsMailingListSignUpEnabled": false,
                        "relatedProductsEnabled": false,
                        "relatedProductsOrdering": "random",
                        "soldOutVariantsDropdownDisabled": false,
                        "productComposerOptedIn": false,
                        "productComposerABTestOptedOut": false,
                        "productReviewsEnabled": false
                    },
                    "isLive": false,
                    "multipleQuantityAllowedForServices": true
                },
                "useEscapeKeyToLogin": true,
                "ssBadgeType": 1,
                "ssBadgePosition": 4,
                "ssBadgeVisibility": 1,
                "ssBadgeDevices": 1,
                "pinterestOverlayOptions": {
                    "mode": "disabled"
                },
                "ampEnabled": false
            },
            "cookieSettings": {
                "isCookieBannerEnabled": false,
                "isRestrictiveCookiePolicyEnabled": false,
                "isRestrictiveCookiePolicyAbsolute": false,
                "cookieBannerText": "",
                "cookieBannerTheme": "",
                "cookieBannerVariant": "",
                "cookieBannerPosition": "",
                "cookieBannerCtaVariant": "",
                "cookieBannerCtaText": "",
                "cookieBannerAcceptType": "OPT_IN",
                "cookieBannerOptOutCtaText": ""
            },
            "websiteCloneable": false,
            "collection": {
                "title": "Contact",
                "id": "5b27a5f103ce643d6e7645d5",
                "fullUrl": "/contact-1",
                "type": 10,
                "permissionType": 1
            },
            "subscribed": false,
            "appDomain": "squarespace.com",
            "templateTweakable": true,
            "tweakJSON": {
                "aspect-ratio": "Auto",
                "gallery-arrow-style": "No Background",
                "gallery-aspect-ratio": "3:2 Standard",
                "gallery-auto-crop": "true",
                "gallery-autoplay": "false",
                "gallery-design": "Slideshow",
                "gallery-info-overlay": "Show on Hover",
                "gallery-loop": "false",
                "gallery-navigation": "Bullets",
                "gallery-show-arrows": "true",
                "gallery-transitions": "Fade",
                "galleryArrowBackground": "rgba(34,34,34,1)",
                "galleryArrowColor": "rgba(255,255,255,1)",
                "galleryAutoplaySpeed": "3",
                "galleryCircleColor": "rgba(255,255,255,1)",
                "galleryInfoBackground": "rgba(0, 0, 0, .7)",
                "galleryThumbnailSize": "100px",
                "gridSize": "350px",
                "gridSpacing": "20px",
                "tweak-blog-list-columns": "3",
                "tweak-blog-list-item-image-aspect-ratio-grid": "3:4 Three-Four (Vertical)",
                "tweak-blog-list-item-image-aspect-ratio-stacked": "1:1 Square",
                "tweak-blog-list-item-image-show": "false",
                "tweak-blog-list-spacing": "60px",
                "tweak-blog-list-style": "Grid",
                "tweak-footer-layout": "Columns",
                "tweak-header-bottom-overlay-on-index-gallery": "false",
                "tweak-index-gallery-apply-bottom-spacing": "true",
                "tweak-index-gallery-autoplay-duration": "2",
                "tweak-index-gallery-autoplay-enable": "true",
                "tweak-index-gallery-fixed-height": "true",
                "tweak-index-gallery-height": "100vh",
                "tweak-index-gallery-indicators": "Lines",
                "tweak-index-gallery-layout": "Packed",
                "tweak-index-gallery-transition": "Fade",
                "tweak-index-gallery-transition-duration": "500",
                "tweak-index-nav-position": "Right",
                "tweak-index-page-apply-bottom-spacing": "false",
                "tweak-index-page-fullscreen": "None",
                "tweak-index-page-min-height": "100vh",
                "tweak-mobile-breakpoint": "640px",
                "tweak-overlay-parallax-enabled": "false",
                "tweak-overlay-parallax-new-math": "false",
                "tweak-product-item-image-zoom-factor": "2.5",
                "tweak-product-list-item-hover-behavior": "Show Alternate Image",
                "tweak-product-list-items-per-row": "4",
                "tweak-related-products-items-per-row": "3",
                "tweak-related-products-title-spacing": "50px",
                "tweak-site-ajax-loading-enable": "false",
                "tweak-site-border-show": "false",
                "tweak-site-border-width": "5px"
            },
            "templateId": "55f0aac0e4b0f0a5b7e0b22e",
            "templateVersion": "7",
            "pageFeatures": [1, 2, 4],
            "gmRenderKey": "QUl6YVN5Q0JUUk9xNkx1dkZfSUUxcjQ2LVQ0QWVUU1YtMGQ3bXk4",
            "templateScriptsRootUrl": "https://static1.squarespace.com/static/ta/55f0a9b0e4b0f3eb70352f6d/345/scripts/",
            "betaFeatureFlags": ["commerce_activation_experiment_add_payment_processor_card",
                "member_areas_annual_subscriptions", "commerce_category_id_discounts_enabled",
                "campaigns_audience_card", "uas_swagger_token_client", "commerce_restock_notifications",
                "commerce_etsy_product_import", "nested_categories_migration_enabled", "uas_swagger_session_client",
                "customer_account_creation_recaptcha", "commerce_local_pickup", "commerce_pdp_survey_modal",
                "commerce_site_visitor_metrics", "member_areas_billing_state_migration",
                "commerce_product_review_import_ga", "reduce_general_search_api_traffic", "startup_checklist",
                "category-delete-product-service-enabled", "uas_swagger_unauthenticated_session_client",
                "campaigns_show_apply_website_styles_button", "commerce_product_branching", "commerce_afterpay_pdp",
                "campaigns_hide_deleted_automations_panel", "commerce_instagram_product_checkout_links",
                "campaigns_new_subscriber_search", "uas_swagger_site_user_account_client",
                "member_areas_schedule_interview", "commerce_shadow_write_to_cart_persistence_service",
                "campaigns_section_reorder_arrows", "commerce_product_review_etsy_import",
                "campaigns_blog_product_image_editor", "commerce_product_composer_ab_test_all_users"
            ],
            "impersonatedSession": false,
            "tzData": {
                "zones": [
                    [240, null, "GST", null]
                ],
                "rules": {}
            },
            "showAnnouncementBar": false
        };
    </script> -->
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
@endsection
@section('content')

    <a class="whats-app" href="https://wa.me/971585357917" target="_blank">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <i style="z-index: 999" class="fab fa-whatsapp my-float" aria-hidden="true"></i>
    </a>
    <div class="Content-outer">
        <main class="Main Main--page">

            <section class="Main-content" data-content-field="main-content">
                <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629807432669"
                    id="page-5b27a5f103ce643d6e7645d5">
                    <div class="row ">
                        <div class="col-md-6 col-12">
                            <div class="s" data-block-type="2"
                                id="block-yui_3_17_2_1_1529325150226_5637">
                                <div class="sqs-block-content">
                                    <h1 style="text-transform: uppercase;">Contact Us</h1>
                                    <p class="">
                                    <h2 style="text-transform: uppercase;">GET IN TOUCH WITH<br><span
                                            style="color: #90D242">JUNK
                                            FITNESS CLUB</span></h2>
                                    </p>
                                    <br>
                                    <p class="">
                                        <span   style="border-bottom: none!important;padding-right: 4px"> <i
                                                    style="font-size: 22px" class="fas fa-map-marker-alt"
                                                    aria-hidden="true"></i>
                                                </span>
                                                <strong
                                            style="text-transform: uppercase;">POSTAL
                                            ADDRESS</strong>
                                        </p>
                                    <p class="" style="">WAREHOUSE 22, AL QUOZ 1, INTERCHANGE 3, FIRST KHAIL
                                        STREET, BELOW 3B STREET, DUBA, UAE</p>
                                    <p class=""><span><a href="tel:(+971) 4 559 8040"
                                                style="border-bottom: none!important;"><i
                                                    class="fas fa-phone"></i></a></span><strong
                                            style="text-transform: uppercase;"> PHONE</strong>
                                    </p>
                                    <p class=""><a href="tel:(+971) 4 591 6966"> +97145916966</a></p>
                                    <p class=""><span><a href="mailto:INFO@JUNK-DUBAI.COM"
                                                style="border-bottom: none!important" ;><i class="fa fa-envelope"
                                                    aria-hidden="true"></i></a></span><strong
                                            style="text-transform: uppercase;">
                                            EMAIL</strong></p>
                                    <p class=""><a href="mailto:INFO@JUNK-DUBAI.COM">INFO@JUNK-DUBAI.COM</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">

                           <div  class=" sized vsize-12" s
                                data-block-json="&#123;&quot;location&quot;:&#123;&quot;mapLat&quot;:25.14071,&quot;mapLng&quot;:55.22631799999999,&quot;mapZoom&quot;:12,&quot;addressLine1&quot;:&quot;Warehouse 43 Alserkal Avenue&quot;,&quot;addressLine2&quot;:&quot;Dubai&quot;,&quot;addressCountry&quot;:&quot;United Arab Emirates&quot;,&quot;markerLat&quot;:25.14071,&quot;markerLng&quot;:55.22631799999999,&quot;addressTitle&quot;:&quot;JUNK&quot;&#125;,&quot;vSize&quot;:12,&quot;style&quot;:4,&quot;labels&quot;:true,&quot;terrain&quot;:false,&quot;controls&quot;:false,&quot;hSize&quot;:null,&quot;floatDir&quot;:null&#125;"
                                data-block-type="4" id="block-yui_3_17_2_1_1534356047510_5421">
                                <div >&nbsp;
                                    <iframe style="width: 100% ; height:100% "  frameborder="0" scrolling="no" marginheight="0" 
                                        marginwidth="0"
                                        src="https://maps.google.com/maps?q=Junk%20Fitness%20Dubai&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                        title="AL QUOZ 1, Dubai" aria-label="AL QUOZ 1, Dubai"></iframe>




                                        
                                </div>
                            </div> 
     
 
                        </div>
                    </div>
            </section>

        </main>

    </div>

@endsection
