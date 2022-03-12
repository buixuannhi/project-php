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
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="Banner title ..." value="{{ request()->title }}">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <select name="position" class="form-control">
                                        <option>Position</option>
                                        <option {{ request()->position === 1 ? 'selected' : '' }} value="1">1</option>
                                        <option {{ request()->position === 2 ? 'selected' : '' }} value="2">2</option>
                                        <option {{ request()->position === 3 ? 'selected' : '' }} value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option>Status</option>
                                        <option {{ request()->status === 1 ? 'selected' : '' }} value="1">Show</option>
                                        <option {{ request()->status === 0 ? 'selected' : '' }} value="0">Hide</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                @includeIf('backend.layouts.alert')
                @if(count($banners_trash) == 0)
                <div class="alert alert-info alert-dismissible fade show p-3" role="alert">
                    <span class="me-3">No banners have been deleted yet !</span>
                    <a href="{{ route('banners.index') }}">All banners !</a>
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
                            <th>Title</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th>Position</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners_trash as $banner)
                        <tr>
                            <form action="{{ route('banners.action') }}" method="POST">
                                @csrf
                                <th width="5%">
                                    <div class="form-check">
                                        <input style="margin-left: -1.1em;" value="{{ $banner->id }}"
                                            id="select-position-{{ $banner->id }}" name="id-{{ $banner->id }}"
                                            class="form-check-input" type="checkbox">
                                    </div>
                                </th>
                                <th>{{ $loop->iteration }}</th>
                                <td>
                                    <p>
                                        {{ $banner->title }}
                                    </p>
                                </td>
                                <td><img width="150px" src="{{ asset("uploads/banners/$banner->image") }}"
                                        alt="{{ $banner->title }}">
                                </td>
                                <td>
                                    <p>{{ Str::limit($banner->content, 30, '...') }}</p>
                                </td>
                                <td>{{$banner->position}}</td>
                                <td>
                                    @if($banner->status == 1)
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
