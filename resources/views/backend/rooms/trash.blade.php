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
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Enter room name ..." value="{{ request()->name }}">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="status" class="form-control">
                                    <option>Choose status</option>
                                    <option {{ request()->status === 1 ? 'selected' : '' }} value="1">Show</option>
                                    <option {{ request()->status === 0 ? 'selected' : '' }} value="0">Hide</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                @includeIf('backend.layouts.alert')
                @if(count($rooms_trash) <= 0) <div class="alert alert-info alert-dismissible fade show p-3"
                    role="alert">
                    <span class="me-3">No rooms have been deleted yet !</span>
                    <a href="{{ route('rooms.index') }}">All Rooms.</a>
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
                        <th>Information</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('rooms.action') }}" method="POST">
                        @csrf
                        @foreach ($rooms_trash as $room)
                        <tr>
                            <th width="5%">
                                <div class="form-check">
                                    <input style="margin-left: -1.1em;" value="{{ $room->id }}" id="select-all"
                                        name="id-{{ $room->id }}" class="form-check-input" type="checkbox">
                                </div>
                            </th>
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                <p>
                                    <a class="text-dark" href="{{ route('rooms.show', $room->id) }}">
                                        <strong>Name</strong>: {{ $room->name }}
                                    </a>
                                </p>
                                <p><strong>Category</strong>: {{ $room->category->name }}</p>
                                <p><strong>Bed</strong>: {{ $room->bed}}</p>
                                <p><strong>Bath</strong>: {{ $room->bath}}</p>
                                <p><strong>Area</strong>: {{ $room->area }}</p>
                            </td>
                            <td><img width="150px" src="{{ asset("uploads/rooms/room_avatar/$room->image") }}"
                                    alt="{{ $room->name }}">
                            </td>
                            <td>
                                @if ($room->sale_price > 0)
                                <p class="text-decoration-line-through">
                                    <del>{{ number_format($room->price, 2, ',') }}$</del>
                                </p>
                                <p>{{ number_format($room->sale_price, 2, ',') }}$</p>
                                @else
                                <p>{{ number_format($room->price, 2, ',') }}$</p>
                                @endif
                            </td>
                            <td>
                                @if($room->status == 1)
                                <span class="badge badge-success">Show</span>
                                @else
                                <span class="badge badge-secondary">Hide</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
            <div class="action text-left my-4">
                {{-- Restore and Delete --}}
                <button type="submit" name="action" value="restore" class="btn btn-success m-1">Restore
                    <i class="fa fa-undo mx-1"></i></button>
                <button type="submit" name="action" value="delete" class="btn btn-danger m-1">Delete
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
@endsection
