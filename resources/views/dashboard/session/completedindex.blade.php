@extends('layouts.dashboard.base')
@section('pageTitle', 'Completed Classes')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Completed Classes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('sessions.index') }}
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
                                <h3 class="card-title">Completed Classes</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Class</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Capacity</th>
                                            <th>Start date</th>
                                            <th>Coach</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sessions as $session)
                                            <tr>
                                                <td>{{ $session['class'] }}</td>
                                                <td>{{ $session['start_time'] }}</td>
                                                <td>{{ $session['end_time'] }}</td>
                                                <td>{{ $session['capacity'] }}</td>  
                                                <td>{{ $session['opendate'] }}</td>  
                                                <td>{{ $session['coach'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Class</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Capacity</th>
                                            <th>Start date</th>
                                            <th>Coach</th>
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
