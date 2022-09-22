@extends('layouts.partions.frontend.master')
@section('title')
Yoou
@endsection


@section('css')
<link href="{{ asset('frontend/css/trackTimeline.css') }}" rel="stylesheet">
@endsection

@section('content')
@if($order)
<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Trạng thái đơn hàng</h3>
            <ul>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="/order/{{ $order->order_code }}">Đơn hàng</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->


<!--================Track Area =================-->

<section class="track_area p_100">
    <div class="container">

        <div class="row-middle">
            <div class="col-12 pb-3" style="max-width: 800px;margin: 0 auto;">
                <div class="row pb-3">
                    <div class="col-12">
                        <h5>Họ tên : {{ $order->customerName }}</h5>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-12 d-flex">
                        <h5>Địa chỉ :&nbsp;{{ $order->customerAddress }}</h5>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-12 d-flex">
                        <h5>Trạng thái :&nbsp;</h5>
                        @if( $order->status == 0)
                        <h5 class="text-primary">Đang chờ</h5>
                        @elseif( $order->status == 1)
                        <h5 class="text-success">Đã tiếp nhận</h5>
                        @elseif( $order->status == 2)
                        <h5 class="text-success">Đang giao</h5>
                        @elseif( $order->status == 3)
                        <h5 class="text-success">Đã giao</h5>
                        @elseif( $order->status == 4)
                        <h5 class="text-warning">Hoàn trả</h5>
                        @elseif( $order->status == -1)
                        <h5 class="text-danger">Đã huỷ</h5>
                        @elseif( $order->status == 5)
                        <h5 class="text-danger">Từ chối tiếp nhận</h5>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9 col-sm-12 pb-3">
                        <h5>Ngày đặt : {{ $order->created_at->isoFormat('DD/MM/YYYY') }}</h5>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <a href="{{ $order->status != 0 ? 'javascript:void(0);' : '/huy-bo-don-hang/'.$order->order_code }}" class="{{ $order->status != 0 ? 'text-secondary' : '' }}">Huỷ đơn hàng</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="track_inner">
            <div class="timeline">
                @foreach($order->orderStatuses as $status)
                <div class="entry">
                    <div class="title">
                        <h3>{{ $status->created_at }}</h3>
                    </div>
                    <div class="body">
                        <p>{{ $status->status }}</p>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!--================End Track Area =================-->
@else
<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Không tìm thấy đơn hàng</h3>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="javascript:void(0);">Đơn hàng</a></li>
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
            <h3>Không tìm thấy đơn hàng này trong hệ thống</h3>
            <h4>hãy <a href="/shop/">mua và đặt hàng</a> để có 1 đơn hàng nhé!</h4>
        </div>
    </div>
</section>
<!--================End login Area =================-->
@endif
@endsection