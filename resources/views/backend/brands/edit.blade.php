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
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search_name" id="name"
                                        placeholder="Enter category name ..." value="{{ request()->search_name }}">
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <select name="status" class="form-control">
                                    <option {{ request()->status == 1 ? 'selected' : '' }} value="1">
                                        Show</option>
                                    <option {{ request()->status == 0 ? 'selected' : '' }} value="0">
                                        Hide</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-primary">
                    <div class="px-4 py-2 bg-light border">
                        <h3 class="card-title my-2">Update brand</h3>
                    </div>
                    <form action="{{ route('brands.update', $brand_update->id ) }}" method="POST"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            @method('put')
                            {{-- Name --}}
                            <input type="hidden" name="id" value="{{ $brand_update->id }}">
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                    name="name" value="{{ old('name') ?? $brand_update->name }}" autofocus>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Image --}}
                            <div class="form-group">
                                <label for="brand_image">Choose Image :</label>
                                <input class="form-control-file d-block" type="file" id="category_image"
                                    name="brand_image">
                                @error('brand_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Preview Image --}}
                            <div class="my-2">
                                <img id="image-show" style="padding: 10px 10px 10px 0;" width="50%"
                                    src="{{ asset("uploads/brands/$brand_update->image")  }}"
                                    alt="{{ $brand_update->name }}">
                            </div>
                            {{-- Position --}}
                            <div class="form-group">
                                <label for="position">Position: </label>
                                <input class="form-control @error('position') is-invalid @enderror" type="number"
                                    id="position" name="position"
                                    value="{{ old('position') ?? $brand_update->position }}" placeholder="Position ...">
                                @error('position')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Status --}}
                            <label for="status">Status: </label>
                            <select class="form-control" name="status" id="status">
                                <option {{ (old('status') ?? $brand_update->status == 1) ? 'selected' : '' }} value="1">
                                    Show</option>
                                <option {{( old('status') ?? $brand_update->status == 0) ? 'selected' : '' }} value="0">
                                    Hide</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-warning mt-2">
                                Update Brand !
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <section class="content-page">
                    @includeIf('backend.layouts.alert')
                    <div class="card">
                        <div class="px-4 py-2 bg-light border">
                            <h3 class="card-title d-inline-block my-2">DataTable brands</h3>
                            <div class="action float-end">
                                <a href="{{ route('brands.trash') }}" class="btn btn-outline-danger"><i
                                        class="fa fa-trash m-1"></i>Trash</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped table-hover table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="20%">Name</th>
                                        <th width="20%">Image</th>
                                        <th width="10%">Position</th>
                                        <th>Status</th>
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($brands) == 0)
                                    <div class="alert alert-warning p-3" role="alert">No any brands here !
                                    </div>
                                    @else
                                    @foreach ($brands as $brand)
                                    <tr>
                                        <th>
                                            <p>{{ $loop->iteration }}</p>
                                        </th>
                                        <td>
                                            <p>{{ Str::limit($brand->name, 25, '...') }}</p>
                                        </td>
                                        <td>
                                            <img class="w-75" src="{{ asset('uploads/brands') . '/' . $brand->image  }}"
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
                                        <td>
                                            <a class="btn btn-info" href="{{ route('brands.edit', $brand->id) }}"
                                                role="button"><i class="fas fa-pen"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('brands.destroy', $brand->id ) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button onclick="return confirm('Are you sure to take this action ?')"
                                                    class="btn btn-danger" type="submit">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="col-md-12 my-3">
                                <!-- Pagination -->
                                {{-- @if(count($brands) >= 3)  --}}
                                <div class="dataTables_info d-inline-block my-2">
                                    <p>Showing {{ $brands->firstItem() }} to
                                        {{ $brands->lastItem() }} of
                                        {{$brands->total()}} entries</p>
                                </div>
                                <div class="float-end">
                                    {{ $brands->withQueryString()->links() }}
                                </div>
                                {{-- @endif --}}
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
</main>

@endsection

@section('script-option')
<script src="{{ asset('assets/backend/js/slug.js') }}"></script>
@includeIf('backend.layouts.preview-input-selected')
@endsection
