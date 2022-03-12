@extends('frontend.auth.master')

@section('content')

<main>
    <section class="breadcrumb-page d-flex align-items-center position-relative bg-img-center"
        style="background-image: url('{{asset('assets/frontend')}}/img/bg/hero-bg-4.jpg');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                    <div class="main-page">
                        <div class="logo text-center">
                            <img src="{{asset('assets/frontend')}}/img/logo-transparent.png" alt="Image" width="160"
                                height="34">
                        </div>
                        <hr>
                        <form action="{{ route('user.handle_register') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-control-input">
                                        <div class="input-wrap">
                                            <input type="text" placeholder="Your Full Name" name="name"
                                                value="{{ old('name') }}">
                                            <i class="far fa-user-alt"></i>
                                        </div>
                                        @error('name')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-control-input">
                                        <div class="input-wrap">
                                            <input type="text" placeholder="Your Email" name="email"
                                                value="{{ old('email') }}">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-control-input">
                                        <div class="input-wrap">
                                            <input type="text" placeholder="Your Phone" name="phone"
                                                value="{{ old('phone') }}">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        @error('phone')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-control-input">
                                        <div class="input-wrap">
                                            <input type="password" placeholder="Password" name="password">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-control-input">
                                        <div class="input-wrap">
                                            <input type="password" placeholder="Confirm Password"
                                                name="password_confirmation">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                        @error('password_confirmation')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn filled-btn">Register</button>
                                </div>
                                <div class="col-12 text-center">
                                    <a href="{{ route('user.show_login_form') }}" type="button"
                                        class="btn filled-btn btn-other">Sign In</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>

@endsection
