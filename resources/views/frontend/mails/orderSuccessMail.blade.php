<head>
    <style>
        * {
            font-family: "Poppins", sans-serif;
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1200px;
            }
        }

        .container {
            margin: 0 auto;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }


        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-12,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }

        @media (min-width: 992px) {
            .col-lg-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
        }

        @media (min-width: 768px) {
            .col-md-4 {
                -ms-flex: 0 0 33.333333%;
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
        }

        @media (min-width: 992px) {
            .col-lg-2 {
                -ms-flex: 0 0 16.666667%;
                flex: 0 0 16.666667%;
                max-width: 16.666667%;
            }
        }

        @media (min-width: 992px) {
            .col-lg-3 {
                -ms-flex: 0 0 25%;
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        .col-12 p {
            font-size: 50px;
            letter-spacing: 15px;
        }

        .emty_cart_inner {
            text-align: center;
        }

        .vadu-logo-container {
            width: 25%;
            margin-right: 0;
            text-align: center;
        }

        .vadu-logo-image {
            width: 100%;
        }

        .vadu-logo {
            width: 75px;
            /* margin: 0 auto; */
        }

        .vadu-logo-text {
            letter-spacing: 15px;
            font-size: 2.5em;
            font-variant: small-caps;
            color: #fff;
        }

        .data-table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            padding: 5px 15px;
        }

        /* footer */

        .f_about_widget {
            text-align: center;
        }

        .vadu-logo-text {
            color: #000;
            letter-spacing: 15px;
            font-size: 2.5em;
            font-variant: small-caps;
        }

        .f_about_widget p {
            font-size: 12.98px;
            font-family: "Poppins", sans-serif;
            font-weight: normal;
            color: #999999;
            line-height: 25.95px;
            letter-spacing: .3245px;
            max-width: 270px;
            margin: auto;
            padding: 30px 0px 15px 0px;
        }

        .f_about_widget h6 {
            font-size: 14px;
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            color: #0b1033;
            display: inline-block;
        }

        ul {
            list-style: none;
            margin: 0px;
            padding: 0px;
        }

        .f_about_widget ul {
            display: inline-block;
        }

        .f_w_title {
            padding-bottom: 30px;
        }

        .f_w_title h3 {
            font-size: 18px;
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            color: #0b1033;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }

        .f_w_title h3:before {
            content: "";
            width: 100%;
            height: 1px;
            background: #cccccc;
            position: absolute;
            left: 0px;
            bottom: 0px;
        }

        .link_widget ul li a {
            font-size: 13px;
            line-height: 30px;
            font-family: "Poppins", sans-serif;
            color: #797b7b;
            font-weight: 400;
            -webkit-transition: all 400ms linear 0s;
            -o-transition: all 400ms linear 0s;
            transition: all 400ms linear 0s;
        }

        a {
            text-decoration: none;
        }

        /* end footer */
    </style>
    <!-- Icon css link -->
</head>
<div class="container">
    <div class="row" style="background: #000;">
        <div class="col-12">
            <div class="vadu-logo-image" style="text-align: center;">
                <img class="vadu-logo" src="{{ asset('/frontend/img/mylogo.png') }}" alt="" width="75px">
            </div>
        </div>
    </div>
</div>

<section class="emty_cart_area p_100">
    <div class="container">
        <div class="emty_cart_inner">
            <i class="icon-handbag icons"></i>
            <h3>Xin chào <strong>{{ $order->customerName }}</strong></h3>
            <h3>Cảm ơn bạn đã đặt hàng của chúng tôi !</h3>
            <h4>Đơn hàng của bạn có mã : <a href="{{ asset('/order?order_code='.$order->order_code) }}">{{ $order->order_code }}</a></h4>
        </div>
    </div>
</section>

<section class="container">
    <div class="box">
        <div class="box-title">
            <h4>Thông tin các sản phẩm</h4>
        </div>
        <div class="box-body">
            <table class="data-table">
                @foreach($order->products as $product)
                <tr style="border-bottom: 1px solid #000">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->pivot->productName }}</td>
                    <td>{{ $product->pivot->productQty }}</td>
                    <td>{{ $product->pivot->ProductAmount }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: right; padding-right: 15px;">Tổng tiền sản phẩm</td>
                    <td style="width: 20%; text-align: right;">{{ $order->products()->sum('ProductAmount') }}đ</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right; padding-right: 15px;">Vận chuyển</td>
                    <td style="width: 20%; text-align: right;">30.000đ</td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right; padding-right: 15px;">Tổng tiền</td>
                    <td style="width: 20%; text-align: right;">{{ $order->products()->sum('ProductAmount') + 30000 }}đ</td>
                </tr>
            </table>
        </div>
    </div>
</section>

<footer class="footer_area" style="padding-top: 30px; margin-top: 30px;">
    <div class="container" style="padding-top: 30px;border-top: 1px solid #000;">
        <div class="footer_widgets">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-6">
                    <aside class="f_widget f_about_widget">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="vadu-logo-image">
                                    <img class="vadu-logo" src="{{ asset('frontend/img/mylogo.png') }}" width="75px">
                                </div>
                                <div class="vadu-logo-text">
                                    <span>vadu</span>
                                </div>
                            </div>
                        </div>
                        <p>Tận hưởng những gì tốt nhất</p>
                    </aside>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <aside class="f_widget link_widget f_info_widget">
                        <div class="f_w_title">
                            <h3>Thông tin</h3>
                        </div>
                        <ul>
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Trung tâm trợ giúp</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <aside class="f_widget link_widget f_service_widget">
                        <div class="f_w_title">
                            <h3>Dịch vụ khách hàng</h3>
                        </div>
                        <ul>
                            <li><a href="#">Lịch sử đặt hàng</a></li>
                            
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</footer>