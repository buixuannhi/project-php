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
                    <div class="card-header bg-light">
                        <h3 class="card-title line-height-40 d-inline-block" style="line-height: 30px;">Edit Category
                        </h3>
                        <a href="{{ route('blog-categories.index') }}" class="btn btn-outline-secondary float-end"><i
                                class="fas fa-plus mr-2"></i>
                            Add New</a>
                    </div>
                    <form action="{{ route('blog-categories.update', $category_update->id ) }}" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{ $category_update->id }}">
                        <div class="card-body">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input class="form-control @error('name') error @enderror" type="text" id="name"
                                    name="name" value="{{ old('name') ?? $category_update->name }}" autofocus>
                            </div>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="slug">Url :</label>
                                <input class="form-control @error('slug') error @enderror" type="text" id="slug"
                                    name="slug" value="{{ old('slug') ?? $category_update->slug }}">
                            </div>
                            @error('slug')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            {{-- Image --}}
                            <div class="form-group">
                                <label for="category_image">Choose Image :</label>
                                <input class="form-control-file" type="file" id="category_image" name="category_image">
                                @error('category_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="my-2">
                                <img id="image-show" style="padding: 10px 10px 10px 0;" width="70%"
                                    src="{{ asset('uploads/blog-categories') . '/' . $category_update->image  }}"
                                    alt="{{ $category_update->name }}">
                            </div>
                            <label for="status">Status: </label>
                            <select class="form-control" name="status" id="status">
                                <option {{ $category_update->status === 1 ? 'selected' : '' }} value="1">Show</option>
                                <option {{ $category_update->status === 0 ? 'selected': '' }} value="0">Hide</option>
                            </select>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-warning mt-2">
                                Update data !
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8">
                <section class="content-page">
                    @includeIf('backend.layouts.alert')
                    <div class="card">
                        <div class="card-header bg-light">
                            <h3 class="card-title">DataTable Blog Categories</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped table-hover table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th width="5%">STT</th>
                                        <th width="20%">Name</th>
                                        <th width="20%">Url</th>
                                        <th width="20%">Image</th>
                                        <th width="10%">Status</th>
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($categories) == 0)
                                    <div class=" alert alert-warning alert-dismissible fade show" role="alert">
                                        <span>No any blog categories here !</span>
                                    </div>
                                    @else
                                    @foreach ($categories as $category)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>
                                            <p>{{ Str::limit($category->name, 25, '...') }}</p>
                                        </td>
                                        <td>
                                            <p>{{ Str::limit($category->slug, 25, '...') }}</p>
                                        </td>
                                        <td><img class="w-100"
                                                src="{{ asset('uploads/blog-categories') . '/' . $category->image  }}"
                                                alt="{{ $category->name }}"></td>
                                        <td>
                                            @if($category->status == 1)
                                            <span class="badge bg-success">Show</span>
                                            @else
                                            <span class="badge bg-secondary">Hide</span>
                                            @endif
                                        <td>
                                            <a class="btn btn-info"
                                                href="{{ route('blog-categories.edit', $category->id) }}"
                                                role="button"><i class="fas fa-pen"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('blog-categories.destroy', $category->id ) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button onclick="return confirm('Are you sure to take this action ?')"
                                                    class="btn btn-danger" type="submit">
                                                    <i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="col-lg-12 col-md-7">
                                <!-- Pagination -->
                                <div class="dataTables_info d-inline-block my-2">
                                    <p>Showing {{ $categories->firstItem() }} to
                                        {{ $categories->lastItem() }} of
                                        {{$categories->total()}} entries</p>
                                </div>
                                <div class="float-end">
                                    {{ $categories->withQueryString()->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
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
