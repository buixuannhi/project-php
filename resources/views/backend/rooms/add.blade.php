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
            <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 px-3">
                            {{-- Name --}}
                            <div class="form-group">
                                <label for="name">Name :</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                    name="name" value="{{ old('name') }}" autofocus>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Slug --}}
                            <div class="form-group">
                                <label for="slug">Url :</label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text" id="slug"
                                    name="slug" value="{{ old('slug') }}">
                                @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Image --}}
                            <div class="form-group">
                                <label for="room_avatar">Choose Image :</label>
                                <input class="form-control-file d-block" type="file" id="room_avatar"
                                    name="room_avatar">
                                @error('room_avatar')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="my-4">
                                <img id="image-show" style="padding: 18px 10px 10px 0;" width="70%"
                                    style="display: none">
                            </div>
                            {{-- Bed --}}
                            <div class="form-group">
                                <label for="bed">Bed :</label>
                                <input type="number" id="bed" name="bed" class="form-control" value="{{ old('bed') }}">
                                @error('bed')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Bath --}}
                            <div class="form-group">
                                <label for="bath">Bath :</label>
                                <input type="number" id="bath" name="bath" class="form-control"
                                    value="{{ old('bath') }}">
                                @error('bath')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Area --}}
                            <div class="form-group">
                                <label for="bath">Area :</label>
                                <input type="number" id="area" name="area" class="form-control"
                                    value="{{ old('area') }}">
                                @error('area')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 px-3">
                            {{-- Price --}}
                            <div class="form-group">
                                <label for="price">Price :</label>
                                <input class="form-control @error('price') is-invalid @enderror" type="number"
                                    id="price" name="price" value="{{ old('price') }}">
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Sale Price --}}
                            <div class="form-group">
                                <label for="sale_price">Sale Price :</label>
                                <input class="form-control @error('sale_price') is-invalid @enderror" type="number"
                                    id="sale_price" name="sale_price" value="{{ old('sale_price') }}">
                                @error('sale_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Image Detail --}}
                            <div class="form-group">
                                <label for="image_details">Choose Image Detail :</label>
                                <input class="form-control-file d-block" type="file" id="image_details"
                                    name="image_details[]" multiple>
                                @error('image_details')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <div class="image-show-detail" style="
                                    display: flex;
                                    flex-wrap: wrap;
                                    align-content: center;
                                    justify-content: space-evenly;
                                "></div>
                            </div>
                            {{-- Quantity --}}
                            <div class="form-group">
                                <label for="quantity">Quantity :</label>
                                <input class="form-control @error('quantity') is-invalid @enderror" type="number"
                                    id="quantity" name="quantity" value="{{ old('quantity') }}">
                                @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Category --}}
                            <div class="form-group">
                                <label for="category">Category: </label>
                                <select class="form-control" name="category_id" id="category">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Status --}}
                            <div class="form-group">
                                <label for="status">Status: </label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Show</option>
                                    <option value="0">Hide</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <label for="summernote">Description: </label>
                            <textarea class="form-control" name="description" id="summernote">
                            </textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <button type="submit" class="btn btn-info btn-lg mx-3">
                    Add New Room !
                </button>
            </form>
        </div>
    </div>
</main>

@endsection

@section('script-option')
<!-- Compiled Slug -->
<script src="{{ asset('assets/backend/js/slug.js') }}"></script>
@includeIf('backend.layouts.preview-input-selected')
@endsection
