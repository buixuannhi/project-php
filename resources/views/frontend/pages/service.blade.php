@extends('frontend.layouts.master')

@section('content')

<main>
    <!-- Breadcrumb section -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
        style="background-image: url({{ asset('assets/frontend') }}/img/bg/breadcrumb-01.jpg);">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1>Our Services</h1>
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><i class="far fa-angle-double-right"></i></li>
                    <li>Services</li>
                </ul>
            </div>
        </div>
        <h1 class="big-text">
            Services
        </h1>
    </section>
    <!-- Breadcrumb section End-->
    <!-- Why Choose US start -->
    <section class="wcu-section section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- Section Title -->
                    <div class="section-title">
                        <span class="title-top">Why Choose Us</span>
                        <h1>Since1990 We Provides <br> Professional Service</h1>
                    </div>
                    <div class="feature-accordion accordion" id="featureAccordion">
                        @foreach ($faqs as $faq)
                        <div class="card">
                            <div class="card-header ">
                                <button type="button" class="active-accordion" data-toggle="collapse"
                                    data-target="#feature-{{ $loop->iteration }}">
                                    {{ $faq->question }} ?
                                    <span class="open-icon"><i class="far fa-eye-slash"></i></span>
                                    <span class="close-icon"><i class="far fa-eye"></i></span>
                                </button>
                            </div>
                            <div id="feature-{{ $loop->iteration }}"
                                class="collapse {{ $loop->iteration == 1 ? 'show' : '' }}"
                                data-parent="#featureAccordion">
                                <div class="card-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="feature-accordion-img text-right">
                        <img src="{{ asset('assets/frontend') }}/img/tile-gallery/03.jpg" alt="Image">
                        <div class="degin-shape">
                            <div class="shape-one">
                                <img src="{{ asset('assets/frontend') }}/img/shape/11.png" alt="Shape">
                            </div>
                            <div class="shape-two">
                                <img src="{{ asset('assets/frontend') }}/img/shape/12.png" alt="Shape">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Choose US End -->
    <!-- Service Section Start -->
    <section class="service-section section-padding section-bg">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center">
                <span class="title-top">Our Services</span>
                <h1>We Provide Most Exclusive <br> Hotel & Room Services </h1>
            </div>

            <!-- Service Boxes -->
            <div class="row">
                <!-- SingleBox -->
                @foreach ($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="single-service-box service-white-bg text-center">
                        <span class="service-counter">{{ $service->position }}</span>
                        <div class="service-icon">
                            <img src="{{ asset("uploads/services/$service->image") }}" alt="Icon" class="first-icon">
                            <img src="{{ asset("uploads/services/$service->image") }}" alt="Hover Icon"
                                class="second-icon">
                        </div>
                        <h4>{{ $service->title }}t</h4>
                        <p>{{ $service->content }}</p>
                        <a href="" class="read-more">Read more <i class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Service Section End -->
    <!-- CounterUp -->
    <section class="counter-up primary-bg" style="background-image: url(assets/img/bg/counter-bg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box style-two">
                        <div class="fact-icon">
                            <img src="{{ asset('assets/frontend') }}/img/icons/07.png" alt="Icon">
                        </div>
                        <p class="fact-num"><span class="counter-number">506</span></p>
                        <p>Luxury Appartment</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box style-two">
                        <div class="fact-icon">
                            <img src="{{ asset('assets/frontend') }}/img/icons/08.png" alt="Icon">
                        </div>
                        <p class="fact-num"><span class="counter-number">352</span></p>
                        <p>Modern Bedroom</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box style-two">
                        <div class="fact-icon">
                            <img src="{{ asset('assets/frontend') }}/img/icons/09.png" alt="Icon">
                        </div>
                        <p class="fact-num"><span class="counter-number">420</span></p>
                        <p>Win Int Awards</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box style-two">
                        <div class="fact-icon">
                            <img src="{{ asset('assets/frontend') }}/img/icons/10.png" alt="Icon">
                        </div>
                        <p class="fact-num"><span class="counter-number">653</span>k</p>
                        <p>Cup Of coffee</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CounterUp End -->
    <!-- Feedback section start -->
    <section class="feedback-section-two section-padding">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center">
                <span class="title-top">Clients Feedback</span>
                <h1>Our Satisfaction People Say <br> About Our Services</h1>
            </div>
            <div class="feedback-slider-two" id="feedSliderTWo">
                @foreach ($feedbacks as $feedback)
                <div class="single-feedback-slide">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="client-big-img">
                                <img src="{{ asset('assets/frontend') }}/img/man-image/01.jpg" alt="Clients">
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <div class="feedback-desc">
                                <div class="feedback-client-desc d-flex align-items-center">
                                    <div class="client-img">
                                        <img src="{{ asset('assets/frontend') }}/img/man-image/man-small-01.png"
                                            alt="Clients">
                                    </div>
                                    <div class="client-name">
                                        <h3>{{ $feedback->name }}</h3>
                                    </div>
                                </div>
                                <p>{{ $feedback->message }}</p>
                                <span class="quote-icon"><img src="{{ asset('assets/frontend') }}/img/icons/quote.png"
                                        alt="quote"></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Feedback section End -->
    <!-- Brands section start -->
    @includeIf('frontend.layouts.brand')
    <!-- Brands section End -->
</main>

@endsection
