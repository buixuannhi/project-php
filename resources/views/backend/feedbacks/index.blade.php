@extends('backend.layouts.master')

@section('css-option')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

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
                            <div class="row my-3">
                                <div class="form-group col-md-3">
                                    <label>Start Date <sup>*</sup>
                                    </label>
                                    <input type="text" name="start_date" id="start-date-picker" class="form-control"
                                        value="{{ request()->start_date ?? old('start_date') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>End Date <sup>*</sup>
                                    </label>
                                    <input type="text" name="end_date" id="end-date-picker" class="form-control"
                                        value="{{ request()->end_date ?? old('end_date') }}">
                                </div>
                                <div class="col-md-2 justify-content-center"
                                    style="display: inline-grid; align-content: center;">
                                    <button type="submit" class="btn btn-info">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="d-inline-block my-0" style="line-height: 35px">DataTable Feedbacks</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @includeIf('backend.layouts.alert')
                                @if (count($feedbacks) == 0)
                                <div class="alert alert-warning alert-dismissible fade show p-3" role="alert">
                                    <span>No any feedbacks here !</span>
                                </div>
                                @else
                                {{-- Show All feedbacks --}}
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th width="18%">Name</th>
                                            <th width="20%">Email</th>
                                            <th width="15%">Phone</th>
                                            <th width="30%">Message</th>
                                            <th width="10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($feedbacks as $feedback)
                                        <tr>
                                            <td><b>{{ $loop->iteration }}</b></td>
                                            <td>{{ $feedback->name }}</td>
                                            <td>{{ $feedback->email }}</td>
                                            <td>{{ $feedback->phone }}</td>
                                            <td>{{ Str::limit($feedback->message, 100, '...') }}</td>
                                            <td>
                                                <select id="feedback-{{ $feedback->id }}"
                                                    onchange="onChangeStatus({{ $feedback->id }})" name="status"
                                                    class="{{ statusClass($feedback->status) }}">
                                                    <option class="bg-secondary" value="0"
                                                        {{ $feedback->status == 0 ? 'selected' : '' }}>
                                                        Hide
                                                    </option>
                                                    <option class="bg-success" value="1"
                                                        {{ $feedback->status == 1 ? 'selected' : '' }}>
                                                        Show
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info my-2">
                                            <p>Showing {{ $feedbacks->firstItem() }} to
                                                {{ $feedbacks->lastItem() }}
                                                of
                                                {{ $feedbacks->total() }} entries</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="float-end">
                                            {{ $feedbacks->withQueryString()->links() }}
                                        </div>
                                    </div>
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

<script>
    // Date Picker
        $(function() {
            var start_date = moment().subtract(10, "days");
            var end_date = moment();

            // Check session date exits
            var start = $('#start-date-picker').val();
            if (!start) {
                start = start_date;
            }

            var end = $('#end-date-picker').val();
            if (!end) {
                end = end_date;
            }

            $("#start-date-picker").daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePickerSeconds: false,
                startDate: start,
                locale: {
                    format: "M/DD/Y hh:mm A",
                },
            });

            $("#end-date-picker").daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePickerSeconds: false,
                startDate: end,
                locale: {
                    format: "M/DD/Y hh:mm A",
                },
            });
        });

        // Change Status Feedback
        function onChangeStatus(feedback_id) {

            // Get status select
            const status = $(`#feedback-${feedback_id}`).val();
            // Call ajax change status
            const url = "/admin/update-status-feedbacks/" + feedback_id;
            const _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "PUT",
                url: url,
                data: {
                    status: status,
                    _token: _token
                },
                success: function(res) {
                    console.log(res);
                    if (res.message) {
                        $(`#feedback-${feedback_id}`).attr('class', res.class);
                    }
                },
                error: function(res) {
                    console.log(res);
                }
            });
        }
</script>
@endsection
