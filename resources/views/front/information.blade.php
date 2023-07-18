@extends('layouts.front.base')
@section('pageTitle', 'Class information')
@section('custom-style')
    <style type="text/css">
        #sub:hover {
            color: #ffffff !important;
            background-color: #171d2b !important;
        }

        .sqs-block {
            padding-bottom: 0px !important;
        }

        .sqs-block-image .image-block-outer-wrapper.layout-caption-overlay-hover .image-caption-wrapper {
            border-radius: 0px 0px 10px 10px;
        }

        a:hover {
            text-decoration: none;
            color: #000;
        }

        @media (max-width: 991px) {
            .co-fit {
                display: none;
            }
        }

        @media (max-width: 767px) {
            #col-right {
                padding-left: 0 !important
            }
        }


        /* The sticky class is added to the header with JS when it reaches its scroll position */
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999999;

        }

        @media (max-width: 767px) {
            #bt {
                margin: 0 auto !important
            }
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
                <div style="box-shadow: 0px 5px 7px #33333340;height: 25rem;" class="sqs-layout sqs-grid-12 columns-12"
                    data-type="page" data-updated-on="1629809956682" id="page-5b27a52f88251ba76209d826">
                    <div class="row sqs-row">
                        <div class="col sqs-col-12 span-12">
                            <div class="sqs-block html-block sqs-block-html" data-block-type="2"
                                id="block-8055dd57ca174b82e253">
                                <div class="sqs-block-content">
                                    <div class="row" style="padding-top: 1rem">
                                        <div class=" col-lg-7 col-md-6 col-sm-6">
                                            <h1 class="page-title" style="font-family: 'Futura'!important;">RESERVE A
                                                SPOT</h1>
                                        </div>
                                        <div class="col-lg-2  col-md-2 col-sm-1"></div>
                                        <div class="col-lg-3 col-md-4 col-sm-5 text-right">
                                            <div class="form-group form-material">
                                                <a href="{{ route('web_calander_data_show', [session()->get('classid', 0), session()->get('musicid', 0), session()->get('coachid', 0), session()->get('weekid', 0), 3]) }}"
                                                    style="font-family: 'Futura'; padding-right: 1rem; color: #ffffff">
                                                    <i class="fa fa-arrow-left"></i>
                                                    Back to Calendar </a>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <p style="width: 50%; margin-left: 25%; margin-top: 5%">
                                            {{ $session->classm->description }}
                                        </p>
                                    </div>
                                    <form id="maindata" method="POST" action="{{ route('books.store') }}">
                                        @csrf
                                        <input type="text" name="class_id" value="{{ $session->class_id }}" hidden>
                                        <input type="text" name="session_id" value="{{ $session->id }}" hidden>
                                        <input type="text" name="bookdate" value="{{ $date }}" hidden>
                                        <input type="text" name="member_id" value="{{ Auth::user()->id }}" hidden>
                                        {{-- <input type="button" class="btn btn-meduim" id="buttonsubmit" value="BOOK NOW"> --}}
                                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                            <a href="" id="">
                                                <button id="" class="btn-book">BOOK NOW</button>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script>
        $('#buttonsubmit').click(function(e) {

            // e.preventDefault();

            if ($('#buttonsubmit').val() == "BOOK NOW") {
                var formData = new FormData();

                $('#maindata').serializeArray().forEach(function(field) {
                    formData.append(field.name, field.value);
                });

                $.ajax({
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    url: "{{ route('books.store') }}",
                    success: function(result) {
                        window.location.href =
                            "{{ route('web_calander_data_show') }}";
                    }
                });
            }
        })
    </script>
@endsection
