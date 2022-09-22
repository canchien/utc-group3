@extends('layouts.partions.frontend.master')
@section('title')
Yoou
@endsection

@section('content')

<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Tình trạng đơn hàng</h3>
            <ul>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="/order/{{ $orderCode }}">{{ $orderCode }}</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->

<!--================login Area =================-->

<!--================End login Area =================-->

@endsection
