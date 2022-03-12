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
                        <form action="{{ route('user.handle_login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-control-input">
                                        <div class="input-wrap">
                                            <input type="text" placeholder="Your Email" name="email">
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
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn filled-btn">Sign In</button>
                                </div>
                                <div class="col-12">
                                    <div class="form-checkbox">
                                        <input type="checkbox" class="custom-checkbox" id="remember_me"
                                            name="remember_me" checked>
                                        <label class="form-control-label" for="remember_me">Remember me</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="small">
                            <a href="{{ route('user.forgot_password') }}" class="small-text">Forgot password!</a>
                            <a href="{{ route('user.show_register_form') }}" class="small-text float-right">I don't have
                                account!</a>
                        </p>
                        <div class="divider"><span>Or</span></div>
                        <a href="#0" class="social_bt facebook">
                            <i class="fab fa-facebook-f"></i>
                            Login with Facebook</a>
                        <a href="#0" class="social_bt google">
                            <i class="fab fa-google"></i>
                            Login with Google</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>

@endsection
