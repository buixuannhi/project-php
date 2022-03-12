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
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="d-inline-block my-0" style="line-height: 35px">DataTable coupons</h5>
                        <div class="action float-end">
                            <a href="{{ route('coupons.create') }}" class="btn btn-outline-success mx-3"><i
                                    class="fas fa-plus mr-2"></i>Add New</a>
                            <a href="{{ route('coupons.trash') }}" class="btn btn-outline-danger"><i
                                    class="fa fa-trash m-1"></i>Trash</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @includeIf('backend.layouts.alert')
                                @if (count($coupons) == 0)
                                <div class="alert alert-warning alert-dismissible fade show p-3" role="alert">
                                    <span>No any coupons here !</span>
                                </div>
                                @else
                                {{-- Show All Coupons --}}
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Code</th>
                                            <th>Limit</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Percent</th>
                                            <th width="15%">Minimum Price</th>
                                            <th>Status</th>
                                            <th width="16%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)
                                        <tr>
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
                                                @if ($coupon->checkExpirationDate())
                                                <span class="badge bg-primary my-1">Alive</span>
                                                @else
                                                <span class="badge bg-secondary my-1">Expired</span>
                                                @endif

                                                @if ($coupon->status == 1)
                                                <span class="badge bg-success my-1">Show</span>
                                                @else
                                                <span class="badge bg-secondary my-1">Hide</span>
                                                @endif
                                            </td>
                                            <td width="15%">
                                                <a class="btn btn-info m-1"
                                                    href="{{ route('coupons.edit', $coupon->id) }}" role="button"><i
                                                        class="fas fa-pen"></i></a>
                                                <form class="d-inline-block"
                                                    action="{{ route('coupons.destroy', $coupon->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        onclick="return confirm('Are you sure to take this action?')"
                                                        class="btn btn-danger m-1" type="submit"><i
                                                            class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="row">
                                    @if(count($coupons) >= 3)
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info my-2">
                                            <p>Showing {{ $coupons->firstItem() }} to
                                                {{ $coupons->lastItem() }} of
                                                {{ $coupons->total() }} entries</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="float-end">
                                            {{ $coupons->withQueryString()->links() }}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif
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
