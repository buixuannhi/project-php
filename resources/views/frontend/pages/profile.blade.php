@extends('frontend.layouts.master')

@section('css-option')

<style>
    .input-avatar {
        background-color: #fff;
        border: 2px solid #dfe9f4;
        height: 45px;
        font-weight: 600;
        color: #0f172b;
        font-size: 14px;
        padding: 0;
        border-radius: 5px;
        width: 100%;
        line-height: 35px;
    }

    input::placeholder {
        font-size: 14px;
    }
</style>

@endsection

@section('content')

<main>
    <section class="room-details-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Room Details -->
                    <div class="room-details">
                        <div class="entry-header">
                            <div class="post-thumb position-relative">
                                <h2 class="entry-title">Personal Profile</h2>
                            </div>
                            <div class="room-details-tab">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <ul class="nav desc-tab-item" role="tab-list">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#info" role="tab"
                                                    data-toggle="tab">Information</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#location" role="tab" data-toggle="tab">Change
                                                    Password</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-9">
                                        @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show mx-5" role="alert">
                                            <strong class="mr-3">Success
                                                !</strong>{{ Session::get('success') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @elseif (Session::has('error'))
                                        <div class="alert alert-danger alert-dismissible fade show mx-5" role="alert">
                                            <strong class="mr-3">Error
                                                !!!</strong>{{ Session::get('error') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <div class="tab-content desc-tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active show" id="info">
                                                <h5 class="tab-title d-inline-block ml-5">Your Information</h5>
                                                <a href="{{ route('order_history') }}"
                                                    class="btn btn-warning px-2 py-1 float-right"><i
                                                        class="fas fa-file-invoice"></i> Your
                                                    orders</a>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="profile-picture p-4">
                                                            @if ($user->avatar)
                                                            <img class="show-avt"
                                                                src="{{ asset('uploads/avatars').'/'.$user->avatar }}"
                                                                alt="Avatar">
                                                            @else
                                                            <img class="show-avt"
                                                                src="https://www.seekpng.com/png/full/245-2454602_tanni-chand-default-user-image-png.png"
                                                                alt="Avatar">
                                                            @endif
                                                            <form method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('put')
                                                                <div class="form-group">
                                                                    <label for="avatar">Choose New Avatar</label>
                                                                    <input type="file"
                                                                        class="form-control-file input-avatar"
                                                                        name="image_avt" id="avatar">
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label for="name">Name
                                                                <sup>*</sup></label>
                                                            <input type="text" class="form-control" name="name"
                                                                placeholder="Enter email"
                                                                value="{{ $user->name ?? old('name') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email
                                                                <sup>*</sup></label>
                                                            <input type="email" class="form-control" id="email"
                                                                name="email" placeholder="Enter email"
                                                                value="{{ $user->email ?? old('email') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone">Phone
                                                                <sup>*</sup></label>
                                                            <input type="text" class="form-control" id="phone"
                                                                name="phone" placeholder="Enter phone"
                                                                value="{{ $user->phone ?? old('phone') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address">Address
                                                                <sup>*</sup></label>
                                                            <input type="text" class="form-control" id="address"
                                                                name="address" placeholder="Enter address"
                                                                value="{{ $user->address ?? old('address') }}">
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary px-3 py-2 my-2">Update</button>
                                                        </form>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="location">
                                                <h5 class="tab-title text-center">Change Your Password</h5>
                                                <div class="row mt-3">
                                                    <div class="col-lg-3"></div>
                                                    <div class="col-lg-6">
                                                        <form action="{{ route('user.change_password') }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="old_password">Old Password
                                                                    <sup>*</sup></label>
                                                                <input type="password" class="form-control"
                                                                    name="old_password" placeholder="Old Password">
                                                                @error('old_password')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="new_password">New Password
                                                                    <sup>*</sup></label>
                                                                <input type="password" class="form-control"
                                                                    name="password" placeholder="New Password">
                                                                @error('password')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="cf_password">Confirm Password
                                                                    <sup>*</sup></label>
                                                                <input type="password" class="form-control"
                                                                    name="password_confirmation"
                                                                    placeholder="Confirm Password">
                                                                @error('password_confirmation')
                                                                <span class="invalid-feedback d-block" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <button type="submit"
                                                                class="btn btn-primary px-3 py-2 my-2">Change
                                                                Password</button>
                                                        </form>
                                                    </div>
                                                    <div class="col-lg-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="reviews">
                                            <h5 class="tab-title">Reviews</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@section('script-option')

{{-- Preview Avatar --}}

<script>
    $('.input-avatar').change(function (e) {

        var file = e.originalEvent.srcElement.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            $('.show-avt').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    });

</script>
@endsection
