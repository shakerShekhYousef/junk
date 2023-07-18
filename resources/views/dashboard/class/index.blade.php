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
                            {{ Breadcrumbs::render('classes.index') }}
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
                                <h3 class="card-title">All Classes</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($classes as $class)
                                            <tr>
                                                <td>{{ $class->name }}</td>
                                                <td>{!! strip_tags($class->description) !!}</td>
                                                <td>
                                                    <img src="{{ asset($class->image) }}" width="100" height="100">
                                                </td>
                                                <td>{{ $class->type }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('classes.edit', $class) }}" type="button"
                                                            class="btn btn-default btn-flat">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="{{ route('classes.show', $class->id) }}" type="button"
                                                            class="btn btn-default btn-flat">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form method="post"
                                                            action="{{ route('classes.destroy', $class->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-default btn-flat"
                                                                onclick="deletefunc(this)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Type</th>
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
