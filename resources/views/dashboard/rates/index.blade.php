@extends('layouts.dashboard.base')
@section('pageTitle', 'Service rates')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Service rates</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- {{ Breadcrumbs::render('jreports.index') }} --}}
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
                                <h3 class="card-title">Service rates</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Member name</th>
                                            <th>Service rate</th>
                                            <th>
                                                <div class="row">SIOS&nbsp&nbsp<div data-toggle="tooltip"
                                                        data-placement="right" title="Specialization in our service"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-info-circle-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                        </svg></div>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="row">IYEAF&nbsp&nbsp<div data-toggle="tooltip"
                                                        data-placement="right" title="Is your elements accurately found">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-info-circle-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                        </svg></div>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="row">DYNCS&nbsp&nbsp<div data-toggle="tooltip"
                                                    data-placement="right" title="Did you need customers service">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-info-circle-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                                    </svg></div>
                                            </div>
                                                </th>
                                            <th>Comments</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rates as $rate)
                                            <tr>
                                                <td style="vertical-align: middle; text-align: center">
                                                    {{ $rate->member_name }}</td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    {{ $rate->service_rate }}</td>
                                                <td style="vertical-align: middle; text-align: left">
                                                    {{ $rate->specialization_in_our_service }}</td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    {{ $rate->is_your_elements_accurately_found }}
                                                </td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    {{ $rate->did_you_need_customers_service }}</td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    {{ $rate->comments }}</td>

                                                <td style="vertical-align: middle; text-align: center">
                                                    <form action="{{ route('web_destroy_rate', $rate->memeber_id) }}"
                                                        method="POST">
                                                        @method("Delete")
                                                        <button type="button" onclick="deletefunc(this)"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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
