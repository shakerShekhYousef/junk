@extends('layouts.dashboard.base')
@section('pageTitle', 'Create new user')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create new user</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('users.create') }}
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
                                <h3 class="card-title">Create new user</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="createUser" action="{{ route('users.store') }}" method="post">
                                @csrf
                                @method("POST")
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName2">First name</label>
                                        <input value="{{ old('fname') }}" type="text" name="fname" class="form-control"
                                            id="exampleInputName2" placeholder="Enter First Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName3">Last name</label>
                                        <input value="{{ old('lname') }}" type="text" name="lname" class="form-control"
                                            id="exampleInputName3" placeholder="Enter Last Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputRole4">Gender</label>
                                        <select name="gender" class="form-control" id="exampleInputRole4">
                                            <option selected disabled>Please Select Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName5">Screen name</label>
                                        <input value="{{ old('screen_name') }}" type="text" name="screen_name"
                                            class="form-control" id="exampleInputName5" placeholder="Enter Screen Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputDob6">Birthday</label>
                                        <input type="date" name="dob" class="form-control" id="exampleInputDob6"
                                            placeholder="Enter Birthday">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName7">Height</label>
                                        <input value="{{ old('height') }}" type="number" name="height"
                                            class="form-control" id="exampleInputName7" placeholder="Enter Height">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName8">Weight</label>
                                        <input value="{{ old('weight') }}" type="number" name="weight"
                                            class="form-control" id="exampleInputName8" placeholder="Enter Weight">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputAddress9">Address1</label>
                                        <input value="{{ old('address1') }}" type="text" name="address1"
                                            class="form-control" id="exampleInputAddress9" placeholder="Enter Address1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputAddress10">Address2</label>
                                        <input value="{{ old('address2') }}" type="text" name="address2"
                                            class="form-control" id="exampleInputAddress10" placeholder="Enter Address2">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCity11">City</label>
                                        <input type="text" name="city" class="form-control" id="exampleInputCity11"
                                            placeholder="Enter City">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputState12">State</label>
                                        <input type="text" name="state" class="form-control" id="exampleInputState12"
                                            placeholder="Enter State">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPostal13">Zip Code</label>
                                        <input type="text" name="zip_code" class="form-control" id="exampleInputPostal13"
                                            placeholder="Enter Zip Code">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCountry14">Country</label>
                                        <input type="text" name="country" class="form-control" id="exampleInputCountry14"
                                            placeholder="Enter Country">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPhone15">Phone</label>
                                        <input value="{{ old('phone') }}" type="text" name="phone" class="form-control"
                                            id="exampleInputPhone15" placeholder="Enter phone number">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPhone16">whats App Phone</label>
                                        <input value="{{ old('whats_app_phone') }}" type="text" name="whats_app_phone"
                                            class="form-control" id="exampleInputPhone16"
                                            placeholder="Enter whats app phone number">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputRole17">Select Referred By</label>
                                        <select name="referred_by" class="form-control" id="exampleInputRole17">
                                            <option selected disabled>Please Referred By</option>
                                            <option value="Another Client" selected="">Another Client</option>
                                            <option value="Cirque Du Soleil">Cirque Du Soleil</option>
                                            <option value="Classpass">Classpass</option>
                                            <option value="Flyer">Flyer</option>
                                            <option value="Internet">Internet</option>
                                            <option value="Radio">Radio</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCountry18">Emergency Contact Name</label>
                                        <input type="text" name="emergency_contact_name" class="form-control" id="exampleInputCountry18"
                                            placeholder="Enter Emergency Contact Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCountry19">Emergency Contact Number</label>
                                        <input type="text" name="emergency_contact_number" class="form-control" id="exampleInputCountry19"
                                            placeholder="Enter Emergency Contact Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCountry20">Emergency Contact Relationship</label>
                                        <input type="text" name="emergency_contact_relation" class="form-control" id="exampleInputCountry20"
                                            placeholder="Enter Emergency Contact Relationship">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputRole1">Select Role</label>
                                        <select name="role_id" class="form-control" id="exampleInputRole1">
                                            <option selected disabled>Please Select Role</option>
                                            <option value="1">Gym Manager</option>
                                            <option value="2">Sales Team</option>
                                            {{-- <option value="3">Coach</option> --}}
                                            <option value="4">Member</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPasswordConfirmation1">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="exampleInputPasswordConfirmation1" placeholder="Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
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
@section('custom-script')
    <script>
        $(function() {
            $('#createUser').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 5,
                        equalTo: "#exampleInputPassword1"
                    },

                },
                messages: {
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    password_confirmation: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Password and Password Confirmation must be match"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
@endsection
