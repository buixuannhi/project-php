<!DOCTYPE html>
<html lang="en">
<!-- Author: Phạm Ngọc Linh - Date: 9-3-2021 -->

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <!-- Font Awesome Css -->
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/all.min.css">
    <!-- Bootstrap version 4.4.1 -->
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/bootstrap-4.4.1.min.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/style.css" />
    <!-- Responsive Css -->
    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/responsive.css" />
</head>

<body>
    <!-- preloader -->
    <div class="loader" id="preLoader">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Main Wrap start -->
    @yield('content')
    <!-- Main Wrap end -->
    <!-- jQuery Version 1.12.4 -->
    <script src="{{asset('assets/frontend')}}/js/jquery-1.12.4.min.js"></script>
    <!-- Proper Version 1.16.0-->
    <script src="{{asset('assets/frontend')}}/js/popper.min-1.16.0.js"></script>
    <!-- Bootstrap Version 4.4.1 -->
    <script src="{{asset('assets/frontend')}}/js/bootstrap-4.4.1.min.js"></script>
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
    <!-- Main JS file -->
    <script src="{{asset('assets/frontend')}}/js/main.js"></script>
</body>


</html>
