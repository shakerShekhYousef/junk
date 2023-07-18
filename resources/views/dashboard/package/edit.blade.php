@extends('layouts.dashboard.base')
@section('pageTitle', 'Edit Membership Bio | ' . $package->name)
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Membership Bio | {{ $package->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('packages.edit', $package->id) }}
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
                                <h3 class="card-title">Edit Membership Bio | {{ $package->name }}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="createUser" action="{{ route('packages.update', $package->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Name</label>
                                        <input value="{{ $package->name }}" type="text" name="name" class="form-control"
                                            id="exampleInputName1" placeholder="Enter name">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="exampleInputName10">Type</label>
                                        <select name="type" class="form-control" data-placeholder="Select Type"
                                            style="width: 100%;">
                                            <option {{ $package->type == 1 ? 'selected' : null }} value="1">One time
                                                package</option>
                                            <option {{ $package->type == 2 ? 'selected' : null }} value="2">Monthly
                                                recuring package</option>
                                            <option {{ $package->type == 3 ? 'selected' : null }} value="3">3 Monthly
                                                recuring package</option>
                                            <option {{ $package->type == 4 ? 'selected' : null }} value="4">6 Monthly
                                                recuring package</option>
                                            <option {{ $package->type == 5 ? 'selected' : null }} value="5">1 Year
                                                recuring package</option>
                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="exampleInputCost1">Cost</label>
                                        <input value="{{ $package->cost }}" type="number" name="cost"
                                            class="form-control" min="1" id="exampleInputCost1" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputValid_for_type">Valid For Type</label>
                                        <select name="valid_for_type" class="form-control" data-placeholder="Select Type"
                                            style="width: 100%;">
                                            <option selected disabled value="">Please select type</option>
                                            <option {{ $package->valid_for_type == 'Day' ? 'selected' : null }}
                                                value="Day">Day</option>
                                            <option {{ $package->valid_for_type == 'Month' ? 'selected' : null }}
                                                value="Month">Month</option>
                                            <option {{ $package->valid_for_type == 'Year' ? 'selected' : null }}
                                                value="Year">Year</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputValid_for_value">Valid For Value</label>
                                        <input value="{{ $package->valid_for_value }}" type="number"
                                            name="valid_for_value" min="1" class="form-control"
                                            id="exampleInputValid_for_value" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputsessions_count">Total sessions count</label>
                                        <input value="{{ $package->sessions_count }}" type="number" name="sessions_count"
                                            min="1" class="form-control" id="exampleInputsessions_count" />
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="exampleInputSession">Sessions</label>
                                        <select name="sessions[]" class="select2bs4" multiple="multiple"
                                            data-placeholder="Select a Session" style="width: 100%;">

                                            @foreach ($sessiondata as $session)
                                                <option selected value="{{ $session->id }}">Class:
                                                    {{ $session->classm->name }} |
                                                    start time {{ $session->start_time }}</option>
                                            @endforeach
                                            @foreach ($sessions as $session)
                                                <option value="{{ $session->id }}">Class: {{ $session->classm->name }}
                                                    |
                                                    start time {{ $session->start_time }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input"
                                                    id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
                    name: {
                        required: true,
                    },
                    valid_for_type: {
                        required: true,
                    },
                    valid_for_value: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: "Please enter a name",
                    },
                    valid_for_type: {
                        required: "Please enter a Valid For Type",
                    },
                    valid_for_value: {
                        required: "Please enter a Valid For Value",
                    },

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
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#exampleInputDes1').summernote()
        })
    </script>
@endsection
@endsection
