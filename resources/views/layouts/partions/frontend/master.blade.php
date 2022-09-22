<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Page Icon -->
    <link rel="icon" href="{{ asset('frontend/img/mylogo.png') }}" type="image/x-icon" />
    <title>@yield('title')</title>
    <!-- Css -->
    @include('layouts.partions.frontend.components.css')
</head>

<body class="home_sidebar">

    <!--================Menu Area =================-->
    @include('layouts.partions.frontend.components.header')
    <!--================End Menu Area =================-->

    <!-- Main Content -->
    @yield('aside')
    @yield('content')
    <!-- End content -->

    <!--================World Wide Service Area =================-->
    <section class="world_service">
        <div class="container">
            <div class="world_service_inner">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="world_service_item">
                            <h4><img src="{{ asset('frontend/img/icon/world-icon-2.png') }}" alt="">Hỗ trợ liên tục</h4>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="world_service_item">
                            <h4><img src="{{ asset('frontend/img/icon/world-icon-3.png') }}" alt="">Giao dịch an toàn</h4>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="world_service_item">
                            <h4><img src="{{ asset('frontend/img/icon/world-icon-4.png') }}" alt="">Giao hàng nhanh chóng</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End World Wide Service Area =================-->


    <!--================Footer Area =================-->
    @include('layouts.partions.frontend.components.footer')
    <!--================End Footer Area =================-->
    <!-- Js -->
    @include('layouts.partions.frontend.components.js')
</body>
