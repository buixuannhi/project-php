<!DOCTYPE html>
<html lang="en">
<!-- Author: Phạm Ngọc Linh - Date: 9-3-2021 -->

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset('assets/frontend') }}/img/icons/01.png" type="image/x-icon">
    <!-- Font Awesome Css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/all.min.css">
    <!-- Bootstrap version 4.4.1 -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/bootstrap-4.4.1.min.css" />
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/animate.css">
    <!-- magnific popup version 1.1.0 -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/magnific-popup-1.1.0.css">
    <!-- Nice Select  -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/nice-select-1.0.css">
    <!-- meanmenu version 2.0.7 -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/meanmenu-2.0.7.min.css">
    <!-- Slick Version 1.9.0 -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/slick-1.9.0.css" />
    <!-- datetimepicker -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/bootstrap-datepicker.css" />
    <!-- jQuery Ui for price range slide -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/jquery-ui.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/style.css" />
    <!-- Responsive Css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend') }}/css/responsive.css" />

    @yield('css-option')
</head>

<body>
    <!-- Preloader -->
    <div class="loader" id="preLoader">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Sweet Alert-->
    @include('sweetalert::alert')

    <!-- Header Start -->
    @includeIf('frontend.layouts.header')
    <!-- Header End -->
    <!-- Main Wrap start -->
    @yield('content')
    <!-- Main Wrap end -->
    <!-- Footer Start -->
    @includeIf('frontend.layouts.footer')
    <!-- Footer End -->

    <!-- modernizr version 3.6.0 -->
    <script src="{{ asset('assets/frontend') }}/js/modernizr-3.6.0.min.js"></script>
    <!-- jQuery Version 1.12.4 -->
    <script src="{{ asset('assets/frontend') }}/js/jquery-1.12.4.min.js"></script>
    <!-- Proper Version 1.16.0-->
    <script src="{{ asset('assets/frontend') }}/js/popper.min-1.16.0.js"></script>
    <!-- Bootstrap Version 4.4.1 -->
    <script src="{{ asset('assets/frontend') }}/js/bootstrap-4.4.1.min.js"></script>
    <!-- Slick Version 1.9.0 -->
    <script src="{{ asset('assets/frontend') }}/js/slick.min-1.9.0.js"></script>
    <!-- isotope version 3.0.6 -->
    <script src="{{ asset('assets/frontend') }}/js/isotope.pkgd-3.0.6.min.js"></script>
    <!-- MeanMenu version 2.0.7-->
    <script src="{{ asset('assets/frontend') }}/js/meanmenu-2.0.7.min.js"></script>
    <!-- Nice select js version 1.0 -->
    <script src="{{ asset('assets/frontend') }}/js/jquery.nice-select-1.0.min.js"></script>
    <!-- wow js version 1.1.3-->
    <script src="{{ asset('assets/frontend') }}/js/wow-1.1.3.min.js"></script>
    <!-- magnific popup version 1.1.0 -->
    <script src="{{ asset('assets/frontend') }}/js/magnific-popup-1.1.0.min.js"></script>
    <!-- jQuery inview  -->
    <script src="{{ asset('assets/frontend') }}/js/jquery.inview.min.js"></script>
    <!-- Waypoints js version 2.0.3 -->
    <script src="{{ asset('assets/frontend') }}/js/waypoints-2.0.3.min.js"></script>
    <!-- counterup js version 1.0 -->
    <script src="{{ asset('assets/frontend') }}/js/jquery.counterup-1.0.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('assets/frontend') }}/js/bootstrap-datepicker.js"></script>
    <!-- jQuery Ui for price range slide -->
    <script src="{{ asset('assets/frontend') }}/js/jquery-ui.min.js"></script>
    <!-- Google Maps -->
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
    <!-- DateRangePicker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Main JS file -->
    <script src="{{ asset('assets/frontend') }}/js/main.js"></script>

    @yield('script-option')
</body>


</html>
