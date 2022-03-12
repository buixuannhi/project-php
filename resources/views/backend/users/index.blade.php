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
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter user Name" value="{{ request()->name }}">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option>Status</option>
                                        <option {{ request()->status === 1 ? 'selected' : '' }} value="1">Show
                                        </option>
                                        <option {{ request()->status === 0 ? 'selected' : '' }} value="0">Hide
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="d-inline-block my-0" style="line-height: 35px">DataTable Users</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @includeIf('backend.layouts.alert')
                                @if (count($users) == 0)
                                <div class="alert alert-warning alert-dismissible fade show p-3" role="alert">
                                    <span>No any users here !</span>
                                </div>
                                @else
                                {{-- Show All Users --}}
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Avatar</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th width="11%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td><img class="w-50" src="{{ asset("uploads/avatars/$user->avatar") }}"
                                                    alt="Avatar">
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>
                                                <select id="user-{{ $user->id }}"
                                                    onchange="onChangeStatus({{ $user->id }})" name="status"
                                                    class="{{ statusClass($user->status) }}">
                                                    <option class="bg-secondary" value="0"
                                                        {{ $user->status == 0 ? 'selected' : '' }}>
                                                        Block
                                                    </option>
                                                    <option class="bg-success" value="1"
                                                        {{ $user->status == 1 ? 'selected' : '' }}>
                                                        Active
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
                                            <p>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }}
                                                of
                                                {{ $users->total() }} entries</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="float-end">
                                            {{ $users->withQueryString()->links() }}
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
<script>
    function onChangeStatus(order_id) {

            const check = confirm('Are you sure you want to change this user status ?');

            if (check) {
                const status = $(`#user-${order_id}`).val();

                // Call ajax change status
                // route('backend.user.update_status')

                const url = "/admin/users/update-status/" + order_id;
                const _token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "PUT",
                    url: url,
                    data: {
                        status: status,
                        _token: _token
                    },
                    success: function(res) {
                        if (res.message) {
                            alert(res.message);
                            $(`#user-${order_id}`).attr('class', res.class);
                        }
                    },
                    error: function(res) {
                        console.log(res);
                    }
                });
            }
        }
</script>
@endsection
