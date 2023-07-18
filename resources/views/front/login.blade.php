@extends('layouts.front.base')
@section('pageTitle', 'Login')
@section('custom-style')
    <style>
        a:hover {
            text-decoration: none;
            color: #fff;
        }

        .login-btn {
            background: #000;

            color: #fff;
            width: 100%;
            font-size: 20px;
            padding: 10px;
            box-shadow: none;
            margin: 1rem 0;
            box-shadow: none !important;

            font-family: 'Futura';
        }

        label {
            font-size: 16px;
            font-weight: 500;
            color: #424242;
        }

        .card-header {
            font-size: 20px;
            font-weight: 600;
        }

        .Main {
            padding: 4rem 0;
        }

        .login-btn:hover {
            background: #90d242 !important;
            color: #fff !important;

        }

        .card-body input {
            box-shadow: none !important;
            border: 1px solid #ced4da !important;
        }

        .forget a {
            color: #000;
            text-decoration: none;
        }

        .btn-new {
            background: #000;
            color: #fff;
            width: 100%;
            font-size: 20px;
            padding: 10px;
            box-shadow: none;
            margin: 1rem 0;
            box-shadow: none !important;
        }

        .btn-new:hover {
            background: #90d242 !important;
            color: #fff !important;
            text-decoration: none;
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
@endsection
@section('content')
    <div class="Content-outer">
        <main class="Main Main--page">
            <div class="container">
                <div class="row">
                    <div class=" col-lg-3 col-md-2 col-xs-12"></div>
                    <div class=" col-lg-6 col-md-8 col-xs-12">
                        <div class="card text-center" style="    box-shadow: 0 2px 8px 1px rgb(0 0 0 / 20%);">
                            <div class="card-header">
                                Sign in
                            </div>
                            <div class="card-body">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
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
                                        <!-- <div class="col form-group form-check ml-2">
                                                          <input class="form-check-input" type="checkbox" id="remember_me" name="_remember_me"
                                                            checked />
                                                          <label class="form-check-label" for="remember_me"><small>Remember me</small></label>
                                                        </div> -->
                                        <div class="col forget" style="text-align: right;">
                                            <a href="/reset-password"><small>Forgot Password?</small></a>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn  login-btn"
                                        style="text-transform: uppercase; color: #fff;">
                                        Login
                                    </button>
                                </form>
                                <div class="">
                                    <div class=" card-fo pt-3">
                                        <small style="    font-family: 'Futura';">Don't have an account with us? Please
                                            signup here:</small>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>
    </div>
@endsection
