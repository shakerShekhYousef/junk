@extends('layouts.dashboard.base')
@section('pageTitle', 'Membership Bios')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Membership Bios</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('packages.index') }}
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
                                <h3 class="card-title">All Membership Bios</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            {{-- <th>Type</th> --}}
                                            <th>Cost</th>
                                            <th>Valid for</th>
                                            <th>Image</th>
                                            <th>Sessions count</th>
                                            <th>Barcode</th>
                                            <th>Sku</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $package)
                                            <tr>
                                                <td>{{ $package->name }}</td>
                                                {{-- @if ($package->type == 1)
                                                    <td>One time package</td>
                                                @elseif ($package->type == 2)
                                                    <td>Monthly recuring package</td>
                                                @elseif ($package->type == 3)
                                                    <td>3 Monthly recuring package</td>
                                                @elseif ($package->type == 4)
                                                    <td>6 Monthly recuring package</td>
                                                @elseif ($package->type == 5)
                                                    <td> 1 Year recuring package</td>
                                                @elseif ($package->type == 6)
                                                    <td>1 Class package</td>
                                                @elseif ($package->type == 7)
                                                    <td>5 Class package</td>
                                                @elseif ($package->type == 8)
                                                    <td> 30 Class package</td>
                                                @elseif ($package->type == 9)
                                                    <td> 3 Class package</td>
                                                @endif --}}
                                                <td>{{ $package->cost }} {{ $package->cost_type }}</td>
                                                <td>{{ $package->valid_for_value }} {{ $package->valid_for_type }}</td>
                                                <td>
                                                    <img src="{{ asset($package->image) }}" width="100" height="100">
                                                </td>
                                                <td>{{ $package->sessions_count }}</td>
                                                {{-- @if ($package->sessions !== null)
                                                <td>
                                                    <table>
                                                        <tbody>
                                                        @foreach ($package->sessions as $session)
                                                            <tr>
                                                                <td>{{ $session->classm->name }}
                                                                    {{ $session->start_time }}
                                                                    {{ $session->end_time }}</td>
                                                            </tr>
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </td>

                                            @else
                                                <td>Empty</td>
                                            @endif --}}
                                                <td>
                                                    <img src="{{ $package->barcode }}" width="100" height="100">
                                                </td>
                                                <td>{{ $package->sku }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('packages.edit', $package->id) }}" type="button"
                                                            class="btn btn-default btn-flat">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="{{ route('packages.show', $package->id) }}" type="button"
                                                            class="btn btn-default btn-flat">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form method="post"
                                                            action="{{ route('packages.destroy', $package->id) }}">
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
                                            {{-- <th>Type</th> --}}
                                            <th>Cost</th>
                                            <th>Valid for</th>
                                            <th>Image</th>
                                            <th>Sessions count</th>
                                            <th>Barcode</th>
                                            <th>Sku</th>
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
