@extends('layouts.front.base')
@section('pageTitle', 'Classes')
@section('custom-style')
    <style>
 .content {
  position: relative;
  margin: auto;
  overflow: hidden;
}

.content .content-overlay {
  background: rgba(0,0,0,0.7);
  position: absolute;
  backdrop-filter: blur(5px);  
  height: 100%;
  width: 100%;
  left: 0;
  top: 0;
  bottom: 0;
  right: 0;
  opacity: 0;
  -webkit-transition: all 0.4s ease-in-out 0s;
  -moz-transition: all 0.4s ease-in-out 0s;
  transition: all 0.4s ease-in-out 0s;
}

.content:hover .content-overlay{
  opacity: 1;
}



.content-details {
  position: absolute;
  text-align: center;
  padding-left: 1em;
  padding-right: 1em;
  width: 100%;
  top: 50%;
  left: 50%;
  opacity: 0;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  -webkit-transition: all 0.3s ease-in-out 0s;
  -moz-transition: all 0.3s ease-in-out 0s;
  transition: all 0.3s ease-in-out 0s;
}

.content:hover .content-details{
  top: 50%;
  left: 50%;
  opacity: 1;
}
.fadeIn-top{
  top: 20%;
}
.content img{
    margin-bottom:2rem;
}
@media (max-width:900px){
    .content:hover .content-details{
        top:45%;
    }
     .content-details p{
         font-size:13px;
     }
}
@media (max-width:600px){
    .content .content-overlay{
        display: none;
    }
    .content-details {
        opacity: 1;
        position: inherit;
        text-align:left;
        top: 0;
    left: 0;
    right: 0;
    -webkit-transform: inherit;
    -moz-transform: translate(-50%, -50%);
    transform: inherit;

    }
    .content:hover .content-details{
  top: 50%;
  left: 0;
  opacity: 1;
}
    .content{
        margin-bottom:4rem;
    }
    .content-details p{
        font-size:15px;
    }
}
        .my-float {
            margin-top: 10px;
        }

        .thumb-image {
            width: 100% !important;
            left: 0 !important;

        }

        .sqs-layout:not(.sqs-editing) .sqs-row + .sqs-row:not(:last-child) .sqs-block:last-child {
            padding-bottom: 30px;
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
    
        @media  (min-width:768px) and (max-width:1190px){
            .classes-text{
                height: 15rem!important;
            }
        }
        @media (max-width:767px){
            .classes-text{
                height: 9rem!important;
            }  
        }
        @media (max-width:450px){
            .classes-text{
                height: auto!important;
                padding: 2rem 0!important;
            }
        }



    </style>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection
@section('content')
    <a class="whats-app" href="https://wa.me/971585357917" target="_blank">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <i style="z-index: 999" class="fab fa-whatsapp my-float" aria-hidden="true"></i>
    </a>
    <div class="Content-outer">
        <main class="Main Main--page">

            <section class="Main-content" data-content-field="main-content">
                <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629807514548"
                     id="page-5b279d9c575d1f6f796beacb">
                    <div class="row sqs-row mb-5" >
                        <div class="col sqs-col-12 span-12">
                            <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                 id="block-yui_3_17_2_1_1573412777688_133784">
                                <div class="sqs-block-content" data-aos="fade-right" data-aos-easing="ease-in-out"
                                     data-aos-mirror="true"
                                     data-aos-once="false"
                                     data-aos-anchor-placement="top-center" data-aos-duration="1000">
                                    <h3 style="white-space:pre-wrap;text-align: center;">OUR CLASSES</h3>
                                    <p style="text-align: center;">You’re here for a good time, not a long time. Our Rockstar MCs have tailor made
                                        each workout to
                                        ensure you achieve maximum results in the minimum amount of time.</p>
                                    <p style="text-align: center;">The buzz you get as you step inside should be equaled only by the one you feel
                                        after your
                                        workout.
                                        Music is the answer…PICK YOUR CLASS AND LET'S WORKOUT!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom" data-aos-duration="1000" data-aos-delay="250">
                        <div class="content">
                        <img src="{{asset('front/img/Logo_recycle1.png')}}" width="100%">
                        <div class="content-overlay"></div>
                        <div class="content-details fadeIn-top">
                     <p>OUR JUNK VERSION OF CYCLING IS THE ONLY RAVE WITHOUT A COMEDOWN. OUR INSTRUCTORS WILL TAKE YOU THROUGH AN ENERGETIC, SENSORY JOURNEY GIVING YOU FULL-BODY WORKOUT AS YOU TACKLE A SERIES OF POWERFUL SPRINTS AND QUAD BURNING CLIMBS.
                    
                     </p>
                     <a href="{{route('buy-packages')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
    </div>
                        </div>
    </div>
                      <div class="col-lg-6 col-md-6 col-12" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom" data-aos-duration="1000" data-aos-delay="500">
                        <div class="content">
                        <img src="{{asset('front/img/Logo_yoga1.png')}}" width="100%">
                        <div class="content-overlay"></div>
                        <div class="content-details fadeIn-top">
                     <p>JUNK YOGA WILL TAKE YOU THROUGH A SERIES OF POSES AND SALUTATIONS DESIGNED TO RELIEVE STRESS, IMPROVE POSTURE, INCREASE FLEXIBILITY AND TO STRENGTHEN AND TONE THE BODY. CHANNEL THE ZEN FROM WITHIN WITH OUR HYPNOTIC- MEDITATIVE YOGA OR JOIN US FOR A BLOOD PUMPING, BODY SCULPTING- HIGH INTENSITY POWER YOGA.
                    
                     </p>
                     <a href="{{route('buy-packages')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                   </div>
                        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-12" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom" data-aos-duration="1000" data-aos-delay="750">
                        <div class="content">
                        <img src="{{asset('front/img/reboot-junk.png')}}" width="100%">
                        <div class="content-overlay"></div>
                        <div class="content-details fadeIn-top">
                     <p>JUNK BOOTCAMP PROVIDES YOU WITH HIGH-INTENSITY, TOTAL BODY CONDITIONING EXERCISES, USING BOTH BODYWEIGHT AND EQUIPMENT, DESIGNED TO STRENGTHEN AND LEAVE YOU WITH A LASTING BURN. TIGHTEN THOSE ABS, BURN FAT AND GET RID OF THE JUNK IN YOUR TRUNK.
                  
                     </p>
                     <a href="{{route('buy-packages')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                   </div>
                        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-12" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom" data-aos-duration="1000" data-aos-delay="1000">
                        <div class="content">
                        <img src="{{asset('front/img/box-junk.jpg')}}" width="100%">
                        <div class="content-overlay"></div>
                        <div class="content-details fadeIn-top">
                     <p>THE JUNK FITNESS CLASS THAT PACKS A PUNCH! LET YOUR BODY MIMIC THE BEAT AS YOU TAKE ON THIS HIGH ENERGY BOX FIT CLASS – HIGH KNEES, POWERFUL JABS AND STEALTHY MOVEMENTS COME TOGETHER TO CREATE A FULL BODY WORKOUT, IMPROVING BOTH STAMINA AND COORDINATION.
                     
                     </p>
                     <a href="{{route('buy-packages')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                   </div>
                        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-12" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom" data-aos-duration="1000" data-aos-delay="1200">
                        <div class="content">
                        <img src="{{asset('front/img/dance-junk.jpg')}}" width="100%">
                        <div class="content-overlay"></div>
                        <div class="content-details fadeIn-top">
                     <p>WE WANT YOU ON OUR “DANCE” FLOOR. THIS ADDICTIVE FITNESS CLASS IS DESIGNED WITH FUN IN MIND. OUR DANCE MC WILL LEAD YOU THROUGH THIS FUN, CALORIE-BURNING, MOOD ENHANCING, ELECTRIFYING WORKOUT.
                    
                     </p>
                     <a href="{{route('buy-packages')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                   </div>
                        </div>
    </div>
                    </div>
                    <!--row image-->
                <!--     <div class="row sqs-row">
                        <div class="col-lg-4 col-md-6 col-sm-12" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom" data-aos-duration="1000" data-aos-delay="250">
                            <div class="sqs-block image-block sqs-block-image" data-aspect-ratio="96.37305699481865"
                                 data-block-type="5" id="block-yui_3_17_2_1_1536922227120_7549">

                                <div class="sqs-block-content">


                                    <div class="
               image-block-outer-wrapper
          layout-caption-below
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

                  padding-bottom:96.37305450439453%;


  overflow: hidden;







              ">
                                                    <noscript><img src="{{asset('front/img/Re-Cycle.png')}}"
                                                                   alt="reCycle.hpg"/>
                                                    </noscript>
                                                    <img
                                                        class="thumb-image"
                                                        data-src="{{asset('front/img/Re-Cycle.png')}}"
                                                        data-image="{{asset('front/img/Re-Cycle.png')}}"
                                                        data-image-dimensions="2500x1667"
                                                        data-image-focal-point="0.5,0.5" alt="reCycle.jpg"
                                                        data-load="false" data-image-id="5dc85fdd09cdf43d6dc62fd4"
                                                        data-type="image"
                                                        style="background: #000;"/>
                                                </div>
                                            </div>


                                        </figure>


                                    </div>


                                </div>
                                <div class="content-overlay"></div>
                                <div class="classes-text content-classes" style="padding-top: 2rem; height: 12rem ">
                          
                                <div class="content-details fadeIn-top">
                                    <p class="">Our JUNK version of cycling is the only rave without a comedown. Our instructors will take you through an energetic, sensory journey giving you full-body workout as you tackle a series of powerful sprints and quad burning climbs. </p>

                                </div>
                                <div class="row d-flex justify-content-center " style="width:100%">
                                    <div class="col-12">
                                        <a href="{{route('buy-packages')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                                    </div>
                                </div>
    </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 classes-col" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom" data-aos-duration="1000" data-aos-delay="500">
                            <div class="sqs-block image-block sqs-block-image" data-aspect-ratio="95.85492227979275"
                                 data-block-type="5" id="block-yui_3_17_2_1_1536928408224_27042">

                                <div class="sqs-block-content">


                                    <div class="
          image-block-outer-wrapper
          layout-caption-below
          design-layout-inline
          combination-animation-fade-in
          individual-animation-none
          individual-text-animation-none
        " data-test="image-block-inline-outer-wrapper">


                                        <figure class="
              sqs-block-image-figure
              intrinsic
            " style="max-width:2500px;
  overflow: hidden;






">


                                            <div class="image-block-wrapper img-class" data-animation-role="image"
                                                 data-animation-override>
                                                <div class="sqs-image-shape-container-element



              has-aspect-ratio
            " style="
                position: relative;

                  padding-bottom:95.85491943359375%;


  overflow: hidden;







              ">
                                                    <noscript><img src="{{asset('front/img/yoga.png')}}"
                                                                   alt="yoga.png"/></noscript>
                                                    <img class="thumb-image"
                                                         data-src="{{asset('front/img/yoga.png')}}"
                                                         data-image="{{asset('front/img/yoga.png')}}"
                                                         data-image-dimensions="2500x1667"
                                                         data-image-focal-point="0.5,0.5" alt="yoga.png"
                                                         data-load="false" data-image-id="5dc8600794d2ca4234c40806"
                                                         data-type="image"
                                                         style="width: 100%!important;"/>
                                                </div>
                                            </div>


                                        </figure>


                                    </div>


                                </div>

                                <div class="classes-text" style="padding-top: 2rem; height: 12rem">
                                    <p class="">JUNK Yoga will take you through a series of poses and salutations designed to relieve stress, improve posture, increase flexibility and to strengthen and tone the body. Channel the zen from within with our hypnotic- meditative yoga or join us for a blood pumping, body sculpting- high intensity power yoga.</p>

                                </div>
                                <div class="row d-flex justify-content-center " style="width:100%">
                                    <div class="col-12">
                                        <a href="{{route('buy-packages')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 classes-col" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom" data-aos-duration="1000" data-aos-delay="750">
                            <div class="sqs-block image-block sqs-block-image" data-aspect-ratio="96.37305699481865"
                                 data-block-type="5" id="block-yui_3_17_2_1_1532262749037_28085">

                                <div class="sqs-block-content">
                                    <div class="
          image-block-outer-wrapper
          layout-caption-below
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
                                                <div class="sqs-image-shape-container-element
              has-aspect-ratio
            " style="
                position: relative;
                  padding-bottom:96.37305450439453%;
  overflow: hidden;">
                                                    <noscript><img src="{{asset('front/img/rebootourclasses.jpg')}}"
                                                                   alt="rebootourclasses.jpg"/></noscript>
                                                    <img class="thumb-image"
                                                         data-src="{{asset('front/img/rebootourclasses.jpg')}}"
                                                         data-image="{{asset('front/img/rebootourclasses.jpg')}}"
                                                         data-image-dimensions="2500x1667"
                                                         data-image-focal-point="0.5,0.5"
                                                         alt="rebootourclasses.png" data-load="false"
                                                         data-image-id="5dc8622fb9580a7364015579"
                                                         data-type="image" style="background: #000;"/>
                                                </div>
                                            </div>


                                        </figure>


                                    </div>


                                </div>

                                <div class="classes-text" style="padding-top: 2rem; height: 12rem">
                                    <p class="">JUNK bootcamp provides you with high-intensity, total body conditioning exercises, using both bodyweight and equipment, designed to strengthen and leave you with a lasting burn. Tighten those abs, burn fat and get rid of the junk in your trunk.</p>

                                </div>
                                <div class="row d-flex justify-content-center " style="width:100%">
                                    <div class="col-12">
                                        <a href="{{route('buy-packages')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 classes-col" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                            <div class="sqs-block image-block sqs-block-image" data-aspect-ratio="96.37305699481865"
                                 data-block-type="5" id="block-yui_3_17_2_1_1532262749037_28085">

                                <div class="sqs-block-content">
                                    <div class="
          image-block-outer-wrapper
          layout-caption-below
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
                                                <div class="sqs-image-shape-container-element
              has-aspect-ratio
            " style="
                position: relative;
                  padding-bottom:96.37305450439453%;
  overflow: hidden;">
                                                    <noscript><img src="{{asset('front/img/beatbox1.png')}}"
                                                                   alt="beatbox1.png"/>
                                                    </noscript>
                                                    <img
                                                        class="thumb-image"
                                                        data-src="{{asset('front/img/beatbox1.png')}}"
                                                        data-image="{{asset('front/img/beatbox1.png')}}"
                                                        data-image-dimensions="2500x1667"
                                                        data-image-focal-point="0.5,0.5" alt="beatbox1.png"
                                                        data-load="false" data-image-id="5dc8622fb9580a7364015579"
                                                        data-type="image"
                                                        style="background: #000;"/>
                                                </div>
                                            </div>


                                        </figure>


                                    </div>


                                </div>

                                <div class="classes-text" style="padding-top: 2rem;height: 12rem ">
                                    <p class="">The JUNK fitness class that packs a punch! Let your body mimic the beat as you take on this high energy box fit class – high knees, powerful jabs and stealthy movements come together to create a full body workout, improving both stamina and coordination. </p>

                                </div>
                                <div class="row d-flex justify-content-center " style="width:100%">
                                    <div class="col-12">
                                        <a href="{{route('buy-packages')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 classes-col" data-aos="fade-up"
                             data-aos-anchor-placement="center-bottom" data-aos-duration="1000" data-aos-delay="250">
                            <div class="sqs-block image-block sqs-block-image" data-aspect-ratio="96.37305699481865"
                                 data-block-type="5" id="block-yui_3_17_2_1_1532262749037_28085">

                                <div class="sqs-block-content">
                                    <div class="
          image-block-outer-wrapper
          layout-caption-below
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
                                                <div class="sqs-image-shape-container-element
              has-aspect-ratio
            " style="
                position: relative;
                  padding-bottom:96.37305450439453%;
  overflow: hidden;">
                                                    <noscript><img src="{{asset('front/img/Dancelogoforclasses.jpg')}}"
                                                                   alt="Dancelogoforclasses.png"/></noscript>
                                                    <img class="thumb-image"
                                                         data-src="{{asset('front/img/Dancelogoforclasses.jpg')}}"
                                                         data-image="{{asset('front/img/Dancelogoforclasses.jpg')}}"
                                                         data-image-dimensions="2500x1667"
                                                         data-image-focal-point="0.5,0.5"
                                                         alt="Dancelogoforclasses.png" data-load="false"
                                                         data-image-id="5dc8622fb9580a7364015579" data-type="image"
                                                         style="background: #000;"/>
                                                </div>
                                            </div>


                                        </figure>


                                    </div>


                                </div>

                                <div class="classes-text" style="padding-top: 2rem; height: 12rem">
                                    <p class="">We WANT you on our “dance” floor. This addictive fitness class is designed with FUN in mind. Our Dance MC will lead you through this FUN, calorie-burning, mood enhancing, electrifying workout. </p>

                                </div>
                                <div class="row d-flex justify-content-center " style="width:100%">
                                    <div class="col-12">
                                        <a href="{{route('buy-packages')}}">
                                            <button id="btn-join" class="btn-book">book now</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 <div class="row sqs-row">
                     <div class="col sqs-col-4 span-4">
                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                          id="block-yui_3_17_2_1_1532264863685_18473">
                          <div class="sqs-block-content">
                            <h3 style="white-space:pre-wrap;">RIDE</h3>
                            <p class="" style="white-space:pre-wrap;">Pedal through heavy climbs and saddle up for powerful
                              sprints in our signature Ride sessions. Enjoy a full body workout set against beat-pumping
                              tracks and state of the art light and sound system.</p>
                            <p class="" data-rte-preserve-empty="true" style="white-space:pre-wrap;"></p>
                          </div>
                        </div>
                      </div>-
                      <div class="col sqs-col-4 span-4">
                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                          id="block-yui_3_17_2_1_1532264863685_8291">
                          <div class="sqs-block-content">
                            <h3 style="white-space:pre-wrap;">SHAPE</h3>
                            <p class="" style="white-space:pre-wrap;">An all-encompassing workout combining high intensity
                              interval training and functional movement skills designed to challenge, burn and shape
                              selected
                              muscle groups and boost your overall strength.</p>
                          </div>
                        </div>
                      </div>
                      <div class="col sqs-col-4 span-4">
                        <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                          id="block-yui_3_17_2_1_1532264863685_20646">
                          <div class="sqs-block-content">
                            <h3 style="white-space:pre-wrap;">STRETCH</h3>
                            <p class="" style="white-space:pre-wrap;">Balance your fitness routine with a combination of
                              dynamic and static stretching for all levels of flexibility. These sessions are designed to
                              aid
                              muscle recovery, reduce the risk of injury, and enhance performance. </p>
                          </div>
                        </div>
                      </div>
                    </div> --> 
                    <div class="row sqs-row">
                        <div class="col sqs-col-0 span-0"></div>
                    </div>
                </div>
            </section>
        </main>
    </div>
@section('custom-script')
    <script type="text/javascript" data-sqs-type="imageloader-bootstrapper">(function () {
            if (window.ImageLoader) {
                window.ImageLoader.bootstrap({}, document);
            }
        })();</script>
    <script>Squarespace.afterBodyLoad(Y);</script>
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display:none" data-usage="social-icons-svg">
        <symbol id="instagram-icon" viewBox="0 0 64 64">
            <path
                d="M46.91,25.816c-0.073-1.597-0.326-2.687-0.697-3.641c-0.383-0.986-0.896-1.823-1.73-2.657c-0.834-0.834-1.67-1.347-2.657-1.73c-0.954-0.371-2.045-0.624-3.641-0.697C36.585,17.017,36.074,17,32,17s-4.585,0.017-6.184,0.09c-1.597,0.073-2.687,0.326-3.641,0.697c-0.986,0.383-1.823,0.896-2.657,1.73c-0.834,0.834-1.347,1.67-1.73,2.657c-0.371,0.954-0.624,2.045-0.697,3.641C17.017,27.415,17,27.926,17,32c0,4.074,0.017,4.585,0.09,6.184c0.073,1.597,0.326,2.687,0.697,3.641c0.383,0.986,0.896,1.823,1.73,2.657c0.834,0.834,1.67,1.347,2.657,1.73c0.954,0.371,2.045,0.624,3.641,0.697C27.415,46.983,27.926,47,32,47s4.585-0.017,6.184-0.09c1.597-0.073,2.687-0.326,3.641-0.697c0.986-0.383,1.823-0.896,2.657-1.73c0.834-0.834,1.347-1.67,1.73-2.657c0.371-0.954,0.624-2.045,0.697-3.641C46.983,36.585,47,36.074,47,32S46.983,27.415,46.91,25.816z M44.21,38.061c-0.067,1.462-0.311,2.257-0.516,2.785c-0.272,0.7-0.597,1.2-1.122,1.725c-0.525,0.525-1.025,0.85-1.725,1.122c-0.529,0.205-1.323,0.45-2.785,0.516c-1.581,0.072-2.056,0.087-6.061,0.087s-4.48-0.015-6.061-0.087c-1.462-0.067-2.257-0.311-2.785-0.516c-0.7-0.272-1.2-0.597-1.725-1.122c-0.525-0.525-0.85-1.025-1.122-1.725c-0.205-0.529-0.45-1.323-0.516-2.785c-0.072-1.582-0.087-2.056-0.087-6.061s0.015-4.48,0.087-6.061c0.067-1.462,0.311-2.257,0.516-2.785c0.272-0.7,0.597-1.2,1.122-1.725c0.525-0.525,1.025-0.85,1.725-1.122c0.529-0.205,1.323-0.45,2.785-0.516c1.582-0.072,2.056-0.087,6.061-0.087s4.48,0.015,6.061,0.087c1.462,0.067,2.257,0.311,2.785,0.516c0.7,0.272,1.2,0.597,1.725,1.122c0.525,0.525,0.85,1.025,1.122,1.725c0.205,0.529,0.45,1.323,0.516,2.785c0.072,1.582,0.087,2.056,0.087,6.061S44.282,36.48,44.21,38.061z M32,24.297c-4.254,0-7.703,3.449-7.703,7.703c0,4.254,3.449,7.703,7.703,7.703c4.254,0,7.703-3.449,7.703-7.703C39.703,27.746,36.254,24.297,32,24.297z M32,37c-2.761,0-5-2.239-5-5c0-2.761,2.239-5,5-5s5,2.239,5,5C37,34.761,34.761,37,32,37z M40.007,22.193c-0.994,0-1.8,0.806-1.8,1.8c0,0.994,0.806,1.8,1.8,1.8c0.994,0,1.8-0.806,1.8-1.8C41.807,22.999,41.001,22.193,40.007,22.193z"/>
        </symbol>
        <symbol id="instagram-mask" viewBox="0 0 64 64">
            <path
                d="M43.693,23.153c-0.272-0.7-0.597-1.2-1.122-1.725c-0.525-0.525-1.025-0.85-1.725-1.122c-0.529-0.205-1.323-0.45-2.785-0.517c-1.582-0.072-2.056-0.087-6.061-0.087s-4.48,0.015-6.061,0.087c-1.462,0.067-2.257,0.311-2.785,0.517c-0.7,0.272-1.2,0.597-1.725,1.122c-0.525,0.525-0.85,1.025-1.122,1.725c-0.205,0.529-0.45,1.323-0.516,2.785c-0.072,1.582-0.087,2.056-0.087,6.061s0.015,4.48,0.087,6.061c0.067,1.462,0.311,2.257,0.516,2.785c0.272,0.7,0.597,1.2,1.122,1.725s1.025,0.85,1.725,1.122c0.529,0.205,1.323,0.45,2.785,0.516c1.581,0.072,2.056,0.087,6.061,0.087s4.48-0.015,6.061-0.087c1.462-0.067,2.257-0.311,2.785-0.516c0.7-0.272,1.2-0.597,1.725-1.122s0.85-1.025,1.122-1.725c0.205-0.529,0.45-1.323,0.516-2.785c0.072-1.582,0.087-2.056,0.087-6.061s-0.015-4.48-0.087-6.061C44.143,24.476,43.899,23.682,43.693,23.153z M32,39.703c-4.254,0-7.703-3.449-7.703-7.703s3.449-7.703,7.703-7.703s7.703,3.449,7.703,7.703S36.254,39.703,32,39.703z M40.007,25.793c-0.994,0-1.8-0.806-1.8-1.8c0-0.994,0.806-1.8,1.8-1.8c0.994,0,1.8,0.806,1.8,1.8C41.807,24.987,41.001,25.793,40.007,25.793z M0,0v64h64V0H0z M46.91,38.184c-0.073,1.597-0.326,2.687-0.697,3.641c-0.383,0.986-0.896,1.823-1.73,2.657c-0.834,0.834-1.67,1.347-2.657,1.73c-0.954,0.371-2.044,0.624-3.641,0.697C36.585,46.983,36.074,47,32,47s-4.585-0.017-6.184-0.09c-1.597-0.073-2.687-0.326-3.641-0.697c-0.986-0.383-1.823-0.896-2.657-1.73c-0.834-0.834-1.347-1.67-1.73-2.657c-0.371-0.954-0.624-2.044-0.697-3.641C17.017,36.585,17,36.074,17,32c0-4.074,0.017-4.585,0.09-6.185c0.073-1.597,0.326-2.687,0.697-3.641c0.383-0.986,0.896-1.823,1.73-2.657c0.834-0.834,1.67-1.347,2.657-1.73c0.954-0.371,2.045-0.624,3.641-0.697C27.415,17.017,27.926,17,32,17s4.585,0.017,6.184,0.09c1.597,0.073,2.687,0.326,3.641,0.697c0.986,0.383,1.823,0.896,2.657,1.73c0.834,0.834,1.347,1.67,1.73,2.657c0.371,0.954,0.624,2.044,0.697,3.641C46.983,27.415,47,27.926,47,32C47,36.074,46.983,36.585,46.91,38.184z M32,27c-2.761,0-5,2.239-5,5s2.239,5,5,5s5-2.239,5-5S34.761,27,32,27z"/>
        </symbol>
        <symbol id="facebook-icon" viewBox="0 0 64 64">
            <path
                d="M34.1,47V33.3h4.6l0.7-5.3h-5.3v-3.4c0-1.5,0.4-2.6,2.6-2.6l2.8,0v-4.8c-0.5-0.1-2.2-0.2-4.1-0.2 c-4.1,0-6.9,2.5-6.9,7V28H24v5.3h4.6V47H34.1z"/>
        </symbol>
        <symbol id="facebook-mask" viewBox="0 0 64 64">
            <path
                d="M0,0v64h64V0H0z M39.6,22l-2.8,0c-2.2,0-2.6,1.1-2.6,2.6V28h5.3l-0.7,5.3h-4.6V47h-5.5V33.3H24V28h4.6V24 c0-4.6,2.8-7,6.9-7c2,0,3.6,0.1,4.1,0.2V22z"/>
        </symbol>
    </svg>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection
@endsection
