@extends('layouts.partions.frontend.master')
@section('title')
Yoou
@endsection

@section('content')

<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Đặt hàng</h3>
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li><a href="/checkout">Đặt hàng</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->

@if(isset($orderCode))

<section class="emty_cart_area p_100">
    <div class="container">
        <div class="emty_cart_inner">
            <i class="icon-handbag icons"></i>
            <h3>Đặt hàng thành công đơn hàng có mã : <strong>{{ $orderCode }}</strong> </h3>
            <h4>bấm vào <a href="/order?order_code={{ $orderCode }}">đây</a> để xem trạng thái đơn hàng</h4>
        </div>
    </div>
</section>
@else
<!--================Register Area =================-->
<section class="register_area p_100">
    <div class="container">
        <div class="register_inner">
            <div class="row">
                <div class="col-lg-7">
                    <div class="billing_details">
                        <h2 class="reg_title">Thông tin phiếu đặt</h2>
                        <form id="checkOutForm" class="billing_inner row" method="post" action="{{ route('cart.doCheckout') }}">
                            @csrf
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="cusName">Họ tên của bạn <span>*</span></label>
                                    <input name="cusName" type="text" class="form-control" id="cusName" aria-describedby="cusName" placeholder="Nhập tên của bạn" value="{{ old('cusName') }}">
                                    @error('cusName')
                                    <p><strong style="color: red;">{{ $message }}</strong></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="cusEmail">Email <span>*</span></label>
                                    <input name="cusEmail" type="email" class="form-control" id="cusEmail" aria-describedby="cusEmail" pattern="^[a-z][a-z0-9_\.]{2,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$" value="{{ old('cusEmail') }}" placeholder="Nhập email của bạn">
                                    <small id="helpId" class="form-text text-muted pl-3 pr-3 text-light-blue"> &rsaquo; Email bắt đầu bằng chữ cái từ 3 đến 32 ký tự, tên miền có thể là cấp 1 hoặc cấp 2</small>
                                    @error('cusEmail')
                                    <p><strong style="color: red;">{{ $message }}</strong></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="cusPhone">Điện thoại <span>*</span></label>
                                    <input name="cusPhone" type="text" class="form-control" id="cusPhone" aria-describedby="cusPhone" placeholder="Nhập số điện thoại" pattern="((\+84|84|0)[9|3])+([0-9]{8})\b" value="{{ old('cusPhone') }}">
                                    @error('cusPhone')
                                    <p><strong style="color: red;">{{ $message }}</strong></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="cusAddress">Địa chỉ <span>*</span></label>
                                    <input name="cusAddress" type="text" class="form-control" id="cusAddress" aria-describedby="cusAddress" value="{{ old('cusAddress') }}" placeholder="Nhập địa chỉ chính xác của bạn">
                                    @error('cusAddress')
                                    <p><strong style="color: red;">{{ $message }}</strong></p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">Ghi chú</label>
                                    <textarea name="description" class="form-control" id="description" rows="3">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="order_box_price">
                        <h2 class="reg_title">Đơn hàng của bạn</h2>
                        <div class="payment_list">
                            <div class="price_single_cost">
                                @foreach($products->items as $product)
                                <h5>{{ $product['item']->name }} <span>x{{ $product['qty'] }} = {{ $product['price'] }}</span> </h5>

                                @endforeach

                                <h4>Tổng tiền sản phẩm <span>{{ $products->totalPrice }} vnđ</span></h4>
                                <h3><span class="normal_text">Chi phí hoá đơn</span> <span>{{ $products->totalPrice + 30000}} vnđ</span></h3>
                                <small id="helpId" class="form-text text-muted pl-3 pr-3 text-light-blue"> &rsaquo; Đã bao gồm chi phí vận chuyển</small>
                            </div>
                            <div id="accordion" role="tablist" class="price_method">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                                                Thanh toán khi nhận hàng
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            Bạn sẽ chỉ phải trả tiền khi đã nhận và kiểm tra hàng của bạn đặt.
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="submit" value="submit" class="btn subs_btn form-control" onclick="event.preventDefault();
                        document.getElementById('checkOutForm').submit();
                        ">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Register Area =================-->
@endif
@endsection