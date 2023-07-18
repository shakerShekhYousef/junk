@extends('layouts.dashboard.base')
@section('pageTitle', 'Show class')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Show class</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('sessions.show', $session->id) }}
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
                                <h3 class="card-title">Show class</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="createUser" action="#" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputClass1">Class</label>
                                        <select name="class_id" class="form-control" id="exampleInputClass1">
                                            <option selected value="{{ $session->class_id }}">
                                                {{ $session->classm->name }}
                                            </option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <!-- time Picker -->
                                        <div class="bootstrap-timepicker">
                                            <div class="form-group">
                                                <label>Start Time</label>
                                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                    <input readonly value="{{ $session->start_time }}" name="start_time"
                                                        type="text" class="form-control datetimepicker-input"
                                                        data-target="#timepicker" required />
                                                    <div class="input-group-append" data-target="#timepicker"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
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
                                                    <input readonly value="{{ $session->end_time }}" name="end_time"
                                                        type="text" class="form-control datetimepicker-input"
                                                        data-target="#timepickerEnd" required />
                                                    <div class="input-group-append" data-target="#timepickerEnd"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
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
                                            <option selected value="{{ $session->coach_id }}">
                                                {{ $session->coachname() }}
                                            </option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputCapacity">Capacity</label>
                                        <input readonly value="{{ $session->capacity }}" type="number" name="capacity"
                                            min="1" class="form-control" id="exampleInputCapacity"
                                            placeholder="Enter capacity">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="exampleInputCost">Session cost</label>
                                        <input readonly value="{{ $session->session_cost }}" type="number" name="session_cost"
                                            class="form-control" id="exampleInputCost" placeholder="Enter Cost">
                                    </div> --}}
                                    {{-- <div class="form-group">
                                        <label for="exampleInputStatus">Status</label>
                                        <select name="status" class="form-control" id="exampleInputStatus">
                                            <option selected disabled>{{ $session->status }}</option>

                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="exampleInputRecurring_type">Recurring Type</label>
                                        <select name="recurring_type" class="form-control"
                                            id="exampleInputRecurring_type">
                                            <option selected disabled>{{ $session->recurring_type }}</option>
                                        </select>
                                    </div>

                                    @if ($session->recurring_type == 'Weekly')
                                        <div id="exampleInputRecuring_interval_weekly" class="form-group">
                                            <label for="exampleInputSession">Session Recurring Interval</label>
                                            <select name="recuring_interval_weekly[]" class="select2bs4"
                                                multiple="multiple" data-placeholder="Select a Session"
                                                style="width: 100%;">
                                                @foreach (json_decode($session->recuring_interval) as $item)
                                                    <option disabled selected value=1>
                                                        {{ $item == '1' ? 'sat' : ($item == '2' ? 'sun' : ($item == '3' ? 'mon' : ($item == '4' ? 'tue' : ($item == '5' ? 'wed' : ($item == '6' ? 'thu' : ($item == '7' ? 'fri' : null)))))) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    @if ($session->recurring_type == 'Daily')
                                        <div id="exampleInputRecuring_interval_daily" class="form-group"
                                            style="display: none">
                                            <label for="exampleInputRecuring_interval">Session Recurring Interval</label>
                                            <input value="{{ old('recuring_interval') }}" type="text"
                                                name="recuring_interval_daily" class="form-control"
                                                id="exampleInputRecuring_interval" placeholder="Enter Recuring Interval ">
                                        </div>
                                    @endif

                                    {{-- <div class="form-group">
                                        <label for="exampleInputSession_total_count">Session Total Count</label>
                                        <input readonly value="{{ $session->session_total_count }}" type="number"
                                            name="session_total_count" min="1" class="form-control"
                                            id="exampleInputSession_total_count" placeholder="Enter Session total count ">
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="exampleInputMinimum_open_type">Minimum Open Type</label>
                                        <select readonly name="minimum_open_type" onchange="getValue(this.value)"
                                            select-value="{{ $session->minimum_open_type }}" class="form-control"
                                            id="exampleInputMinimum_open_type">
                                            <option disabled selected>{{ $session->minimum_open_type }}</option>
                                        </select>

                                    </div>
                                    <div class="form-group" id="exampleInputMinimum_open_value" style="display: none">
                                        <label for="exampleInputMinimum_open_value">Minimum Open value</label>
                                        <input readonly value="{{ $session->minimum_open_value }}" type="number" min="0"
                                            name="minimum_open_value" class="form-control"
                                            id="exampleInputMinimum_open_value" placeholder="Enter Session Total Spot ">
                                    </div>
                                    <div class="form-group" id="exampleInputMinimum_open_date" style="display: none">
                                        <label for="exampleInputMinimum_open_date">Minimum Open Date</label>
                                        <input readonly value="{{ $session->minimum_open_value }}" type="date"
                                            name="minimum_open_value_d" class="form-control"
                                            id="exampleInputMinimum_open_date" placeholder="Enter Session Total Date ">
                                    </div>

                                </div>
                                <!-- /.card-body -->

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
            format: 'LT'
        });
        $('#timepickerEnd').datetimepicker({
            format: 'LT'
        })
    </script>
    <script>
        var value = document.getElementById('exampleInputMinimum_open_type').getAttribute('select-value');
        if (value == "Spot") {
            document.getElementById('exampleInputMinimum_open_value').style.display = "block";
            document.getElementById('exampleInputMinimum_open_date').style.display = "none";
        } else if (value == "Date") {
            document.getElementById('exampleInputMinimum_open_value').style.display = "none";
            document.getElementById('exampleInputMinimum_open_date').style.display = "block";
        }
    </script>
@endsection
@endsection
