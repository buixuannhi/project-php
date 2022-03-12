@extends('frontend.layouts.master')

@section('css-option')
<style>
    .contact-box {
        font-size: 22px;
    }
</style>
@endsection

@section('content')

<main>
    <!-- Hero Section Start -->
    @includeIf('frontend.layouts.banner')
    <!-- End Hero Section -->
    <!-- Book Form Start -->
    <section class="booking-section">
        <div class="container">
            <div class="booking-form-wrap bg-img-center section-bg">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="home" value="true">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="input-wrap">
                                <select name="room_id" id="room">
                                    @foreach ($all_rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="input-wrap">
                                <input type="text" placeholder="Depart Date" name="depart_date" id="depart-date-picker"
                                    autocomplete="off">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="input-wrap">
                                <input type="text" placeholder="Arrive Date" name="arrive_date" id="arrive-date-picker"
                                    autocomplete="off">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="input-wrap">
                                <select name="children" id="children">
                                    <option value="children">Children</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="input-wrap">
                                <select name="adult" id="adult">
                                    <option value="adult">Adult</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="input-wrap">
                                <button type="submit" class="btn filled-btn btn-block">
                                    Book now <i class="far fa-long-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="booking-shape-1">
                    <img src="{{ asset('assets/frontend') }}/img/shape/01.png" alt="shape">
                </div>
                <div class="booking-shape-2">
                    <img src="{{ asset('assets/frontend') }}/img/shape/02.png" alt="shape">
                </div>
                <div class="booking-shape-3">
                    <img src="{{ asset('assets/frontend') }}/img/shape/03.png" alt="shape">
                </div>
            </div>
        </div>
    </section>
    <!-- Book Form End -->
    <!-- Welcome section start -->
    <section class="welcome-section section-padding">
        <div class="container">
            <div class="row align-items-center no-gutters">
                <!-- Tile Gallery -->
                <div class="col-lg-6">
                    <div class="tile-gallery">
                        <img src="{{ asset('assets/frontend') }}/img/tile-gallery/01.jpg" alt="Tile Gallery">
                        <div class="tile-gallery-content">
                            <div class="tile-icon">
                                <img src="{{ asset('assets/frontend') }}/img/icons/hostel-hover.png" alt="">
                            </div>
                            <h3>Luxury Interior</h3>
                            <p>Builder of human happiness. No one rejects dislikes or apleasure itself cause it is
                                pleasure, but
                                because</p>
                        </div>
                    </div>
                </div>
                <!-- End tile Gallery -->
                <div class="col-lg-5 offset-lg-1">
                    <!-- Section Title -->
                    <div class="section-title">
                        <span class="title-top with-border">About Us</span>
                        <h1>Welcome To Avson Modern Hotel Room Sells Services</h1>
                        <p>But I must explain to you how all this mistaken idea denouncing
                            pleasure and praising pain was born and I will give you a complec
                            ount of the system, and expound the actual teachin reatexplorer of the truth, the
                            master-builder of
                            human happiness. No ways
                            one rejdislikes, or avoids pleasure itself, because</p>
                    </div>
                    <!-- counter up -->
                    <div class="counter">
                        <div class="row">
                            <div class="col-4">
                                <div class="counter-box wow fadeInLeft animated" data-wow-duration="1500ms"
                                    data-wow-delay="400ms">
                                    <img src="{{ asset('assets/frontend') }}/img/icons/building.png" alt="">
                                    <span class="counter-number">506</span>
                                    <p>Luxury Appartment</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="counter-box wow fadeInUp animated" data-wow-duration="1500ms"
                                    data-wow-delay="600ms">
                                    <img src="{{ asset('assets/frontend') }}/img/icons/hostel.png" alt="">
                                    <span class="counter-number">252</span>
                                    <p>Modern Bedroom</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="counter-box wow fadeInRight animated" data-wow-duration="1500ms"
                                    data-wow-delay="800ms">
                                    <img src="{{ asset('assets/frontend') }}/img/icons/trophy.png" alt="">
                                    <span class="counter-number">420</span>
                                    <p>Win Int Awards</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End counter -->
                </div>
            </div>
        </div>
    </section>
    <!-- Welcome section End -->
    <!-- Latest Room Section -->
    <section class="latest-room section-bg section-padding">
        <div class="container-fluid">
            <div class="row align-items-center no-gutters">
                <div class="col-lg-3">
                    <!-- Section Title -->
                    <div class="section-title">
                        <span class="title-top with-border">Latest Room</span>
                        <h1>Modern Hotel & Room For Luxury Living</h1>
                        <p>Ullam corporis suscipit laboriosam nisi ut aliqucoe modi consequatur Quis autem vel eum
                            iure repreh nderitqui in ea voluptate velit esse quam nihil molestiae </p>
                        <!-- Page Info -->
                        <div class="pagingInfo"></div>
                        <!-- Room Arrow -->
                        <div class="room-arrows"></div>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="row latest-room-slider" id="roomSliderActive">
                        @foreach ($rooms as $room)
                        <div class="col-lg-4">
                            <!-- Single Room -->
                            <div class="single-room">
                                <div class="room-thumb">
                                    <img src="{{ asset('uploads/rooms/room_avatar') }}/{{ $room->image }}" alt="Room">
                                </div>
                                <div class="room-desc">
                                    <div class="room-cat">
                                        <p>{{ $room->category->name }}</p>
                                    </div>
                                    <h4><a href="{{ route('user.room', $room->slug) }}">{{ $room->name }}</a>
                                    </h4>
                                    <p>
                                        {!! $room->description !!}
                                    </p>
                                    <ul class="room-info list-inline">
                                        <li><i class="far fa-bed"></i>{{ $room->bed }} Bed</li>
                                        <li><i class="far fa-bath"></i>{{ $room->bath }} Baths</li>
                                        <li><i class="far fa-ruler-triangle"></i>{{ $room->area }} m<sup>2</sup>
                                        </li>
                                    </ul>
                                    <div class="room-price">
                                        <p>${{ moneyFormat($room->sale_price) }}<del
                                                class="ml-2 text-secondary">${{ moneyFormat($room->price) }}</del>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Room Section Ends -->
    <!-- Service Section Start -->
    <section class="service-section section-padding">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center">
                <span class="title-top">Our Services</span>
                <h1>We Provide Most Exclusive <br> Hotel & Room Services </h1>
            </div>

            <!-- Service Boxes -->
            <div class="row">
                @foreach ($services as $service)
                <div class="col-lg-4 col-md-6">
                    <!-- SingleBox -->
                    <div class="single-service-box text-center wow fadeIn animated" data-wow-duration="1500ms"
                        data-wow-delay="400ms">
                        <span class="service-counter">{{ sprintf('%02d', $loop->iteration) }}</span>
                        <div class="service-icon">
                            <img src="{{ asset("uploads/services/$service->image") }}" alt="Icon" class="first-icon">
                        </div>
                        <h4>{{ $service->title }}</h4>
                        <p>{{ Str::limit($service->content, 130, '...') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Service Section End -->
    <!-- Call TO action start -->
    <section class="cta-section bg-img-center"
        style="background-image: url({{ asset('assets/frontend') }}/img/bg/cta-01.jpg);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-10">
                    <div class="cta-left-content">
                        <span>Looking For Luxury Hotel</span>
                        <h1>Booking Now</h1>
                        <a href="{{ route('home') }}" class="btn filled-btn">Booking now <i
                                class="far fa-long-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="video-icon text-right">
                        <a href="https://www.youtube.com/watch?v=X6iZrEfh_MA" class="video-popup">
                            <i class="fas fa-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call TO action end -->
    <!-- gallery Section Start -->
    <section class="ma-gallery-section section-padding">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center">
                <span class="title-top">Our Project</span>
                <h1>Let’s See Luxury Property <br> Insides Beautys </h1>
            </div>

            <!-- Gallery Start -->
            <div class="row">
                <div class="col-lg-6">
                    <!-- SingleBox -->
                    <div class="gallery-box bg-img-center big wow fadeIn animated" data-wow-duration="1500ms"
                        data-wow-delay="0ms"
                        style="background-image: url({{ asset('assets/frontend') }}/img/home-gallery/01.jpg);">
                        <div class="gallery-box-content">
                            <a href="#" class="view-more">
                                <i class="far fa-plus"></i>
                            </a>
                            <h3>Deluxe Rooms</h3>
                            <p>Couple Room Deluxe</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <!-- SingleBox -->
                            <div class="gallery-box bg-img-center semi-big wow fadeIn animated"
                                data-wow-duration="1500ms" data-wow-delay="400ms"
                                style="background-image: url({{ asset('assets/frontend') }}/img/home-gallery/02.jpg);">
                                <div class="gallery-box-content">
                                    <a href="#" class="view-more">
                                        <i class="far fa-plus"></i>
                                    </a>
                                    <h3>Deluxe Rooms</h3>
                                    <p>Couple Room Deluxe</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <!-- SingleBox -->
                            <div class="gallery-box bg-img-center small wow fadeIn animated" data-wow-duration="1500ms"
                                data-wow-delay="800ms"
                                style="background-image: url({{ asset('assets/frontend') }}/img/home-gallery/03.jpg);">
                                <div class="gallery-box-content">
                                    <a href="#" class="view-more">
                                        <i class="far fa-plus"></i>
                                    </a>
                                    <h3>Deluxe Rooms</h3>
                                    <p>Couple Room Deluxe</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <!-- SingleBox -->
                            <div class="gallery-box bg-img-center medium wow fadeIn animated" data-wow-duration="1500ms"
                                data-wow-delay="1200ms"
                                style="background-image: url({{ asset('assets/frontend') }}/img/home-gallery/04.jpg);">
                                <div class="gallery-box-content">
                                    <a href="#" class="view-more">
                                        <i class="far fa-plus"></i>
                                    </a>
                                    <h3>Deluxe Rooms</h3>
                                    <p>Couple Room Deluxe</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <!-- SingleBox -->
                            <div class="gallery-box bg-img-center medium wow fadeIn animated" data-wow-duration="1500ms"
                                data-wow-delay="1600ms"
                                style="background-image: url({{ asset('assets/frontend') }}/img/home-gallery/05.jpg);">
                                <div class="gallery-box-content">
                                    <a href="#" class="view-more">
                                        <i class="far fa-plus"></i>
                                    </a>
                                    <h3>Deluxe Rooms</h3>
                                    <p>Couple Room Deluxe</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- gallery Section End -->
    <!-- feature us start -->
    <section class="wcu-section section-bg section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 offset-lg-1">
                    <!-- Section Title -->
                    <div class="feature-left">
                        <div class="section-title">
                            <span class="title-top with-border">Why Choose Us</span>
                            <h1>We Care You & We Feel What’s Needs For Good Living</h1>
                        </div>
                        <ul class="feature-list">
                            <li class="wow fadeInUp animated" data-wow-duration="1000ms" data-wow-delay="0ms">
                                <div class="feature-icon"><i class="far fa-cocktail"></i></div>
                                <h4>Relex Living</h4>
                                <p>Dreat explorer of the truth, the master-builder of human happines one rejects,
                                    dislikes avoids</p>
                            </li>
                            <li class="wow fadeInUp animated" data-wow-duration="1000ms" data-wow-delay="200ms">
                                <div class="feature-icon"><i class="far fa-box-full"></i></div>
                                <h4>High Security System</h4>
                                <p>Procure him some great pleasure. To take a trivial example, which of us ever
                                    undertakes labor</p>
                            </li>
                            <li class="wow fadeInUp animated" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <div class="feature-icon"><i class="far fa-music"></i></div>
                                <h4>Such Events & Party</h4>
                                <p>Libero tempore, cum soluta nobis est eligenoptio cumque nihil impedit quo minus
                                    id quod </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="feature-img">
                        <div class="feature-abs-con">
                            <div class="f-inner">
                                <i class="far fa-stars"></i>
                                <p>Popular Features</p>
                            </div>
                        </div>
                        <img src="{{ asset('assets/frontend') }}/img/tile-gallery/02.jpg" alt="Image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature us end -->
    <!-- Feedback Section start -->
    <section class="feedback-section section-padding">
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
                        <p>{{ $feedback->message }}</p>
                        <h5 class="feedback-author">{{ $feedback->name }}</h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Feedback Section end -->
    <!-- Contact Section Start -->
    <section class="contact-section section-padding">
        <div class="container">
            <div class="row align-items-center no-gutters">
                <div class="col-lg-6">
                    <div id="gg-map" style="height: 530px; margin-top: 5px"></div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <!-- Section Title -->
                    <div class="section-title">
                        <span class="title-top with-border">Have A Coffee </span>
                        <h1>Don’t Hesitate To Contact With Us</h1>
                        <p>Provident, similique sunt in culpa qui officia deserunt mollitia animie est laborum et
                            dolorum fuga harum quidem</p>
                    </div>
{{--                    <div class="contact-box wow fadeInUp animated" data-wow-duration="1500ms" data-wow-delay="400ms">--}}
{{--                        <ul>--}}
{{--                            <li><i class="far fa-map-marker-alt"></i>{{ $info->address }}</li>--}}
{{--                            <input type="hidden" name="map" id="map" value="{{ $info->map }}">--}}
{{--                            <li>--}}
{{--                                <a href="#">--}}
{{--                                    <i class="far fa-envelope-open"></i>{{ $info->email }}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li><a href="#"><i class="far fa-phone"></i>{{ $info->phone }}</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    <!-- Brands section Start -->
    @includeIf('frontend.layouts.brand')
    <!-- ./ Brands section End -->
</main>

@endsection

@section('script-option')
<script>
    // Add to cart
        function addItemToCart() {
            const room_id = $("#room_id").val();
            const _token = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                type: "POST",
                url: `{{ route('cart.add') }}`,
                data: {
                    room_id: room_id,
                    quantity: 1,
                    home: true,
                    _token: _token,
                },
                success: function(res) {
                    const check = confirm(
                        "Add room to your cart successfully! Do you want to go to checkout ?"
                    );
                    if (check) {
                        window.location.replace(res.success);
                    }
                },
                error: function(res) {
                    console.log(res);
                },
            });
        }

        // Date Picker
        $(function() {
            var startDepart = moment();
            var startArrive = moment().add(5, "days");

            $("#depart-date-picker").daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePickerSeconds: false,
                startDate: startDepart,
                locale: {
                    format: "M/DD/Y hh:mm A",
                },
            });

            $("#arrive-date-picker").daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePickerSeconds: false,
                startDate: startArrive,
                locale: {
                    format: "M/DD/Y hh:mm A",
                },
            });
        });

        const input = document.getElementById("map").value;
        const latlngStr = input.split(",", 2);
        const myLatlng = {
            lat: parseFloat(latlngStr[0]),
            lng: parseFloat(latlngStr[1]),
        };

        function myMap() {
            var mapProp = {
                mapTypeId: google.maps.MapTypeId.TERRAIN,
                scrollwheel: false,

                center: new google.maps.LatLng(
                    myLatlng.lat,
                    myLatlng.lng
                ),
                zoom: 15,
            };
            var map = new google.maps.Map(
                document.getElementById("gg-map"),
                mapProp
            );

            var marker = new google.maps.Marker({
                map: map,
                position: map.getCenter(),
                title: "Click to zoom",
                animation: google.maps.Animation.BOUNCE,
            });

            marker.setMap(map);

            var infowindow = new google.maps.InfoWindow({
                content: "Welcome to BachKhoa-Aptech !",
            });

            infowindow.open(map, marker);
        }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFGZV7aczW8BFE53IKMt4DeiPWEFDCRwE&callback=myMap">
</script>
@endsection
