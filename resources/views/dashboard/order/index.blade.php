@extends('layouts.dashboard.base')
@section('pageTitle', 'Orders')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('web_get_orders_info') }}
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
                                <h3 class="card-title">All Users</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                {{-- filteration --}}
                                <div class="row mt-2">
                                    <div class="col-md-2">
                                        <label for="package_name">Package name</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="member_name">User name</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="order_date">Order date</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="order_type">Order type</label>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-2">
                                        <select name="" id="package_name" class="form-control filter">
                                            <option selected disabled value="">Select package name</option>
                                            @foreach ($packages as $package)
                                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="" id="member_name" class="form-control filter">
                                            <option selected disabled value="">Select user name</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="datetimepicker" class="form-control">
                                        {{-- <select name="" id="order_date" class="form-control filter">
                                            <option selected disabled value="">Select date</option>
                                            @foreach ($dateslist as $date)
                                                <option value="{{ $date }}">{{ $date }}</option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                    <div class="col-md-2">
                                        <select name="" id="order_type" class="form-control filter">
                                            <option selected disabled value="">Select type</option>
                                            @foreach ($ordertypelist as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <table id="maindata" class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Order id</th>
                                            <th>Member</th>
                                            <th>Package</th>
                                            <th>Cost</th>
                                            <th>Currency</th>
                                            <th>Order date</th>
                                            <th>Order type</th>
                                            <th>Details</th>
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

            var table = $('#maindata').DataTable({
                "scrollX": true,
                "scrollCollapse": true,
                'ordering': false,
                "dom": "fBrtip",
                processing: true,
                serverSide: true,
                ajax: {
                    type: 'post',
                    url: "{{ route('web_get_orders_info_data_table') }}",
                    data: function(d) {
                        d.package = $('#package_name').val();
                        d.member = $('#member_name').val();
                        d.type = $('#order_type').val();
                        if ($('#datetimepicker').val() != '') {
                            d.startDate = $('#datetimepicker').data('daterangepicker').startDate.format(
                                'YYYY-MM-DD');
                            d.endDate = $('#datetimepicker').data('daterangepicker').endDate.format(
                                'YYYY-MM-DD');
                        }
                        d.search = $('input[type="search"]').val();
                    }

                },
                columns: [{
                        data: 'order_id',
                        name: 'order_id'
                    },
                    {
                        data: 'member',
                        name: 'member'
                    },
                    {
                        data: 'package',
                        name: 'package'
                    },
                    {
                        data: 'cost',
                        name: 'cost'
                    },
                    {
                        data: 'currency',
                        name: 'currency'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'order_type',
                        name: 'order_type'
                    },
                    {
                        data: 'details',
                        name: 'details'
                    }
                ]
            });

            $('.filter').change(function() {
                table.clear().draw();
            });

            $('#datetimepicker').on('apply.daterangepicker', function(ev, picker) {
                table.clear().draw();
            });
        });
    </script>
    <script>
        $(function() {
            $('#datetimepicker').daterangepicker({
                startDate: moment().subtract('days', 1)
            });
        });
    </script>
    {{-- <script>
        $('.filter').change(function() {
            var url =
                "{{ route('web_get_orders_info_filtered', ['package' => ':package', 'user' => ':user', 'date' => ':date', 'type' => ':type']) }}";
            var package = $('#package_name').val();
            var user = $('#user_name').val();
            var date = $('#order_date').val();
            var type = $('#order_type').val();
            url = url.replace(':package', package);
            url = url.replace(':user', user);
            url = url.replace(':date', date);
            url = url.replace(':type', type);

            $.ajax({
                url: url,
                type: 'get',
                success: function(result) {
                    $('table tbody').empty();
                    var resulttag = "";
                    result.forEach(element => {
                        url = "{{ route('web_get_order_info_by_id', ':id') }}";
                        url = url.replace(':id', element.id);
                        resulttag += "<tr><td>" + element.order_id + "</td><td>" + element
                            .member + "</td>" +
                            "<td>" + element.package + "</td><td>" + element.cost + "</td>" +
                            "<td>" + element.currency + "</td><td>" + element.order_date +
                            "</td>" +
                            "<td>" + element.order_type + "</td><td><a href=" + url +
                            " type='button' class='btn btn-default btn-flat'><i class='fas fa-eye'></i></a></td></tr>";
                    });

                    $("table tbody").append(resulttag);
                }
            });
        })
    </script> --}}
@endsection
