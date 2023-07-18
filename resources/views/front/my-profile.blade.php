@extends('layouts.front.base')
@section('pageTitle', 'My Profile')
@section('custom-style')
    <style type="text/css">
        .sidebar .nav-link {
            font-weight: 500;
            color: var(--bs-dark);
        }

        .sidebar .nav-link:hover {
            background: var(--bs-light);
            color: var(--bs-primary);
        }

        .col-lg-9 {

            box-shadow: 1px 1px 4px 0px #afa9a9;
            background-color: #000;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
            padding: 1.5rem;
        }

        .card {
            box-shadow: 1px 1px 4px 0px #afa9a9;
            background-color: #000 !important;
            color: #fff;
        }

        .form-group {
            padding: 1rem;
        }

        input {
            box-shadow: none;
            border: 1px solid #ced4da;
        }

        .Site-inner {
            background-color: #fff;
        }

        .main,
        .row-1 {
            background-color: #000 !important;
            color: #fff;
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

        .info-section .form-reg-box h6 {
            font-size: 16px;
            font-weight: 500;
            color: #424242;
            text-transform: capitalize !important;
            font-family: 'Futura' !important;

        }

        .nav-link {
            font-size: 18px;
            font-weight: 500;
            color: #424242;
            text-transform: capitalize !important;
            font-family: 'Futura' !important;

        }

        .btn-send {
            color: #fff;
            background-color: #8fd241;
            padding: 10px 40px;
        }

        .btn-send:hover {
            background: #90D242;
            box-shadow: none;
        }

        @media (max-width:991px) {
            aside {
                margin-bottom: 2rem;
                padding: 0 !important;
            }
        }

        @media (max-width:575px) {
            aside {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }

            .col-lg-9 {
                box-shadow: none;
                border: none;
            }

            .form-group {
                padding-bottom: 0;
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


        @media screen and (max-width: 991.5px) {
            .arriv-check {
                display: flex;
                align-items: baseline;
            }
        }

    </style>
@endsection
@section('content')
    <div class="container">
        <h1 style="text-transform: uppercase; padding: 3rem 0 0; font-size: 36px;">my profile</h1>
        @auth
            @if (Auth::user()->hasfrozenpackages())
                <div class="col-md-4 pl-0" style="color: rgb(248, 3, 3)">
                    <b> Current balance: &nbsp;</b> {{ Auth::user()->gettotalbalance() }} / &nbsp;
                    <b>Booked:&nbsp;</b>{{ Auth::user()->getbookedbalance() }}
                </div>
            @else
                <div class="col-md-4 pl-0" style="color: white">
                    <b> Current balance: &nbsp;</b> {{ Auth::user()->gettotalbalance() }} / &nbsp;
                    <b>Booked:&nbsp;</b>{{ Auth::user()->getbookedbalance() }}
                </div>
            @endif
        @endauth
        <section class="section-content pt-3 pb-5">
            <div class="row">
                <aside class="col-lg-3 col-md-12 col-sm-12 row-radio">
                    <!-- ============= COMPONENT ============== -->
                    <nav class="sidebar card py-2">
                        <ul class="nav flex-column">
                            @if ($profiletype == 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('my-profile') }}"> <b> personal information
                                        </b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_payments') }}"> purchase
                                        history </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_current_user_sessions') }}">
                                        Sessions </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_previous_user_sessions') }}">
                                        Sessions history </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_packages') }}">
                                        Packages </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_fees') }}">
                                        Fees </a>
                                </li>
                            @elseif ($profiletype == 2)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('my-profile') }}"> personal information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_payments') }}"> <b>
                                            purchase history</b> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_current_user_sessions') }}">
                                        Sessions </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_previous_user_sessions') }}">
                                        Sessions history </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_packages') }}">
                                        Packages </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_fees') }}">
                                        Fees </a>
                                </li>
                            @elseif ($profiletype == 3)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('my-profile') }}"> personal information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_payments') }}">
                                        purchase history </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_current_user_sessions') }}"> <b>
                                            Sessions</b> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_previous_user_sessions') }}">
                                        Sessions history </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_packages') }}">
                                        Packages </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_fees') }}">
                                        Fees </a>
                                </li>
                            @elseif ($profiletype == 4)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('my-profile') }}"> personal information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_payments') }}">
                                        purchase history </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_current_user_sessions') }}">
                                        Sessions </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_previous_user_sessions') }}">
                                        <b> Sessions history </b> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_packages') }}">
                                        Packages </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_fees') }}">
                                        Fees </a>
                                </li>
                            @elseif ($profiletype == 5)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('my-profile') }}"> personal information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_payments') }}">
                                        purchase history </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_current_user_sessions') }}">
                                        Sessions </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_previous_user_sessions') }}">
                                        <b> Sessions history </b> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_packages') }}">
                                        <b>Packages</b> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_fees') }}">
                                        Fees </a>
                                </li>
                            @elseif ($profiletype == 6)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('my-profile') }}"> personal information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_payments') }}">
                                        purchase history </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_current_user_sessions') }}">
                                        Sessions </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_previous_user_sessions') }}">
                                        Sessions history </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_packages') }}">
                                        <b>Packages</b> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('web_get_user_fees') }}">
                                        <b>Fees</b> </a>
                                </li>
                            @endif
                            {{-- <li class="nav-item"> --}}
                            {{-- <a class="nav-link" href="#"> Other link </a> --}}
                            {{-- </li> --}}
                        </ul>
                    </nav>
                    <!-- ============= COMPONENT END// ============== -->
                </aside>

                @if ($profiletype == 1)
                    <main class="col-lg-9 col-md-12 col-sm-12 row-radio  row-1">
                        <div class="info-section">
                            <h1 style="font-family: 'Futura';text-transform: capitalize;"> personal information</h1>
                            <div class="reg-content">
                                <div class="container">
                                    <form action="{{ route('web_user_info_update', $user->id) }}" method="POST">
                                        @csrf
                                        {{-- @method('PUT') --}}
                                        <div class="form-reg-box">
                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label for="f-name">
                                                        <h6> Name: </h6>
                                                    </label>
                                                    <input type="text" name="name" value="{{ $user->username() }}"
                                                        class="form-control" required />
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label for="email">
                                                        <h6>Email Address: </h6>
                                                    </label>
                                                    <input type="email" name="email" value="{{ $user->email }}" readonly
                                                        class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label for="f-name" class="required">
                                                        <h6>Contact Number:*</h6>
                                                    </label>
                                                    <input type="text" class="form-control" name="phone" placeholder=""
                                                        value="{{ $user->phone }}" required=""
                                                        onkeypress="return AllowOnlyNumbers(event);">
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label for="f-name" class="required">
                                                        <h6>WhatsApp Number:*</h6>
                                                    </label>
                                                    <input type="text" class="form-control" name="whats_app_phone"
                                                        placeholder="" value="{{ $user->whats_app_phone }}" required=""
                                                        onkeypress="return AllowOnlyNumbers(event);">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class=" col-lg-6 col-md-12 col-12">
                                                    <label for="birthday">
                                                        <h6>Date of Birth:*</h6>
                                                    </label>
                                                    <input type="date" id="birthday" name="dob" class="form-control"
                                                        value="{{ $user->dob }}">
                                                </div>
                                            </div>

                                            <div class="row"
                                                style="    align-items: center; padding: 2rem 0 0;">
                                                <div class="form-group col-lg-2 col-md-12 col-12">
                                                    <label for="">
                                                        <h6>Gender: </h6>
                                                    </label>
                                                </div>
                                                <div class="form-group col-lg-2  col-md-6 col-6 text-center">
                                                    <div class="radio-custom radio-primary radio-inline">
                                                        <input type="radio" id="gender" name="gender" value="1"
                                                            {{ $user->gender == 1 ? 'checked' : null }}>
                                                        <label style="font-weight: 500;">Male</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-2  col-md-6 col-6 female-co">
                                                    <div class="radio-custom radio-primary radio-inline">
                                                        <input type="radio" id="gender" name="gender" value="2"
                                                            {{ $user->gender == 2 ? 'checked' : null }}>
                                                        <label style="font-weight: 500;">Female</label>

                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-6 col-md-12 col-12">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-12">
                                                            <label for="">
                                                                <h6> Height: </h6>
                                                            </label>
                                                            <input type="text" name="height" value="{{ $user->height }}"
                                                                class="form-control"
                                                                onkeypress="return AllowOnlyNumbers(event);">
                                                        </div>
                                                        <div class="form-group col-md-6 col-12">
                                                            <label for="">
                                                                <h6> Weight: </h6>
                                                            </label>
                                                            <input type="text" name="weight" value="{{ $user->weight }}"
                                                                class="form-control"
                                                                onkeypress="return AllowOnlyNumbers(event);">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6 col-12">
                                                    <label for="emergency_name">
                                                        <h6>Emergency Contact Name:</h6>
                                                    </label>
                                                    <input type="text" class="form-control" id="emergency_name"
                                                        name="emergency_contact_name" placeholder=""
                                                        value="{{ $user->emergency_contact_name }}">
                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label for="emergency_phone">
                                                        <h6> Emergency Contact Number: </h6>
                                                    </label>
                                                    <input type="text" class="form-control" id="emergency_phone"
                                                        name="emergency_contact_number" placeholder=""
                                                        value="{{ $user->emergency_contact_number }}"
                                                        onkeypress="return AllowOnlyNumbers(event);">
                                                </div>
                                            </div>

                                            <div class="row" style="padding: 2rem 0;">
                                                <div class="col-lg-6 col-md-6">
                                                    <label>
                                                        <h6>How did you hear about JUNK?</h6>
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="radio-custom radio-primary radio-inline">
                                                        <input type="radio" id="social" name="how_did_you_hear_about_junk"
                                                            value="IG"
                                                            {{ $user->userinfo != null ? ($user->userinfo->how_did_you_hear_about_junk == 'IG' ? 'checked' : null) : null }}>
                                                        <label style="font-weight: 500;">IG </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="radio-custom radio-primary radio-inline">
                                                        <input type="radio" id="social" name="how_did_you_hear_about_junk"
                                                            value="FB "
                                                            {{ $user->userinfo != null ? ($user->userinfo->how_did_you_hear_about_junk == 'FB' ? 'checked' : null) : null }}>
                                                        <label style="font-weight: 500;">FB </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="radio-custom radio-primary radio-inline">
                                                        <input type="radio" id="social" name="how_did_you_hear_about_junk"
                                                            value="NA "
                                                            {{ $user->userinfo != null ? ($user->userinfo->how_did_you_hear_about_junk == 'NA' ? 'checked' : null) : null }}>
                                                        <label style="font-weight: 500;">NA </label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class=" form-group col-md-4">
                                                    <label for="">
                                                        <h6> Member referral:</h6>
                                                    </label>
                                                    <input type="text" class="form-control" id="" name="member_referral"
                                                        placeholder=""
                                                        value="{{ $user->userinfo != null ? $user->userinfo->member_referral : null }}">
                                                </div>
                                                <div class=" form-group col-md-4">
                                                    <label for="">
                                                        <h6> Influencer referral:</h6>
                                                    </label>
                                                    <input type="text" class="form-control" id=""
                                                        name="influencer_referral" placeholder=""
                                                        value="{{ $user->userinfo != null ? $user->userinfo->influencer_referral : null }}">
                                                </div>
                                                <div class=" form-group col-md-4">
                                                    <label for="">
                                                        <h6> Employee referral:</h6>
                                                    </label>
                                                    <input type="text" class="form-control" id=""
                                                        name="employee_referral" placeholder=""
                                                        value="{{ $user->userinfo != null ? $user->userinfo->employee_referral : null }}">
                                                </div>
                                            </div>

                                            <div class="form-group">

                                                <div class="text-center">
                                                    <p style="    margin: 4rem 0 1rem;"><span
                                                            style="font-weight: 600;font-size: 18px;padding:5px 12px ;border-radius: 0.3em;background: #fff!important;color: #000!important;">
                                                            Medical information</span></p>
                                                    <p style="    margin: 0 0 2rem;">(Please select one)</p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-6" style="margin-bottom: 1rem;">
                                                        <label for="">
                                                            <h6> Heart condition:</h6>
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="radio1-1" name="heart_condition"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->heart_condition == 1 ? 'checked' : null) : null }}
                                                                        value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="radio2-1" name="heart_condition"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->heart_condition == 0 ? 'checked' : null) : null }}
                                                                        value=0>
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
                                                                    <input type="radio" id="social" name="seizure_disorder"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->seizure_disorder == 1 ? 'checked' : null) : null }}
                                                                        value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social" name="seizure_disorder"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->seizure_disorder != 1 ? 'checked' : null) : null }}
                                                                        value=0>
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
                                                                    <input type="radio" id="social"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->dizziness_or_fainting == 1 ? 'checked' : null) : null }}
                                                                        name="dizziness_or_fainting" value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->dizziness_or_fainting != 1 ? 'checked' : null) : null }}
                                                                        name="dizziness_or_fainting" value=0>
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
                                                                    <input type="radio" id="social" name="hypertension"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->hypertension == 1 ? 'checked' : null) : null }}
                                                                        value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social" name="hypertension"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->hypertension != 1 ? 'checked' : null) : null }}
                                                                        value=0>
                                                                    <label style="font-weight: 500;">No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6" style="margin-bottom: 1rem;">
                                                        <label for="">
                                                            <h6> Asthma:</h6>
                                                        </label>
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social" name="asthma"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->asthma == 1 ? 'checked' : null) : null }}
                                                                        value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social" name="asthma"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->asthma != 1 ? 'checked' : null) : null }}
                                                                        value=0>
                                                                    <label style="font-weight: 500;">No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row" style="padding-top: 2rem;">
                                                    <div class="col-lg-8 col-md-12">
                                                        <label>
                                                            <h6>Has a healthcare provider ever told you that you should NOT
                                                                perform
                                                                physical activity?
                                                            </h6>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 row-radio">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social1"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->h_a_h_p_e_t_y_t_y_s_n_p_a == 1 ? 'checked' : null) : null }}
                                                                        name="h_a_h_p_e_t_y_t_y_s_n_p_a" value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social2"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->h_a_h_p_e_t_y_t_y_s_n_p_a != 1 ? 'checked' : null) : null }}
                                                                        name="h_a_h_p_e_t_y_t_y_s_n_p_a" value=0>
                                                                    <label style="font-weight: 500;">No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12">
                                                        <label>
                                                            <h6>Do you have limitations that can prevent you from physical
                                                                activity?
                                                            </h6>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 row-radio">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social11"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->d_y_h_l_t_c_p_y_f_p_a == 1 ? 'checked' : null) : null }}
                                                                        name="d_y_h_l_t_c_p_y_f_p_a" value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social22"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->d_y_h_l_t_c_p_y_f_p_a != 1 ? 'checked' : null) : null }}
                                                                        name="d_y_h_l_t_c_p_y_f_p_a" value=0>
                                                                    <label style="font-weight: 500;">No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12">
                                                        <label>
                                                            <h6>Do you have muscle, tendon ligament, bine or joint problems
                                                                that are
                                                                exasperated by
                                                                increased physical activity?
                                                            </h6>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 row-radio">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social111"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a == 1 ? 'checked' : null) : null }}
                                                                        name="d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a" value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social222"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a != 1 ? 'checked' : null) : null }}
                                                                        name="d_y_h_m_t_l_b_o_j_p_t_a_e_b_i_p_a" value=0>
                                                                    <label style="font-weight: 500;">No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12">
                                                        <label>
                                                            <h6>Have you ever suffered from respiratory difficulties?
                                                            </h6>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 row-radio">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 ">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social3" name="h_y_e_s_f_r_d"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->h_y_e_s_f_r_d == 1 ? 'checked' : null) : null }}
                                                                        value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social4" name="h_y_e_s_f_r_d"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->h_y_e_s_f_r_d != 1 ? 'checked' : null) : null }}
                                                                        value=0>
                                                                    <label style="font-weight: 500;">No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12">
                                                        <label>
                                                            <h6>Have you ever suffered from fainting, migraines or loss of
                                                                balance?
                                                            </h6>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 row-radio">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social33"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->h_y_e_s_f_f_m_o_l_o_b == 1 ? 'checked' : null) : null }}
                                                                        name="h_y_e_s_f_f_m_o_l_o_b" value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social44"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->h_y_e_s_f_f_m_o_l_o_b != 1 ? 'checked' : null) : null }}
                                                                        name="h_y_e_s_f_f_m_o_l_o_b" value=0>
                                                                    <label style="font-weight: 500;">No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-12">
                                                        <label>
                                                            <h6>Do you experience food allergies?
                                                            </h6>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 row-radio">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 ">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social5" name="d_y_e_f_a"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->d_y_e_f_a == 1 ? 'checked' : null) : null }}
                                                                        value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6  col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social6" name="d_y_e_f_a"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->d_y_e_f_a != 1 ? 'checked' : null) : null }}
                                                                        value=0>
                                                                    <label style="font-weight: 500;">No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label style="margin-top: 3rem">
                                                            <h6>If you have answered yes to any of the above, please provide
                                                                a brief
                                                                explanation: </h6>
                                                        </label>
                                                        <textarea type="text" class="form-control" rows="3"
                                                            name="description"
                                                            style="height: auto;min-height: 135px!important;padding: 15px!important; max-height: 70px;margin-top: 15px;">
                                                                                        {{ $user->userinfo != null ? $user->userinfo->description : null }}
                                                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="row row-radio" style="margin-top: 3rem;">
                                                    <div class="col-lg-6 col-md-12">
                                                        <label>
                                                            <h6>Are you currently taking any medications? </h6>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social" name="a_y_c_t_a_m"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->a_y_c_t_a_m == 1 ? 'checked' : null) : null }}
                                                                        value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social" name="a_y_c_t_a_m"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->a_y_c_t_a_m != 1 ? 'checked' : null) : null }}
                                                                        value=0>
                                                                    <label style="font-weight: 500;">No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">
                                                        <label>
                                                            <h6>Are you currently pregnant: </h6>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-6  ">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social" name="a_y_c_p"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->a_y_c_p == 1 ? 'checked' : null) : null }}
                                                                        value=1>
                                                                    <label style="font-weight: 500;">Yes </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6  col-6 p-0">
                                                                <div class="radio-custom radio-primary radio-inline">
                                                                    <input type="radio" id="social" name="a_y_c_p"
                                                                        {{ $user->userinfo != null ? ($user->userinfo->a_y_c_p != 1 ? 'checked' : null) : null }}
                                                                        value=0>
                                                                    <label style="font-weight: 500;">No </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-check col-md-6 col-12"
                                                    style="padding: 1rem;margin-left: 1rem">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="chkPassword" onchange="valueChanged()">
                                                    <label class="form-check-label" for="chkPassword">
                                                        <h6>Update Password</h6>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="row" id="dvpassword" style="display: none">
                                                <div class="form-group col-md-6 col-12">
                                                    <label type="checkbox" for="password">
                                                        <h6>Password: </h6>
                                                    </label>
                                                    <input type="password" name="password" class="form-control" />

                                                </div>
                                                <div class="form-group col-md-6 col-12">
                                                    <label for="password_confirmation">
                                                        <h6>Password Confirm:
                                                        </h6>
                                                    </label>
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control" />
                                                </div>
                                            </div>

                                            <center>
                                                <button type="submit" class="btn btn-send"
                                                    style="text-transform: uppercase;">
                                                    Update
                                                </button>
                                            </center>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                @elseif ($profiletype == 2)
                    <main class="col-lg-9 col-md-12 col-sm-12 row-radio">
                        <div class="purchase-section">
                            <h1 style="text-transform: uppercase;"> purchase history</h1>
                            <div class="reg-content">
                                <table class="table  table-bordered table-calander">
                                    <thead>
                                        <!-- days -->
                                        <tr>
                                            <th>Order id </th>
                                            <th>Order type </th>
                                            <th>Order cost </th>
                                            <th>Currency </th>
                                            <th>Order date </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- // id, package_id, member_id, , transaction_id, , , status, , updated_at, package_member_id, --}}
                                        @foreach ($payments as $payment)
                                            <!-- row 1 -->
                                            <tr>
                                                <td>
                                                    <p> {{ $payment->order_id }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $payment->order_type }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $payment->cost }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $payment->currency }} </p>
                                                </td>

                                                <td>
                                                    <p> {{ $payment->created_at }} </p>
                                                </td>
                                            </tr>
                                            <!-- end row 1 -->
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="row ml-1">
                                    <b> Total:</b> &nbsp; {{ $total }} {{ $currency }}
                                </div>
                            </div>
                        </div>


                    </main>
                @elseif ($profiletype == 3)
                    <main class="col-lg-9 col-md-12 col-sm-12 row-radio">
                        <div class="purchase-section">
                            <h1 style="text-transform: uppercase;"> Sessions</h1>
                            <div class="reg-content">
                                <div class="card-body">
                                    <table class="table  table-bordered table-calander">
                                        <thead>
                                            <!-- days -->
                                            <tr>
                                                <th>Class name </th>
                                                <th>Start time </th>
                                                <th>End time</th>
                                                <th>Day name</th>
                                                <th>Open date </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessions as $session)
                                                <!-- row 1 -->
                                                <tr>
                                                    <td>
                                                        <p> {{ $session->name }} </p>
                                                    </td>
                                                    <td>
                                                        <p> {{ $session->start_time }} </p>
                                                    </td>
                                                    <td>
                                                        <p> {{ $session->end_time }} </p>
                                                    </td>

                                                    <td>
                                                        <p> {{ $session->day_name }} </p>
                                                    </td>

                                                    <td>
                                                        <p> {{ $session->bookdate }} </p>
                                                    </td>
                                                </tr>
                                                <!-- end row 1 -->
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </main>
                @elseif ($profiletype == 4)
                    <main class="col-lg-9 col-md-12 col-sm-12 row-radio">
                        <div class="purchase-section">
                            <h1 style="text-transform: uppercase;"> Sessions history</h1>
                            <div class="reg-content">
                                <div class="card-body">
                                    <table class="table  table-bordered table-calander">
                                        <thead>
                                            <!-- days -->
                                            <tr>
                                                <th>Class name </th>
                                                <th>Start time </th>
                                                <th>End time</th>
                                                <th>Day name</th>
                                                <th>Open date </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessions as $session)
                                                <!-- row 1 -->
                                                <tr>
                                                    <td>
                                                        <p> {{ $session->name }} </p>
                                                    </td>
                                                    <td>
                                                        <p> {{ $session->start_time }} </p>
                                                    </td>
                                                    <td>
                                                        <p> {{ $session->end_time }} </p>
                                                    </td>

                                                    <td>
                                                        <p> {{ $session->day_name }} </p>
                                                    </td>

                                                    <td>
                                                        <p> {{ $session->bookdate }} </p>
                                                    </td>
                                                </tr>
                                                <!-- end row 1 -->
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </main>
                @elseif ($profiletype == 5)
                    <main class="col-lg-9 col-md-12 col-sm-12 row-radio">
                        <div class="purchase-section">
                            <h1 style="text-transform: uppercase;"> Packages</h1>
                            <div class="reg-content">
                                <table class="table  table-bordered table-calander">
                                    <thead>
                                        <!-- days -->
                                        <tr>
                                            <th>Package name </th>
                                            <th>Package cost </th>
                                            <th>Currency </th>
                                            <th>Payment date </th>
                                            <th>Status </th>
                                            <th>Freeze </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <!-- row 1 -->
                                            <tr>
                                                <td>
                                                    <p> {{ $payment['name'] }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $payment['cost'] }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $payment['currency'] }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $payment['payment_date'] }} </p>
                                                </td>
                                                <td>
                                                    @if ($payment['status'] === 'frozen')
                                                        <p> {{ $payment['status'] }} <br>
                                                            <small>{{ $payment['frozen_end_date'] }}</small>
                                                        </p>
                                                    @else
                                                        <p> {{ $payment['status'] }} <br>
                                                            <small>{{ $payment['valid_till'] }}</small>
                                                        </p>

                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($payment['status'] != 'frozen')
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <form method="post"
                                                                    action="{{ route('fpayWithCcav') }}">
                                                                    @csrf
                                                                    <input type="text" name="id"
                                                                        value="{{ $payment['package_member_id'] }}"
                                                                        hidden>
                                                                    <input type="text" name="value" value="1" hidden>
                                                                    <button class="btn btn-success btn-sm" type="submit">1
                                                                        M</button>
                                                                </form>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <form method="post"
                                                                    action="{{ route('fpayWithCcav') }}">
                                                                    @csrf
                                                                    <input type="text" name="id"
                                                                        value="{{ $payment['package_member_id'] }}"
                                                                        hidden>
                                                                    <input type="text" name="value" value="2" hidden>
                                                                    <button class="btn btn-success btn-sm" type="submit">2
                                                                        M</button>
                                                                </form>

                                                            </div>


                                                        </div>

                                                    @endif


                                                    {{-- <a
                                                                href="{{ route('fpayWithCcav', ['id' => $payment->package_member_id, 'value' => 1]) }}">1 month</a>
                                                            <a href="{{ route('fpayWithCcav', ['id' => $payment->package_member_id, 'value' => 2]) }}">2 month</a> --}}
                                                </td>
                                            </tr>
                                            <!-- end row 1 -->
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </main>
                @elseif ($profiletype == 6)
                    <main class="col-lg-9 col-md-12 col-sm-12 row-radio">
                        <div class="purchase-section">
                            <h1 style="text-transform: uppercase;"> Fees</h1>
                            <div class="reg-content">
                                <table class="table  table-bordered table-calander">
                                    <thead>
                                        <!-- days -->
                                        <tr>
                                            <th>Fee type</th>
                                            <th>Fee amount</th>
                                            <th>Currency</th>
                                            <th>Description</th>
                                            <th>Fee date</th>
                                            <th>Status</th>
                                            <th>Pay</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fees as $fee)
                                            <!-- row 1 -->
                                            <tr>
                                                <td>
                                                    <p> {{ $fee->fee_type }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $fee->fee_amount }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $fee->fee_amount_type }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $fee->description }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $fee->created_at->toDateString() }} </p>
                                                </td>
                                                <td>
                                                    <p> {{ $fee->fee_status }} </p>
                                                </td>
                                                <td>
                                                    @if ($fee->fee_status != 'paid')
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <form method="post"
                                                                    action="{{ route('feepayWithCcav') }}">
                                                                    @csrf
                                                                    <input type="text" name="id"
                                                                        value="{{ $fee->id }}" hidden>
                                                                    <button class="btn btn-success btn-sm"
                                                                        type="submit">pay</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div> {{ $fee->paid_at }} </div>
                                                    @endif


                                                    {{-- <a
                                                        href="{{ route('fpayWithCcav', ['id' => $payment->package_member_id, 'value' => 1]) }}">1 month</a>
                                                    <a href="{{ route('fpayWithCcav', ['id' => $payment->package_member_id, 'value' => 2]) }}">2 month</a> --}}
                                                </td>
                                            </tr>
                                            <!-- end row 1 -->
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </main>
                @endif
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
    </section>

    {{-- </div><!-- container //  --> --}}


    <script type="text/javascript">
        function valueChanged() {

            if ($('#chkPassword').is(":checked"))
                $("#dvpassword").show();
            else
                $("#dvpassword").hide();
        }
    </script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    {{-- </div> --}}
@endsection
