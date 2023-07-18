@extends('layouts.dashboard.base')
@section('pageTitle','Payment')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Payment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('payment',['id'=>1]) }}
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
                                <h3 class="card-title">Payment</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="createUser" action="{{route('payment.update',$payment->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputWorking_key1">Merchant ID</label>
                                        <input value="{{$payment->merchant_id}}" type="text" name="merchant_id" class="form-control" id="exampleInputWorking_key1" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputWorking_key1">Working Key</label>
                                        <input value="{{$payment->working_key}}" type="text" name="working_key" class="form-control" id="exampleInputWorking_key1" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputAccess_code1">Access Code</label>
                                        <input value="{{$payment->access_code}}" type="password" name="access_code" class="form-control" id="exampleInputAccess_code1" />
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
        $(function () {
            $('#createUser').validate({
                rules: {
                    working_key: {
                        required: true,
                    },
                    access_code: {
                        required: true,
                    },

                },
                messages: {
                    working_key: {
                        required: "Please enter a working key",
                    },
                    access_code: {
                        required: "Please enter a access code",
                    },


                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $(function () {
            // Summernote
            $('#exampleInputDes1').summernote()
        })
    </script>
@endsection
@endsection
