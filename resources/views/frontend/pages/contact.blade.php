@extends('frontend.layouts.master')

@section('content')

<main>
    <!-- Breadcrumb section -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
        style="background-image: url({{ asset('assets/frontend') }}/img/bg/breadcrumb-02.jpg);">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1>Contact</h1>
                <ul class="list-inline">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><i class="far fa-angle-double-right"></i></li>
                    <li>Contact</li>
                </ul>
            </div>
        </div>
        <h1 class="big-text">
            Contact
        </h1>
    </section>
    <!-- Breadcrumb section End-->
    <!-- Contact Page info Start -->
    <section class="contact-info-section">
        <div class="container">
            <!-- Section Title Start -->
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title">
                        <span class="title-top">Have A Coffee</span>
                        <h1>Don't Hesitate To <br> Contact Us</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <p>
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                        laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                        architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                        aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione
                        voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum
                    </p>
                </div>
            </div>
            <!-- Section Title End -->
            <div class="contact-info-boxes">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-info-box">
                            <div class="contact-icon">
                                <i class="far fa-map-marker-alt"></i>
                            </div>
                            <h4>Address</h4>
                            <p>{{ $info->address }}</p>
                            <input type="hidden" name="map" id="map" value="{{ $info->map }}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="contact-info-box">
                            <div class="contact-icon">
                                <i class="far fa-envelope-open"></i>
                            </div>
                            <h4>Email</h4>
                            <p><a href="">{{ $info->email }}</a></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mx-auto">
                        <div class="contact-info-box">
                            <div class="contact-icon">
                                <i class="far fa-phone"></i>
                            </div>
                            <h4>Phone Us</h4>
                            <p>{{ $info->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Page Info End -->
    <!-- Map -->
    <section class="contact-map" id="contact">
    </section>
    <!-- Map End -->
    <!-- Contact Form -->
    <section class="contact-form">
        <div class="container ">
            <div class="contact-form-wrap section-bg">
                <h2 class="form-title">Send A Message</h2>
                <form action="{{ route('send_message') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="input-wrap">
                                <input type="text" placeholder="Your Full Name" name="name" id="name">
                                <i class="far fa-user-alt"></i>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="input-wrap">
                                <input type="email" placeholder="Your Email" name="email" id="email">
                                <i class="far fa-envelope"></i>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="input-wrap">
                                <input type="text" placeholder="Your Phone Number" name="phone">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="input-wrap text-area">
                                <textarea placeholder="Write Message" name="message"></textarea>
                                <i class="far fa-pencil"></i>
                                @error('message')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn filled-btn">Send Message <i
                                    class="far fa-long-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{-- Brand Session --}}
    @includeIf('frontend.layouts.brand')
</main>

@endsection

@section('script-option')
<!-- Google Maps -->
<script>
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
                document.getElementById("contact"),
                mapProp
            );

            var marker = new google.maps.Marker({
                map: map,
                position: map.getCenter(),
                // position: myCenter,
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
