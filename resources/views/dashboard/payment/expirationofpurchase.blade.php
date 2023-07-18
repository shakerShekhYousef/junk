@extends('layouts.dashboard.base')
@section('pageTitle', 'Sales')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sales</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('web_view_expiration_of_purchase') }}
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
                                <h3 class="card-title">Sales</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Member name</th>
                                            <th>Package name</th>
                                            <th>Payment date</th>
                                            <th>Expiration date</th>
                                            <th>Duration till expiration / days</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($purchaseslist as $purchases)
                                            <tr>
                                                <td>{!! $purchases['user_name'] !!}</td>
                                                <td>{{ $purchases['package_name'] }}</td>
                                                <td>{{ $purchases['payment_date'] }}</td>
                                                <td>{{ $purchases['expire_date'] }}</td>
                                                <td>{{ $purchases['remain_for_expiration'] }}</td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Member name</th>
                                            <th>Package name</th>
                                            <th>Payment date</th>
                                            <th>Expiration date</th>
                                            <th>Duration till expiration</th>
                                        </tr>
                                    </tfoot>
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
