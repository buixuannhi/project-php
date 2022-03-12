@extends('backend.layouts.master')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <div class="row mb-2 mb-xl-3 mx-2">
            <div class="col-auto d-none d-sm-block">
                <h3><strong>{{ $page }}</strong></h3>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('coupons.update', $coupon_edit->id) }}" method="POST">
                @csrf
                @method('put')
                <input type="hidden" name="id" value="{{ $coupon_edit->id }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 px-3">
                            {{-- Code --}}
                            <div class="form-group">
                                <label for="code">Code :</label>
                                <input class="form-control @error('code') is-invalid @enderror" type="text" id="code"
                                    name="code" value="{{ old('code') ?? $coupon_edit->code }}" autofocus>
                                @error('code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Limit --}}
                            <div class="form-group">
                                <label for="limit">Limit :</label>
                                <input class="form-control @error('limit') is-invalid @enderror" type="number"
                                    id="limit" name="limit" value="{{ old('limit') ?? $coupon_edit->limit }}">
                                @error('limit')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Percent --}}
                            <div class="form-group">
                                <label for="percent">Percent :</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">%</span>
                                    <input class="form-control @error('percent') is-invalid @enderror" type="number"
                                        id="percent" name="percent"
                                        value="{{ old('percent') ?? $coupon_edit->percent }}">
                                </div>
                                @error('percent')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Lowest Price --}}
                            <div class="form-group">
                                <label for="min_price">Lowest Price :</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input class="form-control @error('min_price') is-invalid @enderror" type="number"
                                        id="min_price" name="min_price"
                                        value="{{ old('min_price') ?? $coupon_edit->min_price }}">
                                </div>
                                @error('min_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 px-3">
                            <div class="form-group">
                                <label>Start Time <sup>*</sup>
                                </label>
                                <input type="text" name="start_time" id="start-date-picker" class="form-control"
                                    value="{{ old('start_time') ?? $start_time }}">
                                @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>End Time <sup>*</sup>
                                </label>
                                <input type="text" name="end_time" id="end-date-picker" class="form-control"
                                    value="{{ old('end_time') ?? $end_time }}">
                                @error('end_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Status --}}
                            <div class="form-group">
                                <label for="status">Status: </label>
                                <select class="form-control" name="status" id="status">
                                    <option {{ $coupon_edit->status == 1 ? 'selected': '' }} value="1">Show</option>
                                    <option {{ $coupon_edit->status == 0 ? 'selected': '' }} value="0">Hide</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" class="btn btn-warning btn-lg mx-1 my-3">
                        Update Coupon !
                    </button>
                </div>
            </form>
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
        // var startDepart = moment();
        // var startArrive = moment().add(10, "days");

        // var startDepart = "{{ $start_time }}";
        // var startArrive = "{{ $end_time }}";

        var startDepart = $("#start-date-picker").val();
        var startArrive = $("#end-date-picker").val();

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
