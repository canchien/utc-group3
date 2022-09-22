@extends('layouts.partions.frontend.master')
@section('title')
Yoou - tìm kiếm đơn hàng
@endsection

@section('content')

<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Tìm kiếm đơn hàng</h3>
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li><a href="/order-search/">Đơn hàng</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->

<!--================Track Area =================-->
<section class="track_area p_100">
    <div class="container">
        <div class="track_inner">
            <div class="track_title">
                <h2>Tìm kiếm đơn hàng của bạn</h2>
                <p> Vui lòng nhập mã đơn hàng để chúng tôi có thể phục vụ bạn </p>
            </div>
            <form class="track_form row" action="{{ route('doOrderSearch') }}" method="get">
                @csrf
                <div class="col-lg-12 form-group">
                    <label for="order_code">Mã đơn hàng</label>
                    <input name="order_code" class="form-control" type="text" id="order_code">
                </div>
                <div class="col-lg-12 form-group">
                    <button type="submit" value="submit" class="btn subs_btn form-control">Tìm kiếm</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!--================End Track Area =================-->

@endsection