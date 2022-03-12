@extends('frontend.auth.master')

@section('content')

<main>
    <section class="breadcrumb-page d-flex align-items-center position-fixed bg-img-center"
        style="background-image: url('{{ asset('assets/frontend') }}/img/bg/hero-bg-4.jpg');">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                    <div class="main-page">
                        <div class="logo text-center">
                            <img src="{{ asset('assets/frontend') }}/img/logo-transparent.png" alt="Image" width="160"
                                height="34">
                        </div>
                        <hr>
                        <form action="{{ route('user.handle_reset_password') }}" method="POST">
                            @csrf
                            <div class="row">
                                {{-- <input type="hidden" name="user_id" value="{{ $id }}"> --}}
                                <div class="col-12">
                                    <div class="form-control-input">
                                        <div class="input-wrap">
                                            <input type="password" placeholder="Password" name="password">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-control-input">
                                        <div class="input-wrap">
                                            <input type="password" placeholder="Confirm Password"
                                                name="password_confirmation">
                                            <i class="fa fa-lock"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn filled-btn">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
