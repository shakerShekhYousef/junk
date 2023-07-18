@extends('layouts.dashboard.base')
@section('pageTitle', 'Show service rates')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Show service rates</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- {{ Breadcrumbs::render('jreports.show', $report['id']) }} --}}
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
                                <h3 class="card-title">Show service rates</h3>
                            </div>
                            





                            <div class="card card-body">
                                <div class="form-group">
                                    <label for="exampleInputName1">Member name</label>
                                    <input readonly value="{{ $report['type'] }}" type="text" name="name"
                                        class="form-control" id="exampleInputName1" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Service rate</label>
                                    <input readonly value="{{ $report['member'] }}" type="text" name="name"
                                        class="form-control" id="exampleInputName1" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Specialization in our service</label>
                                    <input readonly value="{{ $report['status'] }}" type="text" name="name"
                                        class="form-control" id="exampleInputName1" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Is your elements accurately found</label>
                                    <input readonly value="{{ $report['approvedby'] }}" type="text" name="name"
                                        class="form-control" id="exampleInputName1" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Did you need customers service</label>
                                    <input readonly value="{{ $report['approvedby'] }}" type="text" name="name"
                                        class="form-control" id="exampleInputName1" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">comments</label>
                                    <input readonly value="{{ $report['approvedby'] }}" type="text" name="name"
                                        class="form-control" id="exampleInputName1" placeholder="Enter name">
                                </div>
                            </div>

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
            $('#editClass').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name",
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
