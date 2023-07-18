@extends('layouts.dashboard.base')
@section('pageTitle', 'Fees')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Fees</h1>
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
                                <h3 class="card-title">Fees</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Member name</th>
                                            <th>Fee type</th>
                                            <th>Fee amount</th>
                                            <th>Aamount type</th>
                                            <th>Description</th>
                                            <th>Fee date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($fees as $fee)
                                            <tr>
                                                <td>{{ $fee->member_id }}</td>
                                                <td>{{ $fee->fee_type }}</td>
                                                <td>{{ $fee->fee_amount }}</td>
                                                <td>{{ $fee->fee_amount_type }}</td>
                                                <td>{{ $fee->description }}</td>
                                                <td>{{ $fee->created_at->toDateString() }}</td>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Member name</th>
                                            <th>Fee type</th>
                                            <th>Fee amount</th>
                                            <th>Aamount type</th>
                                            <th>Description</th>
                                            <th>Fee date</th>
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
