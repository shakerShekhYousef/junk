@extends('layouts.dashboard.base')
@section('pageTitle', 'Book Class')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Book Class</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('sessions.attendsession') }}
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
                                <h3 class="card-title">Book Class</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="attendmember" action="{{ route('web_admin_attend_session') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method("POST")
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="selectsessionuser">Users</label>
                                        <select name="user" class="form-control" id="selectsessionuser">
                                            <option selected disabled>Please Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username() }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="selectsession">Sessions</label>
                                        <select name="session" class="form-control" id="selectsession" required>
                                            <option selected disabled>Please Select Session</option>
                                        </select>
                                    </div>

                                    {{-- <div class="form-group">
                                        <label for="memberattenddate">Session date</label>
                                        <input type="date" name="date_of_session" class="form-control"
                                            id="memberattenddate" placeholder="Enter Attend Date">
                                    </div> --}}

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
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
        $('#selectsessionuser').change(function() {
            var userid = $('#selectsessionuser').val();
            var usersessions = "{{ route('web_get_sessions_for_user_in_day', ':userid') }}";
            usersessions = usersessions.replace(':userid', userid);
            var select = $('#selectsession');
            select.find('option').remove();
            $('<option selected disabled>').val('').text('Please Select Session').appendTo(select);
            $.ajax(usersessions, {
                dataType: 'json',
                success: function(data, status, xhr) {
                    $.each(data, function(index, value) {
                        $('<option>').val(value.id).text(value.name + ' - ' + value.start_time +
                                ' - ' + value.end_time + ' - ' + value.bookdate)
                            .appendTo(select);
                    });
                }
            });
        });
    </script>
@endsection
@endsection
