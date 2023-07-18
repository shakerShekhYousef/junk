@extends('layouts.dashboard.base')
@section('pageTitle', 'Add New Class')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Class</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('sessions.create') }}
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
                                <h3 class="card-title">Add New Class</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="createUser" action="{{ route('sessions.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method("POST")
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputClass1">Class</label>
                                        <select name="class_id" class="form-control" id="exampleInputClass1">
                                            <option selected disabled>Please Select Class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <!-- time Picker -->
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group">
                                                <label>Start Time</label>
                                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                    <input onchange="compare()" id="timefrom" name="start_time" type="text"
                                                        class="form-control datetimepicker-input" data-target="#timepicker"
                                                        required />
                                                    <div class="input-group-append" data-target="#timepicker"
                                                        data-toggle="datetimepicker">
                                                        <div onclick="compare()" class="input-group-text"><i
                                                                class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- time Picker -->
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group">
                                                <label>End Time</label>
                                                <div class="input-group date" id="timepickerEnd"
                                                    data-target-input="nearest">
                                                    <input onchange="compare()" id="timeto" name="end_time" type="text"
                                                        class="form-control datetimepicker-input"
                                                        data-target="#timepickerEnd" required />
                                                    <div class="input-group-append" data-target="#timepickerEnd"
                                                        data-toggle="datetimepicker">
                                                        <div onclick="compare()" class="input-group-text"><i
                                                                class="far fa-clock"></i></div>
                                                    </div>
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCoach">Coach</label>
                                        <select name="coach_id" class="form-control" id="exampleInputCoach">
                                            <option selected disabled>Please Select Coach</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCoach">Music</label>
                                        <select name="music_id" class="form-control" id="exampleInputCoach">
                                            <option selected>Please Select music</option>
                                            @foreach ($musics as $music)
                                                <option value="{{ $music->id }}">{{ $music->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCapacity">Capacity</label>
                                        <input value="{{ old('capacity') }}" type="number" name="capacity" min="1"
                                            class="form-control" id="exampleInputCapacity" placeholder="Enter Capacity">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="exampleInputCost">Session cost</label>
                                        <input value="{{ old('session_cost') }}" type="number" name="session_cost"
                                            class="form-control" id="exampleInputCost" placeholder="Enter Cost">
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="exampleInputRecurring_type">Recurring Type</label>
                                        <select name="recurring_type" class="form-control"
                                            id="exampleInputRecurring_type">
                                            <option selected disabled>Please Select Recurring Type</option>
                                            <option value="Daily">Daily</option>
                                            <option value="Weekly">Weekly</option>
                                            <option value="None">None</option>
                                        </select>
                                    </div>

                                    <div id="exampleInputRecuring_interval_weekly" class="form-group"
                                        style="display: none">
                                        <label for="exampleInputSession">Session Recurring Interval</label>
                                        <select name="recuring_interval_weekly[]" class="select2bs4" multiple="multiple"
                                            data-placeholder="Select a Session" style="width: 100%;">
                                            <option value=1>sat</option>
                                            <option value=2>sun</option>
                                            <option value=3>mon</option>
                                            <option value=4>tue</option>
                                            <option value=5>wed</option>
                                            <option value=6>thu</option>
                                            <option value=7>fri</option>
                                        </select>
                                    </div>

                                    {{-- <div id="exampleInputRecuring_interval_daily" class="form-group"
                                        style="display: none">
                                        <label for="exampleInputRecuring_interval">Session Recurring Interval</label>
                                        <input value="{{ old('recuring_interval') }}" type="text"
                                            name="recuring_interval_daily" class="form-control"
                                            id="exampleInputRecuring_interval" placeholder="Enter Recuring Interval ">
                                    </div> --}}
                                    <div id="session_total_count" class="form-group" style="display: none">
                                        <label for="exampleInputSession_total_count">Session Total Count</label>
                                        <input value="{{ old('session_total_count') }}" type="number"
                                            name="session_total_count" min="1" class="form-control"
                                            id="exampleInputSession_total_count" placeholder="Enter Session total count ">
                                    </div>
                                    <div class="form-group" id="exampleInputMinimum_open_type_div">
                                        <label for="exampleInputMinimum_open_type">Minimum Open Type</label>
                                        <select name="minimum_open_type" onchange="getValue(this.value)"
                                            class="form-control" id="exampleInputMinimum_open_type">
                                            <option selected>Please Select Minimum Open Type</option>
                                            <option value="Spot">Spot</option>
                                            <option value="Date">Date</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="exampleInputMinimum_open_value" style="display: none">
                                        <label for="exampleInputMinimum_open_value">Minimum Open value</label>
                                        <input value="{{ old('minimum_open_value') }}" type="number" min="0"
                                            name="minimum_open_value" class="form-control"
                                            id="exampleInputMinimum_open_value" placeholder="Enter Session Total Spot ">
                                    </div>
                                    {{-- <div class="form-group" id="exampleInputMinimum_open_date" style="display: none">
                                        <label for="exampleInputMinimum_open_date">Minimum Open Date</label>
                                        <input value="{{ old('minimum_open_value') }}" type="date"
                                            name="minimum_open_value_d" class="form-control"
                                            id="exampleInputMinimum_open_date" placeholder="Enter Session Total Date ">
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
                    class_id: {
                        required: true,
                    },
                    capacity: {
                        required: true,
                    },
                    coach_id: {
                        required: true,
                    },
                    session_total_count: {
                        required: true,
                    },
                    recurring_type: {
                        required: true,
                    },
                    recuring_interval: {
                        required: true,
                    },
                    minimum_open_type: {
                        required: true,
                    }


                },
                messages: {
                    name: {
                        required: "Please enter a name",
                    },
                    capacity: {
                        required: "Please enter a capacity",
                    },
                    coach_id: {
                        required: "Please enter a coach",
                    },
                    session_total_count: {
                        required: "Please enter a session total count",
                    },
                    recurring_type: {
                        required: "Please enter a recurring type",
                    },
                    recuring_interval: {
                        required: "Please enter a recurring interval",
                    },
                    minimum_open_type: {
                        required: "Please enter a minimum open type",
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
        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'HH:mm'
        });
        $('#timepickerEnd').datetimepicker({
            format: 'HH:mm'
        })
    </script>
    <script>
        function getValue(value) {
            if (value == "Spot") {
                document.getElementById('exampleInputMinimum_open_value').style.display = "block";
                // document.getElementById('exampleInputMinimum_open_date').style.display = "none";
            } else if (value == "Date") {
                document.getElementById('exampleInputMinimum_open_value').style.display = "none";
                // document.getElementById('exampleInputMinimum_open_date').style.display = "block";
            }
        }
    </script>
    <script>
        $('#exampleInputRecurring_type').change(function() {
            val1 = $('#exampleInputRecurring_type').val();
            if (val1 == "Daily") {
                // document.getElementById('exampleInputRecuring_interval_daily').style.display = "block";
                document.getElementById('exampleInputRecuring_interval_weekly').style.display = "none";
                document.getElementById('exampleInputMinimum_open_type_div').style.display = "block";
                document.getElementById('exampleInputMinimum_open_value').style.display = "none";
                document.getElementById('exampleInputMinimum_open_date').style.display = "none";
                // document.getElementById('session_total_count').style.display = "block";
            } else if (val1 == "Weekly") {
                // document.getElementById('exampleInputRecuring_interval_daily').style.display = "none";
                document.getElementById('exampleInputRecuring_interval_weekly').style.display = "block";
                document.getElementById('exampleInputMinimum_open_type_div').style.display = "block";
                document.getElementById('exampleInputMinimum_open_value').style.display = "none";
                document.getElementById('exampleInputMinimum_open_date').style.display = "none";
                // document.getElementById('session_total_count').style.display = "block";
            } else {
                document.getElementById('exampleInputRecuring_interval_weekly').style.display = "none";
                document.getElementById('exampleInputMinimum_open_type_div').style.display = "none";
                document.getElementById('exampleInputMinimum_open_value').style.display = "none";
                document.getElementById('exampleInputMinimum_open_date').style.display = "block";
                // document.getElementById('session_total_count').style.display = "none";
            }
        });
    </script>
    <script>
        function compare() {

            var timefrom = new Date();
            temp = $('#timefrom').val().split(":");

            timefrom.setHours((parseInt(temp[0]) - 1 + 24) % 24);
            timefrom.setMinutes(parseInt(temp[1]));
            var timeto = new Date();
            temp = $('#timeto').val().split(":");
            timeto.setHours((parseInt(temp[0]) - 1 + 24) % 24);
            timeto.setMinutes(parseInt(temp[1]));

            if (timeto < timefrom) {
                alert('start time should be smaller than end time!');
            }


        }
    </script>
@endsection
@endsection
