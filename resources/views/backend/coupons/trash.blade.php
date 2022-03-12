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
            {{-- Search --}}
            <div class="col-md-12">
                <div class="card px-3 pt-3">
                    <form method="GET">
                        <div class="row my-3">
                            <div class="col-md-2">
                                <label>Code <sup>*</sup></label>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ request()->name }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Start Date <sup>*</sup>
                                    </label>
                                    <input type="text" name="start_time" id="start-date-picker" class="form-control"
                                        value="{{ request()->start_time ?? old('start_time') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Arrive Date <sup>*</sup>
                                    </label>
                                    <input type="text" name="end_time" id="end-date-picker" class="form-control"
                                        value="{{ request()->end_time ?? old('end_time') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status <sup>*</sup></label>
                                    <select name="status" class="form-control">
                                        <option {{ request()->status === 1 ? 'selected' : '' }} value="1">Show
                                        </option>
                                        <option {{ request()->status === 0 ? 'selected' : '' }} value="0">Hide
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 justify-content-center"
                                style="display: inline-grid; align-content: center;">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                @includeIf('backend.layouts.alert')
                @if(count($coupons_trash) <= 0) <div class="alert alert-info alert-dismissible fade show p-3"
                    role="alert">
                    <span class="me-3">No coupons have been deleted yet !</span>
                    <a href="{{ route('coupons.index') }}">All coupons.</a>
            </div>
        </div>
        @else
        <div class="soft-delete bg-light text-center mb-5 pb-2">
            <table class="table table-striped table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>
                            <div class="form-check">
                                <input style="margin-left: -1.1em;" value="checked" id="select-all" name="select-all"
                                    class="form-check-input" type="checkbox">
                            </div>
                        </th>
                        <th>No.</th>
                        <th>Code</th>
                        <th>Limit</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Percent</th>
                        <th>Min Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('coupons.action') }}" method="POST">
                        @csrf
                        @foreach ($coupons_trash as $coupon)
                        <tr>
                            <th width="5%">
                                <div class="form-check">
                                    <input style="margin-left: -1.1em;" value="{{ $coupon->id }}" id="select-all"
                                        name="id-{{ $coupon->id }}" class="form-check-input" type="checkbox">
                                </div>
                            </th>
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                <p>{{ $coupon->code }}</p>
                            </td>
                            <td>
                                <p>{{ $coupon->limit }}</p>
                            </td>
                            <td>
                                <p>{{ dateComment($coupon->start_time) }}</p>
                            </td>
                            <td>
                                <p>{{ dateComment($coupon->end_time) }}</p>
                            </td>
                            <td>
                                <p>{{ moneyFormat($coupon->percent) }}%</p>
                            </td>
                            <td>
                                <p>${{ moneyFormat($coupon->min_price) }}</p>
                            </td>
                            <td>
                                @if ($coupon->status == 1)
                                <span class="badge bg-success">Show</span>
                                @else
                                <span class="badge bg-secondary">Hide</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="action text-left my-4">
                {{-- Restore and Delete --}}
                <button type="submit" onclick="return confirm('Are you sure to take this action ?')" name="action"
                    value="restore" class="btn btn-success m-1">Restore
                    <i class="fa fa-undo mx-1"></i></button>
                <button type="submit" onclick="return confirm('Are you sure to take this action ?')" name="action"
                    value="delete" class="btn btn-danger m-1">Delete
                    <i class="fa fa-trash m-1"></i></button>
                </form>
            </div>
        </div>
        @endif
    </div>
    </div>
</main>

@endsection

@section('script-option')
@includeIf('backend.layouts.select-input')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
    // Date Picker
    $(function() {
        var startDepart = moment().subtract(10, "days");
        var startArrive = moment();

        $("#start-date-picker").daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePickerSeconds: false,
            startDate: startDepart,
            locale: {
                format: "M/DD/Y hh:mm A",
            },
        });

        $("#end-date-picker").daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            timePickerSeconds: false,
            startDate: startArrive,
            locale: {
                format: "M/DD/Y hh:mm A",
            },
        });
    });
</script>
@endsection
