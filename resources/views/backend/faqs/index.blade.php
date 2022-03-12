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
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="d-inline-block my-0" style="line-height: 35px">DataTable Question & Answers</h5>
                        <div class="action float-end">
                            <a href="{{ route('faqs.create') }}" class="btn btn-outline-success mx-3"><i
                                    class="fas fa-plus m-1"></i>Add New</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @includeIf('backend.layouts.alert')
                                @if(count($faqs) == 0)
                                <div class="alert alert-warning alert-dismissible fade show p-3" role="alert">
                                    <span>No any faqs here !</span>
                                </div>
                                @else
                                {{-- Show All faqs --}}
                                <table class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Position</th>
                                            <th>Status</th>
                                            <th width="16%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faqs as $faq)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>
                                                <p>
                                                    {{ Str::limit($faq->question, 40, '...') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ Str::limit($faq->answer, 70, '...') }}
                                                </p>
                                            </td>
                                            <td>{{$faq->position}}</td>
                                            <td>
                                                @if($faq->status == 1)
                                                <span class="badge bg-success">Show</span>
                                                @else
                                                <span class="badge bg-secondary">Hide</span>
                                                @endif
                                            </td>
                                            <td width="15%">
                                                <a class="btn btn-info m-1" href="{{ route('faqs.edit', $faq->id) }}"
                                                    role="button"><i class="fas fa-pen"></i></a>
                                                <form class="d-inline-block"
                                                    action="{{ route('faqs.destroy', $faq->id ) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        onclick="return confirm('Are you sure to take this action?')"
                                                        class="btn btn-danger m-1" type="submit"><i
                                                            class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination -->
                                <div class="row">
                                    @if(count($faqs) >= 3)
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info my-2">
                                            <p>Showing {{ $faqs->firstItem() }} to {{ $faqs->lastItem() }} of
                                                {{$faqs->total()}} entries</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="float-end">
                                            {{ $faqs->withQueryString()->links() }}
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</main>

@endsection
