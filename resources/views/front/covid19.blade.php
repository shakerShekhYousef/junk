@extends('layouts.front.base')
@section('pageTitle', 'Covid-19')
@section('custom-style')
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
    </style>
@endsection
@section('content')
    <div class="Content-outer">
        <main class="Main Main--page">

            <section class="Main-content" data-content-field="main-content">
                <div class="sqs-layout sqs-grid-12 columns-12" data-type="page" data-updated-on="1629809956682"
                     id="page-5b27a52f88251ba76209d826">
                    <div class="row sqs-row">
                        <div class="col sqs-col-12 span-12" style="padding-right:15px;">
                            <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                 id="block-8055dd57ca174b82e253">
                                <div class="sqs-block-content">
                                    <p style="text-align:center;" class=""></p>
                                    <div style="text-align:center;" class="" data-aos="fade-up"
                                         data-aos-anchor-placement="center-bottom" data-aos-duration="1000">
                                        <h2 style="text-transform: uppercase;text-align: center; margin-bottom:1rem">Waiver of Liability
                                            <br>Relating to
                                            COVID 19</h2>
                                    </div>
                                    <p class="">The novel coronavirus, COVID-19, has been declared a
                                        worldwide pandemic by the World Health Organization. COVID-19 is extremely
                                        contagious and is
                                        believed to spread mainly from person-to-person contact. As a result, local
                                        governments, federal
                                        and state health agencies recommend social distancing and have, in many
                                        locations, prohibited
                                        the congregation of groups of people. </p>
                                    <p class="">JUNK Fitness Club has put in place aggressive
                                        preventative measures to reduce the spread of COVID-19. However, the studio
                                        cannot guarantee
                                        that you or any member/employee of JUNK Fitness Club will not become infected
                                        with COVID-19.
 </p>
                                    <div data-aos="fade-up" data-aos-anchor-placement="center-bottom"
                                         data-aos-duration="1000"><img
                                            src="{{asset('front/img/covid.jpg')}}" style="width: 100%;object-fit: contain;height: 100%;margin-bottom: 2rem"></div>
                                    <p class="">You acknowledge the contagious nature of COVID-19 and
                                        voluntarily assume the risk that you MAY be exposed to or infected by COVID-19
                                        by attending the
                                        Junk Fitness Club and that such exposure or infection may result in personal
                                        injury, illness,
                                        permanent disability, and death. You understand that the risk of becoming
                                        exposed to or infected
                                        by COVID-19 at the gym may result from the actions, omissions, or negligence of
                                        yourself and
                                        others, including, but not limited to, gym employees, coaches, and staff. </p>
                                    <p class="">If you have come in contact anyone that is COVID-19
                                        positive, you agree to not attend your regular gym sessions, until you have
                                        tested negative
                                        yourself, to avoid the possible spread of COVID-19 within JUNK Fitness Club. You
                                        understand that
                                        full transparency within this regard is required of all Gym employees, staff and
                                        members in
                                        order to sustain a healthy fully functioning fitness environment, and agree to
                                        communicate any
                                        potential exposure with management so they can properly assist you with your
                                        current class
                                        schedule, possible suspension of membership as well as contacting any other
                                        members you may have
                                        been in close contact with while at JUNK. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
@endsection
