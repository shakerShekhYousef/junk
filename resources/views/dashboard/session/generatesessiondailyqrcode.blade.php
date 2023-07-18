@extends('layouts.dashboard.base')
@section('pageTitle', 'Class QRL')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Class QRL</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('sessions.generatesessiondailyqrcodeview') }}
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
                                <h3 class="card-title">Class QRL</h3>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="selectsession">Classes</label>
                                    <select name="session" class="form-control" id="selectsession" required>
                                        <option selected disabled>Please Select Session</option>
                                        @foreach ($sessions as $session)
                                            <option
                                                value="{{ json_encode([$session->id, $session->day_name]) }}">
                                                {{ $session->name }}
                                                {{ $session->start_time }} - {{ $session->end_time }} - {{ $session->day_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="sessionqrcode" class="row pt-5 pb-5 d-flex justify-content-center">

                                </div>

                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@section('custom-script')
    <script>
        $(function() {
            $('#attendmember').validate({
                rules: {
                    session: {
                        required: true,
                    },
                    user: {
                        required: true,
                    },
                    date_of_session: {
                        required: true,
                    }
                },
                messages: {
                    session: {
                        required: "Please select a session",
                    },
                    session: {
                        user: "Please select a user",
                    },
                    date_of_session: {
                        user: "Please select the date of session",
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
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#exampleInputDes1').summernote()
        })
    </script>

    <script>
        $('#selectsession').change(function() {
            var temp = "{{ route('web_generate_session_daily_qrcode', ':id') }}";
            var temp1 = temp.replace(':id', $(this).val());
            $.ajax({
                'url': temp1,
                success: function(res) {
                    $('#sessionqrcode').html(res);
                }
            })
        });
    </script>
@endsection
@endsection
