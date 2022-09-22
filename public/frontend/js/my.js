$(document).ready(function() {
    var cloned = $('.owl-stage').children('.cloned');

    $(document).on('click', '.add_cart_btn', function() {

        var productQtyInput = $(this).prev().children('input').val();
        var id = $(this).attr('data-id');
        let $maxQty = $('#maxQty'),
            maxQty = null;
        if ($maxQty.length > 0) {
            maxQty = parseInt($maxQty.val());
        }
        // Nếu thêm vào giỏ ở trên trang thông tin sản phẩm
        if (productQtyInput == undefined) {
            $.ajax({
                type: "get",
                url: "/addToCard/" + id,
                data: {},
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });
                    Toast.fire({
                        type: 'success',
                        title: 'Thêm vào giỏ hàng thành công :)'
                    });

                    loadCart();

                },
                error: function(data) {
                    var er = data.responseJSON;
                    console.log(er);
                }
            });
        } else if (productQtyInput <= 0 || isNaN(parseInt(productQtyInput))) {
            Swal.fire({
                title: 'Hãy chọn số lượng hợp lệ nhoé !',
                type: 'info',
                animation: false,
                customClass: {
                    popup: 'animated tada'
                },
            });
        } else if (maxQty == null || productQtyInput > maxQty) {
            Swal.fire({
                title: 'Số lượng sản phẩm mua lớn hơn số lượng sản phẩm hiện có!',
                type: 'info',
                animation: false,
                customClass: {
                    popup: 'animated tada'
                },
            });
        } else {
            $.ajax({
                type: "get",
                url: "/addToCard/" + id,
                data: {
                    "qty": parseInt(productQtyInput),
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });
                    Toast.fire({
                        type: 'success',
                        title: 'Thêm vào giỏ hàng thành công :)'
                    });
                    loadCart();
                },
                error: function(data) {
                    var er = data.responseJSON;
                    console.log(er);
                }
            });
        }
    });
});

function loadCart() {
    $.ajax({
        type: "get",
        url: "/getTotalQty",
        data: {},
        dataType: "json",
        success: function(data) {
            var dataContent = data.totalQty;
            $('a.cart').attr('data-content', dataContent);
            $('a.cart').attr('title', 'Có ' + dataContent + ' sản phẩm trong giỏ hàng của bạn');

        }
    });
}