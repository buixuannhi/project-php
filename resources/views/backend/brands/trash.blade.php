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
                                        placeholder="Enter brand name ..." value="{{ request()->name }}">
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
                @if(count($brands_trash) == 0)
                <div class="alert alert-info alert-dismissible fade show p-3" role="alert">
                    <span class="me-3">No brands have been deleted yet !</span>
                    <a href="{{ route('brands.index') }}">All brands !</a>
                </div>
            </div>
            @else
            <div class="soft-delete bg-light text-center mb-5 pb-2">
                <table class="table table-striped table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input style="margin-left: -1.1em;" value="checked" id="select-all"
                                        name="select-all" class="form-check-input" type="checkbox">
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Position</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('brands.action') }}" method="POST">
                            @csrf
                            @foreach ($brands_trash as $brand)
                            <tr>
                                <th width="5%">
                                    <div class="form-check">
                                        <input style="margin-left: -1.1em;" value="{{ $brand->id }}"
                                            id="select-position-{{ $brand->id }}" name="id-{{ $brand->id }}"
                                            class="form-check-input" type="checkbox">
                                    </div>
                                </th>
                                <th>
                                    <p>{{ $loop->iteration }}</p>
                                </th>
                                <td>
                                    <p>{{ Str::limit($brand->name, 25, '...') }}</p>
                                </td>
                                <td>
                                    <img class="w-50" src="{{ asset('uploads/brands') . '/' . $brand->image  }}"
                                        alt="{{ $brand->name }}">
                                </td>
                                <th>
                                    <p>{{ $brand->position }}</p>
                                </th>
                                <td>
                                    @if($brand->status == 1)
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
                    <button onclick="return confirm('Are you sure to take this action ?')" type="submit" name="action"
                        value="restore" class="btn btn-success m-1">Restore
                        <i class="fa fa-undo mx-1"></i></button>
                    <button onclick="return confirm('Are you sure to take this action ?')" type="submit" name="action"
                        value="delete" class="btn btn-danger m-1">Delete
                        <i class="fa fa-trash m-1"></i>
                    </button>
                    </form>
                    {{-- End form --}}
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</main>

@endsection

@section('script-option')
@includeIf('backend.layouts.select-input')
@endsection
