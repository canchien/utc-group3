@extends('layouts.partions.frontend.master')
@section('title')
Yoou
@endsection

@section('css')

<link rel="stylesheet" href="{{ asset('plugins/ion.rangeSlider/css/ion.rangeSlider.min.css') }}" />

@endsection

@section('js')

<script src="{{ asset('plugins/ion.rangeSlider/js/ion.rangeSlider.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // filter with slider
        var priceSlider = $("#priceFilter-slidder");
        priceSlider.ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000000,
            from: 50000,
            to: 200000,
            prettify_enabled: true,
            prettify_separator: ".",
            onFinish: function(data) {
                $('#from').val(data.from);
                $('#to').val(data.to);
                var minPrice = data.from;
                var maxPrice = data.to;
                var id = $('#catId').val();
                console.log(id);
                if (id == undefined) {

                    $.ajax({
                        type: "get",
                        url: "/s/filter",
                        data: {
                            from: minPrice,
                            to: maxPrice,
                        },
                        dataType: "json",
                        success: function(data) {
                            $('.categories_product_area').html(data.html);
                        }
                    });

                } else {


                    $.ajax({
                        type: "get",
                        url: "/sp/filter",
                        data: {
                            from: minPrice,
                            to: maxPrice,
                            id: id,
                        },
                        dataType: "json",
                        success: function(data) {
                            $('.categories_product_area').html(data.html);

                        }
                    });
                }

            },
        });


        // Click on pagination
        //
        $(document).on('click', '.pagination .page-item a', function(e) {
            e.preventDefault();
            var from = $('#from').val();
            var to = $('#to').val();
            var id = $('#catId').val();
            var checkUrl = $(this).attr('href').split('shop');
            var page = 1;
            var data = [];
            if ($(this).attr('href').split(`cat/${id}?`)[1] != undefined || $(this).attr('href').split(`cat/pageAjax?`)[1] != undefined) {
            console.log($(this).attr('href').split(`cat/${id}?`)[1]);
                page = $(this).attr('href').split(`cat/${id}?`)[1] != undefined ? $(this).attr('href').split(`cat/${id}?`)[1].split('page=') : $(this).attr('href').split(`cat/pageAjax?`)[1].split('page=');
                console.log(page);
                $.ajax({
                    type: "get",
                    url: `/cat/pageAjax`,
                    data: {
                        'id': id,
                        'page': page[1],
                    },
                    dataType: "json",
                    success: function (data) {
                        $('.categories_product_area').html(data.html);
                    }
                });
            }
            else if ($(this).attr('href').split('s/filter?')[1] != undefined) {
                page = $(this).attr('href').split('s/filter?')[1].split('page=');
                $.ajax({
                    type: "get",
                    url: "/s/filter",
                    data: {
                        from: from,
                        to: to,
                        page: page[1],
                    },
                    dataType: "json",
                    success: function(data) {
                        $('.categories_product_area').html(data.html);
                    }
                });
            } else if (checkUrl.length > 1) {
                if (checkUrl[1].includes('page=')) {
                    page = checkUrl[1].split('page=')[1];
                    $.ajax({
                        type: "get",
                        url: "/shop/PageAjax",
                        data: {
                            page: page,
                        },
                        dataType: "json",
                        success: function(data) {
                            $('.categories_product_area').html(data.html);
                            
                        }
                    });
                }
            } else {
                var page = $(this).attr('href').split('page=')[1];
                $.ajax({
                    type: "get",
                    url: "/sp/filter",
                    data: {
                        from: from,
                        to: to,
                        page: page,
                        id: id,
                    },
                    dataType: "json",
                    success: function(data) {
                        $('.categories_product_area').html(data.html);
                        
                    }
                });
            }

        });
    });
</script>

@endsection


@section('content')

<!--================Categories Banner Area =================-->
<section class="categories_banner_area">
    <div class="container">
        <div class="c_banner_inner">
            @if(!empty($catId))
            <input type="hidden" value="{{ $catId }}" id="catId">
            <h3>Các sản phẩm thuộc {{ $products[0]->category->name }}</h3>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/cat/{{ $catId }}">{{ $products[0]->category->name }}</a></li>
            </ul>
            @else
            <h3>Tất cả những gì chúng tôi hiện có</h3>
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li><a href="/shop">Shop</a></li>
            </ul>
            @endif
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->


<!--================Categories Product Area =================-->
<section class="categories_product_main p_80">
    <div class="container">
        <div class="categories_main_inner">
            <div class="row row_disable">
                <div class="col-lg-9 float-md-right">
                    <div class="categories_product_area">
                        @include('frontend.product.ajax_product')
                    </div>
                </div>
                <div class="col-lg-3 float-md-right">
                    <div class="categories_sidebar">
                        <aside class="l_widgest l_p_categories_widget">
                            <div class="l_w_title">
                                <h3>danh mục</h3>
                            </div>
                            <ul class="navbar-nav">
                                @foreach($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link" href="/cat/{{ $category->id }}">{{ $category->name }}
                                        <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </aside>
                        <aside class="l_widgest l_fillter_widget">
                            <div class="l_w_title">
                                <h3>Filter section</h3>
                            </div>
                            <div id="priceFilter-slidder"></div>
                            <input type="hidden" name="from" value="" id="from">
                            <input type="hidden" name="to" value="" id="to">

                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Categories Product Area =================-->

@endsection