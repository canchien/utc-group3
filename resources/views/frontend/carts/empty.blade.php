@extends('layouts.partions.frontend.master')
@section('title')
Yoou - Giỏ hàng trống
@endsection

@section('content')

<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Giỏ hàng trống</h3>
            <ul>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="/cart/">Giỏ hàng</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->

<!--================login Area =================-->
<section class="emty_cart_area p_100">
    <div class="container">
        <div class="emty_cart_inner">
            <i class="icon-handbag icons"></i>
            <h3>Giỏ hàng của bạn không có sản phẩm nào cả</h3>
            <h4>tiếp tục <a href="/shop/">mua hàng</a></h4>
        </div>
    </div>
</section>
<!--================End login Area =================-->
@endsection
