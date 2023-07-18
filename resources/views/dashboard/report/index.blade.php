@extends('layouts.dashboard.base')
@section('pageTitle', 'Reports')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('jreports.index') }}
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
                                <h3 class="card-title">All Reports</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Body</th>
                                            <th>Member</th>
                                            <th>Status</th>
                                            <th>Approved by</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $report)
                                            <tr>
                                                <td style="vertical-align: middle; text-align: center">
                                                    {{ $report['type'] }}</td>
                                                <td style="vertical-align: middle; text-align: left">
                                                    {!! $report['body'] !!}</td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    {{ $report['member'] }}
                                                </td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    {{ $report['status'] }}</td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    {{ $report['approvedby'] }}</td>
                                                <td style="vertical-align: middle; text-align: center">
                                                    <div class="btn-group">
                                                        @if ($report['status'] != 'Approved')
                                                            <a href="{{ route('web_approve_cancel_class_request', $report['id']) }}"
                                                                type="button" class="btn btn-default btn-flat">
                                                                Approve
                                                            </a>
                                                        @endif
                                                        {{-- <a href="{{route('jreports.edit',$report['id'])}}" type="button" class="btn btn-default btn-flat">
                                                        <i class="fas fa-pen"></i>
                                                    </a> --}}
                                                        <a href="{{ route('jreports.show', $report['id']) }}"
                                                            type="button" class="btn btn-default btn-flat">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form method="post"
                                                            action="{{ route('jreports.destroy', $report['id']) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" onclick="deletefunc(this)"
                                                                class="btn btn-default btn-flat formsubmit"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Type</th>
                                            <th>Body</th>
                                            <th>Member</th>
                                            <th>Status</th>
                                            <th>Approved by</th>
                                            <th>Actions</th>
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
