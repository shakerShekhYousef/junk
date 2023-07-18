@extends('layouts.dashboard.base')
@section('pageTitle', 'Coach-' . $user->username())
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile. {{ $user->username() }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('web_show_coach', $user->id) }}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Coach {{ $user->username() }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="showUser">
                                @csrf
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input readonly value="{{ $user->email }}" type="email" name="email"
                                                class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName2">First name</label>
                                            <input readonly value="{{ $user->fname }}" type="text" name="fname"
                                                class="form-control" id="exampleInputName2"
                                                placeholder="Enter First Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName3">Last name</label>
                                            <input readonly value="{{ $user->lname }}" type="text" name="lname"
                                                class="form-control" id="exampleInputName3" placeholder="Enter Last Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputRole4">Gender</label>
                                            <select name="gender" class="form-control" id="exampleInputRole4">
                                                @if ($user->gender == 1)
                                                    <option value="1">Male</option>
                                                @elseif ($user->gender == 2)
                                                    <option value="2">Female</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName5">Screen name</label>
                                            <input readonly value="{{ $user->screen_name }}" type="text"
                                                name="screen_name" class="form-control" id="exampleInputName5"
                                                placeholder="Enter Screen Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputDob6">Birthday</label>
                                            <input readonly value="{{ $user->dob }}" type="date" name="dob"
                                                class="form-control" id="exampleInputDob6" placeholder="Enter Birthday">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName7">Height</label>
                                            <input readonly value="{{ $user->height }}" type="number" name="height"
                                                class="form-control" id="exampleInputName7" placeholder="Enter Height">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName8">Weight</label>
                                            <input readonly value="{{ $user->weight }}" type="number" name="weight"
                                                class="form-control" id="exampleInputName8" placeholder="Enter Weight">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputAddress9">Address1</label>
                                            <input readonly value="{{ $user->address1 }}" type="text" name="address1"
                                                class="form-control" id="exampleInputAddress9"
                                                placeholder="Enter Address1">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputAddress10">Address2</label>
                                            <input readonly value="{{ $user->address2 }}" type="text" name="address2"
                                                class="form-control" id="exampleInputAddress10"
                                                placeholder="Enter Address2">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputCity11">City</label>
                                            <input readonly value="{{ $user->city }}" type="text" name="city"
                                                class="form-control" id="exampleInputCity11" placeholder="Enter City">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputState12">State</label>
                                            <input readonly value="{{ $user->state }}" type="text" name="state"
                                                class="form-control" id="exampleInputState12" placeholder="Enter State">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPostal13">Zip Code</label>
                                            <input readonly value="{{ $user->zip_code }}" type="text" name="zip_code"
                                                class="form-control" id="exampleInputPostal13"
                                                placeholder="Enter Zip Code">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputCountry14">Country</label>
                                            <input readonly value="{{ $user->country }}" type="text" name="country"
                                                class="form-control" id="exampleInputCountry14"
                                                placeholder="Enter Country">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPhone15">Phone</label>
                                            <input readonly value="{{ $user->phone }}" type="text" name="phone"
                                                class="form-control" id="exampleInputPhone15"
                                                placeholder="Enter phone number">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPhone16">whats App Phone</label>
                                            <input readonly value="{{ $user->whats_app_phone }}" type="text"
                                                name="whats_app_phone" class="form-control" id="exampleInputPhone16"
                                                placeholder="Enter whats app phone number">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputRole17">Select Referred By</label>
                                            <select name="referred_by" class="form-control" id="exampleInputRole17">
                                                @if ($user->referred_by == 'Cirque Du Soleil')
                                                    <option value="Cirque Du Soleil">Cirque Du Soleil</option>
                                                @elseif ($user->referred_by == "Classpass")
                                                    <option value="Classpass">Classpass</option>
                                                @elseif($user->referred_by == "Flyer")
                                                    <option value="Flyer">Flyer</option>
                                                @elseif($user->referred_by == "Internet")
                                                    <option value="Internet">Internet</option>
                                                @elseif($user->referred_by == "Radio")
                                                    <option value="Radio">Radio</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputCountry18">Emergency Contact Name</label>
                                            <input readonly value="{{ $user->emergency_contact_name }}" type="text"
                                                name="emergency_contact_name" class="form-control"
                                                id="exampleInputCountry18" placeholder="Enter Emergency Contact Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputCountry19">Emergency Contact Number</label>
                                            <input readonly value="{{ $user->emergency_contact_number }}" type="text"
                                                name="emergency_contact_number" class="form-control"
                                                id="exampleInputCountry19" placeholder="Enter Emergency Contact Number">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputCountry20">Emergency Contact Relationship</label>
                                            <input readonly value="{{ $user->emergency_contact_relation }}" type="text"
                                                name="emergency_contact_relation" class="form-control"
                                                id="exampleInputCountry20"
                                                placeholder="Enter Emergency Contact Relationship">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
