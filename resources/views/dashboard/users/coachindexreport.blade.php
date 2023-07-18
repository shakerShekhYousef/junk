@extends('layouts.dashboard.base')
@section('pageTitle', 'Coaches')
@section('head1')
    <!--datatable-->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.5/date-1.1.1/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.5/date-1.1.1/datatables.min.js">
    </script>

@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coaches</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('users.index') }}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All coaches</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <b>Most sessions</b>
                                    </div>
                                    <div class="col-md-2">
                                        <b>Least sessions</b>
                                    </div>
                                    {{-- <div class="col-md-2">
                                        <b>Least attended</b>
                                    </div>
                                    <div class="col-md-2">
                                        <b>Most attended</b>
                                    </div>
                                    <div class="col-md-3">
                                        <b>Filter by purchase expiration</b>
                                    </div> --}}
                                    <div class="col-md-2">
                                        <b>Filter by gender</b>
                                    </div>
                                    <div class="col-md-2">
                                        <b>Filter by dob</b>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    {{-- <div class="col-md-2">
                                        <select name="" id="leastattednded" class="form-control filter-item">
                                            <option value=""></option>
                                            <option value="1">1</option>
                                            <option value="5">5</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div> --}}
                                    <div class="col-md-2">
                                        <select name="" id="mostsessions" class="form-control filter-item">
                                            <option value=""></option>
                                            <option value="1">1</option>
                                            <option value="5">5</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="" id="leastsessions" class="form-control filter-item">
                                            <option value=""></option>
                                            <option value="1">1</option>
                                            <option value="5">5</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="75">75</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <select name="" id="validtill" class="form-control filter-item">
                                            <option value="">Select valid till date</option>
                                            @foreach ($validtilllist as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="col-md-2">
                                        <select name="gender" id="gender" class="form-control filter-item">
                                            <option value="">Select gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="datetimepicker1" class="form-control">
                                    </div>
                                </div>
                                <div class="table-wrapper-scroll-y my-custom-scrollbar">
                                    <table id="maindata" class="table table-bordered table-striped" width="125%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Gender</th>
                                                <th>
                                                    <div class="row">Dob&nbsp&nbsp<div data-toggle="tooltip"
                                                            data-placement="right" title="Date Of Birth"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-info-circle-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                            </svg></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">CTPSs&nbsp&nbsp<div data-toggle="tooltip"
                                                            data-placement="right" title="Coach Total Past Sessions"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-info-circle-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                            </svg></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">CPCSs&nbsp&nbsp<div data-toggle="tooltip"
                                                            data-placement="right" title="Coach Past Completed Sessions">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-info-circle-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                            </svg></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">CPUSs&nbsp&nbsp<div data-toggle="tooltip"
                                                            data-placement="right" title="Coach Past Uncompleted Sessions">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-info-circle-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                            </svg></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">CTWSs&nbsp&nbsp<div data-toggle="tooltip"
                                                            data-placement="right" title="Coach Total Waiting Sessions"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-info-circle-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                            </svg></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">CTCWSs&nbsp&nbsp<div data-toggle="tooltip"
                                                            data-placement="right"
                                                            title="Coach Total Completed Waiting Sessions"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-info-circle-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                            </svg></div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row">CTUWSs&nbsp&nbsp<div data-toggle="tooltip"
                                                            data-placement="right"
                                                            title="Coach Total Uncompleted Waiting Sessions"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-info-circle-fill"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                            </svg></div>
                                                    </div>
                                                </th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-script')
    <script>
        $(function() {
            $('#datetimepicker1').daterangepicker({
                startDate: '01/01/1900',
                showDropdowns: true
            });
        });
    </script>

    <script>
        var table = $('#maindata').DataTable({
            "scrollX": true,
            "scrollCollapse": true,
            'ordering': false,
            "dom": "fBrtip",
            "pagingType": "full_numbers",
            "responsive": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: "{{ route('web_coaches_data_table') }}",
                type: "post",
                data: function(d) {
                    // add these values in order to make filtration for table
                    d.gender = $('#gender').val();
                    // d.search = $('.dataTables_filter input').val();
                    if ($('#datetimepicker1').val() != '') {
                        d.startDate = $('#datetimepicker1').data('daterangepicker').startDate.format(
                            'YYYY-MM-DD');
                        d.endDate = $('#datetimepicker1').data('daterangepicker').endDate.format(
                            'YYYY-MM-DD');
                    }
                    // d.validtilldate = $('#validtill').val();
                    d.mostsessions = $('#mostsessions').val();
                    d.leastsessions = $('#leastsessions').val();
                    // d.leastattednded = $('#leastattednded').val();
                }
            },
            columns: [{
                    data: 'coach_name',
                    name: 'coach_name',
                    width: 200
                },
                {
                    data: 'coach_email',
                    name: 'coach_email',
                    width: 250
                },
                {
                    data: 'coach_gender',
                    name: 'coach_gender',
                    width: 100
                },
                {
                    data: 'coach_dob',
                    name: 'coach_dob',
                    width: 200
                },
                {
                    data: 'total_sessions',
                    name: 'total_sessions',
                    width: 200
                },
                {
                    data: 'completed_sessions',
                    name: 'completed_sessions',
                    width: 150
                },
                {
                    data: 'uncompleted_sessions',
                    name: 'uncompleted_sessions',
                    width: 150
                },
                {
                    data: 'total_waiting_sessions',
                    name: 'total_waiting_sessions',
                    width: 150
                },
                {
                    data: 'completed_waiting_sessions',
                    name: 'completed_waiting_sessions',
                    width: 150
                },
                {
                    data: 'uncompleted_waiting_sessions',
                    name: 'uncompleted_waiting_sessions',
                    width: 150
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: true,
                    width: 50
                }
            ]
        });

        $('.filter-item').change(function() {
            table.draw();
        });
        $('#datetimepicker1').on('apply.daterangepicker', function(ev, picker) {
            table.draw();
        });

        $('#mostsessions').change(function() {
            $('#leastsessions').val('');
        });
        $('#leastsessions').change(function() {
            $('#mostsessions').val('');
        });
    </script>
    <script>
        function deletefunc(event) {
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    event.closest("form").submit();
                }
            });
        }
    </script>
@endsection
