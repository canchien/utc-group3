@extends('layouts.partions.frontend.master')
@section('title')
Yoou
@endsection

@section('js')
@endsection

@section('content')

<!--================Categories Banner Area =================-->
<section class="categories_banner_area">
    <div class="container">
        <div class="c_banner_inner">
            <h3>{{ $product->name }}</h3>
            <ul>
                <li><a href="/">Trang chủ</a></li>
                <li><a href="/cat/{{ $product->category_id }}">{{ $product->category->name }}</a></li>
                <li class="current"><a href="javascript:void(0)">{{ $product->name }}</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->
<!--================Product Details Area =================-->
<section class="product_details_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="product_details_slider">
                    <div id="product_slider" class="rev_slider" data-version="5.3.1.6">
                        <ul>
                            <!-- SLIDE  -->
                            @if ($product->productimages()->where('status',
                            1)->orderBy('created_at','desc')->take(3)->get())
                            @foreach ($product->productimages()->where('status',
                            1)->orderBy('created_at','desc')->take(3)->get() as $image)
                            <li data-transition="scaledownfrombottom" data-slotamount="7" data-easein="Power3.easeInOut"
                                data-easeout="Power3.easeInOut" data-masterspeed="1500"
                                data-thumb="/storage/uploads/{{ $image->image }}" data-rotate="0" data-fstransition="fade">
                                <!-- MAIN IMAGE -->
                                <img src="/storage/uploads/{{ $image->image }}" alt="" data-bgposition="center center"
                                    data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg"
                                    data-no-retina>
                                <!-- LAYERS -->
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="product_details_text">
                    <div class="l_p_img">
                        <a href="/san-pham/{{ $product->id }}">
                            <img style="width: 500px; height: 500px" src="/{{ $product->productimages[0]->image }}" alt="{{ $product->productimages[0]->image }}">
                        </a>
                    </div>
                    <h3 class="mt-2">{{ $product->name }}</h3>
                    <h6>Còn <span>{{ $product->qty }}</span> sản phẩm</h6>
                    <input type="number" hidden id="maxQty" value="{{ $product->qty }}">
                    <h4>{{ number_format($product->price) }} đ</h4>
                    <div class="quantity">
                        <div class="custom">
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                class="reduced items-count" type="button"><i class="icon_minus-06"></i></button>
                            <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:"
                                class="input-text qty">
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                class="increase items-count" type="button"><i class="icon_plus"></i></button>
                        </div>
                        <a class="add_cart_btn" data-id="{{ $product->id }}" href="javascript:void(0)">Thêm vào giỏ
                            hàng</a>
                    </div>
                    <div class="shareing_icon">
                        <h5>Chia sẻ :</h5>
                        <ul>
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ asset('') }}san-pham/{{ $product->id }}" target="_blank"><i class="social_facebook"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Details Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <nav class="tab_menu">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                    aria-controls="nav-home" aria-selected="true" style="padding-left: 25px;">Mô tả sản phẩm</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                    aria-controls="nav-contact" aria-selected="false" style="padding-left: 25px;">Từ khoá</a>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                {!! $product->description !!}
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <p>{{ $product->keyword }}</p>
            </div>
        </div>
    </div>
</section>
@endsection
