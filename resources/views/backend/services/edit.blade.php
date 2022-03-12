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
            <form action="{{ route('services.update', $service_edit->id ) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 px-3">
                            {{-- Title --}}
                            <div class="form-group">
                                <label for="name">Title :</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text" id="title"
                                    name="title" value="{{ old('title') ?? $service_edit->title }}" autofocus
                                    placeholder="Title ...">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Image --}}
                            <div class="form-group">
                                <label for="service_image">Choose Image :</label>
                                <input class="form-control-file d-block" type="file" id="category_image"
                                    name="service_image">
                                @error('service_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Preview Image --}}
                            <div class="my-2">
                                <img id="image-show" style="padding: 10px 10px 10px 0;" width="30%"
                                    src="{{ asset("uploads/services/$service_edit->image")  }}"
                                    alt="{{ $service_edit->title }}">
                            </div>
                            {{-- Position --}}
                            <div class="form-group">
                                <label for="position">Position: </label>
                                <input class="form-control @error('position') is-invalid @enderror" type="number"
                                    id="position" name="position"
                                    value="{{ old('position') ?? $service_edit->position }}" placeholder="Position ...">
                            </div>
                        </div>
                        <div class="col-lg-6 px-3">
                            {{-- Price --}}
                            <div class="form-group">
                                <label for="price">Price: </label>
                                <input class="form-control @error('price') is-invalid @enderror" type="number"
                                    id="price" name="price" value="{{ old('price') ?? $service_edit->price }}"
                                    placeholder="Price ...">
                            </div>
                            {{-- Status --}}
                            <div class="form-group">
                                <label for="status">Status: </label>
                                <select class="form-control" name="status" id="status">
                                    <option {{ $service_edit->status == 1 ? 'selected' : '' }} value="1">
                                        Show</option>
                                    <option {{ $service_edit->status == 0 ? 'selected' : '' }} value="0">
                                        Hide</option>
                                </select>
                            </div>
                            {{-- Content --}}
                            <div class="form-group">
                                <label for="content">Content: </label>
                                <textarea style="height: 80px" class="form-control" name="content"
                                    placeholder="Content ...">{{ $service_edit->content }}
                                </textarea>
                                @error('content')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" class="btn btn-warning btn-lg mx-1">
                        Update Service !
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
