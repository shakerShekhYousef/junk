@extends('layouts.dashboard.base')
@section('pageTitle', 'Order details')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{ Breadcrumbs::render('web_get_order_info_by_id', $data['id']) }}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Order details</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="GET" action="{{ route('web_get_orders_info') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="order_data_1">Order id</label>
                                            <input id="order_data_1" value="{{ $data['order_id'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_2" class="mt-3">Member</label>
                                            <input id="order_data_2" value="{{ $data['member'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_3" class="mt-3">Package</label>
                                            <input id="order_data_3" value="{{ $data['package'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_4" class="mt-3">Cost</label>
                                            <input id="order_data_4" value="{{ $data['cost'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_5" class="mt-3">Currency</label>
                                            <input id="order_data_5" value="{{ $data['currency'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_6" class="mt-3">Order date</label>
                                            <input id="order_data_6" value="{{ $data['order_date'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_7" class="mt-3">Order type</label>
                                            <input id="order_data_7" value="{{ $data['order_type'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_8" class="mt-3">Payment mode</label>
                                            <input id="order_data_8" value="{{ $data['payment_mode'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_9" class="mt-3">Card name</label>
                                            <input id="order_data_9" value="{{ $data['card_name'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_10" class="mt-3">Billing name</label>
                                            <input id="order_data_10" value="{{ $data['billing_name'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_11" class="mt-3">Billing address</label>
                                            <input id="order_data_11" value="{{ $data['billing_address'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_12" class="mt-3">Billing city</label>
                                            <input id="order_data_12" value="{{ $data['billing_city'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_13" class="mt-3">Billing state</label>
                                            <input id="order_data_13" value="{{ $data['billing_state'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_14" class="mt-3">Billing zip</label>
                                            <input id="order_data_14" value="{{ $data['billing_zip'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_15" class="mt-3">Billing country</label>
                                            <input id="order_data_15" value="{{ $data['billing_country'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_16" class="mt-3">Billing tel</label>
                                            <input id="order_data_16" value="{{ $data['billing_tel'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_17" class="mt-3">Billing email</label>
                                            <input id="order_data_17" value="{{ $data['billing_email'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_18" class="mt-3">Delivery name</label>
                                            <input id="order_data_18" value="{{ $data['delivery_name'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_19" class="mt-3">Delivery address</label>
                                            <input id="order_data_19" value="{{ $data['delivery_address'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_20" class="mt-3">Delivery city</label>
                                            <input id="order_data_20" value="{{ $data['delivery_city'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_21" class="mt-3">Delivery state</label>
                                            <input id="order_data_21" value="{{ $data['delivery_state'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_22" class="mt-3">Delivery zip</label>
                                            <input id="order_data_22" value="{{ $data['delivery_zip'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_23" class="mt-3">Delivery country</label>
                                            <input id="order_data_23" value="{{ $data['delivery_country'] }}" type="text"
                                                class="form-control" readonly>
                                            <label for="order_data_24" class="mt-3">Delivery tel</label>
                                            <input id="order_data_24" value="{{ $data['delivery_tel'] }}" type="text"
                                                class="form-control" readonly>
                                        </div>
                                        <input type="submit" value="Back" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
