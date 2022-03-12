@extends('frontend.layouts.master')

@section('content')

<main>
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
        style="background-image: url({{ asset('assets/frontend') }}/img/bg/breadcrumb-02.jpg);">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1>404</h1>
                <h3>OOPS!! PAGE NOT FOUND !</h3>
                <div class="text-center">
                    <a href="{{ route('home') }}" class="btn filled-btn">Back to home</a>
                    <a href="{{ route('user.category') }}" class="btn filled-btn btn-other">View all rooms</a>
                </div>
            </div>
        </div>
        <h1 class="big-text">
            404
        </h1>
    </section>
</main>

@endsection
