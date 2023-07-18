@extends('layouts.dashboard.base')
@section('pageTitle', 'Classes')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Classes</h1>
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
                                <h3 class="card-title">All classes</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Class</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Coach</th>
                                            <th>Music</th>
                                            <th>Recurring Type</th>
                                            <th>Recurring Interval</th>
                                            <th>Session Total Count</th>
                                            <th>Minimum Open Type</th>
                                            <th>Minimum Open Value</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sessions as $session)
                                            <tr>
                                                <td>{{ $session->classm->name }}</td>
                                                <td>{{ $session->start_time }}</td>
                                                <td>{{ $session->end_time }}</td>
                                                <td>{{ $session->coachname()}}</td>
                                                <td>{{ $session->music ? $session->music->title : "Empty"  }}</td>
                                                <td>{{ $session->recurring_type }}</td>
                                                <td>{{ $session->recuring_interval }}</td>
                                                <td>{{ $session->session_total_count }}</td>
                                                <td>{{ $session->minimum_open_type }}</td>
                                                <td>{{ $session->minimum_open_value }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('sessions.edit', $session) }}" type="button"
                                                            class="btn btn-default btn-flat">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="{{ route('sessions.show', $session->id) }}"
                                                            type="button" class="btn btn-default btn-flat">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        <form method="post" action="{{ route('sessions.destroy', $session->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-default btn-flat" onclick="deletefunc(this)"><i
                                                                    class="fas fa-trash"></i> </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Class</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Coach</th>
                                            <th>Music</th>
                                            <th>Recurring Type</th>
                                            <th>Recurring Interval</th>
                                            <th>Session Total Spot</th>
                                            <th>Minimum Open Type</th>
                                            <th>Minimum Open Value</th>
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
        <script>
            function deletefunc(event){
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
    </div>
@endsection
