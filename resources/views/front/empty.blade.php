@extends('layouts.front.base')
@section('pageTitle', 'Calendar')
@section('custom-style')
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1">

    <!-- This is Squarespace. -->
    <!-- JUNK-fit -->
    <!--<base href="">-->
    <meta charset="utf-8" />

    <link rel="shortcut icon" type="image/x-icon" href="image/logo-icon.png" />
    <link rel="canonical" href="dubai-schedule.html" />
    <meta property="og:site_name" content="JUNK" />
    <meta property="og:title" content="Schedule – JUNK Fitness Dubai &mdash; JUNK" />
    <meta property="og:url" content="https://www.junk-fit.com/dubai-schedule" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Login to your JUNK account and check out your stats, credits and bookings!" />
    <meta itemprop="name" content="schedule – JUNK Fitness Dubai — JUNK" />
    <meta itemprop="url" content="https://www.JUNK-fit.com/dubai-schedule" />
    <meta itemprop="description" content="Login to your JUNK account and check out your stats, credits and bookings!" />
    <meta name="twitter:title" content="Schedule – JUNK Fitness Dubai — JUNK" />
    <meta name="twitter:url" content="https://www.JUNK-fit.com/dubai-schedule" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Login to your JUNK account and check out your stats, credits and bookings!" />
    <meta name="description" content="Login to your JUNK account and check out your stats, credits and bookings!" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script type="text/javascript"
        src="https://use.typekit.net/ik/IACzaOq5JENJeGIfxhHY1SJw-KaDI1KaH6iz0ZLy4PMfeT3IfFHN4UJLFRbh52jhWD9ojhIu5QbtZQmqZ2mKZRwu5QqXZ2ZKFgnDMKG0jAFu-WsoShFGZAsude80ZkoRdhXCHKoyjamTiY8Djhy8ZYmC-Ao1Oco8if37OcBDOcu8OfG0ja4ydcClZc8XO1FUiABkZWF3jAF8OcFzdP37O1FUiABkZWF3jAF8ShFGZAsude80ZkoRdhXCjAFu-WsoShFGZAsude80ZkoRdhXCjAFu-WsoShFGZAsude80Zko0ZWbCjWw0dA9Cja4ydcClZc8XOcFzdPURScB0-kuc-Wb0SaBujW48Sagyjh90jhNlOeUzjhBC-eNDifUDSWmyScmDSeBRZWFR-emqiAUTdcS0jhNlOYiaikoyjamTiY8Djhy8ZYmC-Ao1OcFzdPUaiaS0jAFu-WsoShFGZAsude80Zko0ZWbCiaiaOcBDOcu8OYiaikoRScB0-kuc-Wb0jhNlOYiaikoRScB0-kuc-Wb0SaBujW48Sagyjh90jhNlOYiaikoDSWmyScmDSeBRZWFR-emqiAUTdcS0jhNlJ68ciWsuScIlSYbKBY4TZkuD-eBqZAbljcNCZfucjAF8H6qJy89bMg62JMJ7fbKImsMMeMb6MKG4fVN9IMMjgPMfH6qJ6m9bMg6YJMJ7fbKYmsMMeM66MKG4fJmmIMMj2KMfH6qJ689bMg6sJMJ7f6K57MJbMs6YJMHbMjYfDz9B.js">
    </script>
    <script type="text/javascript">
        try {
            Typekit.load();
        } catch (e) {}
    </script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;700">
    <script type="text/javascript" crossorigin="anonymous" nomodule="nomodule"
        src="https://assets.squarespace.com/@sqs/polyfiller/1.2.2/legacy.js"></script>
    <script type="text/javascript" crossorigin="anonymous"
        src="https://assets.squarespace.com/@sqs/polyfiller/1.2.2/modern.js"></script>
    <script type="text/javascript">
        SQUARESPACE_ROLLUPS = {};
    </script>
    <script>
        (function(rollups, name) {
            if (!rollups[name]) {
                rollups[name] = {};
            }
            rollups[name].js = [
                "//assets.squarespace.com/universal/scripts-compressed/moment-js-vendor-26ddeab7fa5f90b6c8cb3-min.en-US.js"
            ];
        })(SQUARESPACE_ROLLUPS, 'squarespace-moment_js_vendor');
    </script>
    <script crossorigin="anonymous"
        src="https://assets.squarespace.com/universal/scripts-compressed/moment-js-vendor-26ddeab7fa5f90b6c8cb3-min.en-US.js">
    </script>
    <script>
        (function(rollups, name) {
            if (!rollups[name]) {
                rollups[name] = {};
            }
            rollups[name].js = [
                "//assets.squarespace.com/universal/scripts-compressed/cldr-resource-pack-be81d1ce004cbca505842-min.en-US.js"
            ];
        })(SQUARESPACE_ROLLUPS, 'squarespace-cldr_resource_pack');
    </script>
    <script crossorigin="anonymous"
        src="https://assets.squarespace.com/universal/scripts-compressed/cldr-resource-pack-be81d1ce004cbca505842-min.en-US.js">
    </script>
    <script>
        (function(rollups, name) {
            if (!rollups[name]) {
                rollups[name] = {};
            }
            rollups[name].js = [
                "//assets.squarespace.com/universal/scripts-compressed/common-vendors-stable-5f58a0e5b599c258afba7-min.en-US.js"
            ];
        })(SQUARESPACE_ROLLUPS, 'squarespace-common_vendors_stable');
    </script>
    <script crossorigin="anonymous"
        src="https://assets.squarespace.com/universal/scripts-compressed/common-vendors-stable-5f58a0e5b599c258afba7-min.en-US.js">
    </script>
    <script>
        (function(rollups, name) {
            if (!rollups[name]) {
                rollups[name] = {};
            }
            rollups[name].js = [
                "//assets.squarespace.com/universal/scripts-compressed/common-vendors-efb91330d3205ff0c994e-min.en-US.js"
            ];
        })(SQUARESPACE_ROLLUPS, 'squarespace-common_vendors');
    </script>
    <script crossorigin="anonymous"
        src="https://assets.squarespace.com/universal/scripts-compressed/common-vendors-efb91330d3205ff0c994e-min.en-US.js">
    </script>
    <script>
        (function(rollups, name) {
            if (!rollups[name]) {
                rollups[name] = {};
            }
            rollups[name].js = [
                "//assets.squarespace.com/universal/scripts-compressed/common-9fa7cfc98f6d84ac98495-min.en-US.js"
            ];
        })(SQUARESPACE_ROLLUPS, 'squarespace-common');
    </script>
    <script crossorigin="anonymous"
        src="https://assets.squarespace.com/universal/scripts-compressed/common-9fa7cfc98f6d84ac98495-min.en-US.js">
    </script>
    <script>
        (function(rollups, name) {
            if (!rollups[name]) {
                rollups[name] = {};
            }
            rollups[name].js = [
                "//assets.squarespace.com/universal/scripts-compressed/performance-475ff57ccb4d428b21a04-min.en-US.js"
            ];
        })(SQUARESPACE_ROLLUPS, 'squarespace-performance');
    </script>
    <script crossorigin="anonymous"
        src="https://assets.squarespace.com/universal/scripts-compressed/performance-475ff57ccb4d428b21a04-min.en-US.js"
        defer></script>
    <script data-name="static-context">
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
                "fullSiteTitle": "Login \u2013 JUNK Fitness Dubai \u2014 JUNK",
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
                    "1": true,
                    "6": true,
                    "2": true
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
                "title": "Dubai Schedule",
                "id": "60e38d4b1b5b112f454f4a56",
                "fullUrl": "/dubai-schedule",
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
            "betaFeatureFlags": ["commerce_product_review_etsy_import", "campaigns_hide_deleted_automations_panel",
                "commerce_etsy_product_import", "campaigns_new_subscriber_search", "uas_swagger_token_client",
                "campaigns_show_apply_website_styles_button", "customer_account_creation_recaptcha",
                "member_areas_schedule_interview", "category-delete-product-service-enabled",
                "commerce_restock_notifications", "commerce_activation_experiment_add_payment_processor_card",
                "commerce_product_composer_ab_test_all_users", "uas_swagger_site_user_account_client",
                "commerce_afterpay_pdp", "campaigns_blog_product_image_editor",
                "commerce_shadow_write_to_cart_persistence_service", "member_areas_annual_subscriptions",
                "commerce_instagram_product_checkout_links", "campaigns_audience_card",
                "member_areas_billing_state_migration", "commerce_site_visitor_metrics", "commerce_local_pickup",
                "campaigns_section_reorder_arrows", "commerce_product_review_import_ga",
                "commerce_pdp_survey_modal", "uas_swagger_unauthenticated_session_client", "startup_checklist",
                "nested_categories_migration_enabled", "commerce_category_id_discounts_enabled",
                "uas_swagger_session_client", "commerce_product_branching", "reduce_general_search_api_traffic"
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
    </script>
    <script type="text/javascript">
        SquarespaceFonts.loadViaContext();
        Squarespace.load(window);
    </script>
    <script type="application/ld+json">
        {
            "url": "https://www.JUNK-fit.com",
            "name": "JUNK",
            "description": "",
            "image": "//images.squarespace-cdn.com/content/v1/59ca5948e5dd5bf35994d6b4/1536919707950-HFYMVNGOK9B0WT3AJ3OU/JUNK+logo+white+%281%29.png",
            "@context": "http://schema.org",
            "@type": "WebSite"
        }
    </script>
    <script type="application/ld+json">
        {
            "legalName": "JUNK",
            "address": "8th Street\nDubai, Dubai, \nUnited Arab Emirates",
            "email": "info@JUNK-fit.com",
            "telephone": "043212095",
            "sameAs": ["http://instagram.com/JUNK.uae", "https://www.facebook.com/JUNK.dubai"],
            "@context": "http://schema.org",
            "@type": "Organization"
        }
    </script>
    <script type="application/ld+json">
        {
            "address": "8th Street\nDubai, Dubai, \nUnited Arab Emirates",
            "image": "https://static1.squarespace.com/static/59ca5948e5dd5bf35994d6b4/t/5b9b889b88251b4c42ff17cd/1630389080670/",
            "name": "JUNK",
            "openingHours": ", , , , , , ",
            "@context": "http://schema.org",
            "@type": "LocalBusiness"
        }
    </script>
    <link rel="stylesheet" type="text/css"
        href="https://static1.squarespace.com/static/sitecss/59ca5948e5dd5bf35994d6b4/132/55f0aac0e4b0f0a5b7e0b22e/59ca5948e5dd5bf35994d6c9/345-05142015/1629841322505/site.css" />
    <meta name="msvalidate.01" content="0C5C6B04970505D826D7EDDC2D195DD6" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    {{-- <script type="text/javascript" src="https://cdn.myperformanceiq.com/iframe-downloads/iframeResizer.min.js"></script>
    <script type="text/javascript" src="https://cdn.myperformanceiq.com/iframe-downloads/piq.js?v=3"></script> --}}

    <script>
        var is_safari = navigator.userAgent.indexOf("Safari") > -1;
        var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
        if ((is_chrome) && (is_safari)) {
            is_safari = false;
        }
        if (is_safari) {
            if (!document.cookie.match(/^(.*;)?\s*fixed\s*=\s*[^;]+(.*)?$/)) {
                document.cookie = 'fixed=fixed; expires=Tue, 19 Jan 2038 03:14:07 UTC; path=/';
                // window.location.replace("https://JUNK-fit.myperformanceiq.com/user/login");
            }
        }
    </script>
    <meta name="ROBOTS" content="NOINDEX">
    <script>
        Static.COOKIE_BANNER_CAPABLE = true;
    </script>
    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-146059422-1', 'auto');
        ga('send', 'pageview');
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- End of Squarespace Headers -->

    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/site.css') }}" />

    <style>
        .sche-section {
            background: #fff;
            padding: 30px 102px;
        }

        @media screen and (max-width: 1024px) {
            .sche-section {
                padding-left: 64px;
                padding-right: 64px;
            }
        }

        @media screen and (max-width: 960px) {
            .sche-section {
                padding-left: 48px;
                padding-right: 48px;
            }
        }

        @media screen and (max-width: 768px) {
            .sche-section {
                padding-left: 36px;
                padding-right: 36px;
            }
        }

        @media screen and (max-width: 640px) {
            .sche-section {
                padding-left: 15px;
                padding-right: 15px;
            }



        }

        .prev,
        .next {
            box-shadow: none !important;
            font-family: 'Futura' !important;
            padding: 8px 20px;
            margin-bottom: 3rem;
        }

        .prev:hover,
        .next:hover {
            background-color: #fff;
            color: #000;
        }


        .table-calander th,
        .table-calander td {
            text-align: center;
        }

        .table-calander td:hover {
            background-color: #e6e5e5b0;
        }

        .table-calander td a:hover {
            text-decoration: none;
            color: #000;
        }

        .table-calander td h6 {
            font-family: 'rig-shaded-bold-face' !important;
        }

        .table-calander td p {
            color: #6e6868;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #fff !important;
        }

        /* Style The Dropdown Button */
        .dropbtn {
            background-color: #000;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
            padding: 3rem 0;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #000;
            min-width: 160px;
            box-shadow: 0 0 1px #b3ff51, 0 0 2px #b3ff51, 0 0 3px #b3ff51, 0 0 12px #b3ff51, inset 0 0 1px #b3ff51, inset 0 0 0 #b3ff51, inset 0 0 0 #b3ff51, inset 0 0 7px #b3ff52;

            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: #fff;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-family: 'Futura';
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #8fd241;
            color: #000;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
            background-color: #000;
        }


        /* The sticky class is added to the header with JS when it reaches its scroll position */
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999999;

        }

        div.disabled {
            pointer-events: none;
            opacity: 0.4;
        }

        h6 {
            color: #8fd241 !important;
            ;
        }

        .table thead th {
            vertical-align: middle !important;
            width: 100px;
        }

        td,
        th {
            box-shadow: 0 0 1px #b3ff51, 0 0 2px #b3ff51, 0 0 3px #b3ff51, 0 0 5px #b3ff51, inset 0 0 1px #b3ff51, inset 0 0 0 #b3ff51, inset 0 0 0 #b3ff51, inset 0 0 2px #b3ff52;
        }

        td>div {
            border-bottom: 2px solid #8fd241;
        }

        td>div:last-child {
            border-bottom: none !important;
        }

        td p:last-child {
            padding-bottom: .5rem;
        }

        .square {
            position: absolute;
            top: 29px;
            left: 1%;
            width: 15px;
            height: 22px;
            display: none;

            background-color: #000;
            transform: rotate(45deg);
        }

        .none1 {
            display: none;
        }

        @media (max-width:991.5px) {
            .none {
                display: none !important;
                ;

            }

            .none1 {
                display: block;
            }

            .prev,
            .next {
                margin-bottom: 15px;
            }
        }

        @media (max-width:1160px) {

            ::-webkit-scrollbar {

                height: 10px;
            }

            .div-table {
                overflow-x: scroll;

            }

            table {
                margin-top: 1rem;
            }

            .table td,
            .table th {
                padding: 3px 30px 3px 10px !important;
            }

            .table td {
                padding-top: 1rem !important;
            }
        }

        @media (max-width:575.5px) {
            .dropdown {
                padding: 15px 0;
            }

            .dropbtn {
                padding: 14px;
                font-size: 14px;
            }
            .dropdown-content a{
                font-size:14px;
            }

            .drop3 {
                right: 0;
            }
        }

    </style>
    <link rel="stylesheet" type="text/css" href="css/site.css" />
    <link rel="stylesheet" type="text/css" href="css/all.min.css">

@endsection
@section('content')
    <div class="Content-outer">
   
        <main class="Main Main--page">
        </main>

    </div>

    </div>

@endsection
