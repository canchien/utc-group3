@extends('layouts.partions.frontend.master')
@section('title')
Yoou
@endsection

@section('css')


@endsection

@section('js')



<script>
    /**
 * Number.prototype.format(n, x)
 *
 * @param integer n: length of decimal
 * @param integer x: length of sections
 */
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};
$(document).ready(function() {
    $(document).on('click', '._remove', function() {
        // Xoá sp khỏi giỏ hàng
        Swal.fire({
            title: 'Warning !',
            text: "Bạn có muốn xoá sản phẩm này khỏi giỏ hàng?!",
            type: 'warning',
            animation: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok !',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.value) {
                // Lấy id sản phẩm
                var productId = $(this).attr('data-id');
                // Lấy ra đối tượng cần xoá trực tiếp trên browser
                var thisRemove = $(this);
                let $totalPrice = $('.total-price'),
                    $productTotalPrice = thisRemove.closest('tr').find('.product-total-price');
                $.ajax({
                    type: "post",
                    url: "/cart/remove",
                    data: {
                        id: productId,
                    },
                    dataType: "json",
                    success: function(data) {
                        // Nếu xoá hết trong giỏ hàng thì trả về giao diện
                        if (data.cart == 'empty') {
                            window.location = '/cart';
                        } else {
                            loadCart();
                            // Load lại tổng tiền
                            let newTotalPrice = parseFloat($totalPrice.attr('data-value')) - parseFloat($productTotalPrice.attr('data-value'));
                            $totalPrice.attr('data-value', newTotalPrice).text(newTotalPrice.format());
                            let newTotalAmount = (parseFloat(newTotalPrice) + 30000).format();
                            $('.total-amount').attr('data-value', newTotalAmount).text(newTotalAmount);
                            // Xoá sp trên trình duyệt
                            console.log(thisRemove.parent().parent().remove());

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000
                            });
                            Toast.fire({
                                type: 'success',
                                title: 'Xoá sản phẩm thành công :)'
                            });
                        }
                    },
                    error: function(data) {
                        var er = data.responseJSON;
                        console.log(er);
                    }
                });
            }
        });
    });

    // Thêm số lượng
    $(document).on('click', '#_plus', function() {
        // Lấy id sp
        var id = $(this).attr('data-id');
        var thisAdd = $(this);
        let $totalPrice = $('.total-price'), $productPrice = thisAdd.closest('tr').find('.product-price');
        let $productTotalPrice = thisAdd.closest('tr').find('.product-total-price');
        console.log(id);
        $.ajax({
            type: "get",
            url: "/addToCard/" + id,
            data: {},
            dataType: "json",
            success: function(data) {
                if (data.updated) {
                    Swal.fire('Số lượng trong kho đã đạt tối đa.');
                    return false;
                }
                loadCart();

                let newTotalPrice = parseFloat($totalPrice.attr('data-value')) + parseFloat($productPrice.attr('data-value'));
                $totalPrice.attr('data-value', newTotalPrice);
                $totalPrice.text(newTotalPrice.format());
                let newTotalAmount = (parseFloat(newTotalPrice) + 30000).format();
                $('.total-amount').attr('data-value', newTotalAmount).text(newTotalAmount);
                if (thisAdd.prev().val() > 0) {
                    console.log(thisAdd.prev().val());
                    thisAdd.prev().val(parseInt(thisAdd.prev().val()) + 1);
                }
                let newProductTotalPrice = thisAdd.prev().val() * parseFloat($productPrice.attr('data-value'));
                $productTotalPrice.attr('data-value', newProductTotalPrice)
                    .text(newProductTotalPrice.format());
            }
        });
    });

    // Xoá số lượng
    $(document).on('click', '#_minus', function () {
        // Lấy id sp
        var id = $(this).attr('data-id');
        var thisMinus = $(this);
        let $totalPrice = $('.total-price'), $productPrice = thisMinus.closest('tr').find('.product-price');
        let $productTotalPrice = thisMinus.closest('tr').find('.product-total-price');

        $.ajax({
            type: "post",
            url: route('minusA_Product'),
            data: {
                "id": id,
            },
            dataType: "json",
            success: function (data) {
                if (data.cart == 'empty') {
                    window.location = '/cart';
                }
                loadCart();
                // (12345.67).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                // Load lại tổng tiền
                let newTotalPrice = parseFloat($totalPrice.attr('data-value')) - parseFloat($productPrice.attr('data-value'));
                $totalPrice.attr('data-value', newTotalPrice);
                $totalPrice.text(newTotalPrice.format());
                let newTotalAmount = (parseFloat(newTotalPrice) + 30000).format();
                $('.total-amount').attr('data-value', newTotalAmount).text(newTotalAmount);
                if (thisMinus.next().val() > 0) {
                    thisMinus.next().val(parseInt(thisMinus.next().val()) - 1);
                }
                let newProductTotalPrice = thisMinus.next().val() * parseFloat($productPrice.attr('data-value'));
                $productTotalPrice.attr('data-value', newProductTotalPrice)
                    .text(newProductTotalPrice.format());

                if (data.is_delete_product) {
                    thisMinus.closest('tr').remove();
                }
            }
        });
    });
});
</script>

@endsection


@section('content')

<!--================Categories Banner Area =================-->
<section class="solid_banner_area">
    <div class="container">
        <div class="solid_banner_inner">
            <h3>Giỏ hàng của bạn</h3>
            {{-- <ul>
                <li><a href="#">Trang chủ</a></li>
                <li><a href="shopping-cart2.html">Giỏ hàng</a></li>
            </ul> --}}
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->


<!--================Shopping Cart Area =================-->
<section class="shopping_cart_area p_100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart_items">
                    <h3>Sản phẩm trong giỏ</h3>
                    <div class="table-responsive-md">
                        <table class="table">
                            <tbody>
                                @if($products)
                                @foreach($products as $product)

                                <tr>
                                    <th scope="row">
                                        <a href="javascript:void(0);" class="_remove"
                                            data-id="{{ $product['item']->id }}" title="Xoá khỏi giỏ hàng">
                                            <img src="{{ asset('frontend/img/close-icon.png') }}" alt="xoá"
                                                style="cursor: pointer;">
                                        </a>
                                    </th>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <a href="{{route('product.showProduct',['id' => $product['item']->id]) }}">
                                                    <img src="/{{ $product['item']->productimages[0]->image }}"
                                                        alt="{{ $product['item']->name }}"
                                                        style="max-width: 64px;max-height: 64px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a href="{{route('product.showProduct',['id' => $product['item']->id]) }}">
                                                    <h4>{{ $product['item']->name }}</h4>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="red product-price" data-value="{{$product['item']->price }}">{{ number_format($product['item']->price) }}</p>
                                    </td>
                                    <td>
                                        <div class="quantity">
                                            <h6>Số lượng</h6>
                                            <div class="custom">
                                                <button id="_minus" data-id="{{ $product['item']->id }}"
                                                    class="reduced items-count" type="button"><i
                                                        class="icon_minus-06"></i></button>
                                                <input readonly type="text" name="qty" id="sst" maxlength="12"
                                                    value="{{ $product['qty'] }}" title="Quantity:"
                                                    class="input-text qty" style="background: #f0f0f0;">
                                                <button id="_plus" data-id="{{ $product['item']->id }}"
                                                    class="increase items-count" type="button"><i
                                                        class="icon_plus"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="product-total-price" data-value="{{ $product['price'] }}">{{ number_format($product['price']) }}</p>
                                    </td>
                                </tr>

                                @endforeach
                                @endif
                                <!-- Empty row -->
                                <tr>
                                    <th scope="row">
                                    </th>
                                </tr>
                                <!-- End empty row -->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart_totals_area">
                    <h4>Tổng quan lại</h4>
                    <div class="cart_t_list">
                        <div class="media">
                            <div class="d-flex">
                                <h5>Tổng tiền</h5>
                            </div>
                            <div class="media-body d-flex">
                                <h6 class="total-price" data-value="{{ $session->totalPrice }}">{{ number_format($session->totalPrice) }}</h6>
                                <h6>&nbsp;vnđ</h6>
                            </div>
                        </div>
                        <div class="media">
                            <div class="d-flex">
                                <h5>Giao hàng: </h5>
                            </div>
                            <div class="media-body">
                                <p>30.000đ trên toàn quốc ! :)</p>
                            </div>
                        </div>

                    </div>
                    <div class="total_amount row m0 row_disable">
                        <div class="float-left">
                            Tổng tiền thanh toán
                        </div>
                        <div class="float-right d-flex">
                            <h6 class="total-amount" data-value="{{ number_format($session->totalPrice + 30000) }}">{{ number_format($session->totalPrice + 30000) }}</h6>
                            <h6>&nbsp;vnđ</h6>
                        </div>
                    </div>
                </div>
                <a href="/checkout" value="submit" class="btn subs_btn form-control">Tiến hành đặt hàng</a>
            </div>
        </div>
    </div>
</section>
<!--================End Shopping Cart Area =================-->

@endsection
