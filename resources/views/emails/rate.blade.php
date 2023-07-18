<!DOCTYPE html>
<html>

<head>
    <title>JUNK</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="image/logo-icon.png">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/rateemail/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" />

</head>

<body>
    <div class="container py-3">
        <div class="text-center pb-5">
            <img src="{{ asset('front/img/logo.png') }}" width="300px">
        </div>
        <div class="title pb-5">
            <h5 style="line-height: 30px;">Hi {{ $user->username() }} <br> Now that your request is with you, we would
                like to know how this
                experience was <br>Please
                take a minute to answer the survey and help us serve you better</h5>
        </div>
        <form method="POST">
            <div class="title">
                <h5>How do you rate the experience of joining us in Junk Club?</h5>
            </div>
            <div class="row rate-text">
                <div class="col-6">
                    <p>Not satisfied at all</p>
                </div>
                <div class="col-6 text-right">
                    <p>Extremely satisfied</p>
                </div>
            </div>
            <div class="row rate">
                <input type="button" id="service_rate" value="" name="service_rate" hidden>

                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">0</button>
                </div>
                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">1</button>
                </div>
                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">2</button>
                </div>
                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">3</button>
                </div>
                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">4</button>
                </div>
                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">5</button>
                </div>
                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">6</button>
                </div>
                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">7</button>
                </div>
                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">8</button>
                </div>
                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">9</button>
                </div>
                <div class="col-1"><button type="button" class="btn button ratebutton"
                        onclick="showDiv('toggle')">10</button>
                </div>
            </div>
            <div class="page2" id="toggle" style="display:none">
                <div class="title pt-5">
                    <h5>What makes your experience with us so special?</h5>
                </div>

                <div class="box">
                    <div>
                        <input type="checkbox" id="" class="specialization_in_our_service"
                            name="specialization_in_our_service" value="service1">
                        <label for="vehicle1"> service1</label>
                    </div>
                    <div>
                        <input type="checkbox" id="" class="specialization_in_our_service"
                            name="specialization_in_our_service" value="service2">
                        <label for="vehicle1"> service2</label>
                    </div>
                    <div>
                        <input type="checkbox" id="" class="specialization_in_our_service"
                            name="specialization_in_our_service" value="service3">
                        <label for="vehicle1"> service3</label>
                    </div>
                    <div>
                        <input type="checkbox" id="" class="specialization_in_our_service"
                            name="specialization_in_our_service" value="service4">
                        <label for="vehicle1"> service4</label>
                    </div>
                </div>
                <div class="title pt-3">
                    <h5>Where the items in your order accurate?</h5>
                </div>
                <div class="box">
                    <div>
                        <input type="radio" id="rate_radio_1" name="is_your_elements_accurately_found" value="1">
                        <label style="font-weight: 500;">Yes</label>
                    </div>
                    <div>
                        <input type="radio" id="rate_radio_1" name="is_your_elements_accurately_found" value="2">
                        <label style="font-weight: 500;">No</label>
                    </div>
                </div>
                <div class="title pt-3">
                    <h5>Did you need to contact customer service for your order?</h5>
                </div>
                <div class="box">
                    <div>
                        <input type="radio" id="rate_radio_2" name="did_you_need_customers_service" value="1">
                        <label style="font-weight: 500;">Yes</label>
                    </div>
                    <div>
                        <input type="radio" id="rate_radio_2" name="did_you_need_customers_service" value="2">
                        <label style="font-weight: 500;">No</label>
                    </div>
                </div>
                <div class="title pt-3">
                    <h5>Do you want to add any other comments?</h5>
                    <textarea id="comments" type="text" class="" name="comments"></textarea>
                </div>
                <div class="text-center pt-3 ">
                    <button id="submitform" type="submit" class="btn btn-submit">Submit</button>
                </div>
                <div hidden id="errordiv" class="alert alert-danger"></div>
                <div class=" powered text-center pt-3">
                    <p>Powered by <strong>Ali Fouad Group</strong></p>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('terms-conditions') }}">Terms & Conditions</a></li>
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                    </ul>

                </div>
            </div>
            <div class="title pt-5">
                <h5>With sincere thanks, JUNK team.</h5>
            </div>
        </form>
    </div>
    <div class="box2 pt-5">
        <div class="container">
            <p>Please do not reply to this email</p>
            <P>Our privacy policy can be found on our website <a href="{{ route('front-home') }}"
                    style="text-decoration: underline; color: #8fd242;">here</a></P>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"
        integrity="sha512-lzilC+JFd6YV8+vQRNRtU7DOqv5Sa9Ek53lXt/k91HZTJpytHS1L6l1mMKR9K6VVoDt4LiEXaa6XBrYk1YhGTQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script>
        $('.ratebutton').click(function() {
            $('#service_rate').val($(this).text());
        });

        $('form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append('serviceRate', $('#service_rate').val());
            var specialization_in_our_service = new Array();
            $('.specialization_in_our_service').each(function(index, item) {
                if (item.checked)
                    specialization_in_our_service.push(item.value);
            });
            formData.append('specialization_in_our_service', specialization_in_our_service);
            formData.append('is_your_elements_accurately_found', $(
                'input[name="is_your_elements_accurately_found"]:checked').val());
            formData.append('did_you_need_customers_service', $(
                'input[name="did_you_need_customers_service"]:checked').val());
            formData.append('comments', $('#comments').val());
            var url = "{{ route('web_service_rate', ':id') }}";
            url = url.replace(':id', "{{ $user->id }}");
            $.ajax({
                url: url,
                type: 'post',
                processData: false,
                contentType: false,
                data: formData,
                success: function(result) {
                    if (result) {
                        $("#errordiv").removeClass("alert-danger").addClass("alert-success");
                        $("#errordiv").text("Thank you for rating our service");
                        $("#errordiv").attr('hidden', false);
                    } else {
                        $("#errordiv").removeClass("alert-success").addClass("alert-danger");
                        var url = "{{ route('web_get_user_rate', ':id') }}";
                        url = url.replace(':id', "{{ $user->id }}");
                        $.ajax({
                            url: url,
                            success: function(result) {
                                $("#errordiv").text(
                                    "You already rate our service thank you").append(
                                    "<br/><b> your rate was  " + result + "</b>");
                                $("#errordiv").attr('hidden', false);
                                $("#errordiv").append(
                                    "<a href='{{ route('front-home') }}'>  Home</a>");
                            }
                        });
                    }
                },
                error: function(error) {
                    $("#errordiv").removeClass("alert-success").addClass("alert-danger");
                    $("#errordiv").empty();
                    $.each(error.responseJSON.errors, function(index, value) {
                        $('#errordiv').append("<li>"+value+"</li>");
                    });
                    $("#errordiv").attr('hidden', false);
                }
            });
        });
    </script>

    <script type="text/javascript">
        function showDiv(toggle) {
            document.getElementById(toggle).style.display = 'block';
            // $("#service_rate").val(this.value);
        }
    </script>
    <script>
        function setThisButtonActive(button) {
            button.classList.add("button-active");
        }

        /* select all active buttons, and remove the active class from them */
        function resetActiveButton() {
            document.querySelectorAll(".button-active").forEach((button) => {
                button.classList.remove("button-active");
            });
        }

        document.querySelectorAll(".button").forEach((button) => {
            button.addEventListener("click", function() {
                resetActiveButton();
                setThisButtonActive(button);
            });
        });
    </script>
</body>

</html>
