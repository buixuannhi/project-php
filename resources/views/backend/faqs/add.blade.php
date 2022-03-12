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
            <form action="{{ route('faqs.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 px-3">
                            {{-- Question --}}
                            <div class="form-group">
                                <label for="question">Question :</label>
                                <textarea style="height: 80px" class="form-control" name="question"
                                    placeholder="Question ...">{{ old('question') }}</textarea>
                                @error('question')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Position --}}
                            <div class="form-group">
                                <label for="position">Position: </label>
                                <input class="form-control @error('position') is-invalid @enderror" type="number"
                                    id="position" name="position" value="{{ old('position') }}"
                                    placeholder="Position ...">
                                @error('position')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 px-3">
                            {{-- Answers --}}
                            <div class="form-group">
                                <label for="answer">Answers: </label>
                                <textarea style="height: 80px" class="form-control" name="answer"
                                    placeholder="Answer ...">{{ old('answer') }}</textarea>
                                @error('answer')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- Status --}}
                            <div class="form-group">
                                <label for="status">Status: </label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Show</option>
                                    <option value="0">Hide</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="submit" class="btn btn-info btn-lg mx-1">
                        Add New Faq !
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
