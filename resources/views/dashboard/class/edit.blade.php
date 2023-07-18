@extends('layouts.dashboard.base')
@section('pageTitle','Edit class-'.$class->name)
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit class | {{$class->name}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('classes.edit',$class->id) }}
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
                                <h3 class="card-title">Edit class | {{$class->name}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="editClass" action="{{route('classes.update',$class->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Name</label>
                                        <input value="{{$class->name}}" type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Enter name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputDes1">Description</label>
                                        <textarea type="text" name="description" class="form-control" id="exampleInputDes1">
                                            {!! old('description') ?? $class->description !!}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputType1">Type</label>
                                        <select  name="type" class="form-control" id="exampleInputType1">
                                            <option selected disabled>{{$class->type}}</option>
                                            <option value="Rave">Rave</option>
                                            <option value="House">House</option>
                                            <option value="90sClassics">90sClassics</option>
                                            <option value="Cheesy pop">Cheesy pop</option>
                                            <option value="r&Beat">r&Beat</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
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
        $(function () {
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
