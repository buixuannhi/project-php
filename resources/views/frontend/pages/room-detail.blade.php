@extends('frontend.layouts.master')

@section('css-option')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
@endsection

@section('content')

<main>
    <!-- Breadcrumb section -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
        style="background-image: url({{ asset('assets/frontend') }}/img/blog/blog-breadcrumb.jpg);">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1>Room Details</h1>
                <ul class="list-inline">
                    <li><a href="">Home</a></li>
                    <li><i class="far fa-angle-double-right"></i></li>
                    <li>Room Details</li>
                </ul>
            </div>
        </div>
        <h1 class="big-text">
            Room
        </h1>
    </section>
    <!-- Breadcrumb section End-->
    <section class="room-details-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Room Details -->
                    <div class="room-details">
                        <div class="entry-header">
                            <div class="post-thumb position-relative">
                                <div class="post-thumb-slider">
                                    <div class="main-slider">
                                        @foreach ($room->roomImages as $image)
                                        <div class="single-img">
                                            <a href="{{ asset('uploads/rooms/room_details') }}/{{ $image->image_name }}"
                                                class="main-img">
                                                <img class="w-100"
                                                    src="{{ asset('uploads/rooms/room_details') }}/{{ $image->image_name }}"
                                                    alt="Image">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="dots-slider row">
                                        @foreach ($room->roomImages as $image)
                                        <div class="col-lg-3">
                                            <div class="single-dots">
                                                <img class="w-100"
                                                    src="{{ asset('uploads/rooms/room_details') }}/{{ $image->image_name }}"
                                                    alt="Image">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="price-tag">
                                    <p>${{ moneyFormat($room->sale_price) }}
                                        <del class="ml-2 text-secondary">${{ moneyFormat($room->price) }}</del>
                                    </p>
                                </div>
                            </div>
                            <div class="room-cat">
                                <a
                                    href="{{ route('user.category', $room->category->slug) }}">{{ $room->category->name }}</a>
                            </div>
                            <h2 class="entry-title">{{ $room->name }}</h2>
                            <ul class="entry-meta list-inline">
                                <li><i class="far fa-bed"></i>{{ $room->bed }} Bed</li>
                                <li><i class="far fa-bath"></i>{{ $room->bath }} Baths</li>
                                <li><i class="far fa-ruler-triangle"></i>{{ $room->area }} m<sup>2</sup></li>
                            </ul>
                        </div>
                        <div class="room-details-tab">
                            <div class="row">
                                <div class="col-sm-3">
                                    <ul class="nav desc-tab-item" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#desc" role="tab" data-toggle="tab">Room
                                                Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#location" role="tab"
                                                data-toggle="tab">Location</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#reviews" role="tab" data-toggle="tab">Reviews</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-9">
                                    <div class="tab-content desc-tab-content">
                                        <div role="tabpanel" class="tab-pane fade" id="desc">
                                            <h5 class="tab-title">Room Details </h5>
                                            <div class="entry-content">
                                                <p>
                                                    {{ $room->description }}
                                                </p>
                                                <div class="entry-gallery-img">
                                                    <figure class="entry-media-img">
                                                        <img src="{{ asset('uploads/rooms/room_avatar') }}/{{ $room->image }}"
                                                            alt="{{ $room->name }}">
                                                    </figure>
                                                </div>
                                            </div>
                                            <div class="room-specification">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-12">
                                                        <div class="pricing-plan">
                                                            <h4 class="specific-title"> Pricing Plan </h4>
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>Day: </td>
                                                                        <td class="big">$525</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Weak: </td>
                                                                        <td class="big">$1050</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-6">
                                                        <div class="feature">
                                                            <h4 class="specific-title"> Features </h4>
                                                            <ul>
                                                                <li>Gym </li>
                                                                <li>Laundry</li>
                                                                <li>TV Cable</li>
                                                                <li>Pool</li>
                                                                <li>Wi-Fi</li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-4 col-6">
                                                        <div class="facilities">
                                                            <h4 class="specific-title"> Facilities </h4>
                                                            <ul>
                                                                <li>Farmacy </li>
                                                                <li>Free Parking</li>
                                                                <li>Reception</li>
                                                                <li>Security</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="location">
                                            <h5 class="tab-title">Location</h5>
                                            <div id="maps"><iframe
                                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.66656488542!2d105.78299366697445!3d21.04602353116366!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab3b4220c2bd%3A0x1c9e359e2a4f618c!2sB%C3%A1ch%20Khoa%20Aptech!5e0!3m2!1svi!2s!4v1630659498844!5m2!1svi!2s"
                                                    width="570" height="550" style="border:0;" allowfullscreen=""
                                                    loading="lazy"></iframe>
                                            </div>
                                            <div class="room-location">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h6>City</h6>
                                                        <p>Ha Noi, VietNam</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h6>Phone</h6>
                                                        <p>(+84) 292286094</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <h6>Email</h6>
                                                        <p>phamlinh@gmail.com</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade in active show" id="reviews">
                                            <h5 class="tab-title">Reviews</h5>
                                            <div class="reviews-count">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div
                                                            class="count-num d-flex align-items-center justify-content-center">
                                                            <p>Total Rating<span
                                                                    class="my-3">{{ $total_ratings }}</span>
                                                                Stars<span id="rating_avg">6.8</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="reviews-bars">
                                                            <!-- Single bar -->
                                                            <div class="single-bar">
                                                                <p class="bar-title">Service
                                                                    <span>8.0</span>
                                                                </p>
                                                                <div class="bar" data-width="80%">
                                                                    <div class="bar-inner"></div>
                                                                </div>
                                                            </div>
                                                            <!-- Single bar -->
                                                            <div class="single-bar">
                                                                <p class="bar-title">Satisfy
                                                                    <span>6.0</span>
                                                                </p>
                                                                <div class="bar" data-width="60%">
                                                                    <div class="bar-inner"></div>
                                                                </div>
                                                            </div>
                                                            <!-- Single bar -->
                                                            <div class="single-bar">
                                                                <p class="bar-title">Serenity
                                                                    <span>7.0</span>
                                                                </p>
                                                                <div class="bar" data-width="70%">
                                                                    <div class="bar-inner"></div>
                                                                </div>
                                                            </div>
                                                            <!-- Single bar -->
                                                            <div class="single-bar">
                                                                <p class="bar-title">Overall
                                                                    <span>9.0</span>
                                                                </p>
                                                                <div class="bar" data-width="90%">
                                                                    <div class="bar-inner"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-form">
                                                <h5 class="tab-title">Write a Review</h5>
                                                <div class="star-given-box">
                                                    <form id="form-rating" action="{{ route('room_rating') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $room->id }}" name="room_id">
                                                        @if (Auth::check())
                                                        <input type="hidden" value="{{ Auth::user()->id }}"
                                                            name="user_id">
                                                        @endif
                                                        <input type="hidden" id="star-number" name="star">
                                                        <div class="rating-form mb-3">
                                                            <div class="rating-container">
                                                                <div id="rateYo"></div>
                                                                <div class="counter"></div>
                                                            </div>
                                                        </div>
                                                        <div class="input-wrap text-area">
                                                            <textarea name="message" id="message"
                                                                placeholder="Write Review"></textarea>
                                                            <i class="far fa-pencil"></i>
                                                        </div>
                                                        <div class="input-wrap">
                                                            <button type="submit" class="btn btn-block">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            @if (!count($ratings) > 0)
                                            <div class="reviews-head my-5">
                                                <h4 class="tab-title comment-title">There are currently no reviews.
                                                </h4>
                                            </div>
                                            @else
                                            <div class="comment-area">
                                                <div class="reviews-head">
                                                    <h4 class="tab-title comment-title">{{ $total_ratings }}
                                                        Reviews
                                                    </h4>
                                                    <div class="select-filter">
                                                        <select name="order-ratings" id="sort_by">
                                                            <option value="latest">Latest</option>
                                                            <option value="oldest">Oldest</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <ul class="comment-list">
                                                    @foreach ($ratings as $rating)
                                                    <li>
                                                        <div class="comment-author">
                                                            <img src="{{ asset('assets/frontend') }}/img/blog-details/04.jpg"
                                                                alt="reviews">
                                                        </div>
                                                        <div class="comment-desc">
                                                            <h6>{{ $rating->user->name }}<span
                                                                    class="comment-date mx-2">{{ date_format($rating->created_at, 'F d, Y \a\t g:i') }}</span>
                                                            </h6>
                                                            <p>{{ $rating->message }}</p>
                                                            <div class="autor-rating">
                                                                <div class="ratings-full">
                                                                    <span class="ratings"
                                                                        style="width:{{ ($rating->star / 5) * 100 }}%">
                                                                    </span>
                                                                    <span
                                                                        class="tooltiptext tooltip-top">{{ $rating->star }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Sidebars Area -->
                    <div class="sidebar-wrap">
                        <div class="widget booking-widget">
                            <h4 class="widget-title">${{ moneyFormat($room->sale_price) }} / <span>House</span>
                            </h4>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $room->id }}" name="room_id" id="room_id">
                                <div class="input-wrap">
                                    <select id="quantity" name="quantity">
                                        <option value="">Quantity</option>
                                        @foreach (range(1, $room->quantity) as $quantity)
                                        <option value="{{ $quantity }}">{{ $quantity }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-wrap">
                                    <button onclick="addItemToCart()" type="button" class="btn filled-btn btn-block"
                                        id="add-to-cart">
                                        Book now <i class="far fa-long-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="widget category-widget">
                            <h4 class="widget-title">Category</h4>
                            <div class="single-cat bg-img-center"
                                style="background-image: url({{ asset('assets/frontend') }}/img/blog/cat-01.jpg);">
                                <a href="#">Luxury Room</a>
                            </div>
                            <div class="single-cat bg-img-center"
                                style="background-image: url({{ asset('assets/frontend') }}/img/blog/cat-02.jpg);">
                                <a href="#">Couple Room</a>
                            </div>
                            <div class="single-cat bg-img-center"
                                style="background-image: url({{ asset('assets/frontend') }}/img/blog/cat-03.jpg);">
                                <a href="#">Hotel Views</a>
                            </div>
                        </div>
                        <div class="widget banner-widget"
                            style="background-image: url({{ asset('assets/frontend') }}/img/blog/sidebar-banner.jpg);">
                            <h2>Booking Your Latest apartment</h2>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit sed do eiusmod tempor
                                incididunt ut labore </p>
                            <a href="#" class="btn filled-btn">BOOK NOW <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Room Start -->
    <section class="latest-room-d section-bg section-padding">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title text-center">
                <span class="title-top">Latest Rooms</span>
                <h1>Explore Latest Rooms</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Single Room -->
                    <div class="single-room">
                        <div class="room-thumb">
                            <img src="{{ asset('assets/frontend') }}/img/rooms/01.jpg" alt="Room">
                        </div>
                        <div class="room-desc">
                            <div class="room-cat">
                                <p>Guest House</p>
                            </div>
                            <h4><a href="single-room.html">Modern Guest Rooms</a></h4>
                            <p>
                                Avoids pleasure itself, because pleasure,
                                but because those who do not know how
                                to pursue pleasure rationally encounter
                            </p>
                            <ul class="room-info list-inline">
                                <li><i class="far fa-bed"></i>3 Bed</li>
                                <li><i class="far fa-bath"></i>2 Baths</li>
                                <li><i class="far fa-ruler-triangle"></i>72 m</li>
                            </ul>
                            <div class="room-price">
                                <p>$180.00 <del class="ml-2 text-secondary">$230.00</del></p>
                            </div>
                            <div class="room-book float-right">
                                <a href="#">Book now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <!-- Single Room -->
                    <div class="single-room">
                        <div class="room-thumb">
                            <img src="{{ asset('assets/frontend') }}/img/rooms/02.jpg" alt="Room">
                        </div>
                        <div class="room-desc">
                            <div class="room-cat">
                                <p>Meeting Room</p>
                            </div>
                            <h4><a href="single-room.html">Conference Room</a></h4>
                            <p>
                                Great explorer of the truth, the master-
                                builder of human happiness one rejects,
                                dislikes avoids pleasure because
                            </p>
                            <ul class="room-info list-inline">
                                <li><i class="far fa-bed"></i>3 Bed</li>
                                <li><i class="far fa-bath"></i>2 Baths</li>
                                <li><i class="far fa-ruler-triangle"></i>72 m</li>
                            </ul>
                            <div class="room-price">
                                <p>$205.00</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mx-auto">
                    <!-- Single Room -->
                    <div class="single-room">
                        <div class="room-thumb">
                            <img src="{{ asset('assets/frontend') }}/img/rooms/03.jpg" alt="Room">
                        </div>
                        <div class="room-desc">
                            <div class="room-cat">
                                <p>Guest Room</p>
                            </div>
                            <h4><a href="single-room.html">Deluxe Couple Room</a></h4>
                            <p>
                                Provident, similique sunt in culpa qui
                                officia deserunt mollitia animi laborum
                                dolorum fuga. Et harum quidem
                            </p>
                            <ul class="room-info list-inline">
                                <li><i class="far fa-bed"></i>3 Bed</li>
                                <li><i class="far fa-bath"></i>2 Baths</li>
                                <li><i class="far fa-ruler-triangle"></i>72 m</li>
                            </ul>
                            <div class="room-price">
                                <p>$199.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Room End -->
    <!-- Brands section Start -->
    @includeIf('frontend.layouts.brand')
    <!-- ./ Brands section End -->
</main>
@endsection

@section('script-option')
{{-- RateYo JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
    // Rating
        $(function() {
            $("#rateYo").rateYo({
                rating: 3.5,
                halfStar: true,
                starWidth: "35px",
                spacing: "5px",

                multiColor: {
                    "startColor": "#c0392b",
                    "endColor": "#f1c40f"
                },
                onChange: function(rating, rateYoInstance) {
                    $('#star-number').val(rating);
                    $(this).next().text(rating);
                },

            });

            $('.counter').html('3.5');
            $('#star-number').val(3.5);

            // Avg Rating
            $("#rating_avg").html("{{ $rating_avg }}");
        });

        // Add to cart
        function addItemToCart() {
            const child = $("#child").val();
            const adult = $("#adult").val();
            const room_id = $("#room_id").val();
            const quantity = $("#quantity").val();
            const _token = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                type: "POST",
                url: `{{ route('cart.add') }}`,
                data: {
                    room_id: room_id,
                    quantity: quantity,
                    _token: _token,
                },
                success: function(res) {
                    const check = confirm(
                        "Add room to your cart successfully! Do you want to go to cart page?"
                    );
                    if (check) {
                        window.location.replace(`{{ route('cart.show') }}`);
                    }
                },
                error: function(res) {
                    console.log(res);
                },
            });
        }

        // Add rating
        $("#form-rating-off").submit(function(event) {
            event.preventDefault();

            // Call Ajax
            const star = $('input[name="star"]').val();
            const message = $('#message').val();
            const user_id = $('input[name="user_id"]').val();
            const room_id = $('input[name="room_id"]').val();
            const _token = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                type: "POST",
                url: `{{ route('room_rating') }}`,
                data: {
                    room_id: room_id,
                    user_id: user_id,
                    star: star,
                    message: message,
                    _token: _token,
                },
                success: function(res) {
                    console.log(res);
                },
                error: function(res) {
                    console.log(res);
                },
            });
        });

        // Order Rating
        $('#sort_by').change(function(e) {

            const sort_by = $(this).val();

            const _token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "GET",
                datatype: 'html',
                url: `{{ route('sort_ratings') }}`,
                data: {
                    sort_by: sort_by,
                    _token: _token
                },
                success: function(res) {
                    console.log(res);

                    const html = res.html;
                    $('.comment-list').html(html);
                },
                error: function(res) {
                    console.log(res);
                }
            });

        });
</script>
@endsection
