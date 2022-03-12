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
                                        placeholder="Enter category name ..." value="{{ request()->name }}">
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
                @if(count($categories_trash) == 0)
                <div class="alert alert-info alert-dismissible fade show p-3" role="alert">
                    <span class="me-3">No blog categories have been deleted yet !</span>
                    <a href="{{ route('blog-categories.index') }}">All blog categories !</a>
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
                            <th>Url</th>
                            <th>Image</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories_trash as $category)
                        <tr>
                            <form action="{{ route('blog_categories.action') }}" method="POST">
                                @csrf
                                <th width="5%">
                                    <div class="form-check">
                                        <input style="margin-left: -1.1em;" value="{{ $category->id }}"
                                            id="select-position-{{ $category->id }}" name="id-{{ $category->id }}"
                                            class="form-check-input" type="checkbox">
                                    </div>
                                </th>
                                <th>{{ $loop->iteration }}</th>
                                <td>
                                    <p>
                                        <a class="text-dark" href="">
                                            <strong>Name</strong>: {{ $category->name }}
                                        </a>
                                    </p>
                                </td>
                                <td>
                                    <p>{{ $category->slug }}</p>
                                </td>
                                <td><img width="150px" src="{{ asset("uploads/blog-categories/$category->image") }}"
                                        alt="{{ $category->name }}">
                                </td>
                                <td>
                                    @if($category->status == 1)
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
                        <i class="fa fa-trash m-1"></i></button>
                    </form>
                </div>
                <div>
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
