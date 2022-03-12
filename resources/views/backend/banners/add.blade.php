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
            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 px-3">
                            {{-- Title --}}
                            <div class="form-group">
                                <label for="name">Title :</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text" id="title"
                                    name="title" value="{{ old('title') }}" autofocus placeholder="Title ...">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Image --}}
                            <div class="form-group">
                                <label for="banner_image">Choose Image :</label>
                                <input class="form-control-file d-block" type="file" id="category_image"
                                    name="banner_image">
                                @error('banner_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Preview Image --}}
                            <div class="my-2">
                                <img id="image-show" style="padding: 10px 10px 10px 0;" width="70%"
                                    style="display: none">
                            </div>
                            {{-- Position --}}
                            <div class="form-group">
                                <label for="position">Position: </label>
                                <select class="form-control" name="position" id="position">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 px-3">
                            <div class="form-group">
                                <label for="status">Status: </label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Show</option>
                                    <option value="0">Hide</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="content">Description: </label>
                                <textarea style="height: 100px" class="form-control" name="content"
                                    placeholder="Content ...">
                                </textarea>
                                @error('content')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" class="btn btn-info btn-lg mx-3">
                        Add New Banner !
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection

@section('script-option')
@includeIf('backend.layouts.preview-input-selected')
@endsection
