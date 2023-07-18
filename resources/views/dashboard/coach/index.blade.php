@extends('layouts.dashboard.base')
@section('pageTitle', 'Coaches')
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
                            {{ Breadcrumbs::render('web_index_coaches') }}
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
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Birthday</th>
                                            <th>Age</th>
                                            <th>Address1</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->username() }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->country }}</td>
                                                <td>{{ $user->state }}</td>
                                                <td>{{ $user->city }}</td>
                                                <td>{{ $user->dob }}</td>
                                                <td>{{ $user->age }}</td>
                                                <td>{{ $user->address1 }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('web_edit_coach', $user) }}" type="button"
                                                            class="btn btn-default btn-flat">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="{{ route('web_show_coach', $user) }}" type="button"
                                                            class="btn btn-default btn-flat">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form method="post"
                                                            action="{{ route('web_delete_coach', $user->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" onclick="deletefunc(this)" class="btn btn-default btn-flat"><i
                                                                    class="fas fa-trash"></i> </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Birthday</th>
                                            <th>Age</th>
                                            <th>Address1</th>
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
@endsection
