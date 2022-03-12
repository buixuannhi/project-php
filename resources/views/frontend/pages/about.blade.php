@extends('frontend.layouts.master')

@section('content')

<main>
    <!-- Breadcrumb section -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
        style="background-image: url({{ asset('assets/frontend') }}/img/bg/breadcrumb-01.jpg);">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1>About Us</h1>
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><i class="far fa-angle-double-right"></i></li>
                    <li>About us</li>
                </ul>
            </div>
        </div>
        <h1 class="big-text">
            About
        </h1>
    </section>
    <!-- Breadcrumb section End-->
    <!-- About Welcome Area -->
    <section class="about-site section-padding">
        <div class="container">
            <!-- Section Title Start -->
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title text-right">
                        <span class="title-top with-border">About Us</span>
                        <h1>Welcome To Avson <br> Modern Hotel Room <br> Sells Services</h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="mb-30">
                        But I must explain you how all this mistaken idea denounci pleasure and praising pain was
                        born and I will give you a comount of the system, and expound the actual teachin
                        reatexplorer of the truth, theter-builder of human happiness one rejdislikes, or avoids
                        pleasure itself
                    </p>
                    <p>
                        Will give you a comount of the system, and expound the actual teachin reatexplorer of the
                        truth, theter-builder of human happiness
                    </p>
                </div>
            </div>
            <!-- Section Title End -->
            <div class="about-img bg-image-center"
                style="background-image: url({{ asset('assets/frontend') }}/img/about/01.jpg);"></div>
            <div class="row no-gutters">
                <div class="offset-xl-1 col-xl-5 col-md-6">
                    <div class="about-text-box section-bg">
                        <h2>An Professional Hotel, Living Service Provider Company</h2>
                        <p>But must explain you how all this mistaken idea deno
                            asure and praising pain was born and will give comous
                            of the system, and expound the actual teachin reatexp
                            lorer of the truth, theter-builder human happine one
                            rejdislikes, or avoids pleasure itself</p>
                        <a href="#" class="btn filled-btn">Get Started <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="offset-lg-1 col-lg-5 col-md-6">
                    <div class="counter">
                        <div class="row">
                            <div class="col-6">
                                <div class="counter-box">
                                    <img src="{{ asset('assets/frontend') }}/img/icons/building.png" alt="">
                                    <span class="counter-number">{{ $total_room }}</span>
                                    <p>Luxury Apartment</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="counter-box">
                                    <img src="{{ asset('assets/frontend') }}/img/icons/trophy.png" alt="">
                                    <span class="counter-number">{{ $total_service }}</span>
                                    <p>Services</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Welcome Area End -->
    <section class="our-mission section-padding pb-0">
        <div class="container">
            <div class="section-title text-center">
                <span class="title-top">Our Mission</span>
                <h1>Modern Hotel & Room For <br> Luxury Living </h1>
            </div>
            <div class="row">
                @foreach ($new_blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="mission-box">
                        <div class="mission-bg bg-img-center"
                            style="background-image: url({{ asset("uploads/blog/$blog->image") }});">
                        </div>
                        <div class="mission-desc">
                            <h4>{{ $blog->title }}</h4>
                            <p>{{ Str::limit($blog->title, 150, '...') }}</p>
                            <a href="{{ route('user.blog_details', $blog->slug) }}" class="read-more">Read More <i
                                    class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Feature Section Start -->
    <section class="feature-section section-padding">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center">
                <span class="title-top">Popular Features</span>
                <h1>Explore Our Hotels Benefits <br> Why Take Our Services?</h1>
            </div>
            <div class="row">
                @foreach ($benefits as $benefit)
                <div class="col-lg-4 col-md-6">
                    <!-- Single feature boxes -->
                    <div class="single-feature-box text-center">
                        <div class="feature-icon">
                            <img width="80px" src="{{ asset("uploads/services/$benefit->image") }}" alt="Icon">
                        </div>
                        <h4>{{ $benefit->title }}</h4>
                        <p>{{ $benefit->content }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Feature section end -->
    <!-- Feedback Section start -->
    <section class="feedback-section section-padding section-bg">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center">
                <span class="title-top">Clients Feedback</span>
                <h1>Our Satisfaction People Say <br> About Our Services </h1>
            </div>
            <div class="feadback-slide row" id="feedbackSlideActive">
                @foreach ($feedbacks as $feedback)
                <div class="col-lg-6">
                    <div class="single-feedback-box">
                        <p>{{$feedback->message}}.</p>
                        <h5 class="feedback-author">{{$feedback->name}}</h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Feedback Section end -->
    <!-- Brands section start -->
    @includeIf('frontend.layouts.brand')
    <!-- Brands section End -->
</main>
@endsection
