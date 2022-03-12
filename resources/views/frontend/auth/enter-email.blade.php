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
                        @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <form action="{{ route('user.send_mail_reset') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-control-input">
                                        <div class="input-wrap">
                                            <input type="text" name="email" placeholder="Your Email"
                                                value="{{ old('email') }}">
                                            <i class="far fa-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn filled-btn">Reset Password</button>
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
