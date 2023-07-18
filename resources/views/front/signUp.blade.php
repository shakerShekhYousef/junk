@extends('layouts.front.base')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
@section('pageTitle', 'Register')
@section('custom-style')
    <style>
        .my-float {
            margin-top: 10px;
        }

        .sticky {
            z-index: 1000 !important;
        }

        .register-section {
            padding: 71px 102px;
        }

        @media screen and (max-width: 1024px) {
            .register-section {
                padding-left: 64px;
                padding-right: 64px;
            }
        }

        @media screen and (max-width: 960px) {
            .register-section {
                padding-left: 48px;
                padding-right: 48px;
            }
        }

        @media screen and (max-width: 768px) {
            .register-section {
                padding-left: 36px;
                padding-right: 36px;
            }
        }

        @media screen and (max-width: 991.5px) {
            .female-co {
                text-align: center;
            }

            .co-weight {
                margin-top: 1rem;
            }

            .row-radio {
                margin-bottom: 2rem;
            }

            .arriv-check {
                display: flex;
                align-items: baseline;
            }
        }



        .register-section .reg-content {
            background: #000;

        }

        .register-section .form-reg-box p {
            text-align: center;
            margin: 4rem 0 5rem;
        }

        .register-section .form-reg-box {
            background: #000;

        }

        .register-section .form-reg-box p span {
            background: #000;
            color: #fff;
            font-weight: 600;
            font-size: 18px;
            padding: 5px 12px;
            border-radius: .3em;
        }

        .register-section .form-reg-box h6 {
            font-size: 16px;
            font-weight: 500;
            color: #424242;
            text-transform: capitalize !important;
            font-family: 'Futura' !important;

        }

        .register-section .form-reg-box input {
            box-shadow: none;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border: 2px solid #ced4da !important;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        .form-control:focus,
        .form-control:active {
            background: transparent;
            border: 1px solid #000;
        }

        .register-section .form-reg-box .input-group-addon {
            position: absolute;
            z-index: 1000;
            background: #90D242;
            color: #fff;
            padding: 8px 20px;
            text-align: center;
            border-radius: .25rem;
        }

        .register-section .form-reg-box .input-group input {
            border-radius: .25rem;
            padding: 0 60px;
        }

        .register-section .form-reg-box .send-form a {
            font-weight: 600;
            text-decoration: none;
            color: #000;
        }

        .register-section .form-reg-box .send-form .btn-send {
            color: #fff;
            background-color: #000000;
            padding: 10px 40px;
        }

        .register-section .form-reg-box .send-form .btn-send:hover {
            background: #90D242;
        }

        .content {
            height: 100vh;
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
            color: #000;
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


        #icon {
            margin-left: -30px;
            cursor: pointer;
        }

        #icon1 {
            margin-left: 462px;
            cursor: pointer;
        }

        @media(max-width: 1440px) {
            #icon1 {
                margin-left: 448px;
            }
        }

        @media(max-width: 1250px) {
            #icon1 {
                margin-left: 90%;
            }
        }

        @media(max-width: 768px) {
            #icon1 {
                margin-left: 88%;
            }
        }

        @media(max-width: 425px) {
            #icon1 {
                margin-left: 92%;
            }
        }

        @media(max-width: 375px) {
            #icon1 {
                margin-left: 90%;
            }
        }

        @media(max-width: 320px) {
            #icon1 {
                margin-left: 88%;
            }
        }


        .second-step{display: none;}
        #second-title{display: none;}
        .third-step{display: none;}
        #sec{display: none;}
        #thir{display: none;}

    </style>
@endsection
@section('content')
    <a class="whats-app" href="https://wa.me/971585357917" target="_blank">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <i style="z-index: 999" class="fab fa-whatsapp my-float" aria-hidden="true"></i>
    </a>
    <div class="Content-outer">
        <!--ghazal register-->
        <main class="Main Main--page">

            <div class="register-section">
                <h1 style="text-transform: uppercase;"> Sign up now</h1>
                <div class="reg-content">
                    <div class="container">
                        <form action="#" method="POST" id="form-reg">
                            @csrf
                            <div class="form-reg-box">
                                <p id="first-title"><span> Profile Information</span></p>
                                <div class="row first-step">
                                    <div class="form-group col-md-6 col-12">
                                        <label for="f-name" class="required">
                                            <h6> Name:* </h6>
                                        </label>
                                        <input type="text" name="name" required="required" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="email" class="required">
                                            <h6>Email Address:* </h6>
                                        </label>
                                        <input type="email" name="email" required="required" class="form-control" />
                                    </div>
                                </div>

                                <div class="row first-step" >
                                    <div class="form-group col-md-6 col-12">
                                        <label for="password" class="required">
                                            <h6>Password:* </h6>
                                        </label>
                                        <span style="display: flex;">
                                            <input type="password" name="password" autocomplete="current-password"
                                                required="" id="id_password" class="form-control" />
                                            <i id="icon" class="far fa-eye togglePassword1" id=""
                                                style="margin-top: 13px"></i>
                                        </span>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label for="password_confirmation" class="required">
                                            <h6>Password Confirm:*
                                            </h6>
                                        </label>
                                        <input type="password" name="password_confirmation" id="id_password2"
                                            required="required" class="form-control" />
                                        <i id="icon1" class="far fa-eye togglePassword2" id="" style="margin-top: 2px"></i>
                                    </div>
                                </div>

                                <div class="row first-step">
                                    <div class="form-group col-md-6 col-12">
                                        <label for="f-name" class="required">
                                            <h6>Contact Number:*</h6>
                                        </label>
                                        <input type="text" class="form-control" name="phone" placeholder="" value=""
                                            required="" onkeypress="return AllowOnlyNumbers(event);">
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="f-name" class="required">
                                            <h6>WhatsApp Number:*</h6>
                                        </label>
                                        <input type="text" class="form-control" name="whats_app_phone" placeholder=""
                                            value="" required="" onkeypress="return AllowOnlyNumbers(event);">
                                    </div>
                                </div>

                                <div class="row second-step">
                                    <div class=" col-lg-6 col-md-12 col-12">
                                        <label for="birthday">
                                            <h6>Date of Birth:</h6>
                                        </label>
                                        <input type="date" id="birthday" name="dob" class="form-control" value="">
                                    </div>
                                </div>


                                <div class="row second-step" style="    align-items: center; padding: 2rem 0;">
                                    <div class="form-group col-lg-2 col-md-12 col-12">
                                        <label for="">
                                            <h6>Gender: </h6>
                                        </label>
                                    </div>
                                    <div class="form-group col-lg-2  col-md-6 col-6 text-center">
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="gender" name="gender" value="1">
                                            <label style="font-weight: 500;">Male</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-2  col-md-6 col-6 female-co">
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="gender" name="gender" value="2" checked="">
                                            <label style="font-weight: 500;">Female</label>

                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-12 col-12">
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="">
                                                    <h6> Height: </h6>
                                                </label>
                                                <input type="text" name="height" value="" class="form-control"
                                                    onkeypress="return AllowOnlyNumbers(event);">
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <label for="">
                                                    <h6> Weight: </h6>
                                                </label>
                                                <input type="text" name="weight" value="" class="form-control"
                                                    onkeypress="return AllowOnlyNumbers(event);">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row second-step">
                                    <div class="form-group col-md-6 col-12">
                                        <label for="emergency_name">
                                            <h6>Emergency Contact Name:</h6>
                                        </label>
                                        <input type="text" class="form-control" id="emergency_name"
                                            name="emergency_contact_name" placeholder="" value="">
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label for="emergency_phone">
                                            <h6> Emergency Contact Number: </h6>
                                        </label>
                                        <input type="text" class="form-control" id="emergency_phone"
                                            name="emergency_contact_number" placeholder="" value=""
                                            onkeypress="return AllowOnlyNumbers(event);">
                                    </div>
                                </div>

                                <div class="row second-step" style="padding: 2rem 0;">
                                    <div class="col-lg-6 col-md-6">
                                        <label>
                                            <h6>How did you hear about JUNK?</h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-4">
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="social" name="how_did_you_hear_about_junk" value="IG"
                                                checked="">
                                            <label style="font-weight: 500;">IG </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-4">
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="social" name="how_did_you_hear_about_junk" value="FB ">
                                            <label style="font-weight: 500;">FB </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-4">
                                        <div class="radio-custom radio-primary radio-inline">
                                            <input type="radio" id="social" name="how_did_you_hear_about_junk" value="NA ">
                                            <label style="font-weight: 500;">NA </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row second-step">
                                    <div class=" form-group col-md-4">
                                        <label for="">
                                            <h6> Member referral:</h6>
                                        </label>
                                        <input type="text" class="form-control" id="" name="member_referral"
                                            placeholder="" value="">
                                    </div>
                                    <div class=" form-group col-md-4">
                                        <label for="">
                                            <h6> Influencer referral:</h6>
                                        </label>
                                        <input type="text" class="form-control" id="" name="influencer_referral"
                                            placeholder="" value="">
                                    </div>
                                    <div class=" form-group col-md-4">
                                        <label for="">
                                            <h6> Employee referral:</h6>
                                        </label>
                                        <input type="text" class="form-control" id="" name="employee_referral"
                                            placeholder="" value="">
                                    </div>
                                </div>
                                <p style="    margin: 4rem 0 1rem;" id="second-title"><span> Medical information</span></p>
                                <p style="    margin: 0 0 2rem;" class="third-step t">(Please select one)</p>

                                <div class="row third-step">
                                    <div class="col-lg-4 col-md-6" style="margin-bottom: 1rem;">
                                        <label for="">
                                            <h6> Heart condition:</h6>
                                        </label>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="radio1-1" name="heart_condition" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="radio2-1" name="heart_condition" value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6" style="margin-bottom: 1rem;">


                                        <label for="">
                                            <h6> Seizure disorder:</h6>
                                        </label>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="seizure_disorder" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="seizure_disorder" value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6" style="margin-bottom: 1rem;">
                                        <label for="">
                                            <h6> Dizziness or fainting:</h6>
                                        </label>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="dizziness_or_fainting" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="dizziness_or_fainting"
                                                        value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6" style="margin-bottom: 1rem;">
                                        <label for="">
                                            <h6> Hypertension:</h6>
                                        </label>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="hypertension" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="hypertension" value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6" style="margin-bottom: 1rem;">
                                        <label for="">
                                            <h6> Asthma:</h6>
                                        </label>
                                        <div class="row third-step">
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="asthma" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="asthma" value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row third-step" style="padding-top: 2rem;">
                                    <div class="col-lg-9 col-md-12">
                                        <label>
                                            <h6>Has a healthcare provider ever told you that you should NOT perform
                                                physical activity?
                                            </h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-12 row-radio">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social1" name="h_a_h_p_e_t_y_t_y_s_n_p_a"
                                                        value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social2" name="h_a_h_p_e_t_y_t_y_s_n_p_a"
                                                        value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row third-step">
                                    <div class="col-lg-9 col-md-12">
                                        <label>
                                            <h6>Do you have limitations that can prevent you from physical activity?
                                            </h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-12 row-radio">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social11" name="d_y_h_l_t_c_p_y_f_p_a" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social22" name="d_y_h_l_t_c_p_y_f_p_a"
                                                        value="No d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row third-step">
                                    <div class="col-lg-9 col-md-12">
                                        <label>
                                            <h6>Do you have muscle, tendon ligament, bine or joint problems that are
                                                exasperated by
                                                increased physical activity?
                                            </h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-12 row-radio">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social111"
                                                        name="d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social222"
                                                        name="d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a" value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row third-step">
                                    <div class="col-lg-9 col-md-12">
                                        <label>
                                            <h6>Have you ever suffered from respiratory difficulties?
                                            </h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-12 row-radio">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 ">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social3" name="h_y_e_s_f_r_d" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social4" name="h_y_e_s_f_r_d" value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row third-step">
                                    <div class="col-lg-9 col-md-12">
                                        <label>
                                            <h6>Have you ever suffered from fainting, migraines or loss of balance?
                                            </h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-12 row-radio">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social33" name="h_y_e_s_f_f_m_o_l_o_b" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social44" name="h_y_e_s_f_f_m_o_l_o_b"
                                                        value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row third-step">
                                    <div class="col-lg-9 col-md-12">
                                        <label>
                                            <h6>Do you experience food allergies?
                                            </h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-12 row-radio">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 ">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social5" name="d_y_e_f_a" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6  col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social6" name="d_y_e_f_a" value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row third-step">
                                    <div class="col-12">
                                        <label>
                                            <h6>If you have answered yes to any of the above, please provide a brief
                                                explanation: </h6>
                                        </label>
                                        <textarea type="text" class="form-control" rows="3" name="description"
                                            style="height: auto;min-height: 135px!important;padding: 15px!important; max-height: 70px;margin-top: 15px;"></textarea>
                                    </div>
                                </div>
                                <div class="row row-radio third-step" style="margin-top: 3rem;">
                                    <div class="col-lg-6 col-md-12">
                                        <label>
                                            <h6>Are you currently taking any medications? </h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="a_y_c_t_a_m" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="a_y_c_t_a_m" value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row third-step">
                                    <div class="col-lg-6 col-md-12">
                                        <label>
                                            <h6>Are you currently pregnant: </h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  ">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="a_y_c_p" value=1>
                                                    <label style="font-weight: 500;">Yes </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6  col-6 p-0">
                                                <div class="radio-custom radio-primary radio-inline">
                                                    <input type="radio" id="social" name="a_y_c_p" value="No ">
                                                    <label style="font-weight: 500;">No </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="third-step" style="text-align: left; margin-bottom: 0;">I confirm that all the answers above are
                                    true to the best of my knowledge, and I believe I am able to participate in exercise
                                    at
                                    Junk Fitness Club
                                </p>


                                <div class="text-center send-for ">
                                    <div class="third-step t">
                                        <input type="checkbox" id="" name="agree" required>
                                        <label style=" margin: 2rem 0 1rem; font-weight: 500;color: #fff"> I agree to the JUNK <a
                                                href="" data-toggle="modal" data-target="#exampleModalCenter"
                                                style="color:#fff;">
                                                T&Cs</a></label>
                                    </div>
                                    <div class="arriv-check third-step t">
                                        <input type="checkbox" id="" name="arrival" required>
                                        <label style=" margin: 0 0 3rem; font-weight: 500;color: #fff"> All new guests first <a href=""
                                                data-toggle="modal" data-target="#exampleModalCenter" style="color:#fff;">
                                                T&Cs</a>
                                            needs to be early arrival 30 minutes to properly introduce to class</label>
                                    </div>
                                    <button type="submit" id="s" class="btn btn-send third-step " style="text-transform: uppercase;color: #000!important">
                                        Submit
                                    </button>
                                </div>
                                <div class="text-center pt-4 third-step">

                                    <a href="{{ route('login') }}"
                                        style="text-align: center; color: #000;    font-family: 'Futura'; ">Already a
                                        member? Click here
                                        to go back to
                                        login</a>
                                </div>
                            </div>

                        </form>

                        <div class="row " id="fir">
                             <div class="col-lg-6 col-md-6 col-sm-6 text-left"></div>
                              <div class="col-lg-6 col-md-6 col-sm-12 text-right">
                        <button id="n1" onclick="firstStep()"  class="btn btn-send " style="text-transform: uppercase;color: #000!important">
                                        next
                         </button>
                     </div>
                         </div>
                         <div class="row " id="sec">
                        <div class="col-lg-6 col-md-6 col-6 text-left">
                        
                        <button id="p1" onclick="secondprev()" class="btn btn-send " style="text-transform: uppercase;color: #000!important ;">
                                        prev
                        </button></div>
                        <div class="col-lg-6 col-md-6 col-6 text-right">
                        <button id="n2" onclick="secondnext()" class="btn btn-send" style="text-transform: uppercase;color: #000!important ;">
                                        next
                        </button>
                        </div>
                        </div>
                        <div class="row " id="thir">
                            
                              <div class="col-lg-6 col-md-6 col-sm-6 text-left">
                        <button  onclick="thirdprev()" id="p2" class="btn btn-send " style="text-transform: uppercase;color: #000!important">
                                        prev
                         </button>
                     </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 text-right"></div>
                         </div>
                    </div>
                </div>
            </div>

        </main>

    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="padding-right: 0!important;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-0">
                <div class="modal-body p-4 px-5">


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

                                                <p style="text-align:center; color:#000!important;" class="">
                                                    <strong style="text-align:center; color:#000!important;">JUNK TERMS
                                                        &amp;
                                                        CONDITIONS</strong>
                                                </p>

                                                <p class="" style=" color:#000!important;">“JUNK FITNESS CLUB
                                                    maintains the<a href="{{ route('front-home') }}"
                                                        style="color: #90D242; text-decoration: none; border-bottom: 1px solid #90D242!important;">
                                                        https://www.junk-dubai.com</a> Website
                                                    <strong>(“Site”)</strong>
                                                </p>
                                                <p class="" style=" color:#000!important;">“United Arab of
                                                    Emirates is our country of
                                                    domicile”
                                                    and stipulate that the governing law is the local law. All disputes
                                                    arising in connection
                                                    therewith shall be heard only by a court of competent jurisdiction
                                                    in U.A.E.</p>
                                                <p class="" style=" color:#000!important;">“Visa or
                                                    MasterCard debit and credit cards in AED
                                                    will
                                                    be accepted for payment’’</p>
                                                <p class="" style=" color:#000!important;">“We will not trade
                                                    with or provide any services
                                                    to
                                                    OFAC (Office of Foreign Assets Control) and sanctioned countries in
                                                    accordance with the law
                                                    of
                                                    UAE’’</p>
                                                <p class="" style=" color:#000!important;">“Customer using
                                                    the website who are Minor /under
                                                    the
                                                    age of 18 shall not register as a User of the website and shall not
                                                    transact on or use the
                                                    website’’</p>
                                                <p class="" style=" color:#000!important;">“Cardholder must
                                                    retain a copy of transaction
                                                    records
                                                    and Merchant policies and rules’’</p>
                                                <p class="" style=" color:#000!important;">“User is
                                                    responsible for maintaining the
                                                    confidentiality of his account’’</p>

                                                <p class="" style=" color:#000!important;"><strong>PAYMENT
                                                        CONFIRMATION </strong>
                                                </p>
                                                <p class="" style=" color:#000!important;">Once the payment
                                                    is made, the confirmation notice
                                                    will
                                                    be sent to the client via email within 24 hours of receipt of
                                                    payment. </p>

                                                <p class="" style=" color:#000!important;">
                                                    <strong>CANCELLATION POLICY </strong>
                                                </p>
                                                <p class="" style=" color:#000!important;">Customer can
                                                    cancel their booking within 24
                                                    hours.
                                                </p>

                                                <p class="" style=" color:#000!important;"><strong>REFUND
                                                        POLICY </strong>
                                                </p>
                                                <p class="" style=" color:#000!important;">We don’t refund
                                                    for any of purchases. </p>
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

    <script type="text/javascript">
        function firstStep(){
          // document.getE('first-step').style.display='none';
           var elements = document.getElementsByClassName('first-step')

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'none';
    }
    document.getElementById('fir').style.display='none';
         var elements = document.getElementsByClassName('second-step')

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'flex';
    }
    document.getElementById('sec').style.display='flex';
        }


    function secondnext(){
        document.getElementById('first-title').style.display='none';
       var elements = document.getElementsByClassName('second-step')

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'none';
    }
    document.getElementById('second-title').style.display='block';
         var elements = document.getElementsByClassName('third-step')

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'flex';
    }
         var elements = document.getElementsByClassName('t')

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'block';
    }
    document.getElementById('s').style.display='inline-block';
    document.getElementById('sec').style.display='none';
    document.getElementById('thir').style.display='flex';

        }


     function secondprev(){
       var elements = document.getElementsByClassName('second-step')

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'none';
    }
         var elements = document.getElementsByClassName('first-step')

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'flex';
    }
    document.getElementById('sec').style.display='none';
    document.getElementById('fir').style.display='flex';
        } 



function thirdprev(){
       var elements = document.getElementsByClassName('third-step')

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'none';
    }
         var elements = document.getElementsByClassName('second-step')

    for (var i = 0; i < elements.length; i++){
        elements[i].style.display = 'flex';
    }
    document.getElementById('second-title').style.display='none';
    document.getElementById('first-title').style.display='block';
    document.getElementById('sec').style.display='flex';
    document.getElementById('thir').style.display='none';
        }       
    </script>
@endsection
