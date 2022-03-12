@extends('backend.layouts.master')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>{{ $page }}</strong></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card px-3 pt-3">
                    <form method="GET">
                        <div class="row my-3">
                            <div class="form-group col-md-3">
                                <label>Depart Date <sup>*</sup>
                                </label>
                                <input type="text" name="depart_date" id="depart-date-picker" class="form-control"
                                    value="{{ request()->depart_date ?? old('depart_date') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Arrive Date <sup>*</sup>
                                </label>
                                <input type="text" name="arrive_date" id="arrive-date-picker" class="form-control"
                                    value="{{ request()->arrive_date ?? old('arrive_date') }}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Status<sup>*</sup>
                                </label>
                                <select name="status" class="form-control w-100">
                                    <option {{ request()->status == 0 ? 'selected' : '' }} value="0">Unpaid</option>
                                    <option {{ request()->status == 1 ? 'selected' : '' }} value="1">Paid</option>
                                    <option {{ request()->status == 2 ? 'selected' : '' }} value="2">Cancelled
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2 justify-content-center"
                                style="display: inline-grid; align-content: center;">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title line-height-40">DataTable Orders</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                {{-- Success --}}
                                <div class="show-success d-none">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong class="message-success">Update status order number $id success
                                            !</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                {{-- Error --}}
                                <div class="show-error d-none">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong class="message-error">Update status order error !</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                {{-- List Order --}}
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th width="20%">Name</th>
                                            <th width="20%">Depart Date</th>
                                            <th width="20%">Arrive Date</th>
                                            <th width="10%">Total</th>
                                            <th width="18%">Status</th>
                                            <th width="20%">Payment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($orders) == 0)
                                        <div class=" alert alert-warning alert-dismissible fade show p-3" role="alert">
                                            <span>No any orders here !</span>
                                        </div>
                                        @else
                                        @foreach ($orders as $order)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $order->user->name }}</td>
                                            <td>{{ date('g:iA jS F Y', strtotime($order->depart_date)) }}</td>
                                            <td>{{ date('g:iA jS F Y', strtotime($order->arrive_date)) }}</td>
                                            <td>${{ number_format($order->total_amount, 2, ',') }}</td>
                                            <td>
                                                <select id="order-{{ $order->id }}"
                                                    onchange="onChangeStatus({{ $order->id }})" name="status"
                                                    class="{{ statusClass($order->status) }}">
                                                    <option class="bg-secondary" value="0"
                                                        {{ 0 < $order->status ? 'disabled' : '' }}
                                                        {{ $order->status == 0 ? 'selected' : '' }}>
                                                        Unpaid
                                                    </option>
                                                    <option class="bg-success" value="1"
                                                        {{ 1 < $order->status ? 'disabled' : '' }}
                                                        {{ $order->status == 1 ? 'selected' : '' }}>
                                                        Paid
                                                    </option>
                                                    <option class="bg-danger" value="2"
                                                        {{ $order->status == 2 ? 'selected' : '' }}>
                                                        Cancelled
                                                    </option>
                                                </select>
                                            </td>
                                            <td>{{ $order->payment->name }}</td>
                                            <td><a href="{{ route('backend.order.detail', $order->id) }}"
                                                    class="btn btn-success">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info my-2">
                                    <p>Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of
                                        {{ $orders->total() }} entries</p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="float-end">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</main>

@endsection

@section('script-option')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
    // Date Picker
        $(function() {
            var startDepart = moment().subtract(10, "days");
            var startArrive = moment();

            // Check session date exits
            var depart_date = $('#depart-date-picker').val();
            if (!depart_date) {
            depart_date = startDepart;
            }

            var arrive_date = $('#arrive-date-picker').val();
            if (!arrive_date) {
            arrive_date = startArrive;
            }

            $("#depart-date-picker").daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePickerSeconds: false,
                startDate: depart_date,
                locale: {
                    format: "M/DD/Y hh:mm A",
                },
            });

            $("#arrive-date-picker").daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePickerSeconds: false,
                startDate: arrive_date,
                locale: {
                    format: "M/DD/Y hh:mm A",
                },
            });
        });

        function onChangeStatus(order_id) {

            const check = confirm('Are you sure you want to change this order status ?');

            if (check) {
                // Get value select
                const value = $(`#order-${order_id}`).val();

                // Call ajax change status
                const url = "/admin/orders/update/" + order_id;
                const _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "PUT",
                    url: url,
                    data: {
                        status: value,
                        _token: _token
                    },
                    success: function(res) {
                        if (res.message) {
                            alert(res.message);
                            $(`#order-${order_id}`).attr('class', res.class);
                        }
                    },
                    error: function(res) {
                        alert(res.message);
                    }
                });
            }
        }
</script>

@endsection
