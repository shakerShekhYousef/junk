@extends('layouts.dashboard.base')
@section('pageTitle', 'Create New Membership Bio')
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
                        <h1>Create New Membership Bio</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('packages.create') }}
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
                                <h3 class="card-title">Create New Membership Bio</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="createUser" action="{{ route('packages.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method("POST")
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Name</label>
                                        <input value="{{ old('name') }}" type="text" name="name" class="form-control"
                                            id="exampleInputName1" placeholder="Enter name">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="exampleInputName10">Type</label>
                                        <select name="type" class="form-control" data-placeholder="Select Type"
                                            style="width: 100%;">
                                            <option selected disabled value="">Please select type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="exampleInputCost1">Cost</label>
                                        <input value="{{ old('cost') }}" type="number" name="cost" class="form-control"
                                            min="1" id="exampleInputCost1" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputValid_for_type">Valid For Type</label>
                                        <select name="valid_for_type" class="form-control" data-placeholder="Select Type"
                                            style="width: 100%;">
                                            <option selected disabled value="">Please select type</option>
                                            <option value="Day">Day</option>
                                            <option value="Month">Month</option>
                                            <option value="Year">Year</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputValid_for_value">Valid For Value</label>
                                        <input value="{{ old('valid_for_value') }}" type="number" name="valid_for_value"
                                            min="1" class="form-control" id="exampleInputValid_for_value" />
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputsessions_count">Total sessions count</label>
                                        <input value="{{ old('sessions_count') }}" type="number" name="sessions_count"
                                            min="1" class="form-control" id="exampleInputsessions_count" />
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="exampleInputSession">Sessions</label>
                                        <select name="sessions[]" class="select2bs4" multiple="multiple"
                                            data-placeholder="Select a Session" style="width: 100%;">

                                            @foreach ($sessions as $session)
                                                <option value="{{ $session->id }}">Class: {{ $session->classm->name }} |
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
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                            </div>
                                        </div>
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
                    name: {
                        required: true,
                    },
                    valid_for_type: {
                        required: true,
                    },
                    valid_for_value: {
                        required: true,
                    },
                    image: {
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
                    image: {
                        required: "Please enter a Valid For Image",
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
